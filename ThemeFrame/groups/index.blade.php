@extends('commons.fresns')

@section('title', fs_config('channel_group_seo')['title'] ?: fs_config('channel_group_name'))
@section('keywords', fs_config('channel_group_seo')['keywords'])
@section('description', fs_config('channel_group_seo')['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('groups.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                @if (fs_config('channel_group_type') == 'tree')
                    {{-- Group Tree --}}
                    @foreach($groupTree ?? [] as $tree)
                        <h3 class="fs-5">{{ $tree['name'] }}</h3>
                        <div class="card mb-5 py-4">
                            @foreach($tree['groups'] ?? [] as $group)
                                @component('components.groups.list', compact('group'))@endcomponent
                                @if (! $loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @else
                    {{-- Group List --}}
                    <div class="card mb-5 py-4" @if (fs_config('channel_group_query_state') != 1) id="fresns-list-container" @endif>
                        @foreach($groups ?? [] as $group)
                            @component('components.groups.list', compact('group'))@endcomponent
                            @if (! $loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if (fs_config('channel_group_query_state') != 1)
                        <div class="my-3 table-responsive">
                            {{ $groups->links() }}
                        </div>
                    @endif
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
