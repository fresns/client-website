<div class="editor-alert">
    @if ($controls['editableStatus'])
        <div class="alert alert-danger" role="alert">
            {{ fs_lang('editorEditTimeTitle') }}<br>
            <kbd>{{ fs_lang('editorEditTimeDesc') }}: {{ $controls['editableTime'] }} ({{ $controls['deadlineTime'] }})</kbd>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            <kbd>{{ fs_lang('errorTimeout') }}</kbd>
            {{ fs_lang('editorEditTimeTitle') }}
        </div>
    @endif
</div>
