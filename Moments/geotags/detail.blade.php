@extends('commons.fresns')

@section('title', $items['title'] ?? $geotag['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $geotag['description'])

@section('content')
    <div class="d-flex mx-3">
        @desktop
            <span class="me-2" style="margin-top:11px;">
                <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
            </span>
        @enddesktop
        <h1 class="fs-5 my-3">{{ fs_config('channel_nearby_posts_name') }}</h1>
    </div>

    {{-- Location Info --}}
    <div class="alert alert-primary mx-3" role="alert">
        <i class="fa-solid fa-map-location-dot"></i> {{ $geotag['name'] ?? $geotag['latitude'].' / '.$geotag['longitude'] }}
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
            <div class="text-center my-5 text-muted fs-7">{{ fs_lang('listEmpty') }}</div>
    @endswitch
@endsection
