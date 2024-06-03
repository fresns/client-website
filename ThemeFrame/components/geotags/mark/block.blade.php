<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
    <input type="hidden" name="markType" value="block"/>
    <input type="hidden" name="type" value="geotag"/>
    <input type="hidden" name="fsid" value="{{ $gtid }}"/>
    @if ($interaction['blockStatus'])
        <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['blockStatus'] }}" data-bi="bi-x-octagon">
            <i class="bi bi-x-octagon-fill"></i>
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-outline-success btn-sm" id="fs-mark-block-{{ $gtid }}" data-bs-toggle="collapse" href="#collapse-{{ $gtid }}" aria-expanded="false" aria-controls="collapse-{{ $gtid }}">
            <i class="bi bi-x-octagon"></i>
            @if ($interaction['followPublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>

        <div class="collapse" id="collapse-{{ $gtid }}">
            <div class="card card-body my-1">
                <h5 class="card-title fs-6">{{ $interaction['blockName'] }}?</h5>
                <a class="btn btn-danger btn-sm fs-mark" role="button" data-id="fs-mark-block-{{ $gtid }}" data-collapse-id="collapse-{{ $gtid }}" data-bi="bi-x-octagon-fill" data-name="{{ $interaction['blockName'] }}" href="javascript:void(0)">{{ fs_lang('confirm') }}</a>
            </div>
        </div>
    @endif
</form>
