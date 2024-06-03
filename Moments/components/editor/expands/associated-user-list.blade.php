@if ($associatedUserListConfig['hasUserList'])
    <ul class="list-group mt-3">
        <li class="list-group-item list-group-item-warning d-flex justify-content-between align-items-center">
            <div class="bd-highlight">{{ fs_lang('editorUserListTitle') }}:</div>
            <div class="bd-highlight">
                <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ fs_lang('editorUserListTitle') }}"
                    data-url="{{ $associatedUserListConfig['userListUrl'] }}"
                    data-draft-type="{{ $type }}"
                    data-did="{{ $did }}"
                    data-post-message-key="fresnsEditorAssociatedUserList">
                    {{ fs_lang('modify') }}
                </button>
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <div class="bd-highlight">{{ fs_lang('editorUserListName') }}</div>
            <div class="bd-highlight">
                <span class="badge bg-secondary rounded-pill">{{ $associatedUserListConfig['userListName'] }}</span>
            </div>
        </li>
    </ul>
@endif
