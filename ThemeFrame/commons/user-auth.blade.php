@if (fs_account()->check())
    {{-- After Login: Select User Modal --}}
    <div class="modal fade" id="userAuth" data-bs-backdrop="static" tabindex="-1"  aria-hidden="true" aria-labelledby="userAuthModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ fs_lang('switchUser') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach(fs_account('detail.users') as $item)
                            <div class="col-sm-4 d-flex flex-column align-items-center">
                                <img src="{{ $item['avatar'] }}" loading="lazy" class="auth-avatar rounded-circle">
                                <div class="auth-nickname mt-2">{{ $item['nickname'] }}</div>
                                <div class="text-secondary">{{ '@'.$item['fsid'] }}</div>
                                <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/auth-token']) }}" method="post" class="user-login-form">
                                    @csrf
                                    <input type="hidden" name="uidOrUsername" value="{{ $item['uid'] }}">
                                    @if ($item['hasPin'])
                                        <div class="btn-group my-2">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#userPinLogin" data-uid="{{ $item['uid'] }}" data-nickname="{{ $item['nickname'] }}" onclick="$('#userPinLoginLabel').text($(this).data('nickname'));$('#userPinLogin input[name=uidOrUsername]').val($(this).data('uid'))">
                                                {{ fs_lang('userPinLogin') }}
                                            </button>
                                            @if (fs_config('account_users_service'))
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split btn-sm" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                                            data-title="{{ fs_lang('userPinReset') }}"
                                                            data-url="{{ fs_config('account_users_service') }}"
                                                            data-uid="{{ $item['uid'] }}"
                                                            data-post-message-key="reload">
                                                            {{ fs_lang('userPinReset') }}
                                                        </button>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                    @else
                                        <button type="submit" class="btn btn-outline-secondary btn-sm my-2">{{ fs_lang('select') }}</button>
                                    @endif
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if (fs_user()->guest())
                    <div class="modal-footer">
                        <a class="btn btn-danger" role="button" href="{{ route('fresns.me.logout') }}"><i class="bi bi-power"></i> {{ fs_lang('accountLogout') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- After Login: Select User - Enter Password Modal --}}
    <div class="modal fade" id="userPinLogin" aria-hidden="true" aria-labelledby="userPinLoginLabel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="user-password-auth">
                <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/auth-token']) }}" method="post" class="user-login-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="userPinLoginLabel">
                            @if (count(fs_account('detail.users')) == 1)
                                {{ fs_account('detail.users.0.nickname') }}
                            @else
                                User PIN Login
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-target="#userAuth" data-bs-toggle="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (count(fs_account('detail.users')) == 1)
                            <input type="hidden" name="uidOrUsername" value="{{ fs_account('detail.users.0.uid') }}">
                        @else
                            <input type="hidden" name="uidOrUsername">
                        @endif
                        <div class="input-group">
                            <span class="input-group-text">{{ fs_lang('userPin') }}</span>
                            <input type="password" class="form-control" name="pin" required>
                        </div>
                        <div class="invalid-feedback" style="display: block"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ fs_lang('userEnter') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@push('script')
    @if (fs_account()->check() && fs_user()->guest())
        <script>
            $(function () {
                var userCount = "{{ count(fs_account('detail.users')) }}";

                switch (Number(userCount)) {
                    default:
                        new bootstrap.Modal('#userAuth').show();
                    break;
                    case 1:
                        var hasPin = "{{ fs_account('detail.users.0.hasPin') }}" || true;
                        if (hasPin == "true") {
                            new bootstrap.Modal('#userPinLogin').show()
                        } else {
                            $("#uid-{{ fs_account('detail.users.0.uid') }} button").click()
                        }
                    break;
                }
            })
        </script>
    @endif
@endpush
