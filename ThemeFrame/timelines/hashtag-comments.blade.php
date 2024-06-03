@extends('commons.fresns')

@section('title', fs_config('channel_timeline_hashtag_comments_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('timelines.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- Comment List --}}
                <article class="card clearfix" id="fresns-list-container">
                    @foreach($comments as $comment)
                        @component('components.comments.list', [
                            'comment' => $comment,
                            'detailLink' => true,
                            'sectionAuthorLiked' => false,
                        ])@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                <div class="my-3 table-responsive">
                    {{ $comments->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
