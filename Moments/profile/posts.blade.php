@extends('profile.profile')

@section('list')
    {{-- List --}}
    <div class="clearfix border-top" id="fresns-list-container">
        @foreach($posts as $post)
            @component('components.posts.list', compact('post'))@endcomponent
        @endforeach
    </div>

    {{-- List is empty --}}
    @if ($posts->isEmpty())
        <div class="text-center my-5 text-muted fs-7"><i class="fa-regular fa-rectangle-list"></i> {{ fs_lang('listEmpty') }}</div>
    @endif

    {{-- Pagination --}}
    <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
        {{ $posts->links() }}
    </div>

    {{-- Ajax Footer --}}
    @include('commons.ajax-footer')
@endsection
