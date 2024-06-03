@extends('commons.fresns')

@section('title', fs_config('channel_search_name').': '.fs_config('group_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('search.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- Group List --}}
                <article class="card clearfix">
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
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
