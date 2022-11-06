<form action="{{ route('fresns.api.user.mark') }}" method="post" class="float-start me-2">
    @csrf
    <input type="hidden" name="interactiveType" value="follow"/>
    <input type="hidden" name="markType" value="user"/>
    <input type="hidden" name="fsid" value="{{ $uid }}"/>
    @if ($interactive['followStatus'])
        <a class="btn btn-success btn-sm fs-mark" data-interactive-active="{{ $interactive['followStatus'] }}" data-bi="bi-person-check">
            <i class="bi bi-person-check-fill"></i>
            @if (fs_api_config('user_follower_count'))
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-outline-success btn-sm fs-mark" data-bi="bi-person-check-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interactive['followName'] }}">
            <i class="bi bi-person-check"></i>
            @if (fs_api_config('user_follower_count'))
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
