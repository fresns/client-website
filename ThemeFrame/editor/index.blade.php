@extends('commons.fresns')

@section('title', fs_lang('editor'))

@section('content')
    <div class="container-fluid">
        <div class="fresns-editor">
            {{-- Tip: Publish Permissions --}}
            @if ($configs['publish']['limit']['status'] && $configs['publish']['limit']['isInTime'])
                @component('components.editor.tip.publish', [
                    'publishConfig' => $configs['publish'],
                ])@endcomponent
            @endif

            {{-- Toolbar --}}
            @component('components.editor.sections.toolbar', [
                'type' => $type,
                'did' => '',
                'editorConfig' => $configs['editor'],
            ])@endcomponent

            {{-- Content Start --}}
            <div class="editor-box p-3">
                {{-- Title --}}
                @if ($configs['editor']['title']['status'])
                    @component('components.editor.sections.title', [
                        'titleConfig' => $configs['editor']['title'],
                        'title' => '',
                    ])@endcomponent
                @endif

                {{-- Content --}}
                <textarea class="form-control rounded-0 border-0" id="content" rows="15" placeholder="{{ fs_lang('editorContent') }}"></textarea>
            </div>
            {{-- Content End --}}

            {{-- Button --}}
            <div class="editor-submit d-grid">
                <button type="button" class="btn btn-success btn-lg my-5 mx-3">{{ fs_config('publish_post_name') }}</button>
            </div>
        </div>
    </div>

    {{-- Draft Modal --}}
    <div class="modal fade" id="fresns-drafts" tabindex="-1" data-bs-backdrop="static" aria-labelledby="fresns-drafts" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ fs_lang('editorDraftSelect') }}</h5>
                </div>

                {{-- Draft List --}}
                <div class="modal-body">
                    @component('components.editor.draft-list', [
                        'type' => $type,
                        'drafts' => $drafts,
                    ])@endcomponent
                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary" href="{{ route('fresns.post.index') }}" role="button">{{ fs_lang('return') }}</a>
                    <a class="btn btn-primary" href="{{ route('fresns.editor.post', ['skipDrafts' => true]) }}" role="button">{{ fs_lang('editorDraftCreate') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($){
            $(function (){
                var myModal = new bootstrap.Modal(document.getElementById('fresns-drafts'), {});
                myModal.show()
            })
        })(jQuery);
    </script>
@endpush
