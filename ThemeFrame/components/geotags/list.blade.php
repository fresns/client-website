<article class="d-flex">
    @if ($geotag['cover'])
        <section class="flex-shrink-0">
            <a href="{{ route('fresns.geotag.detail', ['gtid' => $geotag['gtid']]) }}"><img src="{{ $geotag['cover'] }}" loading="lazy" alt="{{ $geotag['name'] }}" class="rounded list-cover"></a>
        </section>
    @endif
    <div class="flex-grow-1 ms-3">
        <header class="d-lg-flex">
            <section class="d-flex">
                <a href="{{ route('fresns.geotag.detail', ['gtid' => $geotag['gtid']]) }}" class="text-nowrap overflow-hidden list-name">{{ $geotag['name'] }}</a>
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
    </div>
</article>
