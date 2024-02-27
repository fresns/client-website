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

    $totalFiles = 0;
    foreach($post['files'] as $fileType => $files) {
        $totalFiles += count($files);
    }
@endphp

@if ($post['operations']['buttonIcons'])
    @php
        $iconLike = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'like',
        ]);
        $iconDislike = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'dislike',
        ]);
        $iconFollow = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'follow',
        ]);
        $iconBlock = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'block',
        ]);
        $iconComment = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'comment',
        ]);
        $iconShare = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'share',
        ]);
        $iconMore = fs_helpers('Arr', 'pull', $post['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'more',
        ]);
    @endphp
@endif

@if ($post['operations']['diversifyImages'])
    @php
        $title = fs_helpers('Arr', 'pull', $post['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'title',
        ]);
        $decorate = fs_helpers('Arr', 'pull', $post['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'decorate',
        ]);
    @endphp
@endif

<article class="position-relative border-bottom pt-2 pb-3 fs-hover" id="{{ $post['pid'] }}">
    {{-- Post Author --}}
    <section class="content-author order-0">
        @component('components.post.section.author', [
            'pid' => $post['pid'],
            'author' => $post['author'],
            'isAnonymous' => $post['isAnonymous'],
            'createdDatetime' => $post['createdDatetime'],
            'createdTimeAgo' => $post['createdTimeAgo'],
            'editedDatetime' => $post['editedDatetime'],
            'editedTimeAgo' => $post['editedTimeAgo'],
            'geotag' => $post['geotag'],
            'moreInfo' => $post['moreInfo'],
        ])@endcomponent
    </section>

    {{-- Post Main --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- Title --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- Title Text --}}
            @if ($post['title'])
                <h1 class="h5 mb-3">{{ $post['title'] }}</h1>
            @endif

            {{-- Sticky --}}
            @if ($post['stickyState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="Group Sticky" class="ms-2" height="24">
            @elseif ($post['stickyState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="Global Sticky" class="ms-2" height="24">
            @endif

            {{-- Digest --}}
            @if ($post['digestState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="General Digest" class="ms-2" height="24">
            @elseif ($post['digestState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="Senior Digest" class="ms-2" height="24">
            @endif
        </div>

        {{-- Content --}}
        <div class="content-article text-break">
            @if ($post['isMarkdown'])
                {!! Str::markdown($post['content']) !!}
            @else
                {!! nl2br($post['content']) !!}
            @endif

            {{-- Detail Link --}}
            <p class="mt-2">
                <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $post['pid']])) }}" class="text-decoration-none stretched-link">
                    @if ($post['isBrief'])
                        {{ fs_lang('contentFull') }}
                    @endif
                </a>
            </p>
        </div>
    </section>

    {{-- Post Allow Info --}}
    @if ($post['readConfig']['isReadLocked'])
        <section class="post-allow order-2">
            <div class="post-allow-static"></div>
            <div class="text-center">
                <p class="text-secondary mb-2">{{ fs_lang('contentPreReadInfo') }} {{ $post['readConfig']['previewPercentage'] }}%</p>
                <button type="button" class="btn btn-outline-info btn-lg w-50" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-type="post"
                    data-scene="postAuthBtn"
                    data-post-message-key="fresnsPostAuthBtn"
                    data-pid="{{ $post['pid'] }}"
                    data-uid="{{ $post['author']['uid'] }}"
                    data-title="{{ $post['readConfig']['buttonName'] }}"
                    data-url="{{ $post['readConfig']['buttonUrl'] }}">
                    {{ $post['readConfig']['buttonName'] }}
                </button>
            </div>
        </section>
    @endif

    {{-- Post Decorate --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['imageUrl'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- Files --}}
    @if ($totalFiles > 0)
        <section class="content-files position-relative order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($post['files']['images']) }}">
            @component('components.post.section.files', [
                'pid' => $post['pid'],
                'createdDatetime' => $post['createdDatetime'],
                'author' => $post['author'],
                'files' => $post['files'],
            ])@endcomponent

            <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $post['pid']])) }}" class="text-decoration-none stretched-link"></a>
        </section>
    @endif

    {{-- Content Extends --}}
    <section class="content-extends order-3 mx-3">
        @component('components.post.section.extends', [
            'pid' => $post['pid'],
            'createdDatetime' => $post['createdDatetime'],
            'author' => $post['author'],
            'extends' => $post['extends']
        ])@endcomponent
    </section>

    {{-- Quoted Post --}}
    @if ($post['quotedPost'])
        @component('components.post.section.quoted-post', [
            'quotedPost' => $post['quotedPost'],
        ])@endcomponent
    @endif

    {{-- Post Append --}}
    @if ($post['group'] || $post['associatedUserListConfig']['hasUserList'] || $title)
        <section class="content-append order-4 mx-3 mt-3 d-flex">
            <div class="me-auto d-flex flex-row">
                {{-- Post Group --}}
                @if ($post['group'])
                    <div class="content-group me-2">
                        <a href="{{ fs_route(route('fresns.group.detail', ['gid' => $post['group']['gid']])) }}" class="badge rounded-pill text-decoration-none">
                            @if (!empty($post['group']['cover']))
                                <img src="{{ $post['group']['cover'] }}" loading="lazy" alt="$post['group']['name']" class="rounded">
                            @endif
                            {{ $post['group']['name'] }}
                        </a>
                    </div>
                @endif
                {{-- Title Icon --}}
                @if ($title)
                    <div class="me-2 mt-1">
                        <img src="{{ $title['imageUrl'] }}" loading="lazy" alt="{{ $title['name'] }}" height="26">
                    </div>
                @endif
            </div>

            {{-- Post Affiliate User List --}}
            @if ($post['associatedUserListConfig']['hasUserList'])
                <div class="content-user-list">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-type="post"
                        data-scene="postUserList"
                        data-post-message-key="fresnsPostUserList"
                        data-pid="{{ $post['pid'] }}"
                        data-uid="{{ $post['author']['uid'] }}"
                        data-title="{{ $post['associatedUserListConfig']['userListName'] }}"
                        data-url="{{ $post['associatedUserListConfig']['userListUrl'] }}">
                        {{ $post['associatedUserListConfig']['userListName'] }}
                        <span class="badge bg-light text-dark">{{ $post['associatedUserListConfig']['userListCount'] }}</span>
                    </button>
                </div>
            @endif
        </section>
    @endif

    {{-- Comment Preview --}}
    @if ($post['previewComments'])
        @component('components.post.section.preview-comment', [
            'pid' => $post['pid'],
            'commentCount' => $post['commentCount'],
            'previewComments' => $post['previewComments'],
        ])@endcomponent
    @endif

    {{-- Post Interaction --}}
    <section class="interaction order-5 mt-3 px-3">
        <div class="d-flex">
            {{-- Like --}}
            @if ($post['interaction']['likeEnabled'])
                <div class="interaction-box">
                    @component('components.post.mark.like', [
                        'pid' => $post['pid'],
                        'interaction' => $post['interaction'],
                        'count' => $post['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Dislike --}}
            @if ($post['interaction']['dislikeEnabled'])
                <div class="interaction-box">
                    @component('components.post.mark.dislike', [
                        'pid' => $post['pid'],
                        'interaction' => $post['interaction'],
                        'count' => $post['dislikeCount'],
                        'icon' => $iconDislike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Comment --}}
            <div class="interaction-box">
                <button class="btn btn-inter" type="button" data-bs-toggle="modal" @if (fs_user()->check()) data-bs-target="#commentModal-{{ $post['pid'] }}" @else data-bs-target="#commentTipModal" @endif>
                    @if ($iconComment)
                        <img src="{{ $iconComment['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-comment.png">
                    @endif
                    <span class="cm-count">{{ $post['commentCount'] ? $post['commentCount'] : '' }}</span>
                </button>
            </div>

            {{-- Share --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.post.mark.share', [
                    'pid' => $post['pid'],
                    'url' => $post['url'],
                ])@endcomponent
            </div>

            {{-- More --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.post.mark.more', [
                    'pid' => $post['pid'],
                    'uid' => $post['author']['uid'],
                    'editControls' => $post['editControls'],
                    'interaction' => $post['interaction'],
                    'followCount' => $post['followCount'],
                    'blockCount' => $post['blockCount'],
                    'manages' => $post['manages'],
                ])@endcomponent
            </div>
        </div>

        {{-- Comment Box --}}
        @if (fs_user()->check())
            @component('components.editor.comment-box', [
                'nickname' => $post['author']['nickname'],
                'pid' => $post['pid'],
            ])@endcomponent
        @endif
    </section>
</article>
