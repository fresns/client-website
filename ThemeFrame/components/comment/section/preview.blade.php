<section class="comment-preview mt-3 mx-3 position-relative d-flex flex-column">
    @foreach($previewComments as $comment)
        <div class="text-break mb-2">
            @if (! $comment['author']['status'])
                <span class="text-info">{{ fs_lang('userDeactivate') }}</span>
            @elseif ($comment['isAnonymous'])
                <span class="text-info">{{ fs_lang('contentAuthorAnonymous') }}</span>
            @else
                <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $comment['author']['fsid']]) }}" class="content-link text-decoration-none">{{ $comment['author']['nickname'] }}</a>
            @endif

            @if ($comment['author']['isPostAuthor'])
                <span class="author-badge">{{ fs_lang('contentAuthor') }}</span>
            @endif

            @if ($comment['replyToComment'])
                @if (! $comment['replyToComment']['author']['status'])
                    {{ fs_config('publish_comment_name') }} <span class="text-info">{{ fs_lang('userDeactivate') }}</span>
                @elseif ($comment['replyToComment']['isAnonymous'])
                    {{ fs_config('publish_comment_name') }} <span class="text-info">{{ fs_lang('contentAuthorAnonymous') }}</span>
                @else
                    {{ fs_config('publish_comment_name') }} <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $comment['replyToComment']['author']['fsid']]) }}" class="content-link text-decoration-none">{{ $comment['replyToComment']['author']['nickname'] }}</a>
                @endif
            @endif

            : {!! $comment['content'] !!}

            @if (count($comment['files']['images']) > 0)
                <span class="text-primary">[{{ fs_lang('image') }}]</span>
            @endif

            @if (count($comment['files']['videos']) > 0)
                <span class="text-primary">[{{ fs_lang('video') }}]</span>
            @endif

            @if (count($comment['files']['audios']) > 0)
                <span class="text-primary">[{{ fs_lang('audio') }}]</span>
            @endif

            @if (count($comment['files']['documents']) > 0)
                <span class="text-primary">[{{ fs_lang('document') }}]</span>
            @endif
        </div>
    @endforeach

    <a href="{{ route('fresns.comment.detail', ['cid' => $cid]) }}" class="text-decoration-none stretched-link mb-2">
        {{ fs_lang('modifierCount') }}
        {{ $commentCount }}
        {{ fs_lang('contentCommentCountDesc') }}
        <i class="bi bi-chevron-right"></i>
    </a>
</section>
