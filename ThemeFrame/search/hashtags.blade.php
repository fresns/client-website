@extends('commons.fresns')

@section('title', fs_config('channel_search_name').': '.fs_config('hashtag_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('search.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- Hashtag List --}}
                <article class="card clearfix">
                    @foreach($hashtags as $hashtag)
                        @component('components.hashtags.list', compact('hashtag'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                <div class="my-3 table-responsive">
                    {{ $hashtags->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
