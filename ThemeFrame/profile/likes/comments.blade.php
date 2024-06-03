@extends('profile.profile')

@section('list')
    {{-- List --}}
    <article class="py-4" id="fresns-list-container">
        @foreach($comments as $comment)
            @component('components.comments.list', [
                'comment' => $comment,
                'detailLink' => true,
                'sectionAuthorLiked' => false,
            ])@endcomponent
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach
    </article>

    {{-- Pagination --}}
    <div class="my-3 table-responsive">
        {{ $comments->links() }}
    </div>
@endsection
