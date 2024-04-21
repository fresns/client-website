<nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-4 mx-3 mx-lg-0">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_config('channel_me_name') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- User Center --}}
        <a href="{{ route('fresns.me.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.me.index') ? 'active' : '' }}">
            <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account.png" loading="lazy" width="36" height="36">
            {{ fs_config('channel_me_name') }}
        </a>

        {{-- Notifications --}}
        <a href="{{ route('fresns.notification.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.notification.index') ? 'active' : '' }}">
            <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-notifications.png" loading="lazy" width="36" height="36">
            {{ fs_config('channel_notifications_name') }}

            @if (fs_user_overview('unreadNotifications.all') > 0)
                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.all') }}</span>
            @endif
        </a>

        {{-- Conversations --}}
        @if (fs_config('conversation_status'))
            <a href="{{ route('fresns.conversation.index') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.conversation.*') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-conversations.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_conversations_name') }}

                @if (fs_user_overview('conversations.unreadMessages') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('conversations.unreadMessages') }}</span>
                @endif
            </a>
        @endif

        {{-- Draft Box --}}
        <a href="{{ route('fresns.me.drafts') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.me.drafts') ? 'active' : '' }}">
            <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-drafts.png" loading="lazy" width="36" height="36">
            {{ fs_config('channel_me_drafts_name') }}

            @if (array_sum(fs_user_overview('draftCount')) > 0)
                <span class="badge bg-primary">{{ array_sum(fs_user_overview('draftCount')) }}</span>
            @endif
        </a>

        {{-- Wallet --}}
        @if (fs_config('wallet_status'))
            <a href="{{ route('fresns.me.wallet') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.me.wallet') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-wallet.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_me_wallet_name') }}
            </a>
        @endif

        {{-- User Extcredits --}}
        <a href="{{ route('fresns.me.extcredits') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.me.extcredits') ? 'active' : '' }}">
            <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-wallet.png" loading="lazy" width="36" height="36">
            {{ fs_lang('userExtcreditsLogs') }}
        </a>

        {{-- Users of this account --}}
        @if (fs_user_overview('multiUser.status') || count(fs_account('detail.users')) > 1)
            <a href="{{ route('fresns.me.users') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.me.users') ? 'active' : '' }}">
                <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-users.png" loading="lazy" width="36" height="36">
                {{ fs_config('channel_me_users_name') }}
            </a>
        @endif

        {{-- Settings --}}
        <a href="{{ route('fresns.me.settings') }}" class="list-group-item list-group-item-action {{ Route::is('fresns.me.settings') ? 'active' : '' }}">
            <img class="img-fluid" src="{{ fs_theme('assets') }}images/menu-account-settings.png" loading="lazy" width="36" height="36">
            {{ fs_config('channel_me_settings_name') }}
        </a>
    </div>
</nav>
