<article class="d-flex mb-3">
    {{-- Avatar --}}
    <section class="flex-shrink-0">
        <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $user['fsid']]) }}">
            @if ($user['decorate'])
                <img src="{{ $user['decorate'] }}" loading="lazy" alt="Avatar Decorate" class="user-decorate">
            @endif
            <img src="{{ $user['avatar'] }}" loading="lazy" alt="{{ $user['nickname'] }}" class="user-avatar rounded-circle">
        </a>
    </section>
    <div class="flex-grow-1">
        {{-- User Header --}}
        <header class="user-primary d-lg-flex">
            <div class="user-info d-flex text-nowrap overflow-hidden">
                <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $user['fsid']]) }}" class="user-link d-flex">
                    <div class="user-nickname text-nowrap overflow-hidden" style="color:{{ $user['nicknameColor'] }};">{{ $user['nickname'] }}</div>
                    @if ($user['verified'])
                        <div class="user-verified">
                            @if ($user['verifiedIcon'])
                                <img src="{{ $user['verifiedIcon'] }}" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
                            @else
                                <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['verifiedDesc'] }}">
                            @endif
                        </div>
                    @endif
                    <div class="user-name text-secondary">{{ '@'.$user['fsid'] }}</div>
                </a>
                <div class="user-role d-flex">
                    @if ($user['roleIconDisplay'])
                        <div class="user-role-icon"><img src="{{ $user['roleIcon'] }}" loading="lazy" alt="{{ $user['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user['roleName'] }}"></div>
                    @endif
                    @if ($user['roleNameDisplay'])
                        <div class="user-role-name"><span class="badge rounded-pill">{{ $user['roleName'] }}</span></div>
                    @endif
                </div>
            </div>

            {{-- User Affiliate Icons --}}
            @if ($user['operations']['diversifyImages'])
                <div class="user-icon d-flex flex-wrap flex-lg-nowrap overflow-hidden my-2 my-lg-0">
                    @foreach($user['operations']['diversifyImages'] as $icon)
                        <img src="{{ $icon['image'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}">
                    @endforeach
                </div>
            @endif
        </header>

        {{-- User Bio --}}
        <section class="user-secondary d-flex flex-wrap mb-1">
            <p class="fs-7 mt-1 mb-2 pe-2 text-secondary">{!! $user['bioHtml'] !!}</p>
        </section>

        {{-- User Interaction --}}
        <footer class="interaction-btn">
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
        </footer>
    </div>
</article>
