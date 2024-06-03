@extends('commons.fresns')

@section('title', fs_config('channel_comment_list_seo')['title'] ?: fs_config('channel_comment_list_name'))
@section('keywords', fs_config('channel_comment_list_seo')['keywords'])
@section('description', fs_config('channel_comment_list_seo')['description'])

@section('content')
    <div class="d-flex mx-3">
        @desktop
            <span class="me-2" style="margin-top:11px;">
                <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
            </span>
        @enddesktop
        <h1 class="fs-5 my-3">{{ fs_config('channel_comment_list_name') }}</h1>
    </div>

    {{-- Comment List --}}
    <div class="clearfix border-top" @if (fs_config('channel_comment_list_query_state') != 1) id="fresns-list-container" @endif>
        @foreach($comments as $comment)
            @component('components.comments.list', [
                'comment' => $comment,
                'detailLink' => true,
                'sectionAuthorLiked' => false,
            ])@endcomponent
        @endforeach
    </div>

    {{-- Pagination --}}
    @if (fs_config('channel_comment_list_query_state') != 1)
        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
            {{ $comments->links() }}
        </div>

        {{-- Ajax Footer --}}
        @include('commons.ajax-footer')
    @endif
@endsection
