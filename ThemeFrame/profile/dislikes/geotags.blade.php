@extends('profile.profile')

@section('list')
    {{-- List --}}
    <article class="py-4" id="fresns-list-container">
        @foreach($geotags as $geotag)
            @component('components.geotags.list', compact('geotag'))@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- Pagination --}}
    <div class="my-3 table-responsive">
        {{ $geotags->links() }}
    </div>
@endsection
