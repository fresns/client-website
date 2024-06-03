@extends('commons.fresns')

@section('title', fs_config('channel_post_seo')['title'] ?: fs_config('channel_post_name'))
@section('keywords', fs_config('channel_post_seo')['keywords'])
@section('description', fs_config('channel_post_seo')['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- Sticky Posts --}}
                @if (fs_sticky_posts())
                    <div class="list-group mb-4">
                        @foreach(fs_sticky_posts() as $sticky)
                            @component('components.posts.sticky', compact('sticky'))@endcomponent
                        @endforeach
                    </div>
                @endif

                {{-- Post List --}}
                <article class="card clearfix" @if (fs_config('channel_post_query_state') != 1) id="fresns-list-container" @endif>
                    @foreach($posts as $post)
                        @component('components.posts.list', compact('post'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                @if (fs_config('channel_post_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $posts->links() }}
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
