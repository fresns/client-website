<div class="editor-toolbar d-flex flex-wrap shadow-sm">
    {{-- Sticker --}}
    @if ($editorConfig['sticker'])
        <div class="stickers">
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <div class="d-flex flex-column">
                    <i class="bi bi-emoji-smile"></i>
                    <span>{{ fs_lang('editorStickers') }}</span>
                </div>
            </button>
            {{-- Sticker List Start --}}
            <div class="dropdown-menu rounded-0 pt-0" aria-labelledby="stickers">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach(fs_editor_stickers() as $sticker)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif" id="sticker-{{ $loop->index }}-tab" data-bs-toggle="tab" data-bs-target="#sticker-{{ $loop->index }}" type="button" role="tab" aria-controls="sticker-{{ $loop->index }}" aria-selected="{{ $loop->first }}">{{ $sticker['name'] }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content p-2 fs-sticker">
                    @foreach(fs_editor_stickers() as $sticker)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="sticker-{{ $loop->index }}" role="tabpanel" aria-labelledby="sticker-{{ $loop->index }}-tab">
                            @foreach($sticker['stickers'] ?? [] as $value)
                                <a class="fresns-sticker btn btn-outline-secondary rounded-0 border-0" href="javascript:;" value="{{ $value['code'] }}" title="{{ $value['code'] }}" >
                                    <img src="{{ $value['image'] }}" loading="lazy" alt="{{ $value['code'] }}" title="{{ $value['code'] }}">
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Sticker List End --}}
        </div>
    @endif

    {{-- Image --}}
    @if ($editorConfig['image']['status'])
        @if ($editorConfig['image']['uploadMethod'] == 'page')
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ fs_lang('uploadTip') }}"
                data-url="{{ $editorConfig['image']['uploadUrl'] }}"
                data-draft-type="{{ $type }}"
                data-did="{{ $did }}"
                data-upload-info="{{ $type.'Draft,'.$did.',image' }}"
                data-post-message-key="fresnsEditorUpload">
                <div class="d-flex flex-column">
                    <i class="bi bi-image"></i>
                    <span>{{ fs_lang('editorImages') }}</span>
                </div>
            </button>
        @else
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsUploadModal"
                data-type="image"
                data-uploadmethod="{{ $editorConfig['image']['uploadMethod'] }}"
                data-accept="{{ $editorConfig['image']['inputAccept'] }}"
                data-extensions="{{ $editorConfig['image']['extensions'] }}"
                data-maxsize="{{ $editorConfig['image']['maxSize'] }}"
                data-maxnumber="{{ $editorConfig['image']['maxUploadNumber'] }}">
                <div class="d-flex flex-column">
                    <i class="bi bi-image"></i>
                    <span>{{ fs_lang('editorImages') }}</span>
                </div>
            </button>
        @endif
    @endif

    {{-- Video --}}
    @if ($editorConfig['video']['status'])
        @if ($editorConfig['video']['uploadMethod'] == 'page')
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ fs_lang('uploadTip') }}"
                data-url="{{ $editorConfig['video']['uploadUrl'] }}"
                data-draft-type="{{ $type }}"
                data-did="{{ $did }}"
                data-upload-info="{{ $type.'Draft,'.$did.',video' }}"
                data-post-message-key="fresnsEditorUpload">
                <div class="d-flex flex-column">
                    <i class="bi bi-film"></i>
                    <span>{{ fs_lang('editorVideos') }}</span>
                </div>
            </button>
        @else
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsUploadModal"
                data-type="video"
                data-uploadmethod="{{ $editorConfig['video']['uploadMethod'] }}"
                data-accept="{{ $editorConfig['video']['inputAccept'] }}"
                data-extensions="{{ $editorConfig['video']['extensions'] }}"
                data-maxsize="{{ $editorConfig['video']['maxSize'] }}"
                data-maxduration="{{ $editorConfig['video']['maxDuration'] }}"
                data-maxnumber="{{ $editorConfig['video']['maxUploadNumber'] }}">
                    <div class="d-flex flex-column">
                    <i class="bi bi-film"></i>
                    <span>{{ fs_lang('editorVideos') }}</span>
                </div>
            </button>
        @endif
    @endif

    {{-- Audio --}}
    @if ($editorConfig['audio']['status'])
        @if ($editorConfig['audio']['uploadMethod'] == 'page')
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ fs_lang('uploadTip') }}"
                data-url="{{ $editorConfig['audio']['uploadUrl'] }}"
                data-draft-type="{{ $type }}"
                data-did="{{ $did }}"
                data-upload-info="{{ $type.'Draft,'.$did.',audio' }}"
                data-post-message-key="fresnsEditorUpload">
                <div class="d-flex flex-column">
                    <i class="bi bi-music-note-beamed"></i>
                    <span>{{ fs_lang('editorAudios') }}</span>
                </div>
            </button>
        @else
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsUploadModal"
                data-type="audio"
                data-uploadmethod="{{ $editorConfig['audio']['uploadMethod'] }}"
                data-accept="{{ $editorConfig['audio']['inputAccept'] }}"
                data-extensions="{{ $editorConfig['audio']['extensions'] }}"
                data-maxsize="{{ $editorConfig['audio']['maxSize'] }}"
                data-maxduration="{{ $editorConfig['audio']['maxDuration'] }}"
                data-maxnumber="{{ $editorConfig['audio']['maxUploadNumber'] }}">
                <div class="d-flex flex-column">
                    <i class="bi bi-music-note-beamed"></i>
                    <span>{{ fs_lang('editorAudios') }}</span>
                </div>
            </button>
        @endif
    @endif

    {{-- Document --}}
    @if ($editorConfig['document']['status'])
        @if ($editorConfig['document']['uploadMethod'] == 'page')
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ fs_lang('uploadTip') }}"
                data-url="{{ $editorConfig['document']['uploadUrl'] }}"
                data-draft-type="{{ $type }}"
                data-did="{{ $did }}"
                data-upload-info="{{ $type.'Draft,'.$did.',document' }}"
                data-post-message-key="fresnsEditorUpload">
                <div class="d-flex flex-column">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>{{ fs_lang('editorDocuments') }}</span>
                </div>
            </button>
        @else
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsUploadModal"
                data-type="document"
                data-uploadmethod="{{ $editorConfig['document']['uploadMethod'] }}"
                data-accept="{{ $editorConfig['document']['inputAccept'] }}"
                data-extensions="{{ $editorConfig['document']['extensions'] }}"
                data-maxsize="{{ $editorConfig['document']['maxSize'] }}"
                data-maxnumber="{{ $editorConfig['document']['maxUploadNumber'] }}">
                <div class="d-flex flex-column">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>{{ fs_lang('editorDocuments') }}</span>
                </div>
            </button>
        @endif
    @endif

    {{-- Title --}}
    @if ($editorConfig['title']['status'])
        <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="collapse" href="#titleCollapse" aria-expanded="false" aria-controls="titleCollapse">
            <div class="d-flex flex-column">
                <i class="bi bi-textarea-t"></i>
                <span>{{ fs_lang('editorTitle') }}</span>
            </div>
        </button>
    @endif

    {{-- Mention --}}
    @if ($editorConfig['mention']['status'] && $editorConfig['mention']['display'])
        <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresns-mention">
            <div class="d-flex flex-column">
                <i class="bi bi-at"></i>
                <span>{{ fs_lang('editorMention') }}</span>
            </div>
        </button>
    @endif

    {{-- Hashtag --}}
    @if ($editorConfig['hashtag']['status'] && $editorConfig['hashtag']['display'])
        <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresns-hashtag">
            <div class="d-flex flex-column">
                <i class="bi bi-hash"></i>
                <span>{{ fs_lang('editorHashtag') }}</span>
            </div>
        </button>
    @endif

    {{-- Toolbar Extends --}}
    @if ($editorConfig['extend']['list'])
        @foreach($editorConfig['extend']['list'] as $extend)
            @if ($extend['isInToolbar'])
                <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ $extend['name'] }}"
                    data-url="{{ $extend['appUrl']  }}"
                    data-draft-type="{{ $type }}"
                    data-did="{{ $did }}"
                    data-post-message-key="fresnsEditorExtension">
                    <div class="d-flex flex-column">
                        <img src="{{ $extend['icon'] }}" loading="lazy" width="20" height="20">
                        <span>{{ $extend['name'] }}</span>
                    </div>
                </button>
            @endif
        @endforeach
    @endif

    {{-- Extend Menus --}}
    @if ($editorConfig['extend']['status'] && $editorConfig['extend']['list'])
        <div class="dropdown">
            <button type="button" class="btn btn-outline-secondary rounded-0 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex flex-column">
                    <i class="bi bi-menu-up"></i>
                    <span>{{ fs_lang('editorExtends') }}</span>
                </div>
            </button>

            {{-- Extend List --}}
            <ul class="dropdown-menu rounded-0" aria-labelledby="expands">
                @foreach($editorConfig['extend']['list'] as $extend)
                    @if ($extend['isInToolbar'])
                        @continue
                    @endif
                    <li>
                        <a class="dropdown-item" role="button" data-bs-toggle="modal" href="#fresnsModal"
                            data-title="{{ $extend['name'] }}"
                            data-url="{{ $extend['appUrl']  }}"
                            data-draft-type="{{ $type }}"
                            data-did="{{ $did }}"
                            data-post-message-key="fresnsEditorExtension">
                            <img src="{{ $extend['icon'] }}" loading="lazy" width="20" height="20">
                            {{ $extend['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

{{-- Mention Modal --}}
@if ($editorConfig['mention']['status'] && $editorConfig['mention']['display'])
    <div class="modal fade" id="fresns-mention" tabindex="-1" aria-labelledby="fresns-mention" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" list="memberLists" class="form-control" id="atUser" placeholder="{{ fs_config('user_username_name') }} {{ fs_lang('modifierOr') }} {{ fs_config('user_nickname_name') }}">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal" aria-label="Close">✓</button>
                    </div>
                    <datalist id="memberLists">

                    </datalist>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Hashtag Modal --}}
@if ($editorConfig['hashtag']['status'] && $editorConfig['hashtag']['display'])
    <div class="modal fade" id="fresns-hashtag" tabindex="-1" aria-labelledby="fresns-hashtag" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">#</span>
                        <input type="text" list="hashtagLists" id="atHashtag" class="form-control" placeholder="{{ fs_config('hashtag_name') }}">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal" aria-label="Close">✓</button>
                    </div>
                    <datalist id="hashtagLists">

                    </datalist>
                </div>
            </div>
        </div>
    </div>
@endif

@push('script')
    <script>
        $(function (){
            @if ($editorConfig['mention']['status'])
                $("#atUser").on('input propertychange change', function (){
                    let query = $(this).val().trim();
                    if (query) {
                        $.get("{{ route('fresns.api.get', ['path' => '/api/fresns/v1/common/input-tips']) }}", {"type": 'user', "key": query}, function (data) {
                            let html = "";
                            $.each(data.data, function (k,v){
                                html += "<option value='" + v.fsid + "'>" + v.name + " " + "@" + v.fsid + "</option>"
                            })
                            $("#memberLists").empty().html(html);
                        }, 'json')
                    }
                }).bind('keypress', function (event) {
                    if (event.keyCode === 13) {
                        event.preventDefault()
                        $("#atUser").next().trigger("click")
                    }
                })

                $("#atUser").next().on('click',function () {
                    let userContent = $("#atUser").val();
                    if (userContent) {
                        $("#content").trigger('click').insertAtCaret(" @" + userContent + " ");
                    }
                });
            @endif

            @if ($editorConfig['hashtag']['status'])
                $("#atHashtag").on('input propertychange change', function (){
                    let query = $(this).val().trim();
                    if (query) {
                        $.get("{{ route('fresns.api.get', ['path' => '/api/fresns/v1/common/input-tips']) }}", {"type": 'hashtag', "key": query}, function (data) {
                            let html = "";
                            $.each(data.data, function (k,v){
                                html += "<option value='" + v.name +"'>"+ v.name +"</option>"
                            })
                            $("#hashtagLists").empty().html(html);
                        }, 'json')
                    }
                }).bind('keypress', function (event) {
                    if (event.keyCode === 13) {
                        event.preventDefault()
                        $("#atHashtag").next().trigger("click")
                    }
                })

                $("#atHashtag").next().on('click',function () {
                    let hashtagContent = $("#atHashtag").val();
                    if (hashtagContent) {
                        @if (fs_config('hashtag_format') == 2)
                            $("#content").trigger('click').insertAtCaret(" #" + hashtagContent + "# ");
                        @else
                            $("#content").trigger('click').insertAtCaret(" #" + hashtagContent + " ");
                        @endif
                    }
                });
            @endif
        })
    </script>
@endpush
