<article class="d-flex my-3">
    @if ($geotag['cover'])
        <section class="flex-shrink-0">
            <img src="{{ $geotag['cover'] }}" loading="lazy" alt="{{ $geotag['name'] }}" class="rounded list-cover">
        </section>
    @endif
    <div class="flex-grow-1 ms-3">
        <header class="d-lg-flex">
            <section class="d-flex">
                <i class="bi bi-geo-alt-fill me-1"></i> {{ $geotag['name'] }}
                <div class="badge-bg-info ms-2">
                    <span class="badge rounded-pill">{{ $geotag['postCount'] }} {{ fs_config('post_name') }}</span>
                    <span class="badge rounded-pill">{{ $geotag['postDigestCount'] }} {{ fs_lang('contentDigest') }}</span>
                </div>
            </section>

            <section class="list-btn ms-auto">
                {{-- Like --}}
                @if ($geotag['interaction']['likeEnabled'])
                    @component('components.geotags.mark.like', [
                        'gtid' => $geotag['gtid'],
                        'interaction' => $geotag['interaction'],
                        'count' => $geotag['likeCount'],
                    ])@endcomponent
                @endif

                {{-- Dislike --}}
                @if ($geotag['interaction']['dislikeEnabled'])
                    @component('components.geotags.mark.dislike', [
                        'gtid' => $geotag['gtid'],
                        'interaction' => $geotag['interaction'],
                        'count' => $geotag['dislikeCount'],
                    ])@endcomponent
                @endif

                {{-- Follow --}}
                @if ($geotag['interaction']['followEnabled'])
                    @component('components.geotags.mark.follow', [
                        'gtid' => $geotag['gtid'],
                        'interaction' => $geotag['interaction'],
                        'count' => $geotag['followCount'],
                    ])@endcomponent
                @endif

                {{-- Block --}}
                @if ($geotag['interaction']['blockEnabled'])
                    @component('components.geotags.mark.block', [
                        'gtid' => $geotag['gtid'],
                        'interaction' => $geotag['interaction'],
                        'count' => $geotag['blockCount'],
                    ])@endcomponent
                @endif
            </section>
        </header>

        @if ($geotag['description'])
            <section class="fs-7 mt-1 text-secondary">{{ $geotag['description'] }}</section>
        @endif

        {{-- interaction --}}
        <section class="fs-7 mt-2">
            @if ($geotag['interaction']['likePublicRecord'])
                <a href="{{ route('fresns.geotag.detail.likers', ['gtid' => $geotag['gtid']]) }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-3">{{ $geotag['interaction']['likeUserTitle'] }}: {{ $geotag['likeCount'] }}</a>
            @endif
            @if ($geotag['interaction']['dislikePublicRecord'])
                <a href="{{ route('fresns.geotag.detail.dislikers', ['gtid' => $geotag['gtid']]) }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-3">{{ $geotag['interaction']['dislikeUserTitle'] }}: {{ $geotag['dislikeCount'] }}</a>
            @endif
            @if ($geotag['interaction']['followPublicRecord'])
                <a href="{{ route('fresns.geotag.detail.followers', ['gtid' => $geotag['gtid']]) }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-3">{{ $geotag['interaction']['followUserTitle'] }}: {{ $geotag['followCount'] }}</a>
            @endif
            @if ($geotag['interaction']['blockPublicRecord'])
                <a href="{{ route('fresns.geotag.detail.blockers', ['gtid' => $geotag['gtid']]) }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ $geotag['interaction']['blockUserTitle'] }}: {{ $geotag['blockCount'] }}</a>
            @endif
        </section>
    </div>
</article>
