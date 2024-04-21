@if ($quotedPost)
    <section class="comment-post mt-2 mx-3 position-relative">
        <div class="d-flex">
            <div class="flex-shrink-0"><img src="{{ $quotedPost['author']['avatar'] }}" loading="lazy" alt="{{ $quotedPost['author']['nickname'] }}" class="rounded"></div>
            <div class="flex-grow-1">
                @if (isset($quotedPost['author']['status']) && ! $quotedPost['author']['status'])
                    {{ fs_lang('userDeactivate') }}:
                @elseif (empty($quotedPost['author']['fsid']))
                    {{ fs_lang('contentAuthorAnonymous') }}:
                @else
                    {{ $quotedPost['author']['nickname'] }}:
                @endif

                @if ($quotedPost['title'])
                    {{ $quotedPost['title'] }}
                @else
                    {!! Str::limit(strip_tags($quotedPost['content']), 140) !!}
                @endif
            </div>
        </div>

        @if ($quotedPost['group'])
            <div class="comment-post-group border-top text-secondary">{{ $quotedPost['group']['name'] }}</div>
        @endif

        <a href="{{ route('fresns.post.detail', ['pid' => $quotedPost['pid']]) }}" class="text-decoration-none stretched-link"></a>
    </section>
@endif
