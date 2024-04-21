@extends('commons.fresns')

@section('title', fs_config('channel_me_name'))

@section('content')
    <div class="bg-body d-flex flex-row">
        {{-- avatar --}}
        <div class="avatar">
            @if (fs_user('detail.decorate'))
                <img src="{{ fs_user('detail.decorate') }}" alt="Avatar Decorate" loading="lazy" class="profile-decorate">
            @endif
            <img src="{{ fs_user('detail.avatar') }}" alt="{{ fs_user('detail.nickname') }}" loading="lazy" class="profile-avatar rounded-circle">
        </div>

        {{-- username --}}
        <div class="flex-grow-1 d-flex align-items-center">
            <div @if (fs_user('detail.decorate')) class="ms-3" @endif>
                <div class="fs-4 fw-semibold mt-1">
                    {{ fs_user('detail.nickname') }}
                    @if (fs_user('detail.verified'))
                        @if (fs_user('detail.verifiedIcon'))
                            <img src="{{ fs_user('detail.verifiedIcon') }}" alt="Verified" loading="lazy" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_user('detail.verifiedDesc') }}" height="20">
                        @else
                            <img src="{{ fs_theme('assets') }}images/icon-verified.png" alt="Verified" loading="lazy" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_user('detail.verifiedDesc') }}" height="20">
                        @endif
                    @endif
                </div>
                <div class="fs-6 text-secondary">{{ '@'.fs_user('detail.fsid') }}</div>
                <div class="d-flex mt-2">
                    <span class="badge d-flex align-items-center p-1 pe-2 text-dark-emphasis bg-light-subtle border border-dark-subtle rounded-pill @if (! fs_user('detail.roleIconDisplay')) ps-2 @endif">
                        @if (fs_user('detail.roleIconDisplay'))
                            <img class="rounded-circle me-1" width="24" height="24" src="{{ fs_user('detail.roleIcon') }}">
                        @endif
                        {{ fs_user('detail.roleName') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- profile --}}
        <div class="align-self-center pe-3">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('fresns.profile.index', ['uidOrUsername' => fs_user('detail.fsid')]) }}" role="button">{{ fs_lang('userProfile') }}</a>
        </div>
    </div>

    {{-- features --}}
    <div class="clearfix">
        @foreach(fs_user_overview('features') as $feature)
            <div class="float-start mt-3" style="width:20%">
                <a class="text-decoration-none" data-bs-toggle="modal" href="#fresnsModal"
                    data-title="{{ $feature['name'] }}"
                    data-url="{{ $feature['appUrl'] }}"
                    data-post-message-key="fresnsFeatureExtension">
                    <div class="position-relative mx-auto" style="width:52px">
                        <img src="{{ $feature['icon'] }}" loading="lazy" class="rounded" height="52">
                        @if ($feature['badgeType'])
                            <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                {{ $feature['badgeType'] == 1 ? '' : $feature['badgeValue'] }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        @endif
                    </div>
                    <p class="mt-1 mb-0 fs-7 text-center text-nowrap">{{ $feature['name'] }}</p>
                </a>
            </div>
        @endforeach
    </div>

    @mobile
        <div class="list-group rounded-0 my-3">
            {{-- Conversation --}}
            <a href="{{ route('fresns.notification.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-regular fa-bell me-2"></i> {{ fs_config('channel_notifications_name') }}</span>
                <span class="py-2 text-black-50">
                    @if (fs_user_overview('unreadNotifications.all') > 0)
                        <span class="badge bg-danger rounded-pill">{{ fs_user_overview('unreadNotifications.all') }}</span>
                    @endif
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            </a>
            @if (fs_config('conversation_status'))
                    {{-- Conversation --}}
                    <a href="{{ route('fresns.conversation.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <span class="py-2"><i class="fa-regular fa-envelope me-2"></i> {{ fs_config('channel_conversations_name') }}</span>
                        <span class="py-2 text-black-50">
                            @if (fs_user_overview('conversations.unreadMessages') > 0)
                                <span class="badge bg-danger rounded-pill">{{ fs_user_overview('conversations.unreadMessages') }}</span>
                            @endif
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    </a>
            @endif
        </div>
    @endmobile

    <div class="list-group rounded-0 my-3">
        {{-- Extcredits --}}
        @if (fs_user('detail.stats.extcredits1State') != 1 ||
            fs_user('detail.stats.extcredits2State') != 1 ||
            fs_user('detail.stats.extcredits3State') != 1 ||
            fs_user('detail.stats.extcredits4State') != 1 ||
            fs_user('detail.stats.extcredits5State') != 1)
            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" data-bs-toggle="collapse" href="#collapseUserExtcredits" role="button" aria-expanded="false" aria-controls="collapseUserExtcredits">
                <span class="py-2"><i class="fa-solid fa-fw fa-money-bill me-2"></i> {{ fs_lang('userExtcredits') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>

            <div class="collapse" id="collapseUserExtcredits">
                {{-- extcredits1 --}}
                @if (fs_user('detail.stats.extcredits1State') != 1)
                    <a href="{{ route('fresns.me.extcredits', ['extcreditsId' => 1]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <span class="py-2">{{ fs_user('detail.stats.extcredits1Name') }}</span>
                        <span class="py-2 text-black-50">{{ fs_user('detail.stats.extcredits1') }} {{ fs_user('detail.stats.extcredits1Unit') }} <i class="fa-solid fa-chevron-right"></i></span>
                    </a>
                @endif
                {{-- extcredits2 --}}
                @if (fs_user('detail.stats.extcredits2State') != 1)
                    <a href="{{ route('fresns.me.extcredits', ['extcreditsId' => 2]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <span class="py-2">{{ fs_user('detail.stats.extcredits2Name') }}</span>
                        <span class="py-2 text-black-50">{{ fs_user('detail.stats.extcredits2') }} {{ fs_user('detail.stats.extcredits2Unit') }} <i class="fa-solid fa-chevron-right"></i></span>
                    </a>
                @endif
                {{-- extcredits3 --}}
                @if (fs_user('detail.stats.extcredits3State') != 1)
                    <a href="{{ route('fresns.me.extcredits', ['extcreditsId' => 3]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <span class="py-2">{{ fs_user('detail.stats.extcredits3Name') }}</span>
                        <span class="py-2 text-black-50">{{ fs_user('detail.stats.extcredits1') }} {{ fs_user('detail.stats.extcredits3Unit') }} <i class="fa-solid fa-chevron-right"></i></span>
                    </a>
                @endif
                {{-- extcredits4 --}}
                @if (fs_user('detail.stats.extcredits4State') != 1)
                    <a href="{{ route('fresns.me.extcredits', ['extcreditsId' => 4]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <span class="py-2">{{ fs_user('detail.stats.extcredits4Name') }}</span>
                        <span class="py-2 text-black-50">{{ fs_user('detail.stats.extcredits4') }} {{ fs_user('detail.stats.extcredits4Unit') }} <i class="fa-solid fa-chevron-right"></i></span>
                    </a>
                @endif
                {{-- extcredits5 --}}
                @if (fs_user('detail.stats.extcredits5State') != 1)
                    <a href="{{ route('fresns.me.extcredits', ['extcreditsId' => 5]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <span class="py-2">{{ fs_user('detail.stats.extcredits5Name') }}</span>
                        <span class="py-2 text-black-50">{{ fs_user('detail.stats.extcredits5') }} {{ fs_user('detail.stats.extcredits5Unit') }} <i class="fa-solid fa-chevron-right"></i></span>
                    </a>
                @endif
            </div>
        @endif
        {{-- Wallet --}}
        @if (fs_config('wallet_status'))
            <a href="{{ route('fresns.me.wallet') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-solid fa-fw fa-wallet me-2"></i> {{ fs_config('channel_me_wallet_name') }}</span>
                <span class="py-2 text-black-50">{{ fs_account('detail.wallet.balance') }} <i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
        {{-- Draft Box --}}
        <a href="{{ route('fresns.me.drafts') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
            <span class="py-2"><i class="fa-solid fa-fw fa-envelope-open-text me-2"></i> {{ fs_config('channel_me_drafts_name') }}</span>
            <span class="py-2 text-black-50">
                @if (array_sum(fs_user_overview('draftCount')) > 0)
                    <span class="badge bg-success rounded-pill">{{ array_sum(fs_user_overview('draftCount')) }}</span>
                @endif
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        </a>
        {{-- Favorites --}}
        <a href="{{ route('fresns.post.following') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
            <span class="py-2"><i class="fa-solid fa-fw fa-box-archive me-2"></i> {{ fs_config('channel_following_posts_name') }}</span>
            <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
        </a>
        {{-- Blacklist --}}
        <a href="{{ route('fresns.user.blocking') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
            <span class="py-2"><i class="fa-solid fa-fw fa-user-shield me-2"></i> {{ fs_config('channel_blocking_users_name') }}</span>
            <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
        </a>
    </div>

    <div class="list-group rounded-0 my-3">
        {{-- Settings --}}
        <a href="{{ route('fresns.me.settings') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
            <span class="py-2"><i class="fa-solid fa-fw fa-gear me-2"></i> {{ fs_config('channel_me_settings_name') }}</span>
            <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
        </a>
        {{-- Manage Users --}}
        @if (fs_user_overview('multiUser.status') || count(fs_account('detail.users')) > 1)
            {{-- User Page --}}
            <a href="{{ route('fresns.me.users') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-solid fa-fw fa-user-gear me-2"></i> {{ fs_config('channel_me_users_name') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
            {{-- Switch Users --}}
            <a href="#userAuth" id="switch-user" data-bs-toggle="modal" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-solid fa-fw fa-users me-2"></i> {{ fs_lang('switchUser') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
        {{-- Switch Languages --}}
        @if (fs_config('language_status'))
            <a href="#translate" data-bs-toggle="modal" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <span class="py-2"><i class="fa-solid fa-fw fa-language me-2"></i> {{ fs_lang('switchLanguage') }}</span>
                <span class="py-2 text-black-50"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        @endif
    </div>

    @mobile
        <div class="d-grid gap-2 pt-4 pb-5 px-4">
            <a class="btn btn-danger" href="{{ route('fresns.me.logout') }}" role="button">{{ fs_lang('accountLogout') }}</a>
        </div>
    @endmobile
@endsection

@push('style')
    <style>
        body {
            background: #f0f2f5;
        }
    </style>
@endpush
