@extends('commons.fresns')

@section('title', $items['title'] ?? $profile['nickname'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $profile['bio'])

@section('content')
    <main class="row justify-content-md-center">
        <div class="col-md-6 card" style="margin-top: 88px">
            <header class="profile-header position-relative text-center">
                @component('components.users.detail', compact('profile', 'followersYouFollow'))@endcomponent

                {{-- Menus --}}
                @if ($items['manages'])
                    <div class="position-absolute top-0 end-0 dropdown">
                        <button class="btn btn-outline-secondary rounded-circle mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></button>
                        <ul class="dropdown-menu">
                            @foreach($items['manages'] as $plugin)
                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal" href="#fresnsModal"
                                        data-title="{{ $plugin['name'] }}"
                                        data-url="{{ $plugin['appUrl'] }}"
                                        data-uid="{{ $profile['uid'] }}"
                                        data-post-message-key="fresnsUserManage">
                                        @if ($plugin['icon'])
                                            <img src="{{ $plugin['icon'] }}" loading="lazy" width="20" height="20">
                                        @endif
                                        {{ $plugin['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </header>

            <div class="card-header" style="margin-left:-0.8rem;margin-right:-0.8rem">
                @include('profile.navbar')
            </div>

            <div class="profile-list">
                @yield('list')
            </div>
        </div>
    </main>
@endsection
