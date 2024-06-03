@extends('commons.fresns')

@section('title', $items['title'] ?? $group['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $group['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('groups.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.groups.detail', compact('group'))@endcomponent
                </div>

                {{-- extensions --}}
                <div class="clearfix">
                    @foreach($items['extensions'] as $extension)
                        <div class="float-start mb-3" style="width:20%">
                            <a class="text-decoration-none" data-bs-toggle="modal" href="#fresnsModal"
                                data-title="{{ $extension['name'] }}"
                                data-url="{{ $extension['appUrl'] }}"
                                data-post-message-key="fresnsGroupExtension">
                                <div class="position-relative mx-auto" style="width:52px">
                                    <img src="{{ $extension['icon'] }}" loading="lazy" class="rounded" height="52">
                                    @if ($extension['badgeType'])
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                            {{ $extension['badgeType'] == 1 ? '' : $extension['badgeValue'] }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 mb-0 fs-7 text-center text-nowrap">{{ $extension['name'] }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Sticky Posts --}}
                @if (fs_sticky_posts($group['gid']))
                    <div class="list-group mb-3">
                        @foreach(fs_sticky_posts($group['gid']) as $sticky)
                            @component('components.posts.sticky', compact('sticky'))@endcomponent
                        @endforeach
                    </div>
                @endif

                {{-- Post List --}}
                <div class="card clearfix">
                    {{-- Can View Content --}}
                    @if ($group['canViewContent'])
                        {{-- List --}}
                        @switch($type)
                            {{-- Post List --}}
                            @case('posts')
                                <div class="clearfix" id="fresns-list-container">
                                    @foreach($posts as $post)
                                        @component('components.posts.list', compact('post'))@endcomponent

                                        @if (! $loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- Pagination --}}
                                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                                    {{ $posts->links() }}
                                </div>
                            @break

                            {{-- Comment List --}}
                            @case('comments')
                                <div class="clearfix" id="fresns-list-container">
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
                                </div>

                                {{-- Pagination --}}
                                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                                    {{ $comments->links() }}
                                </div>
                            @break

                            @default
                                <div class="text-center my-5 text-muted fs-7">{{ fs_lang('listEmpty') }}</div>
                        @endswitch
                    @else
                        <div class="text-center py-5 text-danger">
                            <i class="bi bi-info-circle"></i> {{ fs_lang('contentGroupTip') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
