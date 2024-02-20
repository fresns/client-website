@extends('commons.fresns')

@section('title', fs_config('menu_like_users'))

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
                <article class="card clearfix" id="fresns-list-container">
                    @foreach($users as $user)
                        @component('components.user.list', compact('user'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                <div class="my-3 table-responsive">
                    {{ $users->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
