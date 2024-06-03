@extends('commons.fresns')

@section('title', fs_config('channel_blocking_geotags_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('geotags.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                {{-- Hashtag List --}}
                <article class="card clearfix py-4" id="fresns-list-container">
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
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
