@extends('commons.fresns')

@section('title', fs_config('channel_blocking_posts_name'))

@section('content')
    {{-- Navigation --}}
    @include('me.tabs-blocking')

    {{-- Post List --}}
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
@endsection
