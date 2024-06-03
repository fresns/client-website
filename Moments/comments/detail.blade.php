@extends('commons.fresns')

@if($comment['isMarkdown'])
    @section('title', $items['title'] ?? Str::limit(strip_tags(Str::markdown($comment['content'])), 40))
    @section('keywords', $items['keywords'])
    @section('description', $items['description'] ?? Str::limit(strip_tags(Str::markdown($comment['content'])), 140))
@else
    @section('title', $items['title'] ?? Str::limit(strip_tags($comment['content']), 40))
    @section('keywords', $items['keywords'])
    @section('description', $items['description'] ?? Str::limit(strip_tags($comment['content']), 140))
@endif

@section('content')
    @desktop
        <div class="d-flex mx-3 my-2">
            <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
            <h4 class="fs-5 mb-0 ms-2" style="padding-top: 0.38rem">{{ fs_config('comment_name') }}</h4>
        </div>
    @enddesktop

    <div class="shadow-sm">
        @component('components.comments.detail', compact('comment'))@endcomponent
    </div>

    <div class="clearfix pb-5" id="commentList" name="commentList">
        <div class="d-flex justify-content-between px-3 mt-4 border-bottom">
            <h3 class="fs-5 pt-2">
                {{ fs_config('comment_name') }}
                <span class="badge bg-secondary rounded-pill">{{ $comment['commentCount'] }}</span>
            </h3>
        </div>

        <div id="fresns-list-container">
            @foreach($comments as $comment)
                @component('components.comments.list', [
                    'comment' => $comment,
                    'detailLink' => false,
                    'sectionAuthorLiked' => true,
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
    </div>
@endsection
