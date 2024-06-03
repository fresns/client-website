@extends('commons.fresns')

@section('title', $items['title'] ?? $geotag['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $geotag['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('geotags.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.geotags.detail', compact('geotag'))@endcomponent
                </div>

                {{-- List --}}
                @switch($type)
                    {{-- Post List --}}
                    @case('posts')
                        <div class="card clearfix" id="fresns-list-container">
                            @foreach($posts as $post)
                                @component('components.posts.list', compact('post'))@endcomponent

                                @if (! $loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                            {{ $posts->links() }}
                        </div>
                    @break

                    {{-- Comment List --}}
                    @case('comments')
                        <div class="card clearfix" id="fresns-list-container">
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
                        </div>

                        {{-- Pagination --}}
                        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                            {{ $comments->links() }}
                        </div>
                    @break

                    @default
                        <div class="text-center my-5 text-muted fs-7">{{ fs_lang('listEmpty') }}</div>
                @endswitch
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
