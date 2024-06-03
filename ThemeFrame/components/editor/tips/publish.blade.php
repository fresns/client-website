<div class="editor-alert">
    <ul class="list-group mb-3">
        <li class="list-group-item list-group-item-danger">{{ fs_lang('editorLimitTitle') }}:</li>
        @if ($publishConfig['limit']['type'] == 1)
            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                <div class="bd-highlight">{{ fs_lang('editorLimitTypeName') }}</div>
                <div class="bd-highlight">
                    <kbd>{{ fs_lang('editorLimitType1Desc') }}</kbd>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                <div class="bd-highlight">{{ fs_lang('editorLimitDateName') }}</div>
                <div class="bd-highlight">
                    <kbd>{{ $publishConfig['limit']['periodStart'] }}</kbd>
                    -
                    <kbd>{{ $publishConfig['limit']['periodEnd'] }}</kbd>
                </div>
            </li>
        @else
            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                <div class="bd-highlight">{{ fs_lang('editorLimitTypeName') }}</div>
                <div class="bd-highlight">
                    <kbd>{{ fs_lang('editorLimitType2Desc') }}</kbd>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                <div class="bd-highlight">{{ fs_lang('editorLimitCycleName') }}</div>
                <div class="bd-highlight">
                    <kbd>{{ $publishConfig['limit']['cycleStart'] }}</kbd>
                    -
                    <kbd>{{ $publishConfig['limit']['cycleEnd'] }}</kbd>
                </div>
            </li>
        @endif
        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <div class="bd-highlight">{{ fs_lang('editorLimitRuleName') }}</div>
            <div class="bd-highlight">
                @if ($publishConfig['limit']['rule'] == 1)
                    <kbd>{{ fs_lang('editorLimitRule1Desc') }}</kbd>
                @else
                    <kbd>{{ fs_lang('editorLimitRule2Desc') }}</kbd>
                @endif
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <div class="bd-highlight w-50">{{ fs_lang('editorLimitPromptName') }}</div>
            <div class="bd-highlight">{{ $publishConfig['limit']['tip'] }}</div>
        </li>
    </ul>
</div>
