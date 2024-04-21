{{-- Publish Modal --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ fs_config('publish_post_name') }}
                    <a href="{{ route('fresns.editor.post') }}" target="_blank" class="fs-7">
                        <i class="bi bi-box-arrow-up-right"></i>
                        {{ fs_lang('editorGoTo') }}
                    </a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-quick-publish" action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/editor/post/publish']) }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gid" id="editor-group-gid" value="{{ (fs_editor_post('group.status') && $group) ? $group['gid'] : '' }}">
                    @if (fs_editor_post('group.status'))
                        <div class="shadow-sm">
                            <div class="d-grid">
                                <button class="rounded-0 border-0 list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2" style="background-color: aliceblue;" type="button" data-bs-toggle="modal" data-bs-target="#editor-groups-modal" data-initialized="0" id="editor-group">
                                    <span class="py-2 ms-1">
                                        <i class="bi bi-archive-fill me-2"></i>
                                        <span id="editor-group-name">@if ($group) {{ $group['name'] }} @else {{ fs_config('group_name') }}: {{ fs_lang('editorNoSelectGroup') }} @endif</span>
                                    </span>
                                    <span class="py-2"><i class="bi bi-chevron-right"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- Content Start --}}
                    <div class="p-3">
                        {{-- Title --}}
                        @if (fs_editor_post('title.status'))
                            <div class="collapse @if (fs_editor_post('title.show')) show @endif" id="quickTitleCollapse">
                                <input type="text" class="form-control form-control-lg rounded-0 border-0 ps-2"
                                    name="title"
                                    placeholder="{{ fs_lang('editorTitle') }} (@if (fs_editor_post('title.required')) {{ fs_lang('required') }} @else {{ fs_lang('optional') }} @endif)"
                                    maxlength="{{ fs_editor_post('title.length') }}"
                                    @if (fs_editor_post('title.required')) required @endif >
                                <hr>
                            </div>
                        @endif

                        {{-- Content --}}
                        <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="quick-publish-post-content" rows="10" placeholder="{{ fs_lang('editorContent') }}"></textarea>

                        {{-- Function Buttons --}}
                        <div class="d-flex mt-2">
                            {{-- Title --}}
                            @if (fs_editor_post('title.status') && ! fs_editor_post('title.show'))
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="collapse" href="#quickTitleCollapse" aria-expanded="false" aria-controls="quickTitleCollapse"><i class="bi bi-textarea-t"></i></button>
                            @endif

                            {{-- Sticker --}}
                            @if (fs_editor_post('sticker'))
                                <div class="me-2">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <i class="bi bi-emoji-smile"></i>
                                    </button>
                                    {{-- Sticker List Start --}}
                                    <div class="dropdown-menu pt-0" aria-labelledby="stickers">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach(fs_editor_stickers() as $sticker)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link @if ($loop->first) active @endif" id="quick-sticker-{{ $loop->index }}-tab" data-bs-toggle="tab" data-bs-target="#quick-sticker-{{ $loop->index }}" type="button" role="tab" aria-controls="quick-sticker-{{ $loop->index }}" aria-selected="{{ $loop->first }}">{{ $sticker['name'] }}</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content p-2 fs-sticker">
                                            @foreach(fs_editor_stickers() as $sticker)
                                                <div class="tab-pane fade @if ($loop->first) show active @endif" id="quick-sticker-{{ $loop->index }}" role="tabpanel" aria-labelledby="quick-sticker-{{ $loop->index }}-tab">
                                                    @foreach($sticker['stickers'] ?? [] as $value)
                                                        <a class="fresns-post-sticker btn btn-outline-secondary border-0" href="javascript:;" value="{{ $value['code'] }}" title="{{ $value['code'] }}" >
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

                            {{-- Upload Image --}}
                            @if (fs_editor_post('image.status'))
                                <div class="input-group">
                                    <label class="input-group-text" for="post-file">{{ fs_lang('editorImages') }}</label>
                                    <input type="file" class="form-control" accept="{{ fs_editor_post('image.inputAccept') ?? null }}" name="image" id="post-file">
                                </div>
                            @endif
                        </div>

                        {{-- Other Options --}}
                        <hr>
                        <div class="d-flex bd-highlight align-items-center">
                            <div class="bd-highlight me-auto">
                                <button type="submit" class="btn btn-success btn-lg">{{ fs_config('publish_post_name') }}</button>
                            </div>
                            @if (fs_editor_post('anonymous'))
                                <div class="bd-highlight">
                                    <div class="form-check">
                                        <input class="form-check-input" name="isAnonymous" type="checkbox" value="1" id="isAnonymous">
                                        <label class="form-check-label" for="isAnonymous">{{ fs_lang('editorAnonymous') }}</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Form End --}}
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Group Modal --}}
<div class="modal fade" id="editor-groups-modal" tabindex="-1" aria-labelledby="editor-groups-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable" id="editor-groups-modal-class">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ fs_config('group_name') }}</h5>
                <button type="button" class="btn-close" data-bs-target="#createModal" data-bs-toggle="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-start">
                {{-- Group List --}}
                <div id="editor-top-groups">
                    @if (! fs_editor_post('group.required'))
                        <button type="button" class="btn btn-outline-secondary btn-sm mb-2 w-100" data-bs-target="#createModal" data-bs-toggle="modal" aria-label="Close" onclick="editorGroup.editorGroupConfirm(this)" data-gid="" data-name="{{ fs_config('group_name') }}: {{ fs_lang('editorNoSelectGroup') }}" data-web-page="quick">
                            {{ fs_lang('editorNoGroup') }}
                        </button>
                    @endif
                    <div class="list-group"></div>
                    <div class="list-group-addmore text-center mb-2 fs-7 text-secondary"></div>
                </div>

                <div id="group-list-1" class="d-flex justify-content-start"></div>
                {{-- Group List --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal" aria-label="Close" id="editor-group-confirm" onclick="editorGroup.editorGroupConfirm(this)" data-gid="" data-name="" data-web-page="quick" disabled>
                    {{ fs_lang('confirm') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(".fresns-post-sticker").on('click', function () {
            $("#quick-publish-post-content").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
        });
    </script>
@endpush
