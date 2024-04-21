<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('comment_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- Comment Home --}}
        @if (fs_config('channel_comment_status'))
            <a href="{{ route('fresns.comment.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.comment.index') ? 'active' : '' }}
                @if (request()->url() === rtrim(route('fresns.home'), '/')) active @endif">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-comment-home.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_comment_name') }}
            </a>
        @endif

        {{-- Comment List --}}
        @if (fs_config('channel_comment_list_status'))
            <a href="{{ route('fresns.comment.list') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.comment.list') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-comment-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_comment_list_name') }}
            </a>
        @endif

        {{-- Likes --}}
        @if (fs_config('comment_like_enabled'))
            <a href="{{ route('fresns.comment.likes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.comment.likes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-likes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_likes_comments_name') }}
            </a>
        @endif

        {{-- Dislikes --}}
        @if (fs_config('comment_dislike_enabled'))
            <a href="{{ route('fresns.comment.dislikes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.comment.dislikes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-dislikes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_dislikes_comments_name') }}
            </a>
        @endif

        {{-- Following --}}
        @if (fs_config('comment_follow_enabled'))
            <a href="{{ route('fresns.comment.following') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.comment.following') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-following.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_following_comments_name') }}
            </a>
        @endif

        {{-- Blocking --}}
        @if (fs_config('comment_block_enabled'))
            <a href="{{ route('fresns.comment.blocking') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.comment.blocking') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-blocking.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_blocking_comments_name') }}
            </a>
        @endif
    </div>
</nav>
