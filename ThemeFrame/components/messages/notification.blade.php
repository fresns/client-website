<li class="list-group-item d-flex justify-content-start align-items-center" data-id="{{ $notification['nmid'] }}" data-type="{{ $notification['type'] }}" data-status="{{ $notification['readStatus'] }}">
    {{-- Read Status --}}
    @if (! $notification['readStatus'])
        <span class="p-1 bg-danger border border-light rounded-circle" id="badge-{{ $notification['nmid'] }}"></span>
    @endif

    {{-- User Avatar --}}
    @if ($notification['actionUser'])
        @if ($notification['actionUser']['status'])
            <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $notification['actionUser']['fsid']]) }}">
                <img src="{{ $notification['actionUser']['avatar'] }}" loading="lazy" class="rounded-circle mx-3" style="width:3.2rem;height:3.2rem;">
            </a>
        @else
            <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" class="conversation-list-avatar rounded-circle">
        @endif
    @else
        <img src="{{ fs_config('site_icon') }}" loading="lazy" class="mx-3" style="width:3.2rem;height:3.2rem;">
    @endif

    <div class="my-2 w-100">
        {{-- User Profile --}}
        @if ($notification['actionUser'])
            <div class="user-info text-nowrap overflow-hidden">
                @if ($notification['actionUser']['status'])
                    <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $notification['actionUser']['fsid']]) }}" class="user-link d-flex">
                        <div class="user-nickname text-nowrap overflow-hidden">{{ $notification['actionUser']['nickname'] }}</div>

                        @if ($notification['actionUser']['verified'])
                            <div class="user-verified">
                                @if ($notification['actionUser']['verifiedIcon'])
                                    <img src="{{ $notification['actionUser']['verifiedIcon'] }}" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $notification['actionUser']['verifiedDesc'] ?? '' }}">
                                @else
                                    <img src="{{ fs_theme('assets') }}images/icon-verified.png" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $notification['actionUser']['verifiedDesc'] ?? '' }}">
                                @endif
                            </div>
                        @endif

                        <div class="user-name text-secondary">{{ '@'.$notification['actionUser']['fsid'] }}</div>
                    </a>
                @else
                    <div class="user-nickname text-nowrap overflow-hidden">{{ fs_lang('userDeactivate') }}</div>
                @endif
            </div>
        @else
            <div class="border-start border-3 border-secondary mb-2">
                <p class="fw-semibold mb-0 ms-2">{{ fs_config('site_name') }}</p>
            </div>
        @endif

        {{-- Content of notice --}}
        <section class="user-secondary d-flex flex-wrap">
            <p class="mb-0 w-100">
                @switch($notification['type'])
                    @case(1)
                        <span class="badge bg-danger me-1">{{ fs_config('channel_notifications_systems_name') }}</span>
                    @break

                    @case(2)
                        <span class="badge bg-danger me-1">{{ fs_config('channel_notifications_recommends_name') }}</span>
                    @break

                    @default

                    @break
                @endswitch

                <span class="badge bg-primary">
                    @switch($notification['type'])
                        @case(3)
                            {{ fs_lang('notificationLiked') }}:
                        @break

                        @case(4)
                            {{ fs_lang('notificationDisliked') }}:
                        @break

                        @case(5)
                            {{ fs_lang('notificationFollowed') }}:
                        @break

                        @case(6)
                            {{ fs_lang('notificationBlocked') }}:
                        @break

                        @case(7)
                            {{ fs_lang('notificationMentioned') }}:
                        @break

                        @case(8)
                            {{ fs_lang('notificationCommented') }}:
                        @break

                        @default

                        @break
                    @endswitch

                    @switch($notification['actionTarget'])
                        @case(1)
                            {{ fs_config('user_name') }}
                        @break

                        @case(2)
                            {{ fs_config('group_name') }}
                        @break

                        @case(3)
                            {{ fs_config('hashtag_name') }}
                        @break

                        @case(4)
                            {{ fs_config('geotag_name') }}
                        @break

                        @case(5)
                            {{ fs_config('post_name') }}
                        @break

                        @case(6)
                            {{ fs_config('comment_name') }}
                        @break

                        @default

                        @break
                    @endswitch

                    @if ($notification['isMention'])
                        ({{ fs_lang('notificationFromContentMentionYou') }})
                    @endif

                    @switch($notification['actionType'])
                        @case(6)
                            : {{ fs_lang('modify') }}
                        @break

                        @case(7)
                            : {{ fs_lang('delete') }}
                        @break

                        @case(8)
                            : {{ fs_lang('setting') }} ({{ fs_lang('contentSticky') }})
                        @break

                        @case(9)
                            : {{ fs_lang('setting') }} ({{ fs_lang('contentDigest') }})
                        @break

                        @case(10)
                            : {{ fs_lang('setting') }}
                        @break

                        @default

                        @break
                    @endswitch
                </span>

                <span class="badge bg-light text-dark fw-normal ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $notification['datetime'] }}">{{ $notification['datetimeFormat'] }}</span>
            </p>

            @if ($notification['content'])
                @if ($notification['contentFsid'])
                    @switch($notification['type'])
                        @case(8)
                            <a href="{{ route('fresns.comment.detail', ['cid' => $notification['contentFsid']]) }}" class="text-decoration-none text-secondary fs-6 mt-2">{{ $notification['content'] }}</a>
                        @break

                        @case(9)
                            <a href="{{ route('fresns.post.detail', ['pid' => $notification['contentFsid']]) }}" class="text-decoration-none text-secondary fs-6 mt-2">{{ $notification['content'] }}</a>
                        @break

                        @default
                            <span class="text-secondary fs-6 mt-2">{{ $notification['content'] }}</span>
                        @break
                    @endswitch
                @else
                    <span class="text-secondary fs-6 mt-2">{{ $notification['content'] }}</span>
                @endif
            @endif
        </section>

        {{-- Content of the trigger notification --}}
        @if ($notification['actionInfo'])
            @switch($notification['actionTarget'])
                @case(2)
                    <div class="content-group mt-2">
                        <a href="{{ route('fresns.group.detail', ['gid' => $notification['actionInfo']['gid']]) }}" class="badge rounded-pill text-decoration-none">
                            @if ($notification['actionInfo']['cover'])
                                <img src="{{ $notification['actionInfo']['cover'] }}" loading="lazy" alt="$notification['actionInfo']['name']" class="rounded">
                            @endif
                            {{ $notification['actionInfo']['name'] }}
                        </a>
                    </div>
                @break

                @case(3)
                    <a href="{{ route('fresns.hashtag.detail', ['htid' => $notification['actionInfo']['htid']]) }}" class="text-decoration-none text-secondary mt-2"><span class="badge text-bg-primary">{{ $notification['actionInfo']['name'] }}</span></a>
                @break

                @case(4)
                    <a href="{{ route('fresns.geotag.detail', ['gtid' => $notification['actionInfo']['gtid']]) }}" class="text-decoration-none text-secondary mt-2"><span class="badge text-bg-primary">{{ $notification['actionInfo']['name'] }}</span></a>
                @break

                @case(5)
                    <section class="comment-post mt-2 position-relative">
                        <div class="d-flex">
                            <div class="flex-shrink-0"><img src="{{ $notification['actionInfo']['author']['avatar'] }}" loading="lazy" class="rounded"></div>
                            <div class="flex-grow-1">{{ $notification['actionInfo']['title'] ?? Str::limit(strip_tags($notification['actionInfo']['content']), 80) }}</div>
                        </div>
                        @if ($notification['actionInfo']['group'])
                            <div class="comment-post-group border-top text-secondary">{{ $notification['actionInfo']['group']['name'] }}</div>
                        @endif
                        <a href="{{ route('fresns.post.detail', ['pid' => $notification['actionInfo']['pid']]) }}" class="text-decoration-none stretched-link"></a>
                    </section>
                @break

                @case(6)
                    <section class="comment-post mt-2 position-relative">
                        <div class="d-flex">
                            <div class="flex-shrink-0"><img src="{{ $notification['actionInfo']['author']['avatar'] }}" loading="lazy" class="rounded"></div>
                            <div class="flex-grow-1">{{ $notification['actionInfo']['title'] ?? Str::limit(strip_tags($notification['actionInfo']['content']), 80) }}</div>
                        </div>
                        <a href="{{ route('fresns.comment.detail', ['cid' => $notification['actionInfo']['cid']]) }}" class="text-decoration-none stretched-link"></a>
                    </section>
                @break

                @default

                @break
            @endswitch
        @endif
    </div>
</li>
