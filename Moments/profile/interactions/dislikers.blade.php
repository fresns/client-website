@extends('profile.profile')

@section('list')
    {{-- List --}}
    <div class="clearfix border-top" id="fresns-list-container">
        @foreach($users as $user)
            @component('components.users.list', compact('user'))@endcomponent
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
        {{ $users->links() }}
    </div>

    {{-- Ajax Footer --}}
    @include('commons.ajax-footer')
@endsection
