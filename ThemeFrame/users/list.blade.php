@extends('commons.fresns')

@section('title', fs_config('channel_user_list_seo')['title'] ?: fs_config('channel_user_list_name'))
@section('keywords', fs_config('channel_user_list_seo')['keywords'])
@section('description', fs_config('channel_user_list_seo')['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('users.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- User List --}}
                <article class="card clearfix" @if (fs_config('channel_user_list_query_state') != 1) id="fresns-list-container" @endif>
                    @foreach($users as $user)
                        @component('components.users.list', compact('user'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                @if (fs_config('channel_user_list_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
