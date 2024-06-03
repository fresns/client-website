<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post">
    <input type="hidden" name="markType" value="block"/>
    <input type="hidden" name="type" value="post"/>
    <input type="hidden" name="fsid" value="{{ $pid }}"/>
    @if ($interaction['blockStatus'])
        <a class="dropdown-item py-2 text-success fs-mark" data-bi="bi-bookmark-x" data-name="{{ $interaction['blockName'] }}" data-interaction-active="{{ $interaction['blockStatus'] }}" href="javascript:void(0)">
            <i class="bi bi-bookmark-x-fill"></i>
            <span class="show-text">√ {{ $interaction['blockName'] }}</span>
            @if ($interaction['blockPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="dropdown-item py-2" id="fs-mark-block-{{ $pid }}" data-bs-toggle="collapse" href="#collapse-{{ $pid }}" aria-expanded="false" aria-controls="collapse-{{ $pid }}">
            <i class="bi bi-bookmark-x"></i>
            <span class="show-text">{{ $interaction['blockName'] }}</span>
            @if ($interaction['blockPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>

        <div class="collapse" id="collapse-{{ $pid }}">
            <div class="card card-body mx-3 my-1">
                <h5 class="card-title fs-6">{{ $interaction['blockName'] }}?</h5>
                <a class="btn btn-danger btn-sm fs-mark" role="button" data-id="fs-mark-block-{{ $pid }}" data-collapse-id="collapse-{{ $pid }}" data-bi="bi-bookmark-x-fill" data-name="{{ $interaction['blockName'] }}" href="javascript:void(0)">{{ fs_lang('confirm') }}</a>
            </div>
        </div>
    @endif
</form>
