<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('channel_timeline_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- Post List --}}
        @if (fs_config('channel_timeline_posts_status'))
            <a href="{{ route('fresns.timeline.posts') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.timeline.posts') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-post-home.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_timeline_posts_name') }}
            </a>

            <a href="{{ route('fresns.timeline.user.posts') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.timeline.user.posts') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-post-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_timeline_user_posts_name') }}
            </a>
            
            <a href="{{ route('fresns.timeline.group.posts') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.timeline.group.posts') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-follow-posts.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_timeline_group_posts_name') }}
            </a>
        @endif

        {{-- Comment List --}}
        @if (fs_config('channel_timeline_comments_status'))
            <a href="{{ route('fresns.timeline.comments') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.timeline.comments') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-comment-home.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_timeline_comments_name') }}
            </a>

            <a href="{{ route('fresns.timeline.user.comments') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.timeline.user.comments') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-comment-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_timeline_user_comments_name') }}
            </a>
            
            <a href="{{ route('fresns.timeline.group.comments') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.timeline.group.comments') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-follow-comments.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_timeline_group_comments_name') }}
            </a>
        @endif
    </div>
</nav>
