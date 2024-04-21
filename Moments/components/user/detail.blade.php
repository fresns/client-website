@php
    $user = $user ?? $profile;
    $followersYouFollow = $followersYouFollow ?? [];
@endphp

@if ($user['banner'])
    <img src="{{ $user['banner'] }}" class="card-img-top" style="max-height:200px;filter:blur(2px);">
@endif

<section class="avatar">
    @if ($user['decorate'])
        <img src="{{ $user['decorate'] }}" loading="lazy" alt="Avatar Decorate" class="profile-decorate">
    @endif
    <img src="{{ $user['avatar'] }}" loading="lazy" alt="{{ $user['nickname'] }}" class="profile-avatar rounded-circle">
</section>

<section class="userinfo">
    <div class="profile-nickname d-flex justify-content-center">
        <h1 style="color:{{ $user['nicknameColor'] }};">{{ $user['nickname'] }}</h1>
        @if ($user['verified'])
            @if ($user['verifiedIcon'])
                <img src="{{ $user['verifiedIcon'] }}" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
            @else
                <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
            @endif
        @endif
        @if ($user['roleIconDisplay'] && $user['roleIcon'])
            <img src="{{ $user['roleIcon'] }}" loading="lazy" alt="{{ $user['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['roleName'] }}">
        @endif
        @if ($user['roleNameDisplay'])
            <span class="badge text-bg-secondary">{{ $user['roleName'] }}</span>
        @endif
    </div>

    <div class="mb-2 text-secondary">{{ '@' . $user['username'] }}</div>

    @if ($user['verified'] && $user['verifiedDesc'])
        <span class="badge rounded-pill text-bg-warning fw-normal mb-2">
            <i class="fa-regular fa-circle-check"></i>
            {{ $user['verifiedDesc'] }}
        </span>
    @endif

    @if ($user['status'])
        <p class="fs-7 text-secondary px-4 mb-3">{!! $user['bioHtml'] !!}</p>
    @else
        <div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> {{ fs_lang('userSuspended') }}</div>
    @endif

    {{-- User Affiliate Icons --}}
    @if ($user['operations']['diversifyImages'])
        <div class="text-center mb-3">
            @foreach($user['operations']['diversifyImages'] as $icon)
                <img src="{{ $icon['image'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}" style="height:2rem">
            @endforeach
        </div>
    @endif

    @if ($user['stats']['extcredits1State'] == 3 ||
        $user['stats']['extcredits2State'] == 3 ||
        $user['stats']['extcredits3State'] == 3 ||
        $user['stats']['extcredits4State'] == 3 ||
        $user['stats']['extcredits5State'] == 3)
        <div class="d-flex gap-2 justify-content-center mb-3">
            {{-- extcredits1 --}}
            @if ($user['stats']['extcredits1State'] == 3 && $user['stats']['extcredits1'])
                <span class="badge d-flex align-items-center p-1 px-2 text-light-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
                    {{ $user['stats']['extcredits1Name'] }}
                    <span class="vr mx-2"></span>
                    {{ $user['stats']['extcredits1'] }}
                </span>
            @endif
            {{-- extcredits2 --}}
            @if ($user['stats']['extcredits2State'] == 3 && $user['stats']['extcredits2'])
                <span class="badge d-flex align-items-center p-1 px-2 text-light-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
                    {{ $user['stats']['extcredits2Name'] }}
                    <span class="vr mx-2"></span>
                    {{ $user['stats']['extcredits2'] }}
                </span>
            @endif
            {{-- extcredits3 --}}
            @if ($user['stats']['extcredits3State'] == 3 && $user['stats']['extcredits3'])
                <span class="badge d-flex align-items-center p-1 px-2 text-light-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
                    {{ $user['stats']['extcredits3Name'] }}
                    <span class="vr mx-2"></span>
                    {{ $user['stats']['extcredits3'] }}
                </span>
            @endif
            {{-- extcredits4 --}}
            @if ($user['stats']['extcredits4State'] == 3 && $user['stats']['extcredits4'])
                <span class="badge d-flex align-items-center p-1 px-2 text-light-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
                    {{ $user['stats']['extcredits4Name'] }}
                    <span class="vr mx-2"></span>
                    {{ $user['stats']['extcredits4'] }}
                </span>
            @endif
            {{-- extcredits5 --}}
            @if ($user['stats']['extcredits5State'] == 3 && $user['stats']['extcredits5'])
                <span class="badge d-flex align-items-center p-1 px-2 text-light-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
                    {{ $user['stats']['extcredits5Name'] }}
                    <span class="vr mx-2"></span>
                    {{ $user['stats']['extcredits5'] }}
                </span>
            @endif
        </div>
    @endif
</section>

@if (fs_config('profile_followers_you_follow_enabled') && $followersYouFollow)
    <section class="text-center mb-3">
        <a href="{{ route('fresns.profile.followers.you.follow', ['uidOrUsername' => $user['fsid']]) }}" class="text-muted fs-7 text-decoration-none">
            @foreach($followersYouFollow as $friend)
                {{ $friend['nickname'] }}@if (! $loop->last), @endif
            @endforeach
            {{ fs_lang('userFollowersYouKnow') }}
        </a>
    </section>
@endif

<section class="d-flex justify-content-center overflow-hidden mb-4">
    {{-- Conversation --}}
    @if (fs_config('conversation_status') && $user['conversation']['status'])
        <button type="button" class="btn btn-outline-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#conversationModal-{{ $user['fsid'] }}">{{ fs_config('channel_conversations_name') }}</button>
    @endif

    {{-- Like --}}
    @if ($user['interaction']['likeEnabled'])
        @component('components.user.mark.like', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['likerCount']
        ])@endcomponent
    @endif

    {{-- Dislike --}}
    @if ($user['interaction']['dislikeEnabled'])
        @component('components.user.mark.dislike', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['dislikerCount']
        ])@endcomponent
    @endif

    {{-- Follow --}}
    @if ($user['interaction']['followEnabled'])
        @component('components.user.mark.follow', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['followerCount']
        ])@endcomponent
    @endif

    {{-- Block --}}
    @if ($user['interaction']['blockEnabled'])
        @component('components.user.mark.block', [
            'uid' => $user['uid'],
            'interaction' => $user['interaction'],
            'count' => $user['stats']['blockerCount']
        ])@endcomponent
    @endif

    {{-- Follow Me Status --}}
    @if ($user['interaction']['followMeStatus'] && $user['interaction']['followStatus'])
        <span class="badge rounded-pill bg-secondary m-1">{{ fs_lang('userFollowMutual') }}</span>
    @elseif ($user['interaction']['followMeStatus'])
        <span class="badge rounded-pill bg-secondary m-1">{{ fs_lang('userFollowMe') }}</span>
    @endif
</section>

{{-- Conversation --}}
@if (fs_config('conversation_status') && $user['conversation']['status'])
    <div class="modal fade" id="conversationModal-{{ $user['fsid'] }}" tabindex="-1" aria-labelledby="conversationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="conversationModalLabel">
                        <a href="{{ route('fresns.conversation.index') }}" target="_blank" class="text-decoration-none"><i class="fa-regular fa-envelope"></i> {{ fs_config('channel_conversations_name') }}</a>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @component('components.message.send', [
                        'user' => $user,
                    ])@endcomponent
                </div>
            </div>
        </div>
    </div>
@endif
