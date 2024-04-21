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

<a href="{{ route('fresns.post.detail', ['pid' => $sticky['pid']]) }}" class="list-group-item list-group-item-action text-break px-3 py-2">
    <i class="fa-regular fa-circle-up me-1 text-danger"></i>
    @if ($title)
        <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" style="height: 24px">
    @endif
    {{ $sticky['title'] ?? Str::limit(strip_tags($sticky['content']), 80) }}
</a>
