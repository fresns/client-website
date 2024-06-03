@extends('commons.fresns')

@section('title', $items['title'] ?? $post['title'] ?? Str::limit(strip_tags($post['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($post['content']), 140))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-4">
                    @component('components.posts.detail', compact('post'))@endcomponent
                </div>

                <div class="card clearfix" id="commentList" name="commentList">
                    <div class="card-header">
                        <h5 class="mb-0">{{ fs_config('comment_name') }}</h5>
                    </div>

                    {{-- Sticky Comments --}}
                    @if (fs_sticky_comments($post['pid']))
                        <div class="card-body bg-primary bg-opacity-10 mb-4">
                            @foreach(fs_sticky_comments($post['pid']) as $sticky)
                                @component('components.comments.sticky', [
                                    'sticky' => $sticky,
                                    'detailLink' => true,
                                    'sectionAuthorLiked' => true,
                                ])@endcomponent
                            @endforeach
                        </div>
                    @endif

                    {{-- No Comments --}}
                    @if ($comments->isEmpty())
                        <div class="text-center my-5 text-muted fs-7"><i class="bi bi-chat-square-text"></i> {{ fs_lang('listEmpty') }}</div>
                    @endif

                    {{-- Comment List --}}
                    <article class="clearfix" id="fresns-list-container">
                        @foreach($comments as $comment)
                            @component('components.comments.list', [
                                'comment' => $comment,
                                'detailLink' => true,
                                'sectionAuthorLiked' => true,
                            ])@endcomponent

                            @if (! $loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </article>

                    {{-- Comment Pagination --}}
                    <div class="my-3 table-responsive">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
