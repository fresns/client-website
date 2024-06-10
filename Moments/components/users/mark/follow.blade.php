@if ($interaction['followMethod'] == 'api')
    <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
        <input type="hidden" name="markType" value="follow"/>
        <input type="hidden" name="type" value="user"/>
        <input type="hidden" name="fsid" value="{{ $uid }}"/>
        @if ($interaction['followStatus'])
            <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['followStatus'] }}" data-bi="fa-regular fa-circle d-none" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_lang('userUnfollow') }}">
                <i class="fa-solid fa-user-check d-none"></i>
                {{ fs_lang('userFollowing') }}
                @if ($interaction['followPublicCount'] != 1 && $count)
                    <span class="show-count">{{ $count }}</span>
                @endif
            </a>
        @else
            <a class="btn btn-outline-success btn-sm fs-mark" data-bi="fa-solid fa-user-check" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['followName'] }}">
                <i class="fa-regular fa-circle d-none"></i>
                {{ $interaction['followName'] }}
                @if ($interaction['followPublicCount'] != 1 && $count)
                    <span class="show-count">{{ $count }}</span>
                @endif
            </a>
        @endif
    </form>
@elseif ($interaction['followMethod'] == 'page')
    <form class="float-start me-2">
        <button type="button" class="btn btn-sm {{ $interaction['followStatus'] ? 'btn-success' : 'btn-outline-success'}}" data-bs-toggle="modal" data-bs-target="#fresnsModal"
            data-title="{{ $interaction['followName'] }}: {{ $name }}"
            data-url="{{ $interaction['followAppUrl'] }}"
            data-uid="{{ $uid }}"
            data-post-message-key="fresnsFollow">
            @if ($interaction['followStatus'])
                <i class="fa-solid fa-user-check d-none"></i>
            @else
                <i class="fa-regular fa-circle d-none"></i>
            @endif
            {{ $interaction['followName'] }}
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </button>
    </form>
@endif
