@extends('commons.fresns')

@section('title', $items['title'] ?? $hashtag['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $hashtag['description'])

@section('content')
    <div class="bg-light shadow-sm py-3">
        @component('components.hashtags.detail', compact('hashtag'))@endcomponent
    </div>

    {{-- List --}}
    @switch($type)
        {{-- Post List --}}
        @case('posts')
            <div class="clearfix border-top" id="fresns-list-container">
                @foreach($posts as $post)
                    @component('components.posts.list', compact('post'))@endcomponent
                @endforeach
            </div>

            @if ($posts->isEmpty())
                {{-- No Post --}}
                <div class="text-center my-5 text-muted fs-7"><i class="fa-regular fa-rectangle-list"></i> {{ fs_lang('listEmpty') }}</div>
            @else
                {{-- Pagination --}}
                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                    {{ $posts->links() }}
                </div>

                {{-- Ajax Footer --}}
                @include('commons.ajax-footer')
            @endif
        @break

        {{-- Comment List --}}
        @case('comments')
            <div class="clearfix border-top" id="fresns-list-container">
                @foreach($comments as $comment)
                    @component('components.comments.list', [
                        'comment' => $comment,
                        'detailLink' => true,
                        'sectionAuthorLiked' => false,
                    ])@endcomponent
                @endforeach
            </div>

            @if ($comments->isEmpty())
                {{-- No Comments --}}
                <div class="text-center my-5 text-muted fs-7"><i class="fa-regular fa-comment-dots"></i> {{ fs_lang('listEmpty') }}</div>
            @else
                {{-- Pagination --}}
                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                    {{ $comments->links() }}
                </div>

                {{-- Ajax Footer --}}
                @include('commons.ajax-footer')
            @endif
        @break

        @default
            <div class="text-center my-5 text-muted fs-7"><i class="fa-regular fa-rectangle-list"></i> {{ fs_lang('listEmpty') }}</div>
    @endswitch
@endsection
