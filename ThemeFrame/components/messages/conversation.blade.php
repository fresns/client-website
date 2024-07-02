<a href="{{ route('fresns.conversation.detail', ['uidOrUsername' => $conversation['user']['fsid']]) }}" class="list-group-item list-group-item-action d-flex justify-content-between position-relative">
    @if ($conversation['user'])
        <img src="{{ $conversation['user']['avatar'] }}" loading="lazy" class="conversation-list-avatar rounded-circle">
    @else
        <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" class="conversation-list-avatar rounded-circle">
    @endif

    <div class="flex-fill ms-2">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">
                @if ($conversation['user'])
                    {{ $conversation['user']['nickname'] }}

                    @if ($conversation['user']['verified'])
                        @if ($conversation['user']['verifiedIcon'])
                            <img src="{{ $conversation['user']['verifiedIcon'] }}" loading="lazy" class="conversation-user-verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $conversation['user']['verifiedDesc'] }}">
                        @else
                            <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" class="conversation-user-verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $conversation['user']['verifiedDesc'] }}">
                        @endif
                    @endif

                    <span class="conversation-user-name text-secondary">{{ '@'.$conversation['user']['fsid'] }}</span>
                @else
                    {{ fs_lang('userDeactivate') }}
                @endif
            </h5>
            <small class="text-muted pt-1">{{ $conversation['latestMessage']['datetimeFormat'] }}</small>
        </div>

        {{-- Notification Brief --}}
        <div class="conversation-brief text-break mt-1">
            @if ($conversation['latestMessage']['type'] == 'text')
                {{ $conversation['latestMessage']['message'] }}
            @else
                {{ '['.$conversation['latestMessage']['message'].']' }}
            @endif
        </div>
    </div>

    {{-- Unread Count --}}
    @if ($conversation['unreadCount'] > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $conversation['unreadCount'] }}</span>
    @endif
</a>
