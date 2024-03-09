@extends('commons.fresns')

@section('title', fs_config('channel_me_settings_name'))

@section('content')
    <div class="d-flex mx-3">
        <span class="me-2" style="margin-top:11px;">
            <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
        </span>
        <h1 class="fs-5 my-3">{{ fs_config('channel_me_settings_name') }}</h1>
    </div>

    {{-- Recall Delete --}}
    @if (fs_account('detail.waitDelete'))
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">{{ fs_lang('accountWaitDelete') }}</h4>
            <p>{{ fs_lang('executionDate') }}: {{ fs_account('detail.waitDeleteDateTime') }}</p>
            <hr>
            <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ fs_lang('accountRecallDelete') }}"
                data-url="{{ fs_config('account_center_service') }}"
                data-post-message-key="reload">
                {{ fs_lang('accountRecallDelete') }}
            </button>
        </div>
    @endif

    <div class="mx-3">
        {{-- Avatar --}}
        <div class="input-group mb-3">
            <div class="position-relative m-auto">
                <img src="{{ fs_user('detail.avatar') }}" loading="lazy" class="rounded-circle" style="width:8rem;height:8rem;">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <label class="btn btn-light" type="button" for="uploadAvatar"><i class="fa-solid fa-camera"></i></label>
                    <input hidden="hidden" type="file" name="uploadAvatar" id="uploadAvatar" accept="{{ fs_post_editor('image.inputAccept') }}" data-user-fsid="{{ fs_user('detail.uid') }}" data-upload-action="{{ route('fresns.api.post', ['path' => '/api/fresns/common/v1/file/uploads']) }}">
                </div>
            </div>
        </div>
        {{-- User Number --}}
        {{-- <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_config('user_uid_name') }}</span>
            <span class="form-control">{{ fs_user('detail.uid') }}</span>
        </div> --}}
        {{-- Username --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_config('user_username_name') }}</span>
            <span class="form-control" id="input-username">{{ fs_user('detail.username') }}</span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_config('user_username_name') }}"
                data-desc="{{ fs_lang('settingIntervalDays') }}: {{ fs_config('username_edit') }} {{ fs_lang('modifierDays') }} | {{ fs_lang('settingLastTime') }}: {{ fs_user('detail.lastEditUsernameDateTime') }}<br>{{ fs_lang('modifierLength') }}: {{ fs_config('username_min') }} - {{ fs_config('username_max') }}<br>{{ fs_lang('settingNameWarning') }}"
                data-name="username"
                data-value="{{ fs_user('detail.username') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">{{ fs_lang('modify') }}</button>
        </div>
        {{-- Nickname --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_config('user_nickname_name') }}</span>
            <span class="form-control" id="input-nickname">{{ fs_user('detail.nickname') }}</span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_config('user_nickname_name') }}"
                data-desc="{{ fs_lang('settingIntervalDays') }}: {{ fs_config('nickname_edit') }} {{ fs_lang('modifierDays') }} | {{ fs_lang('settingLastTime') }}: {{ fs_user('detail.lastEditNicknameDateTime') }}"
                data-name="nickname"
                data-value="{{ fs_user('detail.nickname') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">{{ fs_lang('modify') }}</button>
        </div>
        {{-- Bio --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_config('user_bio_name') }}</span>
            <span class="form-control" id="textarea-bio">{{ fs_user('detail.bio') }}</span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_config('user_bio_name') }}"
                data-type="textarea"
                @if (fs_config('bio_support_mention') || fs_config('bio_support_hashtag'))
                    data-input-tips="editor-content"
                @endif
                data-name="bio"
                data-value="{{ fs_user('detail.bio') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">{{ fs_lang('modify') }}</button>
        </div>
        {{-- Gender --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_lang('userGender') }}</span>
            <span class="form-control" id="select-gender">
                @switch(fs_user('detail.gender'))
                    @case(1)
                        {{ fs_lang('settingGenderNull') }}
                    @break

                    @case(2)
                        {{ fs_lang('settingGenderMale') }}
                    @break

                    @case(3)
                        {{ fs_lang('settingGenderFemale') }}
                    @break

                    @case(4)
                        {{ fs_lang('settingGenderCustom') }}
                    @break
                @endswitch
            </span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_lang('userGender') }}"
                data-type="select"
                data-option='[{"id":1,"text":"{{ fs_lang('settingGenderNull') }}"},{"id":2,"text":"{{ fs_lang('settingGenderMale') }}"},{"id":3,"text":"{{ fs_lang('settingGenderFemale') }}"}]'
                data-name="gender"
                data-value="{{ fs_user('detail.gender') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">{{ fs_lang('modify') }}</button>
        </div>
        {{-- Birthday --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_lang('userBirthday') }}</span>
            <span class="form-control" id="input-birthday">{{ date(fs_config('current_language_menu')['dateFormat'], strtotime(fs_user('detail.birthday'))) }}</span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_lang('userBirthday') }}"
                data-type="date"
                data-name="birthday"
                data-value="{{ date(fs_config('current_language_menu')['dateFormat'], strtotime(fs_user('detail.birthday'))) }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">{{ fs_lang('modify') }}</button>
        </div>
        {{-- Conversation --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_config('channel_conversations_name') }}</span>
            <span class="form-control" id="select-conversationPolicy">
                @switch(fs_user('detail.conversationPolicy'))
                    @case(1)
                        {{ fs_lang('optionEveryone') }}
                    @break

                    @case(2)
                        {{ fs_lang('optionPeopleYouFollow') }}
                    @break

                    @case(3)
                        {{ fs_lang('optionPeopleYouFollowOrVerified') }}
                    @break

                    @case(4)
                        {{ fs_lang('optionNoOneIsAllowed') }}
                    @break
                @endswitch
            </span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_config('channel_conversations_name') }}"
                data-type="select"
                data-option='[{"id":1,"text":"{{ fs_lang('optionEveryone') }}"},{"id":2,"text":"{{ fs_lang('optionPeopleYouFollow') }}"},{"id":3,"text":"{{ fs_lang('optionPeopleYouFollowOrVerified') }}"},{"id":4,"text":"{{ fs_lang('optionNoOneIsAllowed') }}"}]'
                data-name="conversationPolicy"
                data-value="{{ fs_user('detail.conversationPolicy') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">
                {{ fs_lang('modify') }}
            </button>
        </div>
        {{-- Comment --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_config('comment_name') }}</span>
            <span class="form-control" id="select-commentPolicy">
                @switch(fs_user('detail.commentPolicy'))
                    @case(1)
                        {{ fs_lang('optionEveryone') }}
                    @break

                    @case(2)
                        {{ fs_lang('optionPeopleYouFollow') }}
                    @break

                    @case(3)
                        {{ fs_lang('optionPeopleYouFollowOrVerified') }}
                    @break

                    @case(4)
                        {{ fs_lang('optionNoOneIsAllowed') }}
                    @break
                @endswitch
            </span>
            <button class="btn btn-outline-secondary"
                data-label="{{ fs_config('comment_name') }}"
                data-type="select"
                data-option='[{"id":1,"text":"{{ fs_lang('optionEveryone') }}"},{"id":2,"text":"{{ fs_lang('optionPeopleYouFollow') }}"},{"id":3,"text":"{{ fs_lang('optionPeopleYouFollowOrVerified') }}"},{"id":4,"text":"{{ fs_lang('optionNoOneIsAllowed') }}"}]'
                data-name="commentPolicy"
                data-value="{{ fs_user('detail.commentPolicy') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#editModal">
                {{ fs_lang('modify') }}
            </button>
        </div>
        {{-- Profiles --}}
        @foreach(fs_user_overview('profiles') as $profile)
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <img src="{{ $profile['icon'] }}" loading="lazy" class="rounded me-2" height="24">
                    {{ $profile['name'] }}
                </span>
                <span class="form-control"></span>
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ $profile['name'] }}"
                    data-url="{{ $profile['url'] }}"
                    data-post-message-key="fresnsProfileExtension">
                    {{ fs_lang('setting') }}
                </button>
            </div>
        @endforeach
        {{-- Account ID --}}
        {{-- <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_lang('account') }} ID</span>
            <span class="form-control">{{ fs_account('detail.aid') }}</span>
        </div> --}}
        {{-- Account KYC --}}
        @if (fs_config('account_kyc_service'))
            <div class="input-group mb-3">
                <span class="input-group-text">{{ fs_lang('accountKyc') }}</span>
                <span class="form-control">{{ fs_account('detail.verifyStatus') ? fs_lang('success') : fs_lang('settingNot') }}</span>
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ fs_lang('accountKyc') }}"
                    data-url="{{ fs_config('account_kyc_service') }}"
                    data-post-message-key="fresnsAccountKYC">
                    {{ fs_lang('accountKyc') }}
                </button>
            </div>
        @endif
        {{-- Account Center --}}
        <div class="input-group mb-3">
            <span class="input-group-text">{{ fs_lang('settingAccount') }}</span>
            <span class="form-control"></span>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                data-title="{{ fs_lang('accountCenter') }}"
                data-url="{{ fs_config('account_center_service') }}"
                data-post-message-key="reload">
                {{ fs_lang('setting') }}
            </button>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade user-edit" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="api-request-form" action="{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/user/profile']) }}" method="patch" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">{{ fs_lang('errorUnavailable') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center my-4"><a class="btn btn-outline-primary btn-sm" href="javascript:location.reload();" role="button">{{ fs_lang('refresh') }}</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ fs_lang('close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ fs_lang('confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
