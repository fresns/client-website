<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
    <input type="hidden" name="markType" value="follow"/>
    <input type="hidden" name="type" value="user"/>
    <input type="hidden" name="fsid" value="{{ $uid }}"/>
    @if ($interaction['followStatus'])
        <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['followStatus'] }}" data-bi="bi-person-check">
            <i class="bi bi-person-check-fill"></i>
            @if ($interaction['followPublicCount'] != 1 && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-outline-success btn-sm fs-mark" data-bi="bi-person-check-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['followName'] }}">
            <i class="bi bi-person-check"></i>
            @if ($interaction['followPublicCount'] != 1 && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
