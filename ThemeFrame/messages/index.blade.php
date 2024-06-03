@extends('commons.fresns')

@section('title', fs_config('channel_conversations_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            <div class="col-sm-9">
                {{-- Conversation List --}}
                <div class="list-group mt-4 mx-auto" style="max-width:500px;">
                    @foreach($conversations as $conversation)
                        @component('components.messages.conversation', compact('conversation'))@endcomponent
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center my-3">
                    {{ $conversations->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
