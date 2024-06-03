@php
    $btnIconActive = fs_theme('assets').'images/icon-like-active.png';
@endphp

@if ($icon)
    @php
        $btnIconActive = $icon['activeImage'];
    @endphp
@endif

<section class="mx-3 mt-3 position-relative">
    <img src="{{ $btnIconActive }}" loading="lazy" height="20">
    @if ($status)
        {{ fs_user('detail.nickname') }},
    @endif

    @foreach($previewLikeUsers as $user)
        @if (fs_user('detail.uid') == $user['uid'])
            @continue
        @endif
        {{ $user['nickname'] }}@if (! $loop->last),@endif
    @endforeach

    {{ fs_lang('modifierCount') }}
    {{ $count }}
    {{ $name }}
</section>
