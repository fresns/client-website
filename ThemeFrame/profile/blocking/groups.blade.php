@extends('profile.profile')

@section('list')
    {{-- List --}}
    <article class="py-4" id="fresns-list-container">
        @foreach($groups as $group)
            @component('components.groups.list', compact('group'))@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- Pagination --}}
    <div class="my-3 table-responsive">
        {{ $groups->links() }}
    </div>
@endsection
