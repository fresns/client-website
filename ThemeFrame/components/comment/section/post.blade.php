@if ($post['author'] ?? null)
    <section class="comment-post mt-2 mx-3 position-relative">
        <div class="d-flex">
            <div class="flex-shrink-0"><img src="{{ $post['author']['avatar'] }}" loading="lazy" alt="{{ $post['author']['nickname'] }}" class="rounded"></div>
            <div class="flex-grow-1">
                @if (! $post['author']['status'])
                    {{ fs_lang('userDeactivate') }}:
                @elseif (empty($post['author']['fsid']))
                    {{ fs_lang('contentAuthorAnonymous') }}:
                @else
                    {{ $post['author']['nickname'] }}:
                @endif

                {!! Str::limit(strip_tags($post['content']), 140) !!}
            </div>
        </div>

        @if ($post['group'])
            <div class="comment-post-group border-top text-secondary">{{ $post['group']['name'] }}</div>
        @endif

        <a href="{{ route('fresns.post.detail', ['pid' => $post['pid']]) }}" class="text-decoration-none stretched-link"></a>
    </section>
@endif
