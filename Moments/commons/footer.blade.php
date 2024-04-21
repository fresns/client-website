<footer class="text-muted mb-3 fs-8 fs-text-decoration">
    <p class="mb-0">
        @if (fs_config('account_terms_status'))
            <a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#terms-tab' }}" class="link-secondary">{{ fs_lang('accountPoliciesTerms') }}</a>
        @endif
        @if (fs_config('account_privacy_status'))
            <a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#privacy-tab' }}" class="link-secondary ms-2">{{ fs_lang('accountPoliciesPrivacy') }}</a>
        @endif
        @if (fs_config('account_cookie_status'))
            <a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#cookies-tab' }}" class="link-secondary ms-2">{{ fs_lang('accountPoliciesCookie') }}</a>
        @endif
    </p>

    <p class="mb-2">&copy; {{ fs_config('site_copyright_years') }} {{ fs_config('site_copyright_name') }} | Powered by <a href="https://fresns.org" target="_blank" class="link-secondary">Fresns</a></p>

    @if (fs_config('site_china_mode'))
        @if (fs_config('china_icp_filing'))
            <p class="mb-0">
                <a href="https://beian.miit.gov.cn/" target="_blank" rel="nofollow" class="link-secondary">{{ fs_config('china_icp_filing') }}</a>
            </p>
        @endif

        @if (fs_config('china_mps_filing'))
            <p class="mb-0">
                <a href="https://beian.mps.gov.cn/#/query/webSearch?code={{ Str::of(fs_config('china_mps_filing'))->match('/\d+/') }}" target="_blank" rel="nofollow" class="link-secondary">{{ fs_config('china_mps_filing') }}</a>
            </p>
        @endif

        @if (fs_config('china_icp_license'))
            <p class="mb-0">{{ fs_config('china_icp_license') }}</p>
        @endif
    @endif

    @if (fs_config('china_broadcasting_license'))
        <p class="mb-0">{{ fs_config('china_broadcasting_license') }}</p>
    @endif
</footer>
