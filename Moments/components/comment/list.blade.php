@php
    $iconLike = null;
    $iconDislike = null;
    $iconFollow = null;
    $iconBlock = null;
    $iconComment = null;
    $iconShare = null;
    $iconMore = null;

    $title = null;
    $decorate = null;

    $detailLink = $detailLink ?? true;
    $sectionAuthorLiked = $sectionAuthorLiked ?? false;

    $totalFiles = 0;
    foreach($comment['files'] as $fileType => $files) {
        $totalFiles += count($files);
    }
@endphp

@if ($comment['operations']['buttonIcons'])
    @php
        $iconLike = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'like',
            'asArray' => false,
        ]);
        $iconDislike = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'dislike',
            'asArray' => false,
        ]);
        $iconFollow = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'follow',
            'asArray' => false,
        ]);
        $iconBlock = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'block',
            'asArray' => false,
        ]);
        $iconComment = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'comment',
            'asArray' => false,
        ]);
        $iconShare = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'share',
            'asArray' => false,
        ]);
        $iconMore = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'more',
            'asArray' => false,
        ]);
    @endphp
@endif

@if ($comment['operations']['diversifyImages'])
    @php
        $title = fs_helpers('Arr', 'pull', $comment['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'title',
            'asArray' => false,
        ]);
        $decorate = fs_helpers('Arr', 'pull', $comment['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'decorate',
            'asArray' => false,
        ]);
    @endphp
@endif

<article class="position-relative border-bottom pb-2 fs-hover" id="{{ $comment['cid'] }}">
    {{-- Comment Author --}}
    <section class="content-author order-0">
        @component('components.comment.section.author', [
            'cid' => $comment['cid'],
            'author' => $comment['author'],
            'isAnonymous' => $comment['isAnonymous'],
            'createdDatetime' => $comment['createdDatetime'],
            'createdTimeAgo' => $comment['createdTimeAgo'],
            'editedDatetime' => $comment['editedDatetime'],
            'editedTimeAgo' => $comment['editedTimeAgo'],
            'geotag' => $comment['geotag'],
            'moreInfo' => $comment['moreInfo'],
            'replyToComment' => $comment['replyToComment'],
        ])@endcomponent
    </section>

    {{-- Comment Main --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- Reply To Comment --}}
        @if ($comment['replyToComment'])
            <div class="fs-reply-to-comment fs-text-decoration position-relative">
                <p class="mb-1">
                    {{ fs_config('publish_comment_name') }}
                    @if (! $comment['replyToComment']['author']['status'])
                        {{ fs_lang('userDeactivate') }}
                    @elseif (! $comment['replyToComment']['author']['fsid'])
                        {{ fs_lang('contentAuthorAnonymous') }}
                    @else
                        <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $comment['replyToComment']['author']['fsid']]) }}">{{ $comment['replyToComment']['author']['nickname'] }}</a>
                    @endif

                    <span class="mx-1">|</span>

                    {{ fs_lang('contentPublishedOn') }}
                    {{ $comment['replyToComment']['createdDatetime'] }}
                </p>
                <p class="mb-0">
                    <a data-bs-toggle="modal" href="#replyToComment-{{ $comment['cid'] }}" class="text-decoration-none stretched-link">
                        {{ Str::limit(strip_tags($comment['replyToComment']['content']), 70) }}
                    </a>
                </p>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="replyToComment-{{ $comment['cid'] }}" tabindex="-1" aria-labelledby="replyToCommentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header p-0 pe-4">
                            <div class="modal-title">
                                @component('components.comment.section.author', [
                                    'cid' => $comment['replyToComment']['cid'],
                                    'author' => $comment['replyToComment']['author'],
                                    'isAnonymous' => $comment['replyToComment']['isAnonymous'],
                                    'createdDatetime' => $comment['replyToComment']['createdDatetime'],
                                    'createdTimeAgo' => $comment['replyToComment']['createdTimeAgo'],
                                    'editedDatetime' => $comment['replyToComment']['editedDatetime'],
                                    'editedTimeAgo' => $comment['replyToComment']['editedTimeAgo'],
                                    'geotag' => $comment['replyToComment']['geotag'],
                                    'moreInfo' => $comment['replyToComment']['moreInfo'],
                                    'replyToComment' => $comment['replyToComment']['replyToComment'],
                                ])@endcomponent
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($comment['replyToComment']['isMarkdown'])
                                {!! Str::markdown($comment['replyToComment']['content']) !!}
                            @else
                                {!! nl2br($comment['replyToComment']['content']) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Title --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- Title Icon --}}
            @if ($title)
                <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- Sticky --}}
            @if ($comment['isSticky'])
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="Sticky" class="ms-2">
            @endif

            {{-- Digest --}}
            @if ($comment['digestState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="General Digest" class="ms-2">
            @elseif ($comment['digestState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="Senior Digest" class="ms-2">
            @endif
        </div>

        {{-- Content --}}
        <div class="content-article text-break">
            @if ($comment['privacy'] == 'private')
                <div class="alert alert-warning" role="alert">
                    <i class="fa-solid fa-circle-info"></i> {{ fs_lang('editorCommentPrivate') }}
                </div>
            @else
                @if ($comment['isMarkdown'])
                    {!! Str::markdown($comment['content']) !!}
                @else
                    {!! nl2br($comment['content']) !!}
                @endif

                {{-- Detail Link --}}
                @if ($detailLink)
                    <p class="mt-2">
                        <a href="{{ route('fresns.comment.detail', ['cid' => $comment['cid']]) }}" class="text-decoration-none stretched-link">
                            @if ($comment['isBrief'])
                                {{ fs_lang('contentFull') }}
                            @endif
                        </a>
                    </p>
                @endif
            @endif
        </div>
    </section>

    {{-- Comment Decorate --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['image'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- Files --}}
    @if ($totalFiles > 0)
        <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($comment['files']['images']) }}">
            @component('components.comment.section.files', [
                'cid' => $comment['cid'],
                'createdDatetime' => $comment['createdDatetime'],
                'author' => $comment['author'],
                'files' => $comment['files'],
            ])@endcomponent
        </section>
    @endif

    {{-- Content Extends --}}
    @if ($comment['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.comment.section.extends', [
                'cid' => $comment['cid'],
                'createdDatetime' => $comment['createdDatetime'],
                'author' => $comment['author'],
                'extends' => $comment['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- Comment Interaction --}}
    <section class="interaction order-5 mt-3 mx-3">
        <div class="d-flex">
            {{-- Like --}}
            @if ($comment['interaction']['likeEnabled'])
                <div class="interaction-box">
                    @component('components.comment.mark.like', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Dislike --}}
            @if ($comment['interaction']['dislikeEnabled'])
                <div class="interaction-box">
                    @component('components.comment.mark.dislike', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['dislikeCount'],
                        'icon' => $iconDislike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Comment --}}
            <div class="interaction-box">
                <button class="btn btn-inter" type="button" data-bs-toggle="modal" @if (fs_user()->check()) data-bs-target="#commentModal-{{ $comment['cid'] }}" @else data-bs-target="#commentTipModal" @endif>
                    @if ($iconComment)
                        <img src="{{ $iconComment['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-comment.png" loading="lazy">
                    @endif
                    @if (! Route::is('fresns.comment.detail') && $comment['commentCount'])
                        <span class="cm-count">{{ $comment['commentCount'] }}</span>
                    @endif
                </button>
            </div>

            {{-- Share --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.comment.mark.share', [
                    'cid' => $comment['cid'],
                    'url' => $comment['url'],
                ])@endcomponent
            </div>

            {{-- More --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.comment.mark.more', [
                    'cid' => $comment['cid'],
                    'uid' => $comment['author']['uid'],
                    'editControls' => $comment['editControls'],
                    'interaction' => $comment['interaction'],
                    'followCount' => $comment['followCount'],
                    'blockCount' => $comment['blockCount'],
                    'manages' => $comment['manages'],
                    'viewType' => 'list',
                ])@endcomponent
            </div>
        </div>

        {{-- Comment Box --}}
        @if (fs_user()->check())
            @component('components.editor.quick-publish-comment', [
                'nickname' => $comment['author']['nickname'],
                'pid' => $comment['replyToPost']['pid'] ?? null,
                'cid' => $comment['cid'],
            ])@endcomponent
        @endif
    </section>

    {{-- Post Author Like Status --}}
    @if ($sectionAuthorLiked && $comment['interaction']['postAuthorLikeStatus'])
        <div class="post-author-liked order-5 mt-1 mb-2 mx-3">
            <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
        </div>
    @endif

    {{-- Comment Preview --}}
    @if ($comment['previewComments'])
        @component('components.comment.section.preview', [
            'cid' => $comment['cid'],
            'commentCount' => $comment['commentCount'],
            'previewComments' => $comment['previewComments'],
        ])@endcomponent
    @endif

    {{-- Post Preview --}}
    @if ($comment['replyToPost'])
        @component('components.comment.section.post', [
            'post' => $comment['replyToPost'],
        ])@endcomponent
    @endif
</article>
