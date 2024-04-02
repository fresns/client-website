@if (Route::is([
    'fresns.home',
    'fresns.portal',
    'fresns.login',
    'fresns.custom.page',
    'fresns.post.index',
    'fresns.nearby.posts',
    'fresns.group.index',
    'fresns.timeline.posts',
    'fresns.me.index',
]) || request()->url() == fs_route(route('fresns.custom.page', ['name' => 'channels'])))
    <div class="clearfix py-5 d-lg-none"></div>
    <div class="fs-tabbar fixed-bottom bg-light border-top d-lg-none">
        <div class="row mx-1">
            {{-- home --}}
            <div class="col text-center">
                <a class="text-decoration-none {{ Route::is('fresns.home') ? 'link-fresns' : 'link-secondary' }}" href="{{ fs_route(route('fresns.home')) }}">
                    <div class="fs-5 pt-2">{!! Route::is('fresns.home') ? '<i class="fa-solid fa-house-user"></i>' : '<i class="fa-solid fa-house"></i>' !!}</div>
                    <div class="fs-8 pb-2">{{ fs_lang('home') }}</div>
                </a>
            </div>

            {{-- portal or Post --}}
            @if (fs_config('default_homepage') == 'post')
                @if (fs_config('channel_portal_status'))
                    <div class="col text-center">
                        <a class="text-decoration-none {{ Route::is('fresns.portal') ? 'link-fresns' : 'link-secondary' }}" href="{{ fs_route(route('fresns.portal')) }}">
                            <div class="fs-5 pt-2">{!! Route::is('fresns.portal') ? '<i class="fa-solid fa-newspaper"></i>' : '<i class="fa-regular fa-newspaper"></i>' !!}</div>
                            <div class="fs-8 pb-2">{{ fs_config('channel_portal_name') }}</div>
                        </a>
                    </div>
                @endif
            @else
                <div class="col text-center">
                    <a class="text-decoration-none {{ Route::is('fresns.post.index') ? 'link-fresns' : 'link-secondary' }}" href="{{ fs_route(route('fresns.post.index')) }}">
                        <div class="fs-5 pt-2">{!! Route::is('fresns.post.index') ? '<i class="fa-solid fa-newspaper"></i>' : '<i class="fa-regular fa-newspaper"></i>' !!}</div>
                        <div class="fs-8 pb-2">{{ fs_config('channel_post_name') }}</div>
                    </a>
                </div>
            @endif

            {{-- group --}}
            @if (fs_config('channel_group_status'))
                <div class="col text-center">
                    <a class="text-decoration-none {{ Route::is('fresns.group.index') ? 'link-fresns' : 'link-secondary' }}" href="{{ fs_route(route('fresns.group.index')) }}">
                        <div class="fs-5 pt-2">{!! Route::is(['fresns.group.*']) ? '<i class="fa-solid fa-building"></i>' : '<i class="fa-regular fa-building"></i>' !!}</div>
                        <div class="fs-8 pb-2">{{ fs_config('channel_group_name') }}</div>
                    </a>
                </div>
            @endif

            {{-- channels --}}
            <div class="col text-center">
                <a class="text-decoration-none {{ Route::is('fresns.custom.page', ['name' => 'channels']) ? 'link-fresns' : 'link-secondary' }}" href="{{ fs_route(route('fresns.custom.page', ['name' => 'channels'])) }}">
                    <div class="fs-5 pt-2">{!! Route::is('fresns.custom.page', ['name' => 'channels']) ? '<i class="fa-solid fa-compass"></i>' : '<i class="fa-regular fa-compass"></i>' !!}</div>
                    <div class="fs-8 pb-2">{{ fs_lang('discover') }}</div>
                </a>
            </div>

            {{-- user --}}
            <div class="col text-center">
                <a class="text-decoration-none {{ Route::is('fresns.me.index') ? 'link-fresns' : 'link-secondary' }}" href="{{ fs_route(route('fresns.me.index')) }}">
                    <div class="fs-5 pt-2 position-relative">
                        {!! Route::is(['fresns.me.*']) ? '<i class="fa-solid fa-user"></i>' : '<i class="fa-regular fa-user"></i>' !!}

                        @if (fs_user()->check())
                            @php
                                $unreadCount = fs_user_overview('conversations.unreadMessages') + fs_user_overview('unreadNotifications.all');
                            @endphp
                            @if ($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill" style="font-size:0.6rem">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        @endif
                    </div>
                    <div class="fs-8 pb-2">{{ fs_lang('me') }}</div>
                </a>
            </div>
        </div>
    </div>
@endif
