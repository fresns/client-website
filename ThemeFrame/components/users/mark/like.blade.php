<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
    <input type="hidden" name="markType" value="like"/>
    <input type="hidden" name="type" value="user"/>
    <input type="hidden" name="fsid" value="{{ $uid }}"/>
    @if ($interaction['likeStatus'])
        <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['likeStatus'] }}" data-bi="bi-hand-thumbs-up">
            <i class="bi bi-hand-thumbs-up-fill"></i>
            @if ($interaction['likePublicCount'] != 1 && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-outline-success btn-sm fs-mark" data-bi="bi-hand-thumbs-up-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['likeName'] }}">
            <i class="bi bi-hand-thumbs-up"></i>
            @if ($interaction['likePublicCount'] != 1 && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
