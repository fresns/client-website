<nav class="nav nav-pills nav-fill nav-justified gap-2 p-1 small bg-white border rounded-pill shadow-sm m-3">
    <a class="nav-link rounded-pill {{ Route::is(['fresns.profile.index', 'fresns.profile.posts']) ? 'active' : '' }}" href="{{ route('fresns.profile.index', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('post_name') }}</a>
    <a class="nav-link rounded-pill {{ Route::is('fresns.profile.comments') ? 'active' : '' }}" href="{{ route('fresns.profile.comments', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('comment_name') }}</a>
    <a class="nav-link rounded-pill {{ Route::is('fresns.profile.following.users') ? 'active' : '' }}" href="{{ route('fresns.profile.following.users', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_following_users_name') }}</a>
    <a class="nav-link rounded-pill {{ Route::is('fresns.profile.followers') ? 'active' : '' }}" href="{{ route('fresns.profile.followers', ['uidOrUsername' => $profile['fsid']]) }}">{{ fs_config('profile_followers_name') }}</a>
</nav>
