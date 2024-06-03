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
@endphp

@if ($sticky['operations']['buttonIcons'])
    @php
        $iconLike = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'like',
            'asArray' => false,
        ]);
        $iconDislike = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'dislike',
            'asArray' => false,
        ]);
        $iconFollow = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'follow',
            'asArray' => false,
        ]);
        $iconBlock = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'block',
            'asArray' => false,
        ]);
        $iconComment = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'comment',
            'asArray' => false,
        ]);
        $iconShare = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'share',
            'asArray' => false,
        ]);
        $iconMore = fs_helpers('Arr', 'pull', $sticky['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'more',
            'asArray' => false,
        ]);
    @endphp
@endif

@if ($sticky['operations']['diversifyImages'])
    @php
        $title = fs_helpers('Arr', 'pull', $sticky['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'title',
            'asArray' => false,
        ]);
        $decorate = fs_helpers('Arr', 'pull', $sticky['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'decorate',
            'asArray' => false,
        ]);
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $sticky['cid'] }}">
    {{-- Comment Author --}}
    <section class="content-author order-0">
        @component('components.comments.sections.author', [
            'cid' => $sticky['cid'],
            'author' => $sticky['author'],
            'isAnonymous' => $sticky['isAnonymous'],
            'createdDatetime' => $sticky['createdDatetime'],
            'createdTimeAgo' => $sticky['createdTimeAgo'],
            'editedDatetime' => $sticky['editedDatetime'],
            'editedTimeAgo' => $sticky['editedTimeAgo'],
            'geotag' => $sticky['geotag'],
            'moreInfo' => $sticky['moreInfo'],
            'replyToComment' => $sticky['replyToComment'],
        ])@endcomponent
    </section>

    {{-- Comment Main --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- Title --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- Title Icon --}}
            @if ($title)
                <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- Sticky --}}
            @if ($sticky['isSticky'])
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="Sticky" class="ms-2">
            @endif

            {{-- Digest --}}
            @if ($sticky['digestState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="General Digest" class="ms-2">
            @elseif ($sticky['digestState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="Senior Digest" class="ms-2">
            @endif
        </div>

        {{-- Content --}}
        <div class="content-article">
            @if ($sticky['privacy'] == 'private')
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-info-circle"></i> {{ fs_lang('editorCommentPrivate') }}
                </div>
            @else
                @if ($sticky['isMarkdown'])
                    {!! Str::markdown($sticky['content']) !!}
                @else
                    {!! nl2br($sticky['content']) !!}
                @endif

                {{-- Detail Link --}}
                @if ($detailLink)
                    <p class="mt-2">
                        <a href="{{ route('fresns.comment.detail', ['cid' => $sticky['cid']]) }}" class="text-decoration-none stretched-link">
                            @if ($sticky['isBrief'])
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
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($sticky['files']['images']) }}">
        @component('components.comments.sections.files', [
            'cid' => $sticky['cid'],
            'createdDatetime' => $sticky['createdDatetime'],
            'author' => $sticky['author'],
            'files' => $sticky['files'],
        ])@endcomponent
    </section>

    {{-- Content Extends --}}
    @if ($sticky['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.comments.sections.extends', [
                'cid' => $sticky['cid'],
                'createdDatetime' => $sticky['createdDatetime'],
                'author' => $sticky['author'],
                'extends' => $sticky['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- Comment Interaction --}}
    <section class="interaction order-5 mt-3 mx-3">
        <div class="d-flex">
            {{-- Like --}}
            @if ($sticky['interaction']['likeEnabled'])
                <div class="interaction-box">
                    @component('components.comments.mark.like', [
                        'cid' => $sticky['cid'],
                        'interaction' => $sticky['interaction'],
                        'count' => $sticky['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Dislike --}}
            @if ($sticky['interaction']['dislikeEnabled'])
                <div class="interaction-box">
                    @component('components.comments.mark.dislike', [
                        'cid' => $sticky['cid'],
                        'interaction' => $sticky['interaction'],
                        'count' => $sticky['dislikeCount'],
                        'icon' => $iconDislike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Comment --}}
            <div class="interaction-box fresns-trigger-reply">
                <a class="btn btn-inter" href="javascript:;" role="button">
                    @if ($iconComment)
                        <img src="{{ $iconComment['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-comment.png" loading="lazy">
                    @endif
                    <span class="cm-count">
                    {{ $sticky['commentCount'] }}
                    </span>
                </a>
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
                @component('components.comments.mark.share', [
                    'cid' => $sticky['cid'],
                    'url' => $sticky['url'],
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
                @component('components.comments.mark.more', [
                    'cid' => $sticky['cid'],
                    'uid' => $sticky['author']['uid'],
                    'controls' => $sticky['controls'],
                    'interaction' => $sticky['interaction'],
                    'followCount' => $sticky['followCount'],
                    'blockCount' => $sticky['blockCount'],
                    'manages' => $sticky['manages'],
                    'viewType' => 'list',
                ])@endcomponent
            </div>
        </div>

        {{-- Post Author Like Status --}}
        @if ($sectionAuthorLiked && $sticky['interaction']['postAuthorLikeStatus'])
            <div class="post-author-liked order-5 mt-2">
                <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
            </div>
        @endif

        {{-- Comment Box --}}
        @component('components.editor.quick-publish-comment', [
            'nickname' => $sticky['author']['nickname'],
            'pid' => $sticky['replyToPost']['pid'] ?? null,
            'cid' => $sticky['cid'],
        ])@endcomponent
    </section>
</div>
