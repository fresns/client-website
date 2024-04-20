@if (fs_config('conversation_status'))
    @if ($user['conversation']['status'])
        <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/conversation/message']) }}" method="post" class="api-request-form">
            <input type="hidden" name="uidOrUsername" value="{{ $user['fsid'] }}"/>

            <div id="send-box" class="input-group">
                {{-- Send File --}}
                <button class="btn btn-outline-secondary dropdown-toggle send-file-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('file') }}</button>

                <input type="hidden" name="fid"/>

                <ul class="dropdown-menu">
                    @if (in_array('image', fs_config('conversation_files', [])))
                        <li><label class="dropdown-item" for="messageImage" style="cursor:pointer;"><i class="bi bi-image"></i> {{ fs_lang('image') }}</label></li>
                        <input id="messageImage" class="sendFile" hidden="hidden" type="file"
                            name="messageImage"
                            accept="{{ fs_editor_post('image.inputAccept') }}"
                            data-type="image"
                            data-upload-action="{{ route('fresns.api.post', ['path' => '/api/fresns/common/v1/file/upload']) }}"
                            data-send-action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/conversation/message']) }}"
                            data-user-fsid="{{ $user['fsid'] }}">
                    @endif

                    @if (in_array('video', fs_config('conversation_files', [])))
                        <li><label class="dropdown-item" for="messageVideo" style="cursor:pointer;"><i class="bi bi-film"></i> {{ fs_lang('video') }}</label></li>
                        <input id="messageVideo" class="sendFile" hidden="hidden" type="file"
                            name="messageVideo"
                            accept="{{ fs_editor_post('video.inputAccept') }}"
                            data-type="video"
                            data-upload-action="{{ route('fresns.api.post', ['path' => '/api/fresns/common/v1/file/upload']) }}"
                            data-send-action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/conversation/message']) }}"
                            data-user-fsid="{{ $user['fsid'] }}">
                    @endif

                    @if (in_array('audio', fs_config('conversation_files', [])))
                        <li><label class="dropdown-item" for="messageAudio" style="cursor:pointer;"><i class="bi bi-music-note-beamed"></i> {{ fs_lang('audio') }}</label></li>
                        <input id="messageAudio" class="sendFile" hidden="hidden" type="file"
                            name="messageAudio"
                            accept="{{ fs_editor_post('audio.inputAccept') }}"
                            data-type="audio"
                            data-upload-action="{{ route('fresns.api.post', ['path' => '/api/fresns/common/v1/file/upload']) }}"
                            data-send-action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/conversation/message']) }}"
                            data-user-fsid="{{ $user['fsid'] }}">
                    @endif

                    @if (in_array('document', fs_config('conversation_files', [])))
                        <li><label class="dropdown-item" for="messageDocument" style="cursor:pointer;"><i class="bi bi-file-earmark-text"></i> {{ fs_lang('document') }}</label></li>
                        <input id="messageDocument" class="sendFile" hidden="hidden" type="file"
                            name="messageDocument"
                            accept="{{ fs_editor_post('document.inputAccept') }}"
                            data-type="document"
                            data-upload-action="{{ route('fresns.api.post', ['path' => '/api/fresns/common/v1/file/upload']) }}"
                            data-send-action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/conversation/message']) }}"
                            data-user-fsid="{{ $user['fsid'] }}">
                    @endif
                </ul>

                {{-- Send Text --}}
                <textarea name="message" class="form-control"></textarea>
                <button class="btn btn-outline-secondary" type="submit">{{ fs_lang('send') }}</button>
            </div>
        </form>
    @else
        <div class="input-group">
            <textarea name="message" class="form-control pt-4" disabled>{{ $user['conversation']['message'] }}</textarea>
            <button class="btn btn-outline-secondary" type="button" disabled>{{ fs_lang('send') }}</button>
        </div>
    @endif
@else
    <div class="input-group">
        <textarea name="message" class="form-control pt-4" disabled>{{ fs_lang('userConversationCloseDesc') }}</textarea>
        <button class="btn btn-outline-secondary" type="button" disabled>{{ fs_lang('send') }}</button>
    </div>
@endif
