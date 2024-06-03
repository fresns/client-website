@extends('commons.fresns')

@section('title', fs_config('channel_blocking_groups_name'))

@section('content')
    {{-- Navigation --}}
    @include('me.tabs-blocking')

    {{-- Group List --}}
    <div class="clearfix border-top" id="fresns-list-container">
        @foreach($groups as $group)
            @component('components.groups.list', compact('group'))@endcomponent
        @endforeach
    </div>

    @if ($groups->isEmpty())
        {{-- No Group --}}
        <div class="text-center my-5 text-muted fs-7"><i class="fa-regular fa-newspaper"></i> {{ fs_lang('listEmpty') }}</div>
    @else
        {{-- Pagination --}}
        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
            {{ $groups->links() }}
        </div>

        {{-- Ajax Footer --}}
        @include('commons.ajax-footer')
    @endif
@endsection
