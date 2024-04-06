/*!
 * Fresns (https://fresns.org)
 * Copyright 2021-Present Jevan Tang
 * Licensed under the Apache-2.0 license
 */

function makeAccessToken() {
    let accessToken;

    $.ajaxSettings.async = false;
    $.post('/api/theme/access-token', {}, function (res) {
        accessToken = res.data.accessToken;
    });
    $.ajaxSettings.async = true;

    return accessToken;
}

$('#fresnsModal.fresnsExtensions').on('show.bs.modal', function (e) {
    let button = $(e.relatedTarget),
        modalHeight = button.data('modal-height'),
        modalWidth = button.data('modal-width'),
        title = button.data('title'),
        reg = /\{[^\}]+\}/g,
        url = button.data('url'),
        replaceJson = button.data(),
        searchArr = url.match(reg);

    if (searchArr) {
        searchArr.forEach(function (v) {
            let attr = v.substring(1, v.length - 1);
            if (replaceJson[attr]) {
                url = url.replace(v, replaceJson[attr]);
            } else {
                if (v === '{accessToken}') {
                    url = url.replace('{accessToken}', makeAccessToken());
                } else {
                    url = url.replace(v, '');
                }
            }
        });
    }

    $(this).find('.modal-title').empty().html(title);
    let inputHtml = `<iframe src="` + url + `" class="iframe-modal"></iframe>`;
    $(this).find('.modal-body').empty().html(inputHtml);

    // iFrame Resizer V4
    // https://github.com/davidjbradshaw/iframe-resizer
    let isOldIE = navigator.userAgent.indexOf('MSIE') !== -1;
    $('#fresnsModal.fresnsExtensions iframe').on('load', function () {
        $(this).iFrameResize({
            autoResize: true,
            minHeight: modalHeight ? modalHeight : 500,
            heightCalculationMethod: isOldIE ? 'max' : 'lowestElement',
            scrolling: true,
        });
    });
});

// fresns extensions callback
window.onmessage = function (event) {
    let callbackData = FresnsCallback.decode(event.data);

    if (callbackData.code == 40000) {
        // callback data format error
        return;
    }

    if (callbackData.code != 0) {
        tips(callbackData.message);
        return;
    }

    switch (callbackData.action.postMessageKey) {
        case 'reload':
            window.location.reload();
            break;

        case 'fresnsAccountSign':
            html = `<div class="position-fixed top-50 start-50 translate-middle bg-secondary bg-opacity-75 rounded px-4 py-3" style="z-index:2048;">
                <div>
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="text-light mt-2">${fs_lang('accountLoggingIn')}</div>
            </div>`;

            $('.fresns-tips').empty().html(html);

            $.ajax({
                url: '/api/theme/actions/api/fresns/v1/account/auth-token',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    loginToken: callbackData.data.loginToken,
                }),
                success: function (res) {
                    if (res.code !== 0) {
                        tips(res.message, res.code);

                        return;
                    }

                    const authToken = res.data.authToken;
                    const expiredDays = res.data.authToken.expiredDays || 365;

                    const cookiePrefix = window.cookiePrefix;
                    const cookieNameAid = cookiePrefix + 'aid';
                    const cookieNameAidToken = cookiePrefix + 'aid_token';
                    const cookieNameUid = cookiePrefix + 'uid';
                    const cookieNameUidToken = cookiePrefix + 'uid_token';

                    // Cookies.set(cookieNameAid, authToken.aid, { expires: expiredDays });
                    // Cookies.set(cookieNameAidToken, authToken.aidToken, { expires: expiredDays });
                    // Cookies.set(cookieNameUid, authToken.uid, { expires: expiredDays });
                    // Cookies.set(cookieNameUidToken, authToken.uidToken, { expires: expiredDays });

                    window.location.reload();
                },
            });
            break;

        case 'fresnsUserManage':
            window.location.reload();
            break;

        case 'fresnsPostManage':
            window.location.reload();
            break;

        case 'fresnsCommentManage':
            window.location.reload();
            break;

        case 'fresnsEditorUpload':
            if (callbackData.action.dataHandler == 'add') {
                if (Array.isArray(callbackData.data)) {
                    callbackData.data.forEach((fileInfo) => {
                        addEditorFile(fileInfo);
                    });
                } else {
                    addEditorFile(callbackData.data);
                }
            }
            break;
    }

    if (callbackData.action.windowClose) {
        $('#fresnsModal').modal('hide');
    }

    if (callbackData.action.redirectUrl) {
        window.location.href = callbackData.action.redirectUrl;
    }
};
