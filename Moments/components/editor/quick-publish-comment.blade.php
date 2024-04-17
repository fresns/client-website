@php
    $modalId = $cid ?? $pid;
    $cid = $cid ?? '';
@endphp

{{-- Comment Box --}}
@if (fs_user()->check())
    <div class="modal fade" id="commentModal-{{ $modalId }}" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="commentModalLabel">{{ fs_config('publish_comment_name') }} {{ $nickname }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-quick-publish" action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/editor/comment/publish']) }}" method="post" enctype="multipart/form-data">
                        <div class="editor-content">
                            <input type="hidden" name="commentPid" value="{{ $pid }}">
                            <input type="hidden" name="commentCid" value="{{ $cid }}">

                            {{-- Content --}}
                            <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="{{ 'modal-quick-publish-comment-content'.$pid.$cid }}" rows="5" placeholder="{{ fs_lang('editorContent') }}"></textarea>

                            {{-- Content is Markdown --}}
                            @if (fs_config('moments_editor_markdown')['commentBox'] ?? false)
                                <div class="bd-highlight my-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="isMarkdown" value="1" id="{{ $pid.$cid }}-commentIsMarkdown">
                                        <label class="form-check-label" for="{{ $pid.$cid }}-commentIsMarkdown">{{ fs_lang('editorContentMarkdown') }}</label>
                                    </div>
                                </div>
                            @endif

                            {{-- Sticker and Upload --}}
                            <div class="d-flex mt-2">
                                @if (fs_editor('comment', 'sticker'))
                                    <div class="me-2">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            <i class="fa-regular fa-face-smile"></i>
                                        </button>
                                        {{-- Sticker List Start --}}
                                        <div class="dropdown-menu pt-0" aria-labelledby="stickers">
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach(fs_stickers() as $sticker)
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link @if ($loop->first) active @endif"
                                                            id="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}-tab"
                                                            data-bs-toggle="tab"
                                                            data-bs-target="#modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}"
                                                            type="button"
                                                            role="tab"
                                                            aria-controls="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}"
                                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $sticker['name'] }}</button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content p-2 fs-sticker">
                                                @foreach(fs_stickers() as $sticker)
                                                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                                                        id="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}"
                                                        role="tabpanel"
                                                        aria-labelledby="modal-{{ $pid.$cid }}-sticker-{{ $loop->index }}-tab"
                                                        tabindex="0">
                                                        @foreach($sticker['stickers'] ?? [] as $value)
                                                            <a class="{{ 'modal-fresns-comment-sticker'.$pid.$cid }} btn btn-outline-secondary border-0" href="javascript:;" value="{{ $value['code'] }}" title="{{ $value['code'] }}" >
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
                                        <label class="input-group-text" for="modal-comment-file-{{ $pid.$cid }}">{{ fs_lang('editorImages') }}</label>
                                        <input type="file" class="form-control" accept="{{ fs_editor('comment', 'image.inputAccept') }}" name="image" id="modal-comment-file-{{ $pid.$cid }}">
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
        </div>
    </div>

    <script>
        $("{{ '.modal-fresns-comment-sticker'.$pid.$cid }}").on('click',function (){
            $("{{ '#modal-quick-publish-comment-content'.$pid.$cid }}").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
        });
    </script>
@endif
