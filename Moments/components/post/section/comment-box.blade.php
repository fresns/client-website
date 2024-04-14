<div class="border-bottom p-3">
    <label class="form-label">{{ fs_config('publish_comment_name') }} {{ $nickname }}</label>

    @if (fs_user()->check())
        @php
            $cid = $cid ?? '';
        @endphp
        {{-- Comment Box --}}
        <form class="form-quick-publish" action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/editor/comment/publish']) }}" method="post" enctype="multipart/form-data">
            <div class="editor-content">
                <input type="hidden" name="commentPid" value="{{ $pid }}">

                <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="{{ 'quick-publish-comment-content'.$pid }}" rows="4" placeholder="{{ fs_lang('editorContent') }}"></textarea>

                {{-- Content is Markdown --}}
                @if (fs_config('moments_editor_markdown')['commentBox'] ?? false)
                    <div class="bd-highlight my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isMarkdown" value="1" id="commentIsMarkdown">
                            <label class="form-check-label" for="commentIsMarkdown">{{ fs_lang('editorContentMarkdown') }}</label>
                        </div>
                    </div>
                @endif

                <div class="clearfix my-2">
                    {{-- Sticker and Upload --}}
                    <div class="float-lg-start @desktop w-65 @enddesktop">
                        <div class="d-flex">
                            @if (fs_comment_editor('sticker'))
                                <div class="stickers me-2">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <i class="fa-regular fa-face-smile"></i>
                                    </button>
                                    {{-- Sticker List Start --}}
                                    <div class="dropdown-menu pt-0" aria-labelledby="stickers">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach(fs_stickers() as $sticker)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link @if ($loop->first) active @endif" id="quick-comment-{{ $pid }}-sticker-{{ $loop->index }}-tab" data-bs-toggle="tab" data-bs-target="#quick-comment-{{ $pid }}-sticker-{{ $loop->index }}" type="button" role="tab" aria-controls="quick-comment-{{ $pid }}-sticker-{{ $loop->index }}" aria-selected="{{ $loop->first }}">{{ $sticker['name'] }}</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content p-2 fs-sticker">
                                            @foreach(fs_stickers() as $sticker)
                                                <div class="tab-pane fade @if ($loop->first) show active @endif" id="quick-comment-{{ $pid }}-sticker-{{ $loop->index }}" role="tabpanel" aria-labelledby="quick-comment-{{ $pid }}-sticker-{{ $loop->index }}-tab">
                                                    @foreach($sticker['stickers'] ?? [] as $value)
                                                        <a class="{{ 'fresns-comment-sticker'.$pid }} btn btn-outline-secondary border-0" href="javascript:;" value="{{ $value['code'] }}" title="{{ $value['code'] }}" >
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

                            @if (fs_comment_editor('image.status'))
                                <div class="input-group">
                                    <label class="input-group-text" for="comment-file-{{ $pid.$cid }}">{{ fs_lang('editorImages') }}</label>
                                    <input type="file" class="form-control" accept="{{ fs_comment_editor('image.inputAccept') }}" name="image" id="comment-file-{{ $pid.$cid }}">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Comment Button --}}
                    <div class="float-lg-end mt-3 mt-lg-0">
                        <div class="d-flex bd-highlight align-items-center">
                            {{-- Comment Button --}}
                            <div class="bd-highlight me-auto">
                                <button type="submit" class="btn btn-success">{{ fs_config('publish_comment_name') }}</button>
                            </div>

                            {{-- Anonymous Option --}}
                            @if (fs_comment_editor('anonymous'))
                                <div class="bd-highlight ms-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="isAnonymous" type="checkbox" value="1" id="{{ $pid.'isAnonymous' }}">
                                        <label class="form-check-label" for="{{ $pid.'isAnonymous' }}">{{ fs_lang('editorAnonymous') }}</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </form>
    @else
        {{-- Not Logged In Prompt --}}
        <div class="py-5 text-center">
            <p class="mb-4 text-secondary">{{ fs_lang('errorNoLogin') }}</p>

            <button class="btn btn-outline-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-modal-height="700px"
                data-title="{{ fs_lang('accountLogin') }}"
                data-url="{{ fs_config('account_login_service') }}"
                data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                data-post-message-key="fresnsAccountSign">
                {{ fs_lang('accountLogin') }}
            </button>

            @if (fs_config('account_register_status'))
                <button class="btn btn-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-modal-height="700px"
                    data-title="{{ fs_lang('accountRegister') }}"
                    data-url="{{ fs_config('account_register_service') }}"
                    data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                    data-post-message-key="fresnsAccountSign">
                    {{ fs_lang('accountRegister') }}
                </button>
            @endif
        </div>
    @endif
</div>

@push('script')
    <script>
        $("{{ '.fresns-comment-sticker'.$pid }}").on('click',function (){
            $("{{ '#quick-publish-comment-content'.$pid }}").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
        });
    </script>
@endpush
