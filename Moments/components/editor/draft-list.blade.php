<table class="table table-hover">
    <thead>
        <tr class="table-secondary">
            <th scope="col">ID</th>
            <th scope="col">{{ fs_lang('editorTitle') }}</th>
            <th scope="col" class="text-center" style="width:30%">{{ fs_lang('setting') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drafts as $draft)
            <tr id="{{ $draft['did'] }}">
                <th scope="row">{{ $draft['did'] }}</th>
                <td>
                    {{-- title --}}
                    @if ($draft['title'] ?? null)
                        {{ $draft['title'] }}
                    @else
                        {{ Str::limit($draft['content'], 80) }}
                    @endif

                    @if ($draft['fsid'])
                        @switch($type)
                            @case('post')
                                <a href="{{ route('fresns.post.detail', ['pid' => $draft['fsid']]) }}" target="_blank">
                                    <span class="badge bg-info">{{ fs_lang('contentViewOriginal') }}</span>
                                </a>
                            @break

                            @case('comment')
                                <a href="{{ route('fresns.comment.detail', ['cid' => $draft['fsid']]) }}" target="_blank">
                                    <span class="badge bg-info">{{ fs_lang('contentViewOriginal') }}</span>
                                </a>
                            @break
                        @endswitch
                    @endif

                    {{-- state --}}
                    @if ($draft['state'] == 2)
                        <span class="badge bg-success">{{ fs_lang('contentReviewPending') }}</span>
                    @endif
                    @if ($draft['state'] == 4)
                        <span class="badge bg-danger me-1">{{ fs_lang('contentReviewRejected') }}</span>
                        <span class="badge bg-secondary">{{ $draft['reason'] }}</span>
                    @endif
                </td>
                <td class="text-center">
                    @if ($draft['state'] == 1 || $draft['state'] == 4)
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('fresns.editor.edit', ['type' => $type, 'did' => $draft['did']]) }}" role="button">{{ fs_lang('edit') }}</a>

                        <a class="btn btn-link link-danger text-decoration-none api-request-link" href="#" data-method="DELETE" data-fsid="{{ $draft['did'] }}" data-action="{{ route('fresns.api.delete', ['path' => "/api/fresns/v1/editor/{$type}/draft/{$draft['did']}"]) }}">{{ fs_lang('delete') }}</a>
                    @elseif ($draft['state'] == 2)
                        <a class="btn btn-outline-success btn-sm api-request-link" href="#" data-method="PUT" data-action="{{ route('fresns.api.put', ['path' => "/api/fresns/v1/editor/{$type}/draft/{$draft['did']}"]) }}">{{ fs_lang('recall') }}</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
