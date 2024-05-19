<header class="fixed-top">
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('fresns.home') }}"><img src="{{ fs_config('site_logo') }}" height="40"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsNavbar" aria-controls="fresnsNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-3" id="fresnsNavbar">
                {{-- navbar --}}
                <ul class="nav nav-pills me-auto my-4 my-lg-0">
                    {{-- portal --}}
                    @if (fs_config('channel_portal_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.portal') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'portal') active @endif"
                                href="{{ route('fresns.portal') }}">
                                {{ fs_config('channel_portal_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- user --}}
                    @if (fs_config('channel_user_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.user.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'user') active @endif"
                                href="{{ route('fresns.user.index') }}">
                                {{ fs_config('channel_user_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- group --}}
                    @if (fs_config('channel_group_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.group.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'group') active @endif"
                                href="{{ route('fresns.group.index') }}">
                                {{ fs_config('channel_group_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- hashtag --}}
                    @if (fs_config('channel_hashtag_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.hashtag.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'hashtag') active @endif"
                                href="{{ route('fresns.hashtag.index') }}">
                                {{ fs_config('channel_hashtag_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- geotag --}}
                    @if (fs_config('channel_geotag_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.geotag.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'geotag') active @endif"
                                href="{{ route('fresns.geotag.index') }}">
                                {{ fs_config('channel_geotag_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- post --}}
                    @if (fs_config('channel_post_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.post.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'post') active @endif"
                                href="{{ route('fresns.post.index') }}">
                                {{ fs_config('channel_post_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- comment --}}
                    @if (fs_config('channel_comment_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.comment.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'comment') active @endif"
                                href="{{ route('fresns.comment.index') }}">
                                {{ fs_config('channel_comment_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- timeline --}}
                    @if (fs_config('channel_timeline_posts_status') || fs_config('channel_timeline_comments_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.timeline.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'timeline') active @endif"
                                href="{{ route('fresns.timeline.index') }}">
                                {{ fs_config('channel_timeline_name') }}
                            </a>
                        </li>
                    @endif

                    {{-- nearby --}}
                    @if (fs_config('channel_nearby_posts_status') || fs_config('channel_nearby_comments_status'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('fresns.nearby.*') ? 'active' : '' }}
                                @if (request()->url() == rtrim(route('fresns.home'), '/') && fs_config('default_homepage') == 'nearby') active @endif"
                                href="{{ route('fresns.nearby.index') }}">
                                {{ fs_config('channel_nearby_name') }}
                            </a>
                        </li>
                    @endif
                </ul>

                {{-- search --}}
                <form class="me-3 my-4 my-lg-0" action="{{ route('fresns.search.index') }}" method="get">
                    <input type="hidden" name="searchType" value="post"/>
                    <input class="form-control" name="searchKey" value="{{ request('searchKey') }}" placeholder="{{ fs_lang('search') }}" aria-label="Search">
                </form>

                {{-- Login Status --}}
                <div class="d-flex mb-4 mb-lg-0">
                    @if (fs_user()->check())
                        {{-- Logged In --}}
                        <a class="btn" href="{{ route('fresns.me.index') }}" role="button"><img src="{{ fs_user('detail.avatar') }}" loading="lazy" class="nav-avatar rounded-circle"> {{ fs_user('detail.nickname') }}</a>

                        @if (! Route::is('fresns.editor.*'))
                            @if (fs_config('fs_theme_quick_publish'))
                                <button type="button" class="btn btn-outline-secondary btn-nav ms-2 rounded-circle" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-plus-lg"></i></button>
                            @else
                                <a class="btn btn-outline-secondary btn-nav ms-2 rounded-circle" href="{{ route('fresns.editor.post') }}"><i class="bi bi-plus-lg"></i></a>
                            @endif
                        @endif

                        <a href="{{ route('fresns.notification.index') }}"role="button" class="btn btn-outline-secondary btn-nav ms-2 rounded-circle position-relative">
                            <i class="bi bi-bell"></i>
                            @if (fs_user_overview('unreadNotifications.all') > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ fs_user_overview('unreadNotifications.all') }}</span>
                            @endif
                        </a>

                        @if (fs_config('conversation_status'))
                            <a href="{{ route('fresns.conversation.index') }}"role="button" class="btn btn-outline-secondary btn-nav ms-2 rounded-circle position-relative">
                                <i class="bi bi-envelope"></i>
                                @if (fs_user_overview('conversations.unreadMessages') > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ fs_user_overview('conversations.unreadMessages') }}</span>
                                @endif
                            </a>
                        @endif

                        {{-- User Menus --}}
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-nav ms-2 rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-caret-down-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- User Center --}}
                                <li><a class="dropdown-item" href="{{ route('fresns.me.index') }}"><i class="bi bi-person-fill"></i> {{ fs_config('channel_me_name') }}</a></li>

                                {{-- Notifications --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('fresns.notification.index') }}">
                                        <i class="bi bi-bell"></i>
                                        {{ fs_config('channel_notifications_name') }}

                                        @if (fs_user_overview('unreadNotifications.all') > 0)
                                            <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.all') }}</span>
                                        @endif
                                    </a>
                                </li>

                                {{-- Conversations --}}
                                @if (fs_config('conversation_status'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('fresns.conversation.index') }}">
                                            <i class="bi bi-envelope"></i>
                                            {{ fs_config('channel_conversations_name') }}

                                            @if (fs_user_overview('conversations.unreadMessages') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('conversations.unreadMessages') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- Drafts --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('fresns.me.drafts') }}">
                                        <i class="bi bi-file-earmark-text"></i>
                                        {{ fs_config('channel_me_drafts_name') }}

                                        @if (array_sum(fs_user_overview('draftCount')) > 0)
                                            <span class="badge bg-primary">{{ array_sum(fs_user_overview('draftCount')) }}</span>
                                        @endif
                                    </a>
                                </li>

                                {{-- Wallet --}}
                                @if (fs_config('wallet_status'))
                                    <li><a class="dropdown-item" href="{{ route('fresns.me.wallet') }}"><i class="bi bi-wallet"></i> {{ fs_config('channel_me_wallet_name') }}</a></li>
                                @endif

                                {{-- Users of this account --}}
                                @if (fs_user_overview('multiUser.status') || count(fs_account('detail.users')) > 1)
                                    <li><a class="dropdown-item" href="{{ route('fresns.me.users') }}"><i class="bi bi-people"></i> {{ fs_config('channel_me_users_name') }}</a></li>
                                @endif

                                {{-- Settings --}}
                                <li><a class="dropdown-item" href="{{ route('fresns.me.settings') }}"><i class="bi bi-gear"></i> {{ fs_config('channel_me_settings_name') }}</a></li>
                                <li><hr class="dropdown-divider"></li>

                                {{-- Switch Languages --}}
                                @if (fs_config('language_status'))
                                    <li><a class="dropdown-item" href="#translate" data-bs-toggle="modal"><i class="bi bi-translate"></i> {{ fs_lang('switchLanguage') }}</a></li>
                                @endif

                                {{-- Switch Users --}}
                                @if (count(fs_account('detail.users')) > 1)
                                    <li><a class="dropdown-item" href="#userAuth" id="switch-user" data-bs-toggle="modal"><i class="bi bi-people"></i> {{ fs_lang('switchUser') }}</a></li>
                                @endif

                                {{-- Logout --}}
                                <li><a class="dropdown-item" href="{{ route('fresns.me.logout') }}"><i class="bi bi-power"></i> {{ fs_lang('accountLogout') }}</a></li>
                            </ul>
                        </div>
                    @else
                        {{-- Not Logged In --}}
                        <button class="btn btn-outline-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                            data-modal-height="700px"
                            data-title="{{ fs_lang('accountLogin') }}"
                            data-url="{{ fs_config('account_login_service') }}"
                            data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                            data-post-message-key="fresnsAccountSign">
                            {{ fs_lang('accountLogin') }}
                        </button>

                        @if (fs_config('account_register_status'))
                            <button class="btn btn-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-modal-height="700px"
                                data-title="{{ fs_lang('accountRegister') }}"
                                data-url="{{ fs_config('account_register_service') }}"
                                data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                                data-post-message-key="fresnsAccountSign">
                                {{ fs_lang('accountRegister') }}
                            </button>
                        @endif

                        @if (fs_config('language_status'))
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-translate"></i>
                                    @foreach(fs_config('language_menus') as $lang)
                                        @if (fs_theme('lang') == $lang['langTag']) {{ $lang['langName'] }} @endif
                                    @endforeach
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @foreach(fs_config('language_menus') as $lang)
                                        @if (! $lang['isEnabled'])
                                            @continue
                                        @endif
                                        <li>
                                            <a class="dropdown-item @if (fs_theme('lang') == $lang['langTag']) active @endif" href="{!! request()->fullUrlWithQuery(['language' => $lang['langTag']]) !!}" hreflang="{{ $lang['langTag'] }}">
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @endif
                </div>

            </div>
        </div>
    </nav>
</header>
