@extends('commons.fresns')

@if($post['isMarkdown'])
    @section('title', $items['title'] ?? $post['title'] ?? Str::limit(strip_tags(Str::markdown($post['content'])), 40))
    @section('keywords', $items['keywords'])
    @section('description', $items['description'] ?? Str::limit(strip_tags(Str::markdown($post['content'])), 140))
@else
    @section('title', $items['title'] ?? $post['title'] ?? Str::limit(strip_tags($post['content']), 40))
    @section('keywords', $items['keywords'])
    @section('description', $items['description'] ?? Str::limit(strip_tags($post['content']), 140))
@endif

@section('content')
    @desktop
        <div class="d-flex mx-3 my-2">
            <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
            <h4 class="fs-5 mb-0 ms-2" style="padding-top: 0.38rem">{{ fs_config('post_name') }}</h4>
        </div>
    @enddesktop

    <div class="bg-light shadow-sm">
        @component('components.posts.detail', compact('post'))@endcomponent
    </div>

    {{-- Comment Box --}}
    @component('components.posts.sections.comment-box', [
        'nickname' => $post['author']['nickname'],
        'pid' => $post['pid'],
    ])@endcomponent

    {{-- Sticky Comments --}}
    @if (fs_sticky_comments($post['pid']))
        <div class="clearfix">
            <div class="d-flex justify-content-between px-3 mt-5 border-bottom">
                <h3 class="fs-5">{{ fs_lang('contentSticky') }}</h3>
            </div>
            <div class="bg-primary bg-opacity-10 mb-4">
                @foreach(fs_sticky_comments($post['pid']) as $sticky)
                    @component('components.comments.sticky', [
                        'sticky' => $sticky,
                        'detailLink' => true,
                        'sectionAuthorLiked' => true,
                    ])@endcomponent
                @endforeach
            </div>
        </div>
    @endif

    <div class="clearfix pb-5" id="commentList" name="commentList">
        <div class="d-flex justify-content-between px-3 mt-5 border-bottom">
            <h3 class="fs-5 pt-2">
                {{ fs_config('comment_name') }}
                <span class="badge bg-secondary rounded-pill">{{ $post['commentCount'] }}</span>
            </h3>
            <div class="btn-group mb-2">
                <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-sort me-1"></i>
                    {{ fs_lang('contentBrowse') }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item py-2" href="{{ request()->fullUrlWithQuery(['orderType' => 'createdTime', 'orderDirection' => 'asc']).'#commentList' }}"><i class="fa-solid fa-eye me-2"></i> {{ fs_lang('default') }}</a></li>
                    <li><a class="dropdown-item py-2" href="{{ request()->fullUrlWithQuery(['orderType' => 'createdTime', 'orderDirection' => 'desc']).'#commentList' }}"><i class="fa-solid fa-arrow-up-9-1 me-2"></i> {{ fs_lang('contentNewList') }}</a></li>
                    <li><a class="dropdown-item py-2" href="{{ request()->fullUrlWithQuery(['orderType' => 'like', 'orderDirection' => 'desc']).'#commentList' }}"><i class="fa-brands fa-hotjar me-2"></i> {{ fs_lang('contentPopularList') }}</a></li>
                </ul>
            </div>
        </div>

        {{-- Comment List --}}
        <div class="clearfix" id="fresns-list-container">
            @foreach($comments as $comment)
                @component('components.comments.list', [
                    'comment' => $comment,
                    'detailLink' => true,
                    'sectionAuthorLiked' => true,
                ])@endcomponent
            @endforeach
        </div>

        @if ($comments->isEmpty())
            {{-- No Comments --}}
            <div class="text-center my-5 text-muted fs-7"><i class="fa-regular fa-comment-dots"></i> {{ fs_lang('listEmpty') }}</div>
        @else
            {{-- Comment Pagination --}}
            <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                {{ $comments->links() }}
            </div>

            {{-- Ajax Footer --}}
            @include('commons.ajax-footer')
        @endif
    </div>
@endsection
