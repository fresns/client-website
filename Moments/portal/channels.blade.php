@extends('commons.fresns')

@section('title', fs_lang('discover'))

@section('content')
    <div class="text-bg-light p-2 mb-3">
        @if (! fs_config('moments_search_method'))
            <form action="{{ route('fresns.search.index') }}" method="get">
                <input type="hidden" name="searchType" value="post"/>
                <input class="form-control rounded-pill bg-light py-2 px-3" name="searchKey" value="{{ request('searchKey') }}" placeholder="{{ fs_lang('search') }}" aria-label="Search">
            </form>
        @else
            <form id="searchForm" action="https://www.google.com/search" method="get" target="_blank">
                <input type="text" id="searchInput" name="userSearch" placeholder="{{ fs_lang('search') }}" class="form-control rounded-pill bg-light py-2 px-3">
                <input type="hidden" id="hiddenSearch" name="q">
            </form>
            <script>
                document.getElementById('searchForm').addEventListener('submit', function(e) {
                    const searchInput = document.getElementById('searchInput');
                    const hiddenSearch = document.getElementById('hiddenSearch');
                    hiddenSearch.value = 'site:{{ fs_config('site_url') }} ' + searchInput.value;
                });
            </script>
        @endif

        {{-- Sticky Posts --}}
        @if (fs_sticky_posts())
            <div class="mt-2">
                @foreach(fs_sticky_posts() as $sticky)
                    @component('components.post.sticky', compact('sticky'))@endcomponent
                @endforeach
            </div>
        @endif
    </div>

    <div class="list-group rounded-0 my-3">
        {{-- User --}}
        @if (fs_config('channel_user_list_status'))
            <a href="{{ route('fresns.user.list') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-regular fa-fw fa-circle-user me-2"></i> {{ fs_config('channel_user_list_name') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
        {{-- Group --}}
        @if (fs_config('channel_group_list_status'))
            <a href="{{ route('fresns.group.list') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-regular fa-fw fa-building me-2"></i> {{ fs_config('channel_group_list_name') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
        {{-- Hashtag --}}
        @if (fs_config('channel_hashtag_list_status'))
            <a href="{{ route('fresns.hashtag.list') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-solid fa-fw fa-hashtag me-2"></i> {{ fs_config('channel_hashtag_list_name') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
        {{-- Post --}}
        @if (fs_config('channel_post_list_status'))
            <a href="{{ route('fresns.post.list') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-regular fa-fw fa-newspaper me-2"></i> {{ fs_config('channel_post_list_name') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
        {{-- Comment --}}
        @if (fs_config('channel_comment_list_status'))
            <a href="{{ route('fresns.comment.list') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-regular fa-fw fa-comment-dots me-2"></i> {{ fs_config('channel_comment_list_name') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
    </div>

    @if (fs_channels())
        <div class="list-group rounded-0 my-3">
            @foreach(fs_channels() as $channel)
                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" data-bs-toggle="modal" href="#fresnsModal"
                    data-modal-width="100%"
                    data-modal-height="100%"
                    data-title="{{ $channel['name'] }}"
                    data-url="{{ $channel['appUrl'] }}"
                    data-post-message-key="fresnsChannel">
                    <span class="py-2">
                        @if ($channel['icon'])
                            <img src="{{ $channel['icon'] }}" loading="lazy" class="rounded me-1" height="24">
                        @endif
                        {{ $channel['name'] }}
                    </span>
                    <span class="py-2 text-black-50">
                        @if ($channel['badgeType'])
                            <span class="badge border border-light rounded-circle bg-danger @if ($channel['badgeType'] == 1) p-1 @endif">
                                {{ $channel['badgeType'] == 1 ? '' : $channel['badgeValue'] }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        @endif
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                </a>
            @endforeach
        </div>
    @endif
@endsection
