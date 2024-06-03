@if ($actionButton['hasActionButton'])
    <ul class="list-group mt-3">
        <li class="list-group-item list-group-item-warning d-flex justify-content-between align-items-center">
            <div class="bd-highlight">{{ fs_lang('editorCommentButtonTitle') }}:</div>
            <div class="bd-highlight">
                <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ fs_lang('editorCommentButtonTitle') }}"
                    data-url="{{ $actionButton['buttonUrl'] }}"
                    data-draft-type="{{ $type }}"
                    data-did="{{ $did }}"
                    data-post-message-key="fresnsEditorActionButton">
                    {{ fs_lang('modify') }}
                </button>
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <div class="bd-highlight">{{ fs_lang('editorCommentButtonName') }}</div>
            <div class="bd-highlight">
                <span class="badge bg-secondary rounded-pill">{{ $actionButton['buttonName'] }}</span>
            </div>
        </li>
    </ul>
@endif
