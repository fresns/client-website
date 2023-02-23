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

            {{-- Middle Content --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.comment.detail', compact('comment'))@endcomponent
                </div>

                <article class="card clearfix" id="fresns-list-container">
                    <div class="card-header">
                        <h5 class="mb-0">{{ fs_db_config('comment_name') }}</h5>
                    </div>

                    @foreach($comments as $comment)
                        @component('components.comment.list', [
                            'comment' => $comment,
                            'detailLink' => false,
                            'sectionCreatorLiked' => true,
                        ])@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
