@extends('commons.fresns')

@section('title', fs_config('channel_notifications_name'))

@section('content')
    <div class="d-flex justify-content-between mx-3 mt-3">
        <h1 class="fs-5">{{ fs_config('channel_notifications_name') }}</h1>

        {{-- all notifications --}}
        <a class="nav-link rounded-pill px-3 pt-1" style="@empty($types) background-color: var(--bs-orange);color: #FFF; @endempty" href="{{ route('fresns.notification.index') }}">
            {{ fs_config('channel_notifications_all_name') }}
        </a>
    </div>

    {{-- Menus --}}
    <nav class="nav nav-pills nav-fill nav-justified gap-2 p-1 small bg-white border rounded-pill shadow-sm m-3">
        {{-- system notifications --}}
        @if (in_array('systems', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 1) active @endif" href="{{ route('fresns.notification.index', ['types' => 1]) }}">
                {{ fs_config('channel_notifications_systems_name') }}
                @if (fs_user_overview('unreadNotifications.systems') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.systems') }}</span>
                @endif
            </a>
        @endif

        {{-- recommend notifications --}}
        @if (in_array('recommends', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 2) active @endif" href="{{ route('fresns.notification.index', ['types' => 2]) }}">
                {{ fs_config('channel_notifications_recommends_name') }}
                @if (fs_user_overview('unreadNotifications.recommends') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.recommends') }}</span>
                @endif
            </a>
        @endif

        {{-- like notifications --}}
        @if (in_array('likes', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 3) active @endif" href="{{ route('fresns.notification.index', ['types' => 3]) }}">
                {{ fs_config('channel_notifications_likes_name') }}
                @if (fs_user_overview('unreadNotifications.likes') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.likes') }}</span>
                @endif
            </a>
        @endif

        {{-- dislike notifications --}}
        @if (in_array('dislikes', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 4) active @endif" href="{{ route('fresns.notification.index', ['types' => 4]) }}">
                {{ fs_config('channel_notifications_dislikes_name') }}
                @if (fs_user_overview('unreadNotifications.dislikes') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.dislikes') }}</span>
                @endif
            </a>
        @endif

        {{-- follow notifications --}}
        @if (in_array('follows', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 5) active @endif" href="{{ route('fresns.notification.index', ['types' => 5]) }}">
                {{ fs_config('channel_notifications_follows_name') }}
                @if (fs_user_overview('unreadNotifications.follows') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.follows') }}</span>
                @endif
            </a>
        @endif

        {{-- block notifications --}}
        @if (in_array('blocks', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 6) active @endif" href="{{ route('fresns.notification.index', ['types' => 6]) }}">
                {{ fs_config('channel_notifications_blocks_name') }}
                @if (fs_user_overview('unreadNotifications.blocks') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.blocks') }}</span>
                @endif
            </a>
        @endif

        {{-- mention notifications --}}
        @if (in_array('mentions', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 7) active @endif" href="{{ route('fresns.notification.index', ['types' => 7]) }}">
                {{ fs_config('channel_notifications_mentions_name') }}
                @if (fs_user_overview('unreadNotifications.mentions') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.mentions') }}</span>
                @endif
            </a>
        @endif

        {{-- comment notifications --}}
        @if (in_array('comments', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 8) active @endif" href="{{ route('fresns.notification.index', ['types' => 8]) }}">
                {{ fs_config('channel_notifications_comments_name') }}
                @if (fs_user_overview('unreadNotifications.comments') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.comments') }}</span>
                @endif
            </a>
        @endif

        {{-- quote notifications --}}
        @if (in_array('quotes', fs_config('moments_notifications', [])))
            <a class="nav-link rounded-pill px-2 @if ($types == 9) active @endif" href="{{ route('fresns.notification.index', ['types' => 9]) }}">
                {{ fs_config('channel_notifications_quotes_name') }}
                @if (fs_user_overview('unreadNotifications.quotes') > 0)
                    <span class="badge bg-danger">{{ fs_user_overview('unreadNotifications.quotes') }}</span>
                @endif
            </a>
        @endif
    </nav>

    @if ($notifications->isEmpty())
        {{-- No Notification --}}
        <div class="text-center my-5 text-muted fs-7">
            <i class="fa-regular fa-bell"></i> {{ fs_lang('listEmpty') }}
        </div>
    @else
        {{-- Read Button --}}
        @if ($types)
            <div class="border-bottom text-center py-3">
                <form class="api-request-form" action="{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/notification/read-status']) }}" method="patch">
                    <input type="hidden" name="type" value="all"/>
                    <input type="hidden" name="notificationType" value="{{ $types }}"/>
                    <input type="hidden" name="notificationIds" value=""/>
                    <button class="btn btn-success btn-sm" type="submit">{{ fs_lang('notificationMarkAllAsRead') }}</button>
                </form>
            </div>
        @endif

        {{-- Notification List --}}
        <div class="list-group list-group-flush border-bottom" id="notifications">
            @foreach($notifications as $notification)
                @component('components.message.notification', compact('notification'))@endcomponent
            @endforeach
        </div>
    @endif

    <div class="px-3 me-3 me-lg-0 mt-4 d-lg-flex justify-content-center table-responsive">
        {{ $notifications->links() }}
    </div>
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
