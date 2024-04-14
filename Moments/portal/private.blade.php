@extends('commons.fresns')

@section('title', fs_lang('sitePrivate'))

@section('content')
    <div class="m-lg-5 ps-lg-5 pb-lg-5" style="max-width:800px;">
        <div class="card-body p-5">
            <h3 class="card-title">{{ fs_config('site_name') }}</h3>
            <div>{{ fs_lang('sitePrivateDesc') }}</div>

            <div class="mt-4">
                {{-- Go to login --}}
                <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-modal-height="700px"
                    data-title="{{ fs_lang('accountLogin') }}"
                    data-url="{{ fs_config('account_login_service') }}"
                    data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                    data-post-message-key="fresnsAccountSign">
                    {{ fs_lang('accountLogin') }}
                </button>

                {{-- Join --}}
                @if (fs_config('site_private_status') && fs_config('site_private_service'))
                    <button class="btn btn-success ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                        data-title="{{ fs_lang('accountJoin') }}"
                        data-url="{{ fs_config('site_private_service') }}"
                        data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                        data-post-message-key="fresnsAccountSign">
                        {{ fs_lang('accountJoin') }}
                    </button>
                @elseif (fs_config('account_register_status'))
                    <button class="btn btn-success ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
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
@endsection
