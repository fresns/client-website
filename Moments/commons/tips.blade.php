@if (session('success'))
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-50 start-50 translate-middle" style="z-index:2048">
        <div class="toast show text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-error-code="{{ session('code') }}">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@elseif (session('failure'))
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-50 start-50 translate-middle" style="z-index:2048">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-error-code="{{ session('code') }}">
            <div class="toast-header">
                <img src="{{ fs_config('site_icon') }}" width="20px" height="20px" class="me-2" alt="{{ fs_config('site_name') }}">
                <strong class="me-auto">{{ fs_config('site_name') }}</strong>
                @if (session('code') !== 0)
                    <small>{{ session('code') }}</small>
                @endif

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {!! session('failure') !!}

                @if (session('code') == 36104)
                    <div class="mt-2 pt-2 border-top">
                        <kbd>{{ fs_config('channel_me_settings_name') }}->{{ fs_lang('settingAccount') }}</kbd>
                        <a class="btn btn-primary btn-sm" href="{{ route('fresns.me.settings').'#account-tab' }}" role="button">{{ fs_lang('setting') }}</a>
                    </div>
                @endif

                @if (session('code') == 38200)
                    <div class="mt-2 pt-2 border-top">
                        <a class="btn btn-primary btn-sm" href="{{ route('fresns.me.drafts') }}" role="button">{{ fs_lang('view') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
