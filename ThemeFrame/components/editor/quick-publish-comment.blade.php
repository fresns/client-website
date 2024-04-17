@php
    $cid = $cid ?? '';
@endphp

{{-- Comment Box --}}
@if (fs_user()->check())
    <div class="card order-5 mt-3 fresns-reply @if (empty($show)) hide @else show @endif" @if (empty($show)) style="display: none" @endif>
        <div class="card-header d-flex">
            <div class="flex-grow-1">{{ fs_config('publish_comment_name') }} {{ $nickname }}</div>
            <button type="button" class="btn-close"></button>
        </div>
        <div class="card-body">
            <form class="form-quick-publish" action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/editor/comment/publish']) }}" method="post" enctype="multipart/form-data">
                <div class="editor-content">
                    <input type="hidden" name="commentPid" value="{{ $pid }}">
                    <input type="hidden" name="commentCid" value="{{ $cid }}">

                    <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="{{ 'quick-publish-comment-content'.$pid.$cid }}" rows="5" placeholder="{{ fs_lang('editorContent') }}"></textarea>

                    {{-- Sticker and Upload --}}
                    <div class="d-flex mt-2">
                        @if (fs_editor('comment', 'sticker'))
                            <div class="me-2">
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="bi bi-emoji-smile"></i>
                                </button>
                                {{-- Sticker List Start --}}
                                <div class="dropdown-menu pt-0" aria-labelledby="stickers">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach(fs_stickers() as $sticker)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if ($loop->first) active @endif" id="quick-comment-{{ $pid.$cid }}-sticker-{{ $loop->index }}-tab" data-bs-toggle="tab" data-bs-target="#quick-comment-{{ $pid.$cid }}-sticker-{{ $loop->index }}" type="button" role="tab" aria-controls="quick-comment-{{ $pid.$cid }}-sticker-{{ $loop->index }}" aria-selected="{{ $loop->first }}">{{ $sticker['name'] }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content p-2 fs-sticker">
                                        @foreach(fs_stickers() as $sticker)
                                            <div class="tab-pane fade @if ($loop->first) show active @endif" id="quick-comment-{{ $pid.$cid }}-sticker-{{ $loop->index }}" role="tabpanel" aria-labelledby="quick-comment-{{ $pid.$cid }}-sticker-{{ $loop->index }}-tab">
                                                @foreach($sticker['stickers'] ?? [] as $value)
                                                    <a class="{{ 'fresns-comment-sticker'.$pid.$cid }} btn btn-outline-secondary border-0" href="javascript:;" value="{{ $value['code'] }}" title="{{ $value['code'] }}" >
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

                        @if (fs_editor('comment', 'image.status'))
                            <div class="input-group">
                                <label class="input-group-text" for="comment-file-{{ $pid.$cid }}">{{ fs_lang('editorImages') }}</label>
                                <input type="file" class="form-control" accept="{{ fs_editor('comment', 'image.inputAccept') }}" name="image" id="comment-file-{{ $pid.$cid }}">
                            </div>
                        @endif
                    </div>

                    <hr>
                    <div class="d-flex bd-highlight align-items-center">
                        {{-- Comment Button --}}
                        <div class="bd-highlight me-auto">
                            <button type="submit" class="btn btn-success">{{ fs_config('publish_comment_name') }}</button>
                        </div>

                        {{-- Anonymous Option --}}
                        @if (fs_editor('comment', 'anonymous'))
                            <div class="bd-highlight">
                                <div class="form-check">
                                    <input class="form-check-input" name="isAnonymous" type="checkbox" value="1" id="{{ $pid.$cid.'isAnonymous' }}">
                                    <label class="form-check-label" for="{{ $pid.$cid.'isAnonymous' }}">{{ fs_lang('editorAnonymous') }}</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $("{{ '.fresns-comment-sticker'.$pid.$cid }}").on('click',function (){
            $("{{ '#quick-publish-comment-content'.$pid.$cid }}").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
        });
    </script>
@else
    <div class="card order-5 mt-3 fresns-reply @if (empty($show)) hide @else show @endif" @if (empty($show)) style="display: none" @endif>
        <div class="card-header d-flex">
            <div class="flex-grow-1">{{ fs_config('publish_comment_name') }} {{ $nickname }}</div>
            <button type="button" class="btn-close"></button>
        </div>
        <div class="card-body py-5 text-center">
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
    </div>
@endif
