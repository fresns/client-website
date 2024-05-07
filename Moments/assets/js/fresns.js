/*!
 * Fresns (https://fresns.org)
 * Copyright 2021-Present Jevan Tang
 * Licensed under the Apache-2.0 license
 */

/* Fresns Token */
$.ajaxSetup({
    headers: {
        Accept: 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});

// utc timezone
const cookieTimezone = Cookies.get('fresns_timezone');
if (!cookieTimezone) {
    const now = new Date();
    const timezoneOffsetInHours = now.getTimezoneOffset() / -60;
    const fresnsTimezone = (timezoneOffsetInHours > 0 ? '+' : '') + timezoneOffsetInHours.toString();
    const cookieMinutes = 30 / 1440;

    console.log('cookie', 'fresns_timezone', fresnsTimezone);
    Cookies.set('fresns_timezone', fresnsTimezone, { expires: cookieMinutes });
}

// bootstrap Tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    var title = tooltipTriggerEl.getAttribute('title') || tooltipTriggerEl.getAttribute('data-bs-title');

    if (title) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    }
});

// set timeout toast hide
const setTimeoutToastHide = () => {
    $('.toast.show').each((k, v) => {
        setTimeout(function () {
            let errorCode = $(v).data('errorCode');

            if (errorCode == 36104 || errorCode == 38200) {
                return;
            }

            $(v).hide();
        }, 1500);
    });
};

// fs_lang
window.fs_lang = function (key, replace = {}) {
    let translation = key.split('.').reduce((t, i) => {
        if (!t.hasOwnProperty(i)) {
            return key;
        }
        return t[i];
    }, window.translations || []);

    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }

    return translation;
};

// tips
window.tips = function (message, code = 200) {
    siteName = window.siteName ?? 'Tip';
    siteIcon = window.siteIcon ?? '/static/images/icon.png';

    if (code == 0 || code == 200) {
        apiCode = '';
    } else {
        apiCode = code;
    }

    if (code == 36104) {
        apiMessage = `${message}
            <div class="mt-2 pt-2 border-top">
                <a class="btn btn-primary btn-sm" href="/me/settings" role="button">
                    ${fs_lang('settingAccount')}
                </a>
            </div>`;
    } else if (code == 38200) {
        apiMessage = `${message}
            <div class="mt-2 pt-2 border-top">
                <a class="btn btn-primary btn-sm" href="/me/drafts" role="button">
                    ${fs_lang('view')}
                </a>
            </div>`;
    } else {
        apiMessage = message;
    }

    let html = `<div aria-live="polite" aria-atomic="true" class="position-fixed top-50 start-50 translate-middle" style="z-index:2048">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="${siteIcon}" width="20px" height="20px" class="me-2">
                <strong class="me-auto">${siteName}</strong>
                <small>${apiCode}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">${apiMessage}</div>
        </div>
    </div>`;

    $('div.fresns-tips').prepend(html);

    // tip toast time
    if (code == 36104 || code == 38200) {
        return;
    }

    setTimeoutToastHide();
};

// copy url
function copyToClipboard(element) {
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val($(element).text()).select();
    document.execCommand('copy');
    $temp.remove();
    tips(fs_lang('copySuccess'));
}

// download file
function downloadFile(url, fileName, mimeType) {
    const currentDomain = window.location.origin;
    const fileDomain = new URL(url).origin;

    if (currentDomain !== fileDomain) {
        window.open(url);
        return;
    }

    $('#loading').hide();

    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'blob';
    xhr.onload = function () {
        if (xhr.status === 200) {
            const blob = xhr.response;
            const a = document.createElement('a');
            a.style.display = 'none';
            document.body.appendChild(a);
            const url = window.URL.createObjectURL(blob);
            a.href = url;
            a.download = fileName;
            a.type = mimeType;

            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
            $('#loading').hide();
        }
    };
    xhr.send();
}

// comment box
function showReply(fresnsReply) {
    if (fresnsReply.hasClass('show')) {
        fresnsReply.hide();
        fresnsReply.removeClass('show');
    } else {
        fresnsReply.addClass('show');
        fresnsReply.show();
    }
}

// at and hashtag
function atwho() {
    // Debounce function to limit the rate of API calls
    function debounce(func, delay) {
        let debounceTimer;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }

    if (window.mentionStatus) {
        $('.editor-content').atwho({
            at: '@',
            displayTpl:
                '<li><img src="${image}" height="20" width="20"/> ${name} <small class="text-muted">@${fsid}</small></li>',
            insertTpl: '${atwho-at}${fsid}',
            searchKey: 'searchQuery',
            callbacks: {
                remoteFilter: debounce(function (query, callback) {
                    if (query) {
                        $.get(
                            '/api/theme/actions/api/fresns/v1/common/input-tips',
                            { type: 'user', key: query },
                            function (data) {
                                const list = data.data;
                                list.map((item) => (item.searchQuery = item.name + item.fsid));
                                callback(list);
                            },
                            'json'
                        );
                    }
                }, 300), // Debounce time is 300 milliseconds
            },
        });
    }

    if (window.hashtagStatus) {
        $('.editor-content').atwho({
            at: '#',
            displayTpl: '<li> ${name} </li>',
            insertTpl: window.hashtagFormat == 1 ? '${atwho-at}${name}' : '${atwho-at}${name}${atwho-at}',
            callbacks: {
                remoteFilter: debounce(function (query, callback) {
                    if (query) {
                        $.get(
                            '/api/theme/actions/api/fresns/v1/common/input-tips',
                            { type: 'hashtag', key: query },
                            function (data) {
                                const list = data.data;
                                callback(list);
                            },
                            'json'
                        );
                    }
                }, 300), // Debounce time is 300 milliseconds
            },
        });
    }
}

// build ajax and submit
window.buildAjaxAndSubmit = function (url, body, succeededCallback, failedCallback, completeCallback = null) {
    $.ajax({
        type: 'POST',
        url: url,
        data: body,
        error: function (e) {
            typeof failedCallback == 'function' && failedCallback(e);
        },
        success: function (e) {
            typeof succeededCallback == 'function' && succeededCallback(e);
        },
        complete: function (e) {
            typeof completeCallback == 'function' && completeCallback(e);
        },
    });
};

(function ($) {
    // tip toast time
    setTimeoutToastHide();

    // at and hashtag
    atwho();

    // loading
    $(document).on('click', 'a', function (e) {
        var href = $(this).attr('href');
        var loading = $(this).data('loading');

        if (href && !href.startsWith('javascript:') && href !== '#' && loading !== 'false') {
            if ((href.indexOf(location.hostname) !== -1 || href[0] === '/') && $(this).attr('target') !== '_blank') {
                $('#loading').show();
            }
        }
    });
    $(window).on('load', function () {
        $('#loading').hide();
    });
    window.addEventListener('pageshow', function () {
        $('#loading').hide();
    });
    window.addEventListener('visibilitychange', function () {
        // android compatible
        $('#loading').hide();
    });

    // image zoom
    const fancybox = $('[data-fancybox]');
    if (fancybox) {
        Fancybox.bind('[data-fancybox]', {
            loop: true,
        });
    }

    // video play
    var videos = document.getElementsByTagName('video');
    for (var i = videos.length - 1; i >= 0; i--) {
        (function () {
            var p = i;
            videos[p].addEventListener('play', function () {
                pauseAll(p);
            });
        })();
    }
    function pauseAll(index) {
        for (var j = videos.length - 1; j >= 0; j--) {
            if (j != index) videos[j].pause();
        }
    }

    // jquery extend
    $.fn.extend({
        insertAtCaret: function (myValue) {
            var $t = $(this)[0];
            if (document.selection) {
                this.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            } else if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
            } else {
                this.value += myValue;
                this.focus();
            }
        },
    });

    // comment box
    $('.fresns-trigger-reply').on('click', function () {
        var fresnsReply = $(this).parent().next();
        showReply(fresnsReply);
    });

    $('.fresns-reply .btn-close').on('click', function () {
        var fresnsReply = $(this).parent().parent();
        showReply(fresnsReply);
    });

    // file download and users
    $('.fresns-file-users').on('click', function () {
        var fid = $(this).data('fid');
        if (!fid) {
            tips(fs_lang('errorNoInfo'));
            return;
        }

        var modal = $(this).next('.modal');

        $(modal).find('.file-download-user').parent().css('display', 'none');
        $(modal).find('.file-download-user .text-muted').css('display', 'none');

        $.ajax({
            method: 'get',
            url: `/api/theme/actions/api/fresns/v1/common/file/${fid}/users`,
            success: function (res) {
                if (res.code != 0) {
                    tips(res.message, res.code);

                    return;
                }

                if (!res.data || res.data.list.length <= 0) {
                    $(modal).find('.file-download-user .file-user-list').html('');
                    return;
                }
                if (res.data && res.data.pagination.total > 30) {
                    $(modal).find('.file-download-user .text-muted').css('display', 'block');
                }

                var html = '';
                var item = null;
                for (var i = 0; i < res.data.list.length; i++) {
                    item = res.data.list[i];

                    html += `<img src="${item.user.avatar}" alt="${item.user.username}" class="rounded-circle">`;
                }

                $(modal).find('.file-download-user .file-user-list').html(html);
                $(modal).find('.file-download-user').parent().css('display', 'block');
            },
        });
    });

    $('.fresns-file-download').on('click', function (e) {
        e.stopPropagation();
        let button = $(this),
            url = button.data('url'),
            name = button.data('name'),
            mime = button.data('mime');

        button.prop('disabled', true);
        button.prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');

        $.ajax({
            method: 'get',
            url: url,
            success: function (res) {
                if (res.code != 0) {
                    tips(res.message, res.code);

                    return;
                }

                downloadFile(res.data.link, name, mime);
            },
            complete: function (e) {
                tips(e.responseJSON.message, e.responseJSON.code);

                button.prop('disabled', false);
                button.find('.spinner-border').remove();
                $('#loading').hide();
            },
        });
    });

    // show loading spinner while processing a form
    // https://getbootstrap.com/docs/5.1/components/spinners/
    $(document).on('submit', 'form', function () {
        var btn = $(this).find('button[type="submit"]');
        btn.prop('disabled', true);
        if (btn.children('.spinner-border').length == 0) {
            btn.prepend(
                '<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> '
            );
        }
        btn.children('.spinner-border').removeClass('d-none');
    });

    // quick publish
    $('.form-quick-publish').submit(function (e) {
        e.preventDefault();

        const actionUrl = $(this).attr('action'),
            methodType = $(this).attr('method') || 'POST',
            data = new FormData($(this)[0]),
            btn = $(this).find('button[type="submit"]');

        $.ajax({
            url: actionUrl,
            type: methodType,
            data: data, // serializes the form's elements.
            processData: false,
            cache: false,
            contentType: false,
            success: function (res) {
                tips(res.message, res.code);
                if (res.code != 0) {
                    return;
                }
                window.location.reload();
            },
            complete: function (e) {
                btn.prop('disabled', false);
                btn.find('.spinner-border').remove();
            },
        });
    });

    // fs mark ajax submit
    $(document).on('click', '.fs-mark', function (e) {
        e.preventDefault();
        let obj = $(this);
        obj.prop('disabled', true);
        obj.prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');

        let form = obj.closest('form');

        const url = form.attr('action'),
            body = form.serialize(),
            markType = form.find('input[name="markType"]').val(),
            count = obj.find('.show-count').text(),
            text = obj.find('.show-text'),
            id = obj.data('id'),
            collapseId = obj.data('collapse-id'),
            bi = obj.data('bi'),
            icon = obj.data('icon'),
            iconActive = obj.data('icon-active'),
            interactionActive = obj.data('interaction-active') || 0;

        let markBtn = obj;
        if (id) {
            markBtn = $('#' + id);
        }

        window.buildAjaxAndSubmit(
            url,
            body,
            function (e) {
                if (e.code != 0) {
                    tips(e.message, e.code);
                    return;
                }

                if (interactionActive) {
                    obj.data('interaction-active', 0);
                } else {
                    obj.data('interaction-active', 1);
                }

                if (iconActive) {
                    markBtn.find('img').attr('src', interactionActive == 0 ? iconActive : icon);
                    if (interactionActive) {
                        markBtn.removeClass('btn-active');
                    } else {
                        markBtn.addClass('btn-active');
                    }
                }

                if (count) {
                    if (interactionActive) {
                        markBtn.find('.show-count').text(parseInt(count) - 1);
                    } else {
                        markBtn.find('.show-count').text(parseInt(count) + 1);
                    }
                }

                if (text) {
                    const isFollowOrBlock = markType === 'follow' || markType === 'block';

                    if (isFollowOrBlock && interactionActive) {
                        markBtn.find('.show-text').text(markBtn.data('name'));
                    } else {
                        markBtn.find('.show-text').text('√ ' + markBtn.data('name'));
                    }
                }

                if (bi) {
                    markBtn.find('i').removeClass();
                    markBtn.find('i').addClass(bi);

                    if (interactionActive) {
                        markBtn.hasClass('btn')
                            ? markBtn.removeClass('btn-success').addClass('btn-outline-success')
                            : markBtn.removeClass('text-success');
                    } else {
                        markBtn.hasClass('btn')
                            ? markBtn.addClass('btn-success').removeClass('btn-outline-success')
                            : markBtn.addClass('text-success');
                    }
                }

                markType === 'like' ? markBtn.addClass('btn-pre') : markBtn.removeClass('btn-pre');

                if (collapseId) {
                    $('#' + collapseId).collapse('hide');
                }

                if (markType == 'like') {
                    let formObj = form.parent().find('form')[1];
                    let likeOrDislikeObj;
                    if (formObj && formObj !== form[0]) {
                        likeOrDislikeObj = $(formObj).find('.fs-mark');
                    } else {
                        likeOrDislikeObj = $(form.parent().parent().find('form')[1]).find('.fs-mark');
                    }
                    const likeOrDislikeObjInteractionActivate = likeOrDislikeObj.data('interaction-active') || 0;
                    const likeOrDislikeObjCount = likeOrDislikeObj.find('.show-count').text();

                    if (likeOrDislikeObjCount) {
                        if (likeOrDislikeObjInteractionActivate) {
                            likeOrDislikeObj.find('.show-count').text(parseInt(likeOrDislikeObjCount) - 1);
                            likeOrDislikeObj.data('interaction-active', 0);
                        }
                    }

                    const likeOrDislikeObjBi = likeOrDislikeObj.data('bi');
                    if (likeOrDislikeObjBi) {
                        likeOrDislikeObj.find('i').removeClass();
                        likeOrDislikeObj.find('i').addClass(likeOrDislikeObjBi);
                        likeOrDislikeObj.hasClass('btn')
                            ? likeOrDislikeObj.removeClass('btn-success').addClass('btn-outline-success')
                            : likeOrDislikeObj.removeClass('text-success');
                    } else {
                        const likeOrDislikeObjIconActive = likeOrDislikeObj.data('icon-active');
                        const likeOrDislikeObjIcon = likeOrDislikeObj.data('icon');

                        if (likeOrDislikeObjIconActive && likeOrDislikeObjInteractionActivate) {
                            likeOrDislikeObj
                                .find('img')
                                .attr(
                                    'src',
                                    likeOrDislikeObjInteractionActivate == 0
                                        ? likeOrDislikeObjIconActive
                                        : likeOrDislikeObjIcon
                                );
                            likeOrDislikeObj.hasClass('btn')
                                ? likeOrDislikeObj.removeClass('btn-active')
                                : likeOrDislikeObj.removeClass('text-success');
                        }
                    }
                } else if (markType == 'dislike') {
                    let formObj = form.parent().find('form')[0];
                    let likeOrDislikeObj;
                    if (formObj && formObj !== form[0]) {
                        likeOrDislikeObj = $(formObj).find('.fs-mark');
                    } else {
                        likeOrDislikeObj = $(form.parent().parent().find('form')[0]).find('.fs-mark');
                    }
                    const likeOrDislikeObjInteractionActivate = likeOrDislikeObj.data('interaction-active') || 0;
                    const likeOrDislikeObjCount = likeOrDislikeObj.find('.show-count').text();

                    if (likeOrDislikeObjCount) {
                        if (likeOrDislikeObjInteractionActivate) {
                            likeOrDislikeObj.find('.show-count').text(parseInt(likeOrDislikeObjCount) - 1);
                            likeOrDislikeObj.data('interaction-active', 0);
                        }
                    }

                    const likeOrDislikeObjBi = likeOrDislikeObj.data('bi');
                    if (likeOrDislikeObjBi) {
                        likeOrDislikeObj.find('i').removeClass();
                        likeOrDislikeObj.find('i').addClass(likeOrDislikeObjBi);
                        likeOrDislikeObj.hasClass('btn')
                            ? likeOrDislikeObj.removeClass('btn-success').addClass('btn-outline-success')
                            : likeOrDislikeObj.removeClass('text-success');
                    } else {
                        const likeOrDislikeObjIconActive = likeOrDislikeObj.data('icon-active');
                        const likeOrDislikeObjIcon = likeOrDislikeObj.data('icon');

                        if (likeOrDislikeObjIconActive && likeOrDislikeObjInteractionActivate) {
                            likeOrDislikeObj
                                .find('img')
                                .attr(
                                    'src',
                                    likeOrDislikeObjInteractionActivate == 0
                                        ? likeOrDislikeObjIconActive
                                        : likeOrDislikeObjIcon
                                );
                            likeOrDislikeObj.hasClass('btn')
                                ? likeOrDislikeObj.removeClass('btn-active')
                                : likeOrDislikeObj.removeClass('text-success');
                        }
                    }
                }

                tips(e.message, e.code);
            },
            function (e) {
                tips(e.responseJSON.message, e.responseJSON.code);
            },
            function (e) {
                obj.prop('disabled', false);
                obj.children('.spinner-border').remove();
            }
        );
    });

    // api request link
    $(document).on('click', '.api-request-link', function (e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        $(this).prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');

        const actionUrl = $(this).data('action'),
            methodType = $(this).data('method') || 'POST',
            fsid = $(this).data('fsid'),
            data = $(this).data('body') || {},
            btn = $(this);

        $.ajax({
            url: actionUrl,
            type: methodType,
            data: data,
            success: function (res) {
                if (res.code == 0) {
                    if (fsid) {
                        if (
                            $('#' + fsid)
                                .next()
                                .prop('nodeName') === 'HR'
                        ) {
                            $('#' + fsid)
                                .next()
                                .remove();
                        }
                        $('#' + fsid).remove();

                        return;
                    }

                    window.location.reload();
                }

                tips(res.message, res.code);
            },
            complete: function (e) {
                btn.prop('disabled', false);
                btn.find('.spinner-border').remove();
            },
        });
    });

    // api request form
    $('.api-request-form').submit(function (e) {
        e.preventDefault();
        let form = $(this),
            btn = $(this).find('button[type="submit"]');

        const actionUrl = form.attr('action'),
            methodType = form.attr('method') || 'POST',
            data = form.serialize();

        $.ajax({
            url: actionUrl,
            type: methodType,
            data: data,
            success: function (res) {
                tips(res.message, res.code);
                if (res.code == 0) {
                    window.location.reload();
                }
            },
            complete: function (e) {
                btn.prop('disabled', false);
                btn.find('.spinner-border').remove();
            },
        });
    });

    // User Settings
    $('#editModal.user-edit').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget),
            label = button.data('label'),
            name = button.data('name'),
            desc = button.data('desc') ?? '',
            type = button.data('type'),
            inputTips = button.data('input-tips'),
            option = button.data('option'),
            action = button.data('action'),
            value = button.data('value') ?? '';

        $(this).find('.modal-title').empty().html(label);
        $(this).find('form').attr('action', action);
        $(this)
            .find('.modal-footer button[type="submit"]')
            .data('targe-type', type ?? 'input')
            .data('targe-name', name);

        let html = '';
        switch (type) {
            case 'select':
                html = `
                <div class="input-group has-validation">
                    <label class="input-group-text border-end-rounded-0">${label}</label>
                    <select class="form-select" name="${name}">`;
                $(option).each(function (k, v) {
                    let selected = value == v.id ? 'selected' : '';
                    html += `<option ` + selected + ` value="` + v.id + `">` + v.text + `</option>`;
                });
                html += `
                    </select>
                </div>`;
                break;
            case 'textarea':
                html = `
                <div class="input-group has-validation">
                    <span class="input-group-text border-end-rounded-0">${label}</span>
                    <textarea class="form-control ${inputTips}" name="${name}" rows="5">${value}</textarea>
                </div>`;
                break;
            case 'date':
                html = `
                <div class="input-group has-validation">
                    <span class="input-group-text border-end-rounded-0">${label}</span>
                    <input type="date" class="form-control" name="${name}" value="${value}" required>
                </div>`;
                break;
            default:
                html = `
                <div class="input-group has-validation">
                    <span class="input-group-text border-end-rounded-0">${label}</span>
                    <input type="text" class="form-control" name="${name}" value="${value}" required>
                </div>
                <div class="form-text">${desc}</div>`;
                break;
        }
        $(this).find('.modal-body').empty().html(html);

        // at and hashtag
        atwho();
    });

    // Upload Avatar
    $('#uploadAvatar').on('change', function (e) {
        let formData = new FormData(),
            token = $('meta[name="csrf-token"]').attr('content'),
            obj = $(this),
            uidOrUsername = obj.data('user-fsid');

        obj.prop('disabled', true);
        obj.prev().prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');

        formData.append('file', obj[0].files[0]);
        formData.append('_token', token);
        formData.append('usageType', 'userAvatar');
        formData.append('usageFsid', uidOrUsername);
        formData.append('type', 'image');

        $.ajax({
            url: '/api/theme/actions/api/fresns/v1/common/file/upload',
            type: 'POST',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.code !== 0) {
                    tips(res.message, res.code);
                    return;
                }

                window.location.reload();
            },
            error: function (e) {
                tips(e.responseJSON.message, e.status);
            },
        });
    });

    // Send File Message
    $('.sendFile').on('change', function (e) {
        let formData = new FormData(),
            token = $('meta[name="csrf-token"]').attr('content'),
            obj = $(this),
            type = obj.data('type'),
            uidOrUsername = obj.data('user-fsid');

        $('.send-file-btn').prop('disabled', true);
        $('.send-file-btn').prepend(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> '
        );

        formData.append('file', obj[0].files[0]);
        formData.append('_token', token);
        formData.append('usageType', 'conversation');
        formData.append('usageFsid', uidOrUsername);
        formData.append('type', type);

        $.ajax({
            url: '/api/theme/actions/api/fresns/v1/common/file/upload',
            type: 'POST',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.code == 0) {
                    tips(res.message, res.code);
                    window.location.reload();
                    return;
                }

                tips(res.message, res.code);
            },
            error: function (e) {
                tips(e.responseJSON.message, e.status);
            },
        });
    });

    // top groups
    $('#editor-group').on('click', function (obj) {
        var initialized = $(this).attr('data-initialized');

        console.log('initialized', initialized);

        if (initialized == 1) {
            return;
        }

        editorGroup.editorAjaxGetTopGroups();
    });
})(jQuery);

// Editor Groups
var editorGroup = {
    // editorGroupConfirm
    editorGroupConfirm: function (obj) {
        var gid = $(obj).attr('data-gid');
        var name = $(obj).attr('data-name');
        var webPage = $(obj).attr('data-web-page');

        console.log('editorGroupConfirm', gid, name, webPage);

        $('#editor-group-gid').val(gid);
        $('#editor-group-name').text(name);

        if (webPage == 'editor') {
            editorChangeGid(gid);
        }
    },

    // editorGroupSelect
    editorGroupSelect: function (obj) {
        var gid = $(obj).data('gid');
        var name = $(obj).text();
        var publish = $(obj).data('publish');
        var level = $(obj).data('level');
        var subgroupCount = $(obj).data('subgroup-count');

        console.log('editorGroupSelect', gid, name, publish, subgroupCount);

        var btnGid = $('#editor-group-confirm').attr('data-gid');

        console.log('editor-group-confirm', btnGid);

        if (gid != btnGid) {
            $('.group-list-' + gid).addClass('active');
            $('.group-list-' + btnGid).removeClass('active');
        }

        $('#editor-group-confirm').attr('data-gid', gid);
        $('#editor-group-confirm').attr('data-name', name);

        if (publish == 1) {
            $('#editor-group-confirm').prop('disabled', false);
        } else {
            $('#editor-group-confirm').prop('disabled', true);
        }

        downLevel = level + 1;
        editorGroup.editorRemoveGroupBox(downLevel);

        editorGroup.editorGroupModalSize(level, subgroupCount);

        if (subgroupCount) {
            editorGroup.editorAjaxGetGroupList(level, gid, (page = 1));
        }
    },

    // editorAjaxGetTopGroups
    editorAjaxGetTopGroups: function (topGroupsPage = 1) {
        $('#editor-top-groups .list-group').append(
            '<div class="text-center group-spinners mt-2"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
        );
        $('#editor-top-groups .list-group-addmore').empty().append(fs_lang('loading'));

        let html = '';

        $.get(
            '/api/theme/actions/api/fresns/v1/group/list?topGroups=1&pageSize=30&page=' + topGroupsPage,
            function (data) {
                let apiData = data.data;

                let groups = apiData.list;

                topGroupsPage = topGroupsPage + 1;

                if (groups.length > 0) {
                    $.each(groups, function (i, group) {
                        html +=
                            '<a href="javascript:void(0)" data-gid="' +
                            group.gid +
                            '" data-level="1" data-subgroup-count="' +
                            group.subgroupCount +
                            '" onclick="editorGroup.editorGroupSelect(this)" class="list-group-item list-group-item-action group-list-' +
                            group.gid +
                            '"';

                        if (group.publishRule.canPublish && group.publishRule.allowPost) {
                            html += ' data-publish="1">';
                        } else {
                            html += ' data-publish="0">';
                        }

                        if (group.cover) {
                            html += '<img src="' + group.cover + '" height="20" class="me-1">';
                        }

                        html += group.name + '</a>';
                    });
                }

                if (apiData.pagination.currentPage == 1) {
                    $('#editor-top-groups .list-group').each(function () {
                        $(this).empty();
                        $(this).next().empty();
                    });
                }

                $('#editor-top-groups .list-group .group-spinners').remove();
                $('#editor-top-groups .list-group').append(html);

                $('#editor-top-groups .list-group-addmore').empty();
                if (apiData.pagination.currentPage < apiData.pagination.lastPage) {
                    let addMoreHtml = `<a href="javascript:void(0)"  class="add-more mt-3" onclick="editorGroup.editorAjaxGetTopGroups(${topGroupsPage})">${fs_lang(
                        'clickToLoadMore'
                    )}</a>`;
                    $('#editor-top-groups .list-group-addmore').append(addMoreHtml);
                }

                $('#editor-group').attr('data-initialized', 1);
            }
        );
    },

    // editorAjaxGetGroupList
    editorAjaxGetGroupList: function (level, gid, page = 1) {
        var parentTargetId = 'group-list-' + level;
        level = level + 1;

        var targetId = 'group-list-' + level;
        var targetElement = $('#' + targetId);

        if (targetElement.length > 0) {
            targetElement.empty().append('<div class="list-group"></div>');
        } else {
            $('#' + parentTargetId).append(
                '<div id="' +
                    targetId +
                    '" class="d-flex justify-content-start ms-4"><div class="list-group"></div></div>'
            );
        }

        $('#' + targetId + ' .list-group').append(
            '<div class="text-center group-spinners mt-2"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div><div class="list-group-addmore text-center mb-2 fs-7 text-secondary"></div></div>'
        );
        $('#' + targetId + ' .list-group-addmore')
            .empty()
            .append(fs_lang('loading'));

        let html = '';

        $.get('/api/theme/actions/api/fresns/v1/group/list?gid=' + gid + '&pageSize=30&page=' + page, function (data) {
            let apiData = data.data;

            let groups = apiData.list;

            page = page + 1;

            if (groups.length > 0) {
                $.each(groups, function (i, group) {
                    html +=
                        '<a href="javascript:void(0)" data-gid="' +
                        group.gid +
                        '" data-level="' +
                        level +
                        '" data-subgroup-count="' +
                        group.subgroupCount +
                        '" onclick="editorGroup.editorGroupSelect(this)" class="list-group-item list-group-item-action group-list-' +
                        group.gid +
                        '"';

                    if (group.publishRule.canPublish && group.publishRule.allowPost) {
                        html += ' data-publish="1">';
                    } else {
                        html += ' data-publish="0">';
                    }

                    if (group.cover) {
                        html += '<img src="' + group.cover + '" height="20" class="me-1">';
                    }

                    html += group.name + '</a>';
                });
            }

            if (apiData.pagination.currentPage == 1) {
                $('#' + targetId + ' .list-group').each(function () {
                    $(this).empty();
                    $(this).next().empty();
                });
            }

            $('#' + targetId + ' .list-group .group-spinners').remove();
            $('#' + targetId + ' .list-group').append(html);

            $('#' + targetId + ' .list-group-addmore').empty();
            if (apiData.pagination.currentPage < apiData.pagination.lastPage) {
                let addMoreHtml = `<a href="javascript:void(0)"  class="add-more mt-3" onclick="editorGroup.editorAjaxGetTopGroups(${topGroupsPage})">${fs_lang(
                    'clickToLoadMore'
                )}</a>`;
                $('#' + targetId + ' .list-group-addmore').append(addMoreHtml);
            }

            $('#editor-group').attr('data-initialized', 1);
        });
    },

    // editorRemoveGroupBox
    editorRemoveGroupBox: function (level) {
        var targetId = 'group-list-' + level;
        var targetElement = $('#' + targetId);

        console.log('editorRemoveGroupBox', targetId);

        if (targetElement.length > 0) {
            targetElement.remove();
            editorGroup.editorRemoveGroupBox(level);
        }
    },

    // editorGroupModalSize
    editorGroupModalSize: function (level, subgroupCount) {
        console.log('editorGroupModalSize', level);

        if (subgroupCount == 0) {
            return;
        }

        if (level == 1 || level == 2) {
            $('#editor-groups-modal-class').removeClass('modal-sm');
            $('#editor-groups-modal-class').removeClass('modal-lg');
            $('#editor-groups-modal-class').removeClass('modal-xl');
        } else if (level == 3) {
            $('#editor-groups-modal-class').removeClass('modal-sm');
            $('#editor-groups-modal-class').removeClass('modal-lg');
            $('#editor-groups-modal-class').removeClass('modal-xl');

            $('#editor-groups-modal-class').addClass('modal-lg');
        } else {
            $('#editor-groups-modal-class').removeClass('modal-sm');
            $('#editor-groups-modal-class').removeClass('modal-lg');
            $('#editor-groups-modal-class').removeClass('modal-xl');

            $('#editor-groups-modal-class').addClass('modal-xl');
        }
    },
};

// File Upload
var numberFiles = 0;
var numberUploaded = 0;

var progressInterval;
var maxProgress = 50;

var fresnsFile = {
    // get file data
    uploadRequest: function (
        usageType,
        usageFsid,
        fileType,
        uploadType,
        files,
        supportedExtensions,
        maxSize,
        maxDuration = 0
    ) {
        if (!files.length) {
            alert(fs_lang('uploadTip'));
            return;
        }

        numberFiles = files.length;
        numberUploaded = 0;

        // progress bar initialization
        $('#uploadProgressBar').removeClass('d-none').attr('aria-valuenow', 0);
        $('#uploadProgressBar').find('.progress-bar').css('width', '0%').text('0%');
        clearInterval(progressInterval);

        // Adjusting progress bar increment dynamically
        progressInterval = setInterval(function () {
            var currentProgress = parseInt($('#uploadProgressBar').attr('aria-valuenow'));
            var increment = 0;

            if (currentProgress < maxProgress) {
                // Faster increment rate before reaching maxProgress
                increment = maxProgress - currentProgress > 10 ? 10 : maxProgress - currentProgress;
            } else if (currentProgress >= maxProgress && currentProgress < 100) {
                // Slower increment rate after reaching maxProgress
                increment = currentProgress < 98 ? 1 : 0.5; // even slower when approaching 100%
            }

            var newProgress = currentProgress + increment;
            newProgress = newProgress > 100 ? 100 : newProgress;

            $('#uploadProgressBar').attr('aria-valuenow', newProgress);
            $('#uploadProgressBar')
                .find('.progress-bar')
                .css('width', newProgress + '%')
                .text(newProgress + '%');

            if (newProgress >= 100 || numberUploaded === numberFiles) {
                clearInterval(progressInterval);
            }
        }, 500);

        // upload
        Array.from(files).forEach((file) => {
            fresnsFile.getFileData(
                usageType,
                usageFsid,
                fileType,
                uploadType,
                file,
                supportedExtensions,
                maxSize,
                maxDuration
            );
        });
    },

    // get file data
    getFileData: function (
        usageType,
        usageFsid,
        fileType,
        uploadType,
        file,
        supportedExtensions,
        maxSize,
        maxDuration
    ) {
        function proceedWithUpload(fileType, fileData) {
            console.log('fileData', fileType, fileData);

            if (!fresnsFile.validateFile(fileData, supportedExtensions, maxSize, maxDuration)) {
                $('#uploadSubmit').prop('disabled', false);
                $('#uploadSubmit').find('.spinner-border').remove();

                $('#uploadProgressBar').addClass('d-none');

                return;
            }

            fresnsFile.makeUploadToken(fileData, uploadType, file);
        }

        let fileData = {
            usageType: usageType,
            usageFsid: usageFsid,
            type: fileType,
            name: file.name,
            mime: file.type,
            extension: file.name.split('.').pop(),
            size: file.size,
            width: null,
            height: null,
            duration: null,
            warning: 'none',
            moreInfo: null,
        };

        if (fileType == 'image') {
            const image = new Image();
            image.onload = function () {
                fileData.width = this.naturalWidth;
                fileData.height = this.naturalHeight;

                // clean up memory
                URL.revokeObjectURL(this.src);

                // upload file
                proceedWithUpload(fileType, fileData);
            };
            image.onerror = function () {
                console.error('Error loading image');
            };
            image.src = URL.createObjectURL(file);

            return;
        }

        if (fileType == 'video' || fileType == 'audio') {
            const media = document.createElement(fileType);
            media.preload = 'metadata';
            media.onloadedmetadata = function () {
                fileData.width = fileType == 'video' ? media.videoWidth : null;
                fileData.height = fileType == 'video' ? media.videoHeight : null;
                fileData.duration = Math.round(media.duration);

                // clean up memory
                URL.revokeObjectURL(this.src);

                // upload file
                proceedWithUpload(fileType, fileData);
            };
            media.onerror = function () {
                console.error(`Error loading ${fileType}`);
            };
            media.src = URL.createObjectURL(file);

            return;
        }

        // upload file
        proceedWithUpload(fileType, fileData);
    },

    // validate file data
    validateFile: function (fileData, supportedExtensions, maxSize, maxDuration) {
        let fileName = fileData.name;
        let fileExtension = fileData.extension;
        let fileSize = fileData.size;
        let fileDuration = fileData.duration;
        let tipMessage;

        let extensions = supportedExtensions.split(',');
        if (!extensions.includes(fileExtension)) {
            tipMessage = `[${fileName}] ${fs_lang('uploadWarningExtension')}`;
            tips(tipMessage);

            return false;
        }

        if (fileSize > maxSize * 1024 * 1024) {
            tipMessage = `[${fileName}] ${fs_lang('uploadWarningMaxSize')}`;
            tips(tipMessage);

            return false;
        }

        if (maxDuration && fileDuration > maxDuration) {
            tipMessage = `[${fileName}] ${fs_lang('uploadWarningMaxDuration')}`;
            tips(tipMessage);

            return false;
        }

        return true;
    },

    // make upload token
    makeUploadToken: function (fileData, uploadType, file) {
        if (uploadType == 'api') {
            let uploadToken = {
                url: '/api/theme/actions/api/fresns/v1/common/file/upload',
                method: 'POST',
                headers: {},
                fid: '',
            };

            fresnsFile.uploadFile(uploadType, uploadToken, fileData, file);
            return;
        }

        $.ajax({
            url: '/api/theme/actions/api/fresns/v1/common/file/upload-token',
            type: 'POST',
            data: fileData,
            success: function (res) {
                if (res.code != 0) {
                    tips(res.message, true);

                    $('#uploadSubmit').prop('disabled', false);
                    $('#uploadSubmit').find('.spinner-border').remove();

                    $('#uploadProgressBar').addClass('d-none');

                    return;
                }

                fresnsFile.uploadFile(uploadType, res.data, fileData, file);
            },
            error: function (e) {
                tips(e.responseJSON.message, true);

                $('#uploadSubmit').prop('disabled', false);
                $('#uploadSubmit').find('.spinner-border').remove();

                $('#uploadProgressBar').addClass('d-none');
            },
        });
    },

    // upload file
    uploadFile: function (uploadType, uploadToken, fileData, file) {
        let formData = new FormData();
        formData.append('usageType', fileData.usageType);
        formData.append('usageFsid', fileData.usageFsid);
        formData.append('type', fileData.type);
        formData.append('file', file);
        formData.append('warning', fileData.warning);
        formData.append('moreInfo', JSON.stringify(fileData.moreInfo));

        // api upload
        if (uploadType == 'api') {
            let fileNumber = numberFiles - numberUploaded;

            $.ajax({
                url: '/api/theme/actions/api/fresns/v1/common/file/upload',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function (res) {
                    if (res.code != 0) {
                        tips(res.message, res.code);

                        if (fileNumber >= 1) {
                            $('#uploadSubmit').prop('disabled', false);
                            $('#uploadSubmit').find('.spinner-border').remove();

                            $('#uploadProgressBar').addClass('d-none');
                        }
                        return;
                    }

                    numberUploaded++;

                    addEditorFile(res.data);
                },
                error: function (e) {
                    tips(e.responseJSON.message);

                    if (fileNumber >= 1) {
                        $('#uploadSubmit').prop('disabled', false);
                        $('#uploadSubmit').find('.spinner-border').remove();

                        $('#uploadProgressBar').addClass('d-none');
                    }
                },
                complete: function (e) {
                    let lastUploaded = numberFiles == numberUploaded;
                    if (lastUploaded) {
                        $('#uploadSubmit').prop('disabled', false);
                        $('#uploadSubmit').find('.spinner-border').remove();

                        $('#uploadProgressBar').attr('aria-valuenow', 100);
                        $('#uploadProgressBar').find('.progress-bar').css('width', '100%').text('100%');

                        $('#fresnsUploadModal .btn-close').trigger('click');

                        var fileInput = $('#fileInput');
                        fileInput.replaceWith(fileInput.val('').clone(true));
                        $('#uploadProgressBar').addClass('d-none');
                    }
                },
            });

            return;
        }

        // s3 upload
        $.ajax({
            url: uploadToken.url,
            type: uploadToken.method,
            headers: uploadToken.headers,
            data: formData,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function (res) {
                numberUploaded++;

                console.log('updateFileUploaded', uploadToken.fid, numberFiles, numberUploaded);

                fresnsFile.updateFileUploaded(uploadToken.fid);
            },
            error: function (e) {
                tips(e.responseJSON.message);

                $('#uploadSubmit').prop('disabled', false);
                $('#uploadSubmit').find('.spinner-border').remove();

                $('#uploadProgressBar').addClass('d-none');
            },
        });
    },

    // update file uploaded
    updateFileUploaded: function (fid) {
        let lastUploaded = numberFiles == numberUploaded;

        $.ajax({
            url: '/api/theme/actions/api/fresns/v1/common/file/' + fid + '/info',
            type: 'patch',
            data: {
                fid: fid,
                uploaded: 1,
            },
            success: function (res) {
                if (res.code != 0) {
                    tips(res.message, res.code);
                    return;
                }

                addEditorFile(res.data);
            },
            error: function (e) {
                tips(e.responseJSON.message);
            },
            complete: function (e) {
                if (lastUploaded) {
                    $('#uploadSubmit').prop('disabled', false);
                    $('#uploadSubmit').find('.spinner-border').remove();

                    $('#uploadProgressBar').attr('aria-valuenow', 100);
                    $('#uploadProgressBar').find('.progress-bar').css('width', '100%').text('100%');

                    $('#fresnsUploadModal .btn-close').trigger('click');

                    var fileInput = $('#fileInput');
                    fileInput.replaceWith(fileInput.val('').clone(true));
                    $('#uploadProgressBar').addClass('d-none');
                }
            },
        });
    },
};

// List: ajax get
$(function () {
    var currentPage = 1;
    var lastPage = 1;
    var isLoading = false;

    // Loading data for the next page
    function loadNextPage() {
        // Show loading text
        $('#fresns-list-tip').hide();
        $('#fresns-list-loading').show();

        // Set status to loading
        isLoading = true;

        // Send an AJAX request to get the data of the next page
        $.ajax({
            url: window.location.href,
            type: 'get',
            data: {
                page: currentPage + 1,
            },
            dataType: 'json',
            success: function (response) {
                // Hide the loading text
                $('#fresns-list-loading').hide();
                $('#fresns-list-tip').show();

                // Insert the HTML of the next page into the list
                $('#fresns-list-container').append(response.html);

                // Update current page number and last page code
                currentPage = response.pagination.currentPage;
                lastPage = response.pagination.lastPage;

                // If it is the last page, the text of "no more" is displayed
                if (currentPage >= lastPage) {
                    $('#fresns-list-tip').hide();
                    $('#fresns-list-no-more').show();

                    console.log('ajax get list => no more');
                }

                // Set status to not loading
                isLoading = false;
            },
            error: function () {
                // Set status to not loading
                isLoading = false;

                console.log('ajax get list => error');
            },
        });
    }

    // Use IntersectionObserver to listen to whether the bottom is reached
    if ('IntersectionObserver' in window) {
        let options = {
            root: null,
            rootMargin: '0px',
            threshold: 1.0,
        };

        let observer = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                console.log('ajax switch', window.ajaxGetList);

                if (!window.ajaxGetList || $('#fresns-list-container').length == 0) {
                    $('#fresns-list-tip').hide();

                    console.log('ajax get list => end');
                    return;
                }

                if (entry.isIntersecting && currentPage <= lastPage && !isLoading) {
                    loadNextPage();
                }
            });
        }, options);

        var targetElement = document.querySelector('#fresns-list-tip');
        if (targetElement) {
            observer.observe(targetElement);
        }
    }

    // Click the button to load the next page of data
    $('#fresns-list-loading-btn').click(function () {
        if (currentPage <= lastPage && !isLoading) {
            loadNextPage();
        }
    });
});

// Markdown a tag
$(document).ready(function () {
    var parse_url = /^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/;
    var location_href = window.location.href.replace(parse_url, '$3');
    $('.content-article a:not(:has(img)),.content-article a').hover(function () {
        var this_href = $(this).attr('href');
        var replace_href = this_href.replace(parse_url, '$3');
        if (this_href != replace_href && location_href != replace_href) $(this).attr('target', '_blank');
    });

    window.locale = $('html').attr('lang');
    if (window.locale) {
        $.ajax({
            url: '/api/theme/actions/api/fresns/v1/global/language-pack',
            method: 'get',
            success(response) {
                if (response.data) {
                    window.translations = response.data;
                } else {
                    console.error('Failed to get translation');
                }
            },
        });
    }
});
