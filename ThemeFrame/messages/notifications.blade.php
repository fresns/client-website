@extends('commons.fresns')

@section('title', fs_config('channel_notifications_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            {{-- Notification List --}}
            <div class="col-sm-9">
                <div class="card">
                    {{-- Menus --}}
                    @if (fs_config('webframe_notifications', []))
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                {{-- all notifications --}}
                                <li class="nav-item">
                                    <a class="nav-link @if (empty(request('types'))) active @endif" href="{{ route('fresns.notification.index') }}">
                                        {{ fs_config('channel_notifications_all_name') }}
                                        @if (fs_user_overview('unreadNotifications.all') > 0)
                                            <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.all') }}</span>
                                        @endif
                                    </a>
                                </li>

                                {{-- system notifications --}}
                                @if (in_array('systems', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 1) active @endif" href="{{ route('fresns.notification.index', ['types' => 1]) }}">
                                            {{ fs_config('channel_notifications_systems_name') }}
                                            @if (fs_user_overview('unreadNotifications.systems') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.systems') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- recommend notifications --}}
                                @if (in_array('recommends', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 2) active @endif" href="{{ route('fresns.notification.index', ['types' => 2]) }}">
                                            {{ fs_config('channel_notifications_recommends_name') }}
                                            @if (fs_user_overview('unreadNotifications.recommends') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.recommends') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- like notifications --}}
                                @if (in_array('likes', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 3) active @endif" href="{{ route('fresns.notification.index', ['types' => 3]) }}">
                                            {{ fs_config('channel_notifications_likes_name') }}
                                            @if (fs_user_overview('unreadNotifications.likes') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.likes') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- dislike notifications --}}
                                @if (in_array('dislikes', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 4) active @endif" href="{{ route('fresns.notification.index', ['types' => 4]) }}">
                                            {{ fs_config('channel_notifications_dislikes_name') }}
                                            @if (fs_user_overview('unreadNotifications.dislikes') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.dislikes') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- follow notifications --}}
                                @if (in_array('follows', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 5) active @endif" href="{{ route('fresns.notification.index', ['types' => 5]) }}">
                                            {{ fs_config('channel_notifications_follows_name') }}
                                            @if (fs_user_overview('unreadNotifications.follows') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.follows') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- block notifications --}}
                                @if (in_array('blocks', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 6) active @endif" href="{{ route('fresns.notification.index', ['types' => 6]) }}">
                                            {{ fs_config('channel_notifications_blocks_name') }}
                                            @if (fs_user_overview('unreadNotifications.blocks') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.blocks') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- mention notifications --}}
                                @if (in_array('mentions', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 7) active @endif" href="{{ route('fresns.notification.index', ['types' => 7]) }}">
                                            {{ fs_config('channel_notifications_mentions_name') }}
                                            @if (fs_user_overview('unreadNotifications.mentions') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.mentions') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- comment notifications --}}
                                @if (in_array('comments', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 8) active @endif" href="{{ route('fresns.notification.index', ['types' => 8]) }}">
                                            {{ fs_config('channel_notifications_comments_name') }}
                                            @if (fs_user_overview('unreadNotifications.comments') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.comments') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- quote notifications --}}
                                @if (in_array('quotes', fs_config('webframe_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if (request('types') == 9) active @endif" href="{{ route('fresns.notification.index', ['types' => 9]) }}">
                                            {{ fs_config('channel_notifications_quotes_name') }}
                                            @if (fs_user_overview('unreadNotifications.quotes') > 0)
                                                <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.quotes') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    {{-- List of notices --}}
                    <div class="card-body">
                        @if ($notifications->isEmpty())
                            {{-- No Notification --}}
                            <div class="text-center my-5 text-muted fs-7">
                                <i class="bi bi-chat-square"></i> {{ fs_lang('listEmpty') }}
                            </div>
                        @else
                            {{-- Read Button --}}
                            @if (request('types'))
                                <div class="border-bottom text-center py-3">
                                    <form class="api-request-form" action="{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/notification/read-status']) }}" method="patch">
                                        <input type="hidden" name="type" value="all"/>
                                        <input type="hidden" name="notificationType" value="{{ request('types') }}"/>
                                        <input type="hidden" name="notificationIds" value=""/>
                                        <button class="btn btn-success btn-sm" type="submit">{{ fs_lang('notificationMarkAllAsRead') }}</button>
                                    </form>
                                </div>
                            @endif

                            {{-- Notification List --}}
                            <ul class="list-group list-group-flush border-bottom" id="notifications">
                                @foreach($notifications as $notification)
                                    @component('components.messages.notification', compact('notification'))@endcomponent
                                @endforeach
                            </ul>

                            {{-- Notification List-Pagination --}}
                            <div class="my-3 table-responsive">
                                {{ $notifications->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#notifications > li').click(function (event) {
                event.preventDefault();

                const id = $(this).data('id');
                const type = $(this).data('type');
                const status = $(this).data('status');

                let targetUrl = $(event.target).attr('href');
                let tagName = $(event.target).prop('tagName');
                if (tagName == 'IMG' || tagName == 'DIV') {
                    tagName = 'A';
                    targetUrl = $(event.target).parent().attr('href');
                }

                console.log(id, type, targetUrl, tagName);

                if (status) {
                    if(targetUrl) {
                        window.location.href = targetUrl;
                    }
                    return;
                }

                $.ajax({
                    url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/notification/read-status']) }}",
                    type: "PATCH",
                    data: {
                        type: "choose",
                        notificationType: type,
                        notificationIds: id
                    },
                    success: (resp) => {
                        if (resp.code != 0) {
                            tips(resp.message, resp.code);
                        }

                        if (targetUrl) {
                            window.location.href = targetUrl;
                        }

                        $(this).find('#badge-' + id).remove();
                    },
                });
            });
        });
    </script>
@endpush
