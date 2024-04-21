<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('channel_search_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- Search Users --}}
        @if (fs_config('channel_user_status'))
            <a href="{{ route('fresns.search.users', ['searchKey' => request('searchKey')]) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.search.users') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-user-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('user_name') }}
            </a>
        @endif

        {{-- Search Groups --}}
        @if (fs_config('channel_group_status'))
            <a href="{{ route('fresns.search.groups', ['searchKey' => request('searchKey')]) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.search.groups') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-group-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('group_name') }}
            </a>
        @endif

        {{-- Search Hashtags --}}
        @if (fs_config('channel_hashtag_status'))
            <a href="{{ route('fresns.search.hashtags', ['searchKey' => request('searchKey')]) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.search.hashtags') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-hashtag-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('hashtag_name') }}
            </a>
        @endif

        {{-- Search Posts --}}
        @if (fs_config('channel_post_status'))
            <a href="{{ route('fresns.search.posts', ['searchKey' => request('searchKey')]) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.search.posts') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-post-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('post_name') }}
            </a>
        @endif

        {{-- Search Comments --}}
        @if (fs_config('channel_comment_status'))
            <a href="{{ route('fresns.search.comments', ['searchKey' => request('searchKey')]) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.search.comments') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-comment-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('comment_name') }}
            </a>
        @endif
    </div>
</nav>
