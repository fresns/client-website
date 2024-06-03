<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
    <input type="hidden" name="markType" value="follow"/>
    <input type="hidden" name="type" value="hashtag"/>
    <input type="hidden" name="fsid" value="{{ $htid }}"/>
    @if ($interaction['followStatus'])
        <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['followStatus'] }}" data-bi="fa-regular fa-star" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_lang('cancel') }}">
            <i class="fa-solid fa-star"></i>
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-outline-success btn-sm fs-mark" data-bi="fa-solid fa-star" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['followName'] }}">
            <i class="fa-regular fa-star"></i>
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
