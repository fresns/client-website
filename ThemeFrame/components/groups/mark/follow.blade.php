@if ($interaction['followType'] == 1)
    <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
        <input type="hidden" name="markType" value="follow"/>
        <input type="hidden" name="type" value="group"/>
        <input type="hidden" name="fsid" value="{{ $gid }}"/>
        @if ($interaction['followStatus'])
            <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['followStatus'] }}" data-bi="bi-person-check">
                <i class="bi bi-person-check-fill"></i>
                @if ($interaction['followPublicCount'] && $count)
                    <span class="show-count">{{ $count }}</span>
                @endif
            </a>
        @else
            <a class="btn btn-outline-success btn-sm fs-mark" data-bi="bi-person-check-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['followName'] }}">
                <i class="bi bi-person-check"></i>
                @if ($interaction['followPublicCount'] && $count)
                    <span class="show-count">{{ $count }}</span>
                @endif
            </a>
        @endif
    </form>
@elseif ($interaction['followType'] == 2)
    @if (! $interaction['followStatus'])
        <form class="float-start me-2">
            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ $interaction['followName'] }}: {{ $name }}"
                data-url="{{ $interaction['followUrl'] }}"
                data-gid="{{ $gid }}"
                data-post-message-key="fresnsFollow">
                <i class="bi bi-person-check"></i>
                {{ $interaction['followName'] }}
                @if ($interaction['followPublicCount'] && $count)
                    <span class="badge rounded-pill bg-success">{{ $count }}</span>
                @endif
            </button>
        </form>
    @endif
@endif
