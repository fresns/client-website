@php
    $user = $user ?? $topUser;
@endphp

<div class="position-relative d-flex fs-hover">
    <section class="flex-shrink-0">
            @if ($user['decorate'])
                <img src="{{ $user['decorate'] }}" loading="lazy" alt="Avatar Decorate" class="user-decorate">
            @endif
            <img src="{{ $user['avatar'] }}" loading="lazy" alt="{{ $user['nickname'] }}" class="user-avatar rounded-circle">
    </section>
    <div class="text-start ms-2 mt-2">
        <div class="user-nickname text-nowrap overflow-hidden mt-1" style="color:{{ $user['nicknameColor'] }};">
            {{ $user['nickname'] }}
            @if ($user['verified'])
                @if ($user['verifiedIcon'])
                    <img src="{{ $user['verifiedIcon'] }}" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}" height="18">
                @else
                    <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}" height="18">
                @endif
            @endif
        </div>
        <div class="user-name text-secondary fs-7">{{ '@' . $user['username'] }}</div>
    </div>

    <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $user['fsid']]) }}" class="stretched-link"></a>

    <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="position-absolute top-50 end-0 translate-middle-y fresns_link">
        <input type="hidden" name="markType" value="follow"/>
        <input type="hidden" name="type" value="user"/>
        <input type="hidden" name="forgetCache" value=1 />
        <input type="hidden" name="fsid" value="{{ $user['fsid'] }}"/>
        @if ($user['interaction']['followStatus'])
            <a class="btn btn-success btn-sm rounded-pill fs-mark me-3 px-3" data-interaction-active="{{ $user['interaction']['followStatus'] }}" data-bi="fa-regular fa-circle d-none" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_lang('userUnfollow') }}">
                <i class="fa-solid fa-user-check d-none"></i>
                {{ fs_lang('userFollowing') }}
            </a>
        @else
            <a class="btn btn-outline-success btn-sm rounded-pill fs-mark me-3 px-3" data-bi="fa-solid fa-user-check" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['interaction']['followName'] }}">
                <i class="fa-regular fa-circle d-none"></i>
                {{ $user['interaction']['followName'] }}
            </a>
        @endif
    </form>
</div>
