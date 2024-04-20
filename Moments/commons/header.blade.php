<nav class="navbar navbar-expand-lg fixed-top border-end fs-navbar">
    <div class="container-fluid d-lg-flex flex-lg-column align-items-center">
        {{-- go back --}}
        @if (! Route::is([
            'fresns.home',
            'fresns.portal',
            'fresns.post.index',
            'fresns.nearby.posts',
            'fresns.group.index',
            'fresns.timeline.posts',
            'fresns.me.index',
        ]) && request()->url() != fs_route(route('fresns.custom.page', ['name' => 'channels'])))
            <a class="btn btn-outline-secondary border-0 rounded-circle d-block d-sm-none" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
        @endif

        {{-- logo --}}
        <a class="navbar-brand rounded-circle" href="{{ fs_route(route('fresns.home')) }}">
            <img src="{{ fs_config('site_icon') }}" alt="{{ fs_config('site_name') }}" class="d-none d-sm-block" width="50" height="50">
            <img src="{{ fs_config('site_logo') }}" alt="{{ fs_config('site_name') }}" class="d-block d-sm-none" height="30">
        </a>

        @if (fs_user()->check() && Route::is([
            'fresns.home',
            'fresns.portal',
            'fresns.login',
            'fresns.custom.page',
            'fresns.*.index',
            'fresns.*.list',
            'fresns.geotag.*',
            'fresns.nearby.*',
            'fresns.timeline.*',
            'fresns.group.detail',
        ]) && ! Route::is([
            'fresns.notification.index',
            'fresns.conversation.index',
            'fresns.editor.*',
        ]) || request()->url() == fs_route(route('fresns.custom.page', ['name' => 'channels'])))
            @if (fs_config('moments_quick_publish'))
                <button class="btn btn-warning text-white rounded-pill d-lg-none fs-create fs-6" type="button" data-bs-toggle="modal" data-bs-target="#createModal">{{ fs_config('publish_post_name') }}</button>
            @else
                <a class="btn btn-warning text-white rounded-pill d-lg-none fs-create fs-6" href="{{ fs_route(route('fresns.editor.post')) }}">{{ fs_config('publish_post_name') }}</a>
            @endif
        @else
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        @endif

        {{-- navbar --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav fs-menus d-flex flex-column">
                {{-- Home --}}
                <li class="nav-item mt-1">
                    <a class="nav-link rounded-pill d-inline-flex {{ Route::is('fresns.home') ? 'active' : '' }}" href="{{ fs_route(route('fresns.home')) }}">
                        {!! Route::is('fresns.home') ? '<i class="fa-solid fa-fw fa-house-user mx-2 mt-1"></i>' : '<i class="fa-solid fa-fw fa-house mx-2 mt-1"></i>' !!}
                        <span class="me-2">{{ fs_lang('home') }}</span>
                    </a>
                </li>
                {{-- Portal or Post --}}
                @if (fs_config('default_homepage') == 'post')
                    @if (fs_config('channel_portal_status'))
                        <li class="nav-item mt-1">
                            <a class="nav-link rounded-pill d-inline-flex {{ Route::is('fresns.portal') ? 'active' : '' }}" href="{{ fs_route(route('fresns.portal')) }}">
                                {!! Route::is('fresns.portal') ? '<i class="fa-solid fa-fw fa-newspaper mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-newspaper mx-2 mt-1"></i>' !!}
                                <span class="me-2">{{ fs_config('channel_portal_name') }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item mt-1">
                        <a class="nav-link rounded-pill d-inline-flex {{ Route::is('fresns.post.index') ? 'active' : '' }}" href="{{ fs_route(route('fresns.post.index')) }}">
                            {!! Route::is('fresns.post.index') ? '<i class="fa-solid fa-fw fa-newspaper mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-newspaper mx-2 mt-1"></i>' !!}
                            <span class="me-2">{{ fs_config('channel_post_name') }}</span>
                        </a>
                    </li>
                @endif
                {{-- Group --}}
                @if (fs_config('channel_group_status'))
                    <li class="nav-item mt-1">
                        <a class="nav-link rounded-pill d-inline-flex {{ Route::is(['fresns.group.index', 'fresns.group.detail']) ? 'active' : '' }}" href="{{ fs_route(route('fresns.group.index')) }}">
                            {!! Route::is(['fresns.group.*']) ? '<i class="fa-solid fa-fw fa-building mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-building mx-2 mt-1"></i>' !!}
                            <span class="me-2">{{ fs_config('channel_group_name') }}</span>
                        </a>
                    </li>
                @endif
                {{-- Channels --}}
                <li class="nav-item mt-1">
                    <a class="nav-link rounded-pill d-inline-flex {{ Route::is('fresns.custom.page', ['name' => 'channels']) ? 'active' : '' }}" href="{{ fs_route(route('fresns.custom.page', ['name' => 'channels'])) }}">
                        {!! Route::is('fresns.custom.page', ['name' => 'channels']) ? '<i class="fa-solid fa-fw fa-compass mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-compass mx-2 mt-1"></i>' !!}
                        <span class="me-2">{{ fs_lang('discover') }}</span>
                    </a>
                </li>
                @if (fs_user()->check())
                    {{-- Notifications --}}
                    <li class="nav-item mt-1">
                        <a class="nav-link rounded-pill d-inline-flex {{ Route::is(['fresns.notification.index']) ? 'active' : '' }}" href="{{ fs_route(route('fresns.notification.index')) }}">
                            {!! Route::is(['fresns.notification.index']) ? '<i class="fa-solid fa-fw fa-bell mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-bell mx-2 mt-1"></i>' !!}
                            <span class="me-2">{{ fs_config('channel_notifications_name') }}</span>

                            @if (fs_user_overview('unreadNotifications.all') > 0)
                                <span class="badge bg-danger rounded-pill">{{ fs_user_overview('unreadNotifications.all') }}</span>
                            @endif
                        </a>
                    </li>
                    {{-- Messages --}}
                    @if (fs_config('conversation_status'))
                        <li class="nav-item mt-1">
                            <a class="nav-link rounded-pill d-inline-flex {{ Route::is('fresns.conversation.*') ? 'active' : '' }}" href="{{ fs_route(route('fresns.conversation.index')) }}">
                                {!! Route::is('fresns.conversation.*') ? '<i class="fa-solid fa-fw fa-envelope mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-envelope mx-2 mt-1"></i>' !!}
                                <span class="me-2">{{ fs_config('channel_conversations_name') }}</span>

                                @if (fs_user_overview('conversations.unreadMessages') > 0)
                                    <span class="badge bg-danger rounded-pill">{{ fs_user_overview('conversations.unreadMessages') }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                    {{-- User Center --}}
                    <li class="nav-item mt-1">
                        <a class="nav-link rounded-pill d-inline-flex {{ Route::is('fresns.me.*') ? 'active' : '' }}" href="{{ fs_route(route('fresns.me.index')) }}">
                            {!! Route::is('fresns.me.*') ? '<i class="fa-solid fa-fw fa-user mx-2 mt-1"></i>' : '<i class="fa-regular fa-fw fa-user mx-2 mt-1"></i>' !!}
                            {{ fs_config('channel_me_name') }}
                        </a>
                    </li>
                    {{-- Publish --}}
                    @if (! Route::is('fresns.editor.*'))
                        <li class="nav-item mt-4">
                            <div class="d-grid gap-2">
                                @if (fs_config('moments_quick_publish'))
                                    <button class="btn btn-warning text-white rounded-pill fs-create" type="button" data-bs-toggle="modal" data-bs-target="#createModal">{{ fs_config('publish_post_name') }}</button>
                                @else
                                    <a class="btn btn-warning text-white rounded-pill fs-create" href="{{ fs_route(route('fresns.editor.post')) }}">{{ fs_config('publish_post_name') }}</a>
                                @endif
                            </div>
                        </li>
                    @endif
                @else
                    {{-- Switch Languages --}}
                    @if (fs_config('language_status'))
                        <li class="nav-item mt-4 d-grid gap-2 dropup-center dropup">
                            <button class="btn btn-outline-secondary rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-fw fa-language"></i>
                                @foreach(fs_config('language_menus') as $lang)
                                    @if (fs_theme('lang') == $lang['langTag']) {{ $lang['langName'] }} @endif
                                @endforeach
                            </button>
                            <ul class="dropdown-menu">
                                @foreach(fs_config('language_menus') as $lang)
                                    @if (! $lang['isEnabled'])
                                        @continue
                                    @endif
                                    <li>
                                        <a class="dropdown-item py-3 @if (fs_theme('lang') == $lang['langTag']) active @endif" href="{{ request()->fullUrlWithQuery(['language' => $lang['langTag']]) }}" hreflang="{{ $lang['langTag'] }}">
                                            {{ $lang['langName'] }}
                                            @if ($lang['areaName'])
                                                {{ '('.$lang['areaName'].')' }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>

            {{-- Account --}}
            <div class="fs-account dropup-center dropup my-4 my-lg-0">
                @if (fs_user()->check())
                    <button type="button" class="btn btn-account rounded-pill d-flex py-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-avatar ms-1"><img src="{{ fs_user('detail.avatar') }}" class="rounded-circle"></div>
                        <div class="text-start ms-2">
                            <div class="nav-nickname">{{ fs_user('detail.nickname') }}</div>
                            <div class="text-secondary fs-7">{{ '@'.fs_user('detail.username') }}</div>
                        </div>
                        <div class="text-secondary ms-4 pt-2 me-1" style="padding-top: 10px"><i class="fa-solid fa-ellipsis"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                        {{-- Switch Languages --}}
                        @if (fs_config('language_status'))
                            <li><a class="dropdown-item py-3" href="#translate" data-bs-toggle="modal"><i class="fa-solid fa-fw fa-language me-2"></i> {{ fs_lang('switchLanguage') }}</a></li>
                        @endif
                        {{-- Switch Users --}}
                        @if (count(fs_account('detail.users')) > 1)
                            <li><a class="dropdown-item py-3" href="#userAuth" id="switch-user" data-bs-toggle="modal"><i class="fa-solid fa-fw fa-users me-2"></i> {{ fs_lang('switchUser') }}</a></li>
                        @endif
                        {{-- Logout --}}
                        <li><a class="dropdown-item py-3" href="{{ fs_route(route('fresns.me.logout', ['redirectURL' => request()->fullUrl()])) }}"><i class="fa-solid fa-fw fa-arrow-right-from-bracket me-2"></i> {{ fs_lang('accountLogout') }}</a></li>
                    </ul>
                @else
                    <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-modal-height="700px"
                        data-title="{{ fs_lang('accountLogin') }}"
                        data-url="{{ fs_config('account_login_service') }}"
                        data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                        data-post-message-key="fresnsAccountSign">
                        {{ fs_lang('accountLogin') }}
                    </button>

                    @if (fs_config('account_register_status'))
                        <button class="btn btn-outline-primary ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                            data-modal-height="700px"
                            data-title="{{ fs_lang('accountRegister') }}"
                            data-url="{{ fs_config('account_register_service') }}"
                            data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                            data-post-message-key="fresnsAccountSign">
                            {{ fs_lang('accountRegister') }}
                        </button>
                    @endif
                @endif
            </div>
            {{-- navbar-collapse end --}}
        </div>
    </div>
</nav>
