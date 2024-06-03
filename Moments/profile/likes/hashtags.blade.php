@extends('profile.profile')

@section('list')
    {{-- List --}}
    <div class="clearfix border-top" id="fresns-list-container">
        @foreach($hashtags as $hashtag)
            @component('components.hashtags.list', compact('hashtag'))@endcomponent
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
        {{ $hashtags->links() }}
    </div>

    {{-- Ajax Footer --}}
    @include('commons.ajax-footer')
@endsection
