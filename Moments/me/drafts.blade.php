@extends('commons.fresns')

@section('title', fs_config('channel_me_drafts_name'))

@section('content')
    <div class="card border-0">
        {{-- Menus --}}
        <div class="card-header">
            <div class="d-flex">
                @desktop
                    <span class="me-2 mb-2" style="margin-top:3px;">
                        <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
                    </span>
                @enddesktop
                <h1 class="fs-5 mt-2">{{ fs_config('channel_me_drafts_name') }}</h1>
            </div>
            <ul class="nav nav-tabs card-header-tabs">
                {{-- posts --}}
                <li class="nav-item">
                    <a class="nav-link @if ($type == 'post') active @endif" href="{{ route('fresns.me.drafts', ['type' => 'posts']) }}">
                        {{ fs_config('post_name') }}

                        @if (fs_user_overview('draftCount.posts') > 0)
                            <span class="badge bg-danger">{{ fs_user_overview('draftCount.posts') }}</span>
                        @endif
                    </a>
                </li>
                {{-- comments --}}
                <li class="nav-item">
                    <a class="nav-link @if ($type == 'comment') active @endif" href="{{ route('fresns.me.drafts', ['type' => 'comments']) }}">
                        {{ fs_config('comment_name') }}

                        @if (fs_user_overview('draftCount.comments') > 0)
                            <span class="badge bg-danger">{{ fs_user_overview('draftCount.comments') }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        {{-- Draft List --}}
        <div class="card-body">
            @component('components.editor.draft-list', [
                'type' => $type,
                'drafts' => $drafts,
            ])@endcomponent
        </div>
    </div>
@endsection
