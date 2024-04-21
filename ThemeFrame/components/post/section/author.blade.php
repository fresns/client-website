@if (! $author['status'])
    {{-- Deactivate --}}
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="user-avatar rounded-circle">
        </div>
        <div class="flex-grow-1">
            <div class="user-primary d-lg-flex">
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <div class="text-muted">{{ fs_lang('userDeactivate') }}</div>
                </div>
            </div>
            <div class="user-secondary d-flex flex-wrap mb-3">
                {{-- Create Time --}}
                <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

                {{-- Edit Time --}}
                @if ($editedDatetime)
                    <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
                @endif

                {{-- Post Location --}}
                @if ($geotag)
                    <a href="{{ route('fresns.geotag.detail', ['gtid' => $geotag['gtid']]) }}" class="link-secondary ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $geotag['name'] }}</a>
                @endif
            </div>
        </div>
    </div>
@elseif ($isAnonymous)
    {{-- Anonymous --}}
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{ $author['avatar'] }}" loading="lazy" alt="{{ fs_lang('contentAuthorAnonymous') }}" class="user-avatar rounded-circle">
        </div>
        <div class="flex-grow-1">
            <div class="user-primary d-lg-flex">
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <div class="text-muted">{{ fs_lang('contentAuthorAnonymous') }}</div>
                </div>
            </div>
            <div class="user-secondary d-flex flex-wrap mb-3">
                {{-- Create Time --}}
                <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

                {{-- Edit Time --}}
                @if ($editedDatetime)
                    <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
                @endif

                {{-- Post Location --}}
                @if ($geotag)
                    <a href="{{ route('fresns.geotag.detail', ['gtid' => $geotag['gtid']]) }}" class="link-secondary ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $geotag['name'] }}</a>
                @endif
            </div>
        </div>
    </div>
@else
    {{-- Author --}}
    <div class="d-flex">
        <div class="flex-shrink-0">
            <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $author['fsid']]) }}">
                @if ($author['decorate'])
                    <img src="{{ $author['decorate'] }}" loading="lazy" alt="Avatar Decorate" class="user-decorate">
                @endif
                <img src="{{ $author['avatar'] }}" loading="lazy" alt="{{ $author['username'] }}" class="user-avatar rounded-circle">
            </a>
        </div>
        <div class="flex-grow-1">
            <div class="user-primary d-lg-flex">
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $author['fsid']]) }}" class="user-link d-flex">
                        <div class="user-nickname text-nowrap overflow-hidden" style="color:{{ $author['nicknameColor'] }};">{{ $author['nickname'] }}</div>
                        @if ($author['verified'])
                            <div class="user-verified">
                                @if ($author['verifiedIcon'])
                                    <img src="{{ $author['verifiedIcon'] }}" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $author['verifiedDesc'] }}">
                                @else
                                    <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $author['verifiedDesc'] }}">
                                @endif
                            </div>
                        @endif
                        <div class="user-name text-secondary">{{ '@'.$author['fsid'] }}</div>
                    </a>
                    <div class="user-role d-flex">
                        @if ($author['roleIconDisplay'])
                            <div class="user-role-icon"><img src="{{ $author['roleIcon'] }}" loading="lazy" alt="{{ $author['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $author['roleName'] }}"></div>
                        @endif
                        @if ($author['roleNameDisplay'])
                            <div class="user-role-name"><span class="badge rounded-pill">{{ $author['roleName'] }}</span></div>
                        @endif
                    </div>
                </div>

                {{-- User Affiliate Icons --}}
                @if ($author['operations']['diversifyImages'])
                    <div class="user-icon d-flex flex-wrap flex-lg-nowrap overflow-hidden my-2 my-lg-0">
                        @foreach($author['operations']['diversifyImages'] as $icon)
                            <img src="{{ $icon['image'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="user-secondary d-flex flex-wrap mb-3">
                {{-- Create Time --}}
                <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

                {{-- Edit Time --}}
                @if ($editedDatetime)
                    <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
                @endif

                {{-- Post Location --}}
                @if ($geotag)
                    <a href="{{ route('fresns.geotag.detail', ['gtid' => $geotag['gtid']]) }}" class="link-secondary ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $geotag['name'] }}</a>
                @endif
            </div>
        </div>
    </div>
@endif
