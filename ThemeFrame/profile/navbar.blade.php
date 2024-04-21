<ul class="nav nav-tabs card-header-tabs">
    {{-- posts --}}
    @if (fs_config('profile_posts_enabled'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is('fresns.profile.posts') ? 'active' : '' }}"href="{{ route('fresns.profile.posts', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('post_name') }}</a>
        </li>
    @endif

    {{-- comments --}}
    @if (fs_config('profile_comments_enabled'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is('fresns.profile.comments') ? 'active' : '' }}" href="{{ route('fresns.profile.comments', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('comment_name') }}</a>
        </li>
    @endif

    {{-- interaction --}}
    @if (fs_config('user_like_public_record') != 1 && fs_config('user_dislike_public_record') != 1 && fs_config('user_follow_public_record') != 1 && fs_config('user_block_public_record') != 1)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Route::is([
                'fresns.profile.likers',
                'fresns.profile.dislikers',
                'fresns.profile.followers',
                'fresns.profile.blockers',
                'fresns.profile.followers.you.follow',
            ]) ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-users.png" loading="lazy" width="24" height="24">
            </a>
            <ul class="dropdown-menu">
                @if (fs_config('user_like_public_record') != 1)
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likers') ? 'active' : '' }}" href="{{ route('fresns.profile.likers', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likers_name') }}</a></li>
                @endif
                @if (fs_config('user_dislike_public_record') != 1)
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikers') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikers', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikers_name') }}</a></li>
                @endif
                @if (fs_config('user_follow_public_record') != 1)
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.followers') ? 'active' : '' }}" href="{{ route('fresns.profile.followers', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_followers_name') }}</a></li>
                @endif
                @if (fs_config('user_block_public_record') != 1)
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blockers') ? 'active' : '' }}" href="{{ route('fresns.profile.blockers', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blockers_name') }}</a></li>
                @endif
                @if (fs_config('profile_followers_you_follow_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.followers.you.follow') ? 'active' : '' }}" href="{{ route('fresns.profile.followers.you.follow', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_followers_you_follow_name') }}</a></li>
                @endif
            </ul>
        </li>
    @endif

    {{-- likes --}}
    @if (fs_config('profile_likes_users_enabled') && fs_config('profile_likes_groups_enabled') && fs_config('profile_likes_hashtags_enabled') && fs_config('profile_likes_posts_enabled') && fs_config('profile_likes_comments_enabled'))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Route::is('fresns.profile.likes.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-likes.png" loading="lazy" width="24" height="24">
            </a>
            <ul class="dropdown-menu">
                @if (fs_config('profile_likes_users_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likes.users') ? 'active' : '' }}" href="{{ route('fresns.profile.likes.users', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likes_users_name') }}</a></li>
                @endif
                @if (fs_config('profile_likes_groups_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likes.groups') ? 'active' : '' }}" href="{{ route('fresns.profile.likes.groups', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likes_groups_name') }}</a></li>
                @endif
                @if (fs_config('profile_likes_hashtags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likes.hashtags') ? 'active' : '' }}" href="{{ route('fresns.profile.likes.hashtags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likes_hashtags_name') }}</a></li>
                @endif
                @if (fs_config('profile_likes_geotags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likes.geotags') ? 'active' : '' }}" href="{{ route('fresns.profile.likes.geotags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likes_geotags_name') }}</a></li>
                @endif
                @if (fs_config('profile_likes_posts_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likes.posts') ? 'active' : '' }}" href="{{ route('fresns.profile.likes.posts', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likes_posts_name') }}</a></li>
                @endif
                @if (fs_config('profile_likes_comments_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.likes.comments') ? 'active' : '' }}" href="{{ route('fresns.profile.likes.comments', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_likes_comments_name') }}</a></li>
                @endif
            </ul>
        </li>
    @endif

    {{-- dislikes --}}
    @if (fs_config('profile_dislikes_users_enabled') && fs_config('profile_dislikes_groups_enabled') && fs_config('profile_dislikes_hashtags_enabled') && fs_config('profile_dislikes_posts_enabled') && fs_config('profile_dislikes_comments_enabled'))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Route::is('fresns.profile.dislikes.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-dislikes.png" loading="lazy" width="24" height="24">
            </a>
            <ul class="dropdown-menu">
                @if (fs_config('profile_dislikes_users_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikes.users') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikes.users', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikes_users_name') }}</a></li>
                @endif
                @if (fs_config('profile_dislikes_groups_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikes.groups') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikes.groups', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikes_groups_name') }}</a></li>
                @endif
                @if (fs_config('profile_dislikes_hashtags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikes.hashtags') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikes.hashtags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikes_hashtags_name') }}</a></li>
                @endif
                @if (fs_config('profile_dislikes_geotags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikes.geotags') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikes.geotags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikes_geotags_name') }}</a></li>
                @endif
                @if (fs_config('profile_dislikes_posts_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikes.posts') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikes.posts', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikes_posts_name') }}</a></li>
                @endif
                @if (fs_config('profile_dislikes_comments_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.dislikes.comments') ? 'active' : '' }}" href="{{ route('fresns.profile.dislikes.comments', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_dislikes_comments_name') }}</a></li>
                @endif
            </ul>
        </li>
    @endif

    {{-- following --}}
    @if (fs_config('profile_following_users_enabled') && fs_config('profile_following_groups_enabled') && fs_config('profile_following_hashtags_enabled') && fs_config('profile_following_posts_enabled') && fs_config('profile_following_comments_enabled'))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Route::is('fresns.profile.following.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-following.png" loading="lazy" width="24" height="24">
            </a>
            <ul class="dropdown-menu">
                @if (fs_config('profile_following_users_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.following.users') ? 'active' : '' }}" href="{{ route('fresns.profile.following.users', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_users_name') }}</a></li>
                @endif
                @if (fs_config('profile_following_groups_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.following.groups') ? 'active' : '' }}" href="{{ route('fresns.profile.following.groups', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_groups_name') }}</a></li>
                @endif
                @if (fs_config('profile_following_hashtags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.following.hashtags') ? 'active' : '' }}" href="{{ route('fresns.profile.following.hashtags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_hashtags_name') }}</a></li>
                @endif
                @if (fs_config('profile_following_geotags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.following.geotags') ? 'active' : '' }}" href="{{ route('fresns.profile.following.geotags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_geotags_name') }}</a></li>
                @endif
                @if (fs_config('profile_following_posts_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.following.posts') ? 'active' : '' }}" href="{{ route('fresns.profile.following.posts', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_posts_name') }}</a></li>
                @endif
                @if (fs_config('profile_following_comments_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.following.comments') ? 'active' : '' }}" href="{{ route('fresns.profile.following.comments', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_comments_name') }}</a></li>
                @endif
            </ul>
        </li>
    @endif

    {{-- blocking --}}
    @if (fs_config('profile_blocking_users_enabled') && fs_config('profile_blocking_groups_enabled') && fs_config('profile_blocking_hashtags_enabled') && fs_config('profile_blocking_posts_enabled') && fs_config('profile_blocking_comments_enabled'))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Route::is('fresns.profile.blocking.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-blocking.png" loading="lazy" width="24" height="24">
            </a>
            <ul class="dropdown-menu">
                @if (fs_config('profile_blocking_users_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blocking.users') ? 'active' : '' }}" href="{{ route('fresns.profile.blocking.users', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blocking_users_name') }}</a></li>
                @endif
                @if (fs_config('profile_blocking_groups_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blocking.groups') ? 'active' : '' }}" href="{{ route('fresns.profile.blocking.groups', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blocking_groups_name') }}</a></li>
                @endif
                @if (fs_config('profile_blocking_hashtags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blocking.hashtags') ? 'active' : '' }}" href="{{ route('fresns.profile.blocking.hashtags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blocking_hashtags_name') }}</a></li>
                @endif
                @if (fs_config('profile_blocking_geotags_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blocking.geotags') ? 'active' : '' }}" href="{{ route('fresns.profile.blocking.geotags', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blocking_geotags_name') }}</a></li>
                @endif
                @if (fs_config('profile_blocking_posts_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blocking.posts') ? 'active' : '' }}" href="{{ route('fresns.profile.blocking.posts', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blocking_posts_name') }}</a></li>
                @endif
                @if (fs_config('profile_blocking_comments_enabled'))
                    <li><a class="dropdown-item {{ Route::is('fresns.profile.blocking.comments') ? 'active' : '' }}" href="{{ route('fresns.profile.blocking.comments', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_blocking_comments_name') }}</a></li>
                @endif
            </ul>
        </li>
    @endif
</ul>
