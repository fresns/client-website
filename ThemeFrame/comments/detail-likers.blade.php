@extends('commons.fresns')

@section('title', $items['title'] ?? Str::limit(strip_tags($comment['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($comment['content']), 140))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('comments.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.comments.detail', compact('comment'))@endcomponent
                </div>

                {{-- User List --}}
                <div class="card clearfix" id="fresns-list-container">
                    <div class="card-header">{{ $comment['interaction']['likeUserTitle'] }}</div>

                    @foreach($users as $user)
                        @component('components.users.list', compact('user'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>

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
