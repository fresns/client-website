@extends('commons.fresns')

@section('title', fs_lang('editor'))

@section('content')
    <div class="container-fluid">
        <div class="fresns-editor">
            <form action="{{ route('fresns.api.post', ['path' => "/api/fresns/v1/editor/{$type}/draft/{$draft['detail']['did']}"]) }}" method="post">
                <input type="hidden" name="type" value="{{ $type ?? '' }}" />
                <input type="hidden" name="gid" id="editor-group-gid" value="{{ $draft['detail']['group']['gid'] ?? '' }}" />
                {{-- Tip: Publish Permissions --}}
                @if ($configs['publish']['limit']['status'] && $configs['publish']['limit']['isInTime'])
                    @component('components.editor.tip.publish', [
                        'publishConfig' => $configs['publish'],
                    ])@endcomponent
                @endif

                {{-- Tip: Edit Controls --}}
                @if ($draft['editControls']['isEditDraft'] && ! in_array($draft['detail']['state'], [2, 3]))
                    @component('components.editor.tip.edit', [
                        'editControls' => $draft['editControls'],
                    ])@endcomponent
                @endif

                {{-- Tip: Draft under review or published --}}
                @if (in_array($draft['detail']['state'], [2, 3]))
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ $draft['detail']['state'] == 2 ? fs_lang('contentEditReviewTip') : fs_lang('contentEditPublishedTip') }}
                    </div>
                @endif

                {{-- Group --}}
                @if ($configs['editor']['group']['status'])
                    @component('components.editor.section.group', [
                        'groupConfig' => $configs['editor']['group'],
                        'did' => $draft['detail']['did'],
                        'group' => $draft['detail']['group'],
                    ])@endcomponent
                @endif

                {{-- Toolbar --}}
                @component('components.editor.section.toolbar', [
                    'editorConfig' => $configs['editor'],
                ])@endcomponent

                {{-- Content Start --}}
                <div class="editor-content p-3">
                    {{-- Title --}}
                    @if ($configs['editor']['title']['status'] || optional($draft['detail'])['title'])
                        @component('components.editor.section.title', [
                            'titleConfig' => $configs['editor']['title'],
                            'title' => $draft['detail']['title'] ?? '',
                        ])@endcomponent
                    @endif

                    {{-- Content --}}
                    <textarea class="form-control rounded-0 border-0 fresns-content" name="content" id="content" rows="15" placeholder="{{ fs_lang('editorContent') }}">{{ $draft['detail']['content'] }}</textarea>

                    {{-- Files --}}
                    @component('components.editor.section.files', [
                        'files' => $draft['detail']['files'],
                    ])@endcomponent

                    {{-- Extends --}}
                    @component('components.editor.section.extends', [
                        'extends' => $draft['detail']['extends'],
                    ])@endcomponent

                    {{-- readConfig --}}
                    @if ($draft['detail']['permissions']['readConfig'] ?? null)
                        @component('components.editor.section.config-read', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'readConfig' => $draft['detail']['permissions']['readConfig'],
                        ])@endcomponent
                    @endif

                    {{-- commentConfig --}}
                    @if ($draft['detail']['permissions']['commentConfig']['action'] ?? null)
                        @component('components.editor.section.config-action-button', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'actionButton' => $draft['detail']['permissions']['commentConfig']['action'],
                        ])@endcomponent
                    @endif

                    {{-- associatedUserListConfig --}}
                    @if ($draft['detail']['permissions']['associatedUserListConfig'] ?? null)
                        @component('components.editor.section.config-associated-user-list', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'associatedUserListConfig' => $draft['detail']['permissions']['associatedUserListConfig'],
                        ])@endcomponent
                    @endif

                    <hr>

                    {{-- Location and Anonymous: Start --}}
                    <div class="d-flex justify-content-between">
                        {{-- Location --}}
                        @if ($configs['editor']['location']['status'])
                            @component('components.editor.section.location', [
                                'type' => $type,
                                'did' => $draft['detail']['did'],
                                'locationConfig' => $configs['editor']['location'],
                                'locationInfo' => $draft['detail']['locationInfo'],
                                'geotag' => $draft['detail']['geotag'],
                            ])@endcomponent
                        @endif

                        {{-- Anonymous --}}
                        @if ($configs['editor']['anonymous'])
                            @component('components.editor.section.anonymous', [
                                'isAnonymous' => $draft['detail']['isAnonymous'],
                            ])@endcomponent
                        @endif

                        {{-- comment private --}}
                        @if ($type == 'post')
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" name="commentPrivate" value="1" id="commentPrivate" {{ $draft['detail']['isPrivate'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="commentPrivate">
                                    {{ fs_lang('editorCommentPrivate') }}
                                </label>
                            </div>
                        @endif

                        {{-- Markdown --}}
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="checkbox" name="isMarkdown" value="1" id="isMarkdown" {{ $draft['detail']['isMarkdown'] ? 'checked' : '' }}>
                            <label class="form-check-label" for="isMarkdown">{{ fs_lang('editorContentMarkdown') }}</label>
                        </div>
                    </div>
                    {{-- Location and Anonymous: End --}}

                    @if ($type == 'post')
                        {{-- comment policy --}}
                        <div class="input-group my-3">
                            <label class="input-group-text">{{ fs_lang('whoCanReply') }}</label>
                            <select class="form-select" name="commentPolicy">
                                <option value="1" {{ $draft['detail']['permissions']['commentConfig']['policy'] == 1 ? 'selected' : ''}}>{{ fs_lang('optionEveryone') }}</option>
                                <option value="2" {{ $draft['detail']['permissions']['commentConfig']['policy'] == 2 ? 'selected' : ''}}>{{ fs_lang('optionPeopleYouFollow') }}</option>
                                <option value="3" {{ $draft['detail']['permissions']['commentConfig']['policy'] == 3 ? 'selected' : ''}}>{{ fs_lang('optionPeopleYouFollowOrVerified') }}</option>
                                <option value="4" {{ $draft['detail']['permissions']['commentConfig']['policy'] == 4 ? 'selected' : ''}}>{{ fs_lang('optionNoOneIsAllowed') }}</option>
                                <option value="5" {{ $draft['detail']['permissions']['commentConfig']['policy'] == 5 ? 'selected' : ''}}>{{ fs_lang('optionOnlyUsersYouMention') }}</option>
                            </select>
                        </div>
                    @endif
                </div>
                {{-- Content End --}}

                {{-- Button --}}
                <div class="editor-submit d-grid">
                    <button type="submit" class="btn btn-success btn-lg my-5 mx-3" {{ in_array($draft['detail']['state'], [2, 3]) ? 'disabled' : ''}}>
                        {{ fs_config("publish_{$type}_name") }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Upload Modal --}}
    <div class="modal fade" id="fresns-upload" tabindex="-1" aria-labelledby="fresns-upload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ fs_lang('editorUploadTip') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="mt-2" method="post" id="upload-form" multiple="true" enctype="multipart/form-data">
                        <input type="hidden" name="usageType" @if ($type === 'post') value="7" @elseif($type === "comment") value="8" @endif>
                        <input type="hidden" name="tableName" @if ($type === 'post') value="post_logs" @elseif($type === "comment") value="comment_logs" @endif>
                        <input type="hidden" name="tableColumn" value="id">
                        <input type="hidden" name="tableId" value="{{ $draft['detail']['id'] ?? '' }}">
                        <input type="hidden" name="uploadMode" value="file">
                        <input type="hidden" name="type">
                        <input class="form-control" type="file" id="formFile">
                        <label class="form-label mt-3 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('editorUploadTipExtensions') }}: <span id="extensions"></span></label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('editorUploadTipMaxSize') }}: <span id="maxSize"></span> MB</label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block" id="maxTimeDiv">{{ fs_lang('editorUploadTipMaxTime') }}: <span id="maxTime"></span> {{ fs_lang('unitSecond') }}</label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('editorUploadTipNumber') }}: <span id="maxNumber"></span></label>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="ajax-upload">{{ fs_lang('editorUploadButton') }}</button>
                    <div class="progress w-100 d-none" id="upload-progress"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function addEditorAttachment(fileinfo) {
            let html;

            if (fileinfo.type === 1) {
                html = `
                <div class="position-relative">
                    <img src="${fileinfo.imageSquareUrl}" class="img-fluid">
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileinfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`;

                $(".editor-file-image").append(html);
                let imgLength = $(".editor-file-image").find(".position-relative").length
                $(".editor-file-image").removeClass().addClass("editor-file-image editor-file-image-"+ imgLength +" mt-3 clearfix")
            }
            if (fileinfo.type === 2) {
                var videoImage = ''
                if (fileinfo.videoPosterUrl) {
                    videoImage = `<img src="${fileinfo.videoPosterUrl}" class="img-fluid">`
                } else {
                    videoImage = `<svg class="bd-placeholder-img rounded" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>`
                }
                html = `
                <div class="position-relative">
                    ${videoImage}
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileinfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <button type="button" class="btn btn-light editor-btn-video-play" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('editorVideoPlay') }}" title="{{ fs_lang('editorVideoPlay') }}">
                            <i class="bi bi-play-fill"></i>
                        </button>
                    </div>
                </div>`
                $(".editor-file-video").append(html);
            }
            if (fileinfo.type === 3) {
                html = `
                <div class="position-relative">
                    <audio src="${fileinfo.audioUrl}" controls="controls" preload="meta" controlsList="nodownload" oncontextmenu="return false">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileinfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button></div>
                </div>`
                $('.editor-file-audio').append(html);
            }
            if(fileinfo.type === 4) {
                html = `
                <div class="position-relative">
                    <div class="editor-document-box">
                        <div class="editor-document-icon">
                            <i class="bi bi-file-earmark"></i>
                        </div>
                        <div class="editor-document-name text-nowrap overflow-hidden">${fileinfo.name}</div>
                    </div>
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileinfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`
                $(".editor-file-document").append(html);
            }
        }

        function deleteFile(obj) {
            let fid = $(obj).data('fid');

            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                type: "PATCH",
                data: {
                    'deleteFile': fid,
                }
            });

            $(obj).parent().parent().remove();
        }

        function deleteLocation() {
            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                type: "PATCH",
                data: {
                    'deleteLocation': 1,
                }
            });

            $('#location-info').hide();
            $('#location-btn').show();
        }

        (function($){
            let fileUploadModal = document.getElementById('fresns-upload');
            fileUploadModal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget,
                    extensions = $(button).data('extensions'),
                    type = $(button).data('type'),
                    accept = $(button).data('accept'),
                    maxSize = $(button).data('maxsize');
                    maxTime = $(button).data('maxtime') ?? 0;
                    maxNumber = $(button).data('maxnumber');

                if ($.inArray(type, ['document', 'image']) >= 0 ) {
                    $("#formFile").attr('multiple', 'multiple')
                } else {
                    $("#formFile").removeAttr('multiple')
                }

                if (maxTime == 0) {
                    $(this).find("#maxTimeDiv").addClass('d-none');
                } else {
                    $(this).find("#maxTimeDiv").removeClass('d-none');
                }

                $("#formFile").prop('accept', accept)
                $("#extensions").text(extensions);
                $("#maxSize").text(maxSize);
                $("#maxTime").text(maxTime);
                $("#maxNumber").text(maxNumber);
                $("#fresns-upload input[name='type']").val(type);
            })

            $(".fresns-sticker").on('click',function (){
                $("#content").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
            });

            $("#fresns-upload").on('show.bs.modal', function () {
                $(this).find('#ajax-upload').show().removeAttr("disabled");
                $(this).find('#formFile').val("");
                $(this).find("#upload-progress").addClass('d-none').empty();
            })

            $("#ajax-upload").on('click', function (event){
                event.preventDefault();
                let obj = $(this),
                    maxSize = $("#maxSize").text() || 0,
                    form = new FormData(document.getElementById("upload-form"))

                let files = $('#formFile').prop('files');

                for (let i = 0; i < files.length; i++) {
                    if (files[i].size > maxSize  * 1024 * 1024) {
                        alert("{{ fs_lang('editorUploadTipMaxSize') }}: " + $("#maxSize").text() + "MB");
                        return;
                    }

                    form.append('files[]', files[i])
                    maxSize += files[i].size;
                }

                if (obj.is(":disabled")) {
                    return;
                }
                if (!$("#formFile").val()) {
                    alert("{{ fs_lang('editorUploadInfo') }}");
                    return;
                }

                obj.attr('disabled', true);
                obj.hide();

                // set progress
                progress.init().setParentElement(obj.next('.progress').removeClass('d-none')).work();

                $.ajax({
                    url: "{{ route('fresns.api.post', ['path' => '/api/fresns/v1/common/file/uploads']) }}",
                    type: "POST",
                    data: form,
                    timeout: 600000,
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    success: function(resp) {
                        progress.done();
                        if (resp.code === 0) {
                            resp.data.forEach(function (res){
                                addEditorAttachment(res);
                            })
                        } else {
                            tips(resp.message, resp.code)
                        }
                        $("#fresns-upload .btn-close").trigger('click');
                    },
                    error: function(e) {
                        progress.exit();
                        tips(e.responseJSON.message)
                        $("#fresns-upload .btn-close").trigger('click');
                    },
                });
            })

            // update draft
            const updateDraft = function (title, content, fid = ''){
                $.ajax({
                    url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                    type: "PATCH",
                    data: {
                        'title' : title,
                        'content':  content,
                    },
                    success: function(data) {
                        console.log(data);

                        // If the 'code' value in the returned JSON is not 0, stop the interval loop
                        if (data.code != 0) {
                            clearInterval(intervalId);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            };

            let content, title;
            let intervalId;

            // Start the interval loop
            intervalId = setInterval(function() {
                content = $("#content").val();
                title = $("#title").val();
                updateDraft(title, content);
            }, 10000);

            // Add a click event listener to the submit button
            $(document).ready(function() {
                $("button[type='submit']").on('click', function(event) {
                    // Stop the interval loop
                    clearInterval(intervalId);
                });
            });
        })(jQuery);
    </script>
@endpush
