@if (fs_config('channel_post_status') || fs_config('channel_timeline_posts_status') || fs_config('channel_nearby_posts_status'))
    <nav class="nav nav-pills nav-fill nav-justified gap-2 p-1 small bg-white border rounded-pill shadow-sm m-3">
        @if (fs_config('channel_post_status'))
            <a class="nav-link rounded-pill {{ (Route::is('fresns.post.index') || Route::is('fresns.home')) ? 'active' : '' }}" href="{{ route('fresns.post.index') }}">{{ fs_config('channel_post_name') }}</a>
        @endif
        @if (fs_config('channel_timeline_posts_status'))
            <a class="nav-link rounded-pill {{ Route::is('fresns.timeline.posts') ? 'active' : '' }}" href="{{ route('fresns.timeline.posts') }}">{{ fs_config('channel_timeline_posts_name') }}</a>
        @endif
        @if (fs_config('channel_nearby_posts_status'))
            <a class="nav-link rounded-pill {{ Route::is('fresns.nearby.posts') ? 'active' : '' }}" href="{{ route('fresns.nearby.posts') }}">{{ fs_config('channel_nearby_posts_name') }}</a>
        @endif
    </nav>
@endif
