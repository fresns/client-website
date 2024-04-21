<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('post_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- Post Home --}}
        @if (fs_config('channel_post_status'))
            <a href="{{ route('fresns.post.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.index') ? 'active' : '' }}
                @if (request()->url() === rtrim(route('fresns.home'), '/')) active @endif">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-post-home.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_post_name') }}
            </a>
        @endif

        {{-- Post List --}}
        @if (fs_config('channel_post_list_status'))
            <a href="{{ route('fresns.post.list') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.list') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-post-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_post_list_name') }}
            </a>
        @endif

        {{-- Likes --}}
        @if (fs_config('post_like_enabled'))
            <a href="{{ route('fresns.post.likes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.likes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-likes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_likes_posts_name') }}
            </a>
        @endif

        {{-- Dislikes --}}
        @if (fs_config('post_dislike_enabled'))
            <a href="{{ route('fresns.post.dislikes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.dislikes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-dislikes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_dislikes_posts_name') }}
            </a>
        @endif

        {{-- Following --}}
        @if (fs_config('post_follow_enabled'))
            <a href="{{ route('fresns.post.following') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.following') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-following.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_following_posts_name') }}
            </a>
        @endif

        {{-- Blocking --}}
        @if (fs_config('post_block_enabled'))
            <a href="{{ route('fresns.post.blocking') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.blocking') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-blocking.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_blocking_posts_name') }}
            </a>
        @endif
    </div>
</nav>
