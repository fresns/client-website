<div class="editor-group">
    <div class="d-grid">
        <button class="rounded-0 border-0 d-flex justify-content-between p-3" type="button" data-bs-toggle="modal" data-bs-target="#editor-groups-modal" data-initialized="0" id="editor-group">
            <span>
                <i class="bi bi-archive-fill me-2"></i>
                <span id="editor-group-name">@if ($group) {{ $group['name'] }} @else {{ fs_config('group_name') }}: {{ fs_lang('editorNoSelectGroup') }} @endif</span>
            </span>
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
</div>

{{-- Group Modal --}}
<div class="modal fade" id="editor-groups-modal" tabindex="-1" aria-labelledby="editor-groups-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable" id="editor-groups-modal-class">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ fs_config('group_name') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-start">
                {{-- Group List --}}
                <div id="editor-top-groups">
                    @if (! fs_editor_post('group.required'))
                        <button type="button" class="btn btn-outline-secondary btn-sm mb-2 w-100" data-bs-dismiss="modal" onclick="editorGroup.editorGroupConfirm(this)" data-gid="" data-name="{{ fs_config('group_name') }}: {{ fs_lang('editorNoSelectGroup') }}" data-web-page="editor">
                            {{ fs_lang('editorNoGroup') }}
                        </button>
                    @endif
                    <div class="list-group"></div>
                    <div class="list-group-addmore text-center mb-2 fs-7 text-secondary"></div>
                </div>

                <div id="group-list-1" class="d-flex justify-content-start"></div>
                {{-- Group List --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="editor-group-confirm" onclick="editorGroup.editorGroupConfirm(this)" data-gid="" data-name="" data-web-page="editor" disabled>
                    {{ fs_lang('confirm') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function editorChangeGid(gid = '') {
            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/post/draft/'.$did]) }}",
                type: "PATCH",
                data: {
                    'gid': gid,
                }
            });
        };
    </script>
@endpush
