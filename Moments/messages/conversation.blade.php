@extends('commons.fresns')

@section('title', fs_config('channel_conversations_name').' - '.$conversation['detail']['user']['nickname'])

@section('content')
    @desktop
        <div class="d-flex mx-3">
                <span class="me-2" style="margin-top:11px;">
                    <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
                </span>
                <h1 class="fs-5 my-3">{{ fs_config('channel_conversations_name') }}</h1>
        </div>
    @enddesktop

    <div class="card border-0">
        {{-- Conversation User --}}
        <div class="card-header">
            @if ($conversation['detail']['user']['status'])
                <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $conversation['detail']['user']['fsid']]) }}" target="_blank" class="text-decoration-none">
                    <img src="{{ $conversation['detail']['user']['avatar'] }}" loading="lazy" alt="{{ $conversation['detail']['user']['nickname'] }}" class="rounded-circle conversation-avatar">
                    <span class="ms-2 fs-5">{{ $conversation['detail']['user']['nickname'] }}</span>
                    <span class="ms-2 conversation-user-name text-secondary">{{ '@'.$conversation['detail']['user']['username'] }}</span>
                </a>
            @else
                <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="rounded-circle conversation-avatar">
                {{ fs_lang('userDeactivate') }}
            @endif
        </div>

        {{-- Messages --}}
        <div class="card-body">
            @foreach($messages as $message)
                @component('components.messages.message', compact('message'))@endcomponent
            @endforeach

            <div class="d-flex justify-content-center mt-4">
                {{ $messages->links() }}
            </div>
        </div>

        {{-- Send Box --}}
        <div class="card-footer">
            @component('components.messages.send', [
                'configs' => $conversation['configs'],
                'user' => $conversation['detail']['user'],
            ])@endcomponent
        </div>
    </div>
@endsection
