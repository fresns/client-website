<div class="collapse @if ($titleConfig['show'] || $title) show @endif" id="titleCollapse">
    <input type="text" class="form-control form-control-lg rounded-0 border-0 ps-2 editor-title"
        id="title"
        name="title"
        placeholder="{{ fs_lang('editorTitle') }} (@if ($titleConfig['required']) {{ fs_lang('required') }} @else {{ fs_lang('optional') }} @endif)"
        maxlength="{{ $titleConfig['length'] }}"
        @if ($titleConfig['required']) required @endif
        value="{{ $title }}"
    >
    <hr>
</div>
