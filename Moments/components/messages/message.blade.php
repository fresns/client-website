@if ($message['isMe'])
    <div class="d-flex justify-content-end mt-3">
        <div class="text-end">
            <p class="bg-success bg-gradient text-white rounded p-2 mb-0">
                @if ($message['type'] == 'text')
                    {{ $message['content'] }}
                @else
                    @component('components.messages.message-file', [
                        'cmid' => $message['cmid'],
                        'file' => $message['file'],
                    ])@endcomponent
                @endif
            </p>
            <small class="text-muted">{{ $message['datetimeFormat'] }}</small>
        </div>
        <div class="ms-2">
            <img src="{{ $message['user']['avatar'] }}" loading="lazy" alt="{{ $message['user']['nickname'] }}" class="conversation-avatar rounded-circle">
        </div>
    </div>
@else
    <div class="d-flex justify-content-start mt-3">
        <div class="me-2">
            <img src="{{ $message['user']['avatar'] }}" loading="lazy" alt="{{ $message['user']['nickname'] }}" class="conversation-avatar rounded-circle">
        </div>
        <div class="text-start">
            <p class="bg-secondary bg-gradient bg-opacity-25 text-break rounded p-2 mb-0">
                @if ($message['type'] == 'text')
                    {{ $message['content'] }}
                @else
                    @component('components.messages.message-file', [
                        'cmid' => $message['cmid'],
                        'file' => $message['file'],
                    ])@endcomponent
                @endif
            </p>
            <small class="text-muted">{{ $message['datetimeFormat'] }}</small>
        </div>
    </div>
@endif
