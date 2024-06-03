@php
    $btnIcon = fs_theme('assets').'images/icon-dislike.png';
    $btnIconActive = fs_theme('assets').'images/icon-dislike-active.png';
@endphp

@if ($icon)
    @php
        $btnIcon = $icon['image'];
        $btnIconActive = $icon['activeImage'];
    @endphp
@endif

<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post">
    <input type="hidden" name="markType" value="dislike"/>
    <input type="hidden" name="type" value="post"/>
    <input type="hidden" name="fsid" value="{{ $pid }}"/>
    @if ($interaction['dislikeStatus'])
        <a class="btn btn-inter btn-active fs-mark" data-icon="{{ $btnIcon }}" data-icon-active="{{ $btnIconActive }}" data-interaction-active="{{ $interaction['dislikeStatus'] }}">
            <img src="{{ $btnIconActive }}" loading="lazy">
            @if ($interaction['dislikePublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-inter fs-mark" data-icon="{{ $btnIcon }}" data-icon-active="{{ $btnIconActive }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['dislikeName'] }}">
            <img src="{{ $btnIcon }}" loading="lazy">
            @if ($interaction['dislikePublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
