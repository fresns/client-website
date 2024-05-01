<!doctype html>
<html lang="{{ fs_theme('lang') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Fresns" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title') - {{ fs_config('site_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ fs_config('site_name') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ fs_config('site_icon') }}">
    <link rel="icon" href="{{ fs_config('site_icon') }}">
    @if (fs_config('language_status'))
        @foreach(fs_config('language_menus') as $lang)
            @if (! $lang['isEnabled'])
                @continue
            @endif
            <link rel="alternate" href="{{ request()->fullUrlWithQuery(['language' => $lang['langTag']]) }}" hreflang="{{ $lang['langTag'] }}"/>
        @endforeach
    @endif
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/atwho.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/prism.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/fresns.css') }}">
    <script src="/static/js/jquery.min.js"></script>
    @stack('style')
    @if (fs_config('website_stat_position') == 'head')
        {!! fs_config('website_stat_code') !!}
    @endif
</head>

<body>
    {{-- Header --}}
    <header class="fs-header">
        @include('commons.header')
    </header>

    @if (Route::is([
        'fresns.me.*',
        'fresns.editor.*',
        'fresns.portal',
        'fresns.custom.page',
    ]) || fs_config('default_homepage') == 'portal' && Route::is('fresns.home'))
        {{-- Main --}}
        <main class="main-fullscreen ms-25 pt-4 mt-lg-0 pt-lg-0">
            @yield('content')
        </main>

        {{-- Footer --}}
        @if (Route::is('fresns.me.index'))
            <footer class="ms-25 py-4 text-center text-muted border-top">
                <p class="mb-1">
                    @if (fs_config('account_terms_status'))
                        <a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#terms-tab' }}" class="link-secondary text-decoration-none">{{ fs_lang('accountPoliciesTerms') }}</a>
                    @endif
                    @if (fs_config('account_privacy_status'))
                        <a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#privacy-tab' }}" class="link-secondary text-decoration-none ms-2">{{ fs_lang('accountPoliciesPrivacy') }}</a>
                    @endif
                    @if (fs_config('account_cookie_status'))
                        <a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#cookies-tab' }}" class="link-secondary text-decoration-none ms-2">{{ fs_lang('accountPoliciesCookie') }}</a>
                    @endif
                </p>

                <p class="mb-1">Copyright &copy; {{ fs_config('site_copyright_years') }} {{ fs_config('site_copyright_name') }}. All Rights Reserved</p>

                @if (fs_config('site_china_mode'))
                    <p class="mb-1" style="font-size:15px;">
                        @if (fs_config('china_icp_filing'))
                            <a href="https://beian.miit.gov.cn/" target="_blank" rel="nofollow" class="text-decoration-none link-secondary">{{ fs_config('china_icp_filing') }}</a>
                        @endif
                        @if (fs_config('china_icp_filing') && fs_config('china_mps_filing'))
                            <span class="mx-1">|</span>
                        @endif
                        @if (fs_config('china_mps_filing'))
                            <a href="https://beian.mps.gov.cn/#/query/webSearch?code={{ Str::of(fs_config('china_mps_filing'))->match('/\d+/') }}" target="_blank" rel="nofollow" class="text-decoration-none link-secondary">{{ fs_config('china_mps_filing') }}</a>
                        @endif
                    </p>

                    @if (fs_config('china_icp_license'))
                        <p class="mb-1" style="font-size:15px;">{{ fs_config('china_icp_license') }}</p>
                    @endif

                    @if (fs_config('china_broadcasting_license'))
                        <p class="mb-1" style="font-size:15px;">{{ fs_config('china_broadcasting_license') }}</p>
                    @endif
                @endif

                <p class="mb-0">Powered by <a href="https://fresns.org" target="_blank" class="text-decoration-none link-secondary">Fresns</a></p>
            </footer>
        @endif
    @else
        {{-- Main --}}
        <main class="fs-main pt-4 mt-lg-0 pt-lg-0">
            {{-- Private mode user status handling --}}
            @if (fs_user()->check() && fs_user('detail.expired'))
                <div class="alert alert-warning m-3" role="alert">
                    <i class="fa-solid fa-circle-info"></i>
                    @if (fs_config('site_private_end_after') == 1)
                        {{ fs_lang('privateContentHide') }}
                    @else
                        {{ fs_lang('privateContentShowOld') }}
                    @endif

                    <button class="btn btn-primary btn-sm ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-title="{{ fs_lang('renewal') }}"
                        data-url="{{ fs_config('site_public_service') }}"
                        data-post-message-key="fresnsRenewal">
                        {{ fs_lang('renewal') }}
                    </button>
                </div>
            @endif

            {{-- content --}}
            @yield('content')
        </main>

        {{-- Sidebar --}}
        <div class="fs-sidebar d-none d-sm-block">
            {{-- Sidebar --}}
            <section>
                @include('commons.sidebar')
            </section>

            {{-- Footer --}}
            @include('commons.footer')
        </div>
    @endif

    {{-- Mobile Tabbar --}}
    @include('commons.tabbar')

    {{-- Fresns Extensions Modal --}}
    <div class="modal fade" id="fresnsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fresnsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fresnsModalLabel">Fresns Title</h5>
                    <button type="button" class="btn-close btn-done-extensions" id="done-extensions" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:0"></div>
            </div>
        </div>
    </div>

    {{-- Quick Post Box --}}
    @if (fs_user()->check() && ! Route::is('fresns.editor.*'))
        @component('components.editor.quick-publish-post', [
            'group' => $group ?? null
        ])@endcomponent
    @endif

    {{-- Tip Toasts --}}
    <div class="fresns-tips">
        @include('commons.tips')
    </div>

    {{-- Loading --}}
    @if (fs_config('moments_loading'))
        <div id="loading" class="position-fixed top-50 start-50 translate-middle bg-light bg-opacity-75 rounded pt-4 pb-5 px-5" style="z-index:2048;display:none;">
            <div class="loader"></div>
        </div>
    @endif

    {{-- Switching Languages Modal --}}
    @if (fs_config('language_status'))
        <div class="modal fade" id="translate" tabindex="-1" aria-labelledby="translateModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ fs_lang('switchLanguage') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush">
                            @foreach(fs_config('language_menus') as $lang)
                                @if (! $lang['isEnabled'])
                                    @continue
                                @endif
                                <a class="list-group-item list-group-item-action @if (fs_theme('lang') == $lang['langTag']) active @endif" href="{{ request()->fullUrlWithQuery(['language' => $lang['langTag']]) }}" hreflang="{{ $lang['langTag'] }}">
                                    {{ $lang['langName'] }}
                                    @if ($lang['areaName'])
                                        {{ '('.$lang['areaName'].')' }}
                                    @endif
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- User Auth --}}
    @include('commons.user-auth')

    {{-- No login comment tip --}}
    @if (fs_user()->guest())
        <div class="modal fade" id="commentTipModal" tabindex="-1" aria-labelledby="commentTipModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="commentTipModalLabel">{{ fs_config('publish_comment_name') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4 pb-5 text-center">
                        <p class="mt-2 mb-4 text-secondary">{{ fs_lang('errorNoLogin') }}</p>

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
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Stat Code --}}
    @if (fs_config('website_stat_position') == 'body')
        <div style="display:none;">{!! fs_config('website_stat_code') !!}</div>
    @endif
    <script src="/static/js/bootstrap.bundle.min.js"></script>
    <script src="/static/js/js-cookie.min.js"></script>
    <script src="/static/js/fresns-callback.js"></script>
    <script>
        window.ajaxGetList = true;
        window.siteName = "{{ fs_config('site_name') }}";
        window.siteIcon = "{{ fs_config('site_icon') }}";
        window.cookiePrefix = "{{ fs_config('website_cookie_prefix') }}";
        window.userIdentifier = "{{ fs_config('user_identifier') }}";
        window.mentionStatus = {{ fs_config('mention_status') ? 1 : 0 }};
        window.hashtagStatus = {{ fs_config('hashtag_status') ? 1 : 0 }};
        window.hashtagFormat = {{ fs_config('hashtag_format') }};

        // back
        function goBack() {
            if (history.length <= 1) {
                window.location.href = "{{ route('fresns.home') }}";
            } else {
                history.go(-1);
            }
        };
    </script>
    <script src="{{ fs_theme('assets', 'js/fresns-extensions.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/jquery.caret.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/atwho.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/prism.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/fancybox.umd.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/fresns.js') }}"></script>
    @stack('script')
</body>

</html>
