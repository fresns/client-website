<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('group_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- Group Home --}}
        @if (fs_config('channel_group_status'))
            <a href="{{ route('fresns.group.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.group.index') ? 'active' : '' }}
                @if (request()->url() === rtrim(route('fresns.home'), '/')) active @endif">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-group-home.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_group_name') }}
            </a>
        @endif

        {{-- Group List --}}
        @if (fs_config('channel_group_list_status'))
            <a href="{{ route('fresns.group.list') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.group.list') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-group-list.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_group_list_name') }}
            </a>
        @endif

        {{-- Likes --}}
        @if (fs_config('group_like_enabled'))
            <a href="{{ route('fresns.group.likes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.group.likes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-likes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_likes_groups_name') }}
            </a>
        @endif

        {{-- Dislikes --}}
        @if (fs_config('group_dislike_enabled'))
            <a href="{{ route('fresns.group.dislikes') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.group.dislikes') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-dislikes.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_dislikes_groups_name') }}
            </a>
        @endif

        {{-- Following --}}
        @if (fs_config('group_follow_enabled'))
            <a href="{{ route('fresns.group.following') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.group.following') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-following.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_following_groups_name') }}
            </a>
        @endif

        {{-- Blocking --}}
        @if (fs_config('group_block_enabled'))
            <a href="{{ route('fresns.group.blocking') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.group.blocking') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-blocking.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_blocking_groups_name') }}
            </a>
        @endif
    </div>
</nav>
