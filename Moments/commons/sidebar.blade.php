{{-- Search --}}
<aside class="mt-2 mb-3">
    @if (fs_config('moments_search_method') == 'api')
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
</aside>

{{-- Widget --}}
{!! fs_config('moments_widget_sidebar') !!}

{{-- Sticky Posts --}}
@if (fs_sticky_posts())
    <aside class="fs-list-group rounded mb-3">
        <h4 class="fs-5 px-3 pb-1 pt-3">{{ fs_lang('contentSticky') }}</h4>
        @foreach(fs_sticky_posts() as $sticky)
            @component('components.posts.sticky', compact('sticky'))@endcomponent
        @endforeach
    </aside>
@endif

{{-- Digest Posts --}}
<aside class="fs-list-group rounded mb-3">
    <h4 class="fs-5 px-3 pb-1 pt-3">{{ fs_lang('contentHotList') }}</h4>
    @foreach(fs_content_list('post', 'list') as $topPost)
        <a href="{{ route('fresns.post.detail', ['pid' => $topPost['pid']]) }}" class="list-group-item list-group-item-action text-break px-3 py-2">
            <i class="fa-solid fa-arrow-trend-up me-1 text-primary"></i>
            {{ $topPost['title'] ?? Str::limit(strip_tags($topPost['content']), 80) }}
        </a>
    @endforeach
</aside>

{{-- Recommend Users --}}
<aside class="fs-list-group rounded mb-3">
    <h4 class="fs-5 px-3 pb-1 pt-3">{{ fs_lang('contentRecommend') }}</h4>
    @foreach(fs_content_list('user', 'home') as $topUser)
        @component('components.users.sidebar-list', compact('topUser'))@endcomponent
    @endforeach
</aside>
