@php
    use \App\Utilities\ArrUtility;

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
        $iconLike = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'like');
        $iconDislike = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'dislike');
        $iconFollow = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'follow');
        $iconBlock = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'block');
        $iconComment = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'comment');
        $iconShare = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'share');
        $iconMore = ArrUtility::pull($post['operations']['buttonIcons'], 'code', 'more');
    @endphp
@endif

@if ($post['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($post['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($post['operations']['diversifyImages'], 'code', 'decorate');
    @endphp
@endif

<article class="position-relative border-bottom pt-2 pb-3 fs-hover" id="{{ $post['pid'] }}">
    {{-- Post Creator --}}
    <section class="content-creator order-0">
        @component('components.post.section.creator', [
            'pid' => $post['pid'],
            'creator' => $post['creator'],
            'isAnonymous' => $post['isAnonymous'],
            'createTime' => $post['createTime'],
            'createTimeFormat' => $post['createTimeFormat'],
            'editTime' => $post['editTime'],
            'editTimeFormat' => $post['editTimeFormat'],
            'moreJson' => $post['moreJson'],
            'location' => $post['location']
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
                <img src="/assets/themes/Moments/images/icon-sticky.png" loading="lazy" alt="Group Sticky" class="ms-2" height="24">
            @elseif ($post['stickyState'] == 3)
                <img src="/assets/themes/Moments/images/icon-sticky.png" loading="lazy" alt="Global Sticky" class="ms-2" height="24">
            @endif

            {{-- Digest --}}
            @if ($post['digestState'] == 2)
                <img src="/assets/themes/Moments/images/icon-digest.png" loading="lazy" alt="General Digest" class="ms-2" height="24">
            @elseif ($post['digestState'] == 3)
                <img src="/assets/themes/Moments/images/icon-digest.png" loading="lazy" alt="Senior Digest" class="ms-2" height="24">
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
    @if (! $post['isAllow'])
        <section class="post-allow order-2">
            <div class="post-allow-static"></div>
            <div class="text-center">
                <p class="text-secondary mb-2">{{ fs_lang('contentAllowInfo') }} {{ $post['allowProportion'] }}%</p>
                <button type="button" class="btn btn-outline-info btn-lg w-50" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-type="post"
                    data-scene="postAllowBtn"
                    data-post-message-key="fresnsPostUserList"
                    data-pid="{{ $post['pid'] }}"
                    data-uid="{{ $post['creator']['uid'] }}"
                    data-title="{{ $post['allowBtnName'] }}"
                    data-url="{{ $post['allowBtnUrl'] }}">
                    {{ $post['allowBtnName'] }}
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
                'createTime' => $post['createTime'],
                'creator' => $post['creator'],
                'files' => $post['files'],
            ])@endcomponent

            <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $post['pid']])) }}" class="text-decoration-none stretched-link"></a>
        </section>
    @endif

    {{-- Content Extends --}}
    @if ($post['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.post.section.extends', [
                'pid' => $post['pid'],
                'createTime' => $post['createTime'],
                'creator' => $post['creator'],
                'extends' => $post['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- Quoted Post --}}
    @if ($post['quotedPost'])
        @component('components.post.section.quoted-post', [
            'post' => $post['quotedPost'],
        ])@endcomponent
    @endif

    {{-- Post Append --}}
    @if ($post['group'] || $post['isUserList'] || $title)
        <section class="content-append order-4 mx-3 mt-3 d-flex">
            <div class="me-auto d-flex flex-row">
                {{-- Post Group --}}
                @if ($post['group'])
                    <div class="content-group me-2">
                        <a href="{{ fs_route(route('fresns.group.detail', ['gid' => $post['group']['gid']])) }}" class="badge rounded-pill text-decoration-none">
                            @if (!empty($post['group']['cover']))
                                <img src="{{ $post['group']['cover'] }}" loading="lazy" alt="$post['group']['gname']" class="rounded">
                            @endif
                            {{ $post['group']['gname'] }}
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
            @if ($post['isUserList'])
                <div class="content-user-list">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-type="post"
                        data-scene="postUserList"
                        data-post-message-key="fresnsPostUserList"
                        data-pid="{{ $post['pid'] }}"
                        data-uid="{{ $post['creator']['uid'] }}"
                        data-title="{{ $post['userListName'] }}"
                        data-url="{{ $post['userListUrl'] }}">
                        {{ $post['userListName'] }}
                        <span class="badge bg-light text-dark">{{ $post['userListCount'] }}</span>
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
            @if ($post['interaction']['likeSetting'])
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
            @if ($post['interaction']['dislikeSetting'])
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
                        <img src="/assets/themes/Moments/images/icon-comment.png">
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
                        <img src="/assets/themes/Moments/images/icon-share.png" loading="lazy">
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
                        <img src="/assets/themes/Moments/images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.post.mark.more', [
                    'pid' => $post['pid'],
                    'uid' => $post['creator']['uid'],
                    'editStatus' => $post['editStatus'],
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
                'nickname' => $post['creator']['nickname'],
                'pid' => $post['pid'],
            ])@endcomponent
        @endif
    </section>
</article>