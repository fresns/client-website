@php
    $title = fs_helpers('Arr', 'pull', $sticky['operations']['diversifyImages'], [
        'key' => 'code',
        'values' => 'title',
        'asArray' => false,
    ]);
    $decorate = fs_helpers('Arr', 'pull', $sticky['operations']['diversifyImages'], [
        'key' => 'code',
        'values' => 'decorate',
        'asArray' => false,
    ]);
@endphp

<a href="{{ route('fresns.post.detail', ['pid' => $sticky['pid']]) }}" class="list-group-item list-group-item-action text-break">
    <i class="bi bi-arrow-up-square-fill me-1" style="color: #F40;"></i>
    @if ($title)
        <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" style="height: 24px">
    @endif
    {{ $sticky['title'] ?? Str::limit(strip_tags($sticky['content']), 80) }}
</a>
