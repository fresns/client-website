<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post">
    <input type="hidden" name="markType" value="follow"/>
    <input type="hidden" name="type" value="post"/>
    <input type="hidden" name="fsid" value="{{ $pid }}"/>
    @if ($interaction['followStatus'])
        <a class="dropdown-item py-2 text-success fs-mark" data-bi="bi-bookmark-check" data-name="{{ $interaction['followName'] }}" data-interaction-active="{{ $interaction['followStatus'] }}" href="javascript:void(0)">
            <i class="bi bi-bookmark-check-fill"></i>
            <span class="show-text">√ {{ $interaction['followName'] }}</span>
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="dropdown-item py-2 fs-mark" data-bi="bi-bookmark-check-fill" data-name="{{ $interaction['followName'] }}" href="javascript:void(0)">
            <i class="bi bi-bookmark-check"></i>
            <span class="show-text">{{ $interaction['followName'] }}</span>
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
