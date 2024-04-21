<nav class="nav nav-pills nav-fill nav-justified gap-2 p-1 small bg-white border rounded-pill shadow-sm m-3">
    <a class="nav-link rounded-pill {{ Route::is('fresns.post.index') ? 'active' : '' }} @if (request()->url() === rtrim(route('fresns.home'), '/')) active @endif" href="{{ route('fresns.post.index') }}">{{ fs_config('channel_post_name') }}</a>
    <a class="nav-link rounded-pill {{ Route::is('fresns.timeline.posts') ? 'active' : '' }}" href="{{ route('fresns.timeline.posts') }}">{{ fs_config('channel_timeline_posts_name') }}</a>
    <a class="nav-link rounded-pill {{ Route::is('fresns.nearby.posts') ? 'active' : '' }}" href="{{ route('fresns.nearby.posts') }}">{{ fs_config('channel_nearby_posts_name') }}</a>
</nav>
