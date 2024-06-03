@extends('commons.fresns')

@section('title', fs_config('channel_hashtag_seo')['title'] ?: fs_config('channel_hashtag_name'))
@section('keywords', fs_config('channel_hashtag_seo')['keywords'])
@section('description', fs_config('channel_hashtag_seo')['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('hashtags.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- Hashtag List --}}
                <article class="card clearfix py-4" @if (fs_config('channel_hashtag_query_state') != 1) id="fresns-list-container" @endif>
                    @foreach($hashtags as $hashtag)
                        @component('components.hashtags.list', compact('hashtag'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                @if (fs_config('channel_hashtag_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $hashtags->links() }}
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
