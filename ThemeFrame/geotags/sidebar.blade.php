<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('geotag_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- Hashtag Home --}}
        @if (fs_config('channel_geotag_status'))
            <a href="{{ route('fresns.geotag.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.geotag.index') ? 'active' : '' }}
                @if (request()->url() === rtrim(route('fresns.home'), '/')) active @endif">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-group-home.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_geotag_name') }}
            </a>
        @endif

        {{-- Hashtag List --}}
        @if (fs_config('channel_geotag_list_status'))
            <a href="{{ route('fresns.geotag.list') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.geotag.list') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-group-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_geotag_list_name') }}
            </a>
        @endif

        {{-- Likes --}}
        @if (fs_config('geotag_like_enabled'))
            <a href="{{ route('fresns.geotag.likes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.geotag.likes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-likes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_likes_geotags_name') }}
            </a>
        @endif

        {{-- Dislikes --}}
        @if (fs_config('geotag_dislike_enabled'))
            <a href="{{ route('fresns.geotag.dislikes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.geotag.dislikes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-dislikes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_dislikes_geotags_name') }}
            </a>
        @endif

        {{-- Following --}}
        @if (fs_config('geotag_follow_enabled'))
            <a href="{{ route('fresns.geotag.following') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.geotag.following') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-following.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_following_geotags_name') }}
            </a>
        @endif

        {{-- Blocking --}}
        @if (fs_config('geotag_block_enabled'))
            <a href="{{ route('fresns.geotag.blocking') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.geotag.blocking') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-blocking.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_blocking_geotags_name') }}
            </a>
        @endif
    </div>
</nav>
