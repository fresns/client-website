@extends('commons.fresns')

@section('title', fs_config('channel_conversations_name').' - '.$conversation['detail']['user']['nickname'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            {{-- Conversation --}}
            <div class="col-sm-9">
                <div class="card">
                    {{-- Conversation User --}}
                    <div class="card-header">
                        @if ($conversation['detail']['user'])
                            <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $conversation['detail']['user']['fsid']]) }}" target="_blank" class="text-decoration-none">
                                <img src="{{ $conversation['detail']['user']['avatar'] }}" loading="lazy" alt="{{ $conversation['detail']['user']['nickname'] }}" class="rounded-circle conversation-avatar">
                                <span class="ms-2 fs-5">{{ $conversation['detail']['user']['nickname'] }}</span>
                                <span class="ms-2 conversation-user-name text-secondary">{{ '@'.$conversation['detail']['user']['fsid'] }}</span>
                            </a>
                        @else
                            <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="rounded-circle conversation-avatar">
                            {{ fs_lang('userDeactivate') }}
                        @endif
                    </div>

                    {{-- Messages --}}
                    <div class="card-body">
                        @foreach($messages as $message)
                            @component('components.message.message', compact('message'))@endcomponent
                        @endforeach

                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    </div>

                    {{-- Send Box --}}
                    <div class="card-footer">
                        @component('components.message.send', [
                            'configs' => $conversation['configs'],
                            'user' => $conversation['detail']['user'],
                        ])@endcomponent
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
