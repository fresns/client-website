@extends('commons.fresns')

@section('title', fs_config('channel_blocking_hashtags_name'))

@section('content')
    {{-- Navigation --}}
    @include('me.tabs-blocking')

    {{-- Hashtag List --}}
    <div class="clearfix border-top" id="fresns-list-container">
        @foreach($hashtags as $hashtag)
            @component('components.hashtags.list', compact('hashtag'))@endcomponent
        @endforeach
    </div>

    @if ($hashtags->isEmpty())
        {{-- No Hashtag --}}
        <div class="text-center my-5 text-muted fs-7"><i class="fa-solid fa-hashtag"></i> {{ fs_lang('listEmpty') }}</div>
    @else
        {{-- Pagination --}}
        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
            {{ $hashtags->links() }}
        </div>

        {{-- Ajax Footer --}}
        @include('commons.ajax-footer')
    @endif
@endsection
