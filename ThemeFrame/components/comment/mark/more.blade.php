<ul class="dropdown-menu interaction-more" aria-labelledby="more">
    {{-- Edit --}}
    @if ($editControls['isAuthor'] && $editControls['canEdit'])
        <li>
            <a class="dropdown-item py-2" href="{{ route('fresns.editor.comment', ['cid' => $cid]) }}">
                <i class="bi bi-pencil-square"></i>
                {{ fs_lang('edit') }}
            </a>
        </li>
    @endif

    {{-- Delete --}}
    @if ($editControls['isAuthor'] && $editControls['canDelete'])
        <li><a class="dropdown-item py-2" data-bs-toggle="modal" href="#delete-{{ $cid }}"><i class="bi bi-trash"></i> {{ fs_lang('delete') }}</a></li>
    @endif

    {{-- Follow --}}
    @if ($interaction['followEnabled'])
        <li>
            @component('components.comment.mark.follow', [
                'cid' => $cid,
                'interaction' => $interaction,
                'count' => $followCount,
            ])@endcomponent
        </li>
    @endif

    {{-- Block --}}
    @if ($interaction['blockEnabled'])
        <li>
            @component('components.comment.mark.block', [
                'cid' => $cid,
                'interaction' => $interaction,
                'count' => $blockCount,
            ])@endcomponent
        </li>
    @endif

    {{-- Manages --}}
    @if ($manages)
        @foreach($manages as $plugin)
            <li>
                <a class="dropdown-item py-2" data-bs-toggle="modal" href="#fresnsModal"
                    data-title="{{ $plugin['name'] }}"
                    data-url="{{ $plugin['appUrl'] }}"
                    data-cid="{{ $cid }}"
                    data-uid="{{ $uid }}"
                    data-view-type="{{ $viewType }}"
                    data-post-message-key="fresnsCommentManage">
                    @if ($plugin['icon'])
                        <img src="{{ $plugin['icon'] }}" loading="lazy" width="20" height="20">
                    @endif
                    {{ $plugin['name'] }}
                </a>
            </li>
        @endforeach
    @endif
</ul>

{{-- Delete Secondary Confirmation --}}
@if ($editControls['isAuthor'] && $editControls['canDelete'])
    <div class="modal fade" id="delete-{{ $cid }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete-{{ $cid }}Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5">{{ fs_lang('delete') }}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ fs_lang('cancel') }}</button>
                    <a class="btn btn-danger api-request-link" href="#" role="button" data-method="DELETE" data-fsid="{{ $cid }}" data-action="{{ route('fresns.api.delete', ['path' => "/api/fresns/v1/comment/{$cid}"]) }}" data-bs-dismiss="modal">{{ fs_lang('delete') }}</a>
                </div>
            </div>
        </div>
    </div>
@endif