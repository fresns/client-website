@extends('ThemeFunctions::layout')

@section('body')
    <header class="border-bottom mb-3 pt-5 ps-5 pb-3">
        <h3>{{ $lang['name'] }}</h3>
        <p class="text-secondary"><i class="bi bi-palette"></i> {{ $lang['description'] }}</p>
    </header>

    <main class="my-5">
        <form action="{{ route('fresns.api.functions', ['fskey' => 'Moments']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- Loading dynamic effects --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['loadingConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="moments_loading" id="loading_true" value="true" {{ $params['moments_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="moments_loading" id="loading_false" value="false" {{ ! $params['moments_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- Quick publish post --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['quickPublishConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="moments_quick_publish" id="quick_publish_true" value="true" {{ $params['moments_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="moments_quick_publish" id="quick_publish_false" value="false" {{ ! $params['moments_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- Content markdown config --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['contentMarkdownConfig'] }}</label>
                <div class="col-lg-10 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="option_quick_publish" name="moments_editor_markdown[quickPublish]" value="1" {{ ($params['moments_editor_markdown']['quickPublish'] ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="option_quick_publish">{{ $lang['option_quick_publish'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="option_editor" name="moments_editor_markdown[editor]" value="1" {{ ($params['moments_editor_markdown']['editor'] ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="option_editor">{{ $lang['option_editor'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="option_comment_box" name="moments_editor_markdown[commentBox]" value="1" {{ ($params['moments_editor_markdown']['commentBox'] ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="option_comment_box">{{ $lang['option_comment_box'] }}</label>
                    </div>
                </div>
            </div>

            {{-- Is the message page displayed --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['notificationConfig'] }}</label>
                <div class="col-lg-10 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_systems" name="moments_notifications[]" value="systems" {{ in_array('systems', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_systems">{{ $lang['notification_systems'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_recommends" name="moments_notifications[]" value="recommends" {{ in_array('recommends', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_recommends">{{ $lang['notification_recommends'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_likes" name="moments_notifications[]" value="likes" {{ in_array('likes', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_likes">{{ $lang['notification_likes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_dislikes" name="moments_notifications[]" value="dislikes" {{ in_array('dislikes', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_dislikes">{{ $lang['notification_dislikes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_follows" name="moments_notifications[]" value="follows" {{ in_array('follows', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_follows">{{ $lang['notification_follows'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_blocks" name="moments_notifications[]" value="blocks" {{ in_array('blocks', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_blocks">{{ $lang['notification_blocks'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_mentions" name="moments_notifications[]" value="mentions" {{ in_array('mentions', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_mentions">{{ $lang['notification_mentions'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_comments" name="moments_notifications[]" value="comments" {{ in_array('comments', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_comments">{{ $lang['notification_comments'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_quotes" name="moments_notifications[]" value="quotes" {{ in_array('quotes', $params['moments_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_quotes">{{ $lang['notification_quotes'] }}</label>
                    </div>
                </div>
            </div>

            {{-- Search Method --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['search_method'] }}</label>
                <div class="col-lg-6">
                    <select class="form-select" name="moments_search_method">
                        <option value="api" {{ $params['moments_search_method'] == 'api' ? 'selected' : '' }}>Fresns API</option>
                        <option value="google" {{ $params['moments_search_method'] == 'google' ? 'selected' : '' }}>Google</option>
                    </select>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">Sidebar Widget</label>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#sidebarModal">{{ __('FsLang::panel.button_edit') }}</button>
                </div>
            </div>

            {{-- Portal --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">Portal Widget</label>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#portalModal">{{ __('FsLang::panel.button_edit') }}</button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ $lang['save'] }}</button></div>
            </div>
        </form>
    </main>

    <footer class="copyright text-center">
        <p class="my-5 text-muted">&copy; <span class="copyright-year"></span> Fresns</p>
    </footer>

    {{-- Sidebar Modal --}}
    <div class="modal fade" id="sidebarModal" tabindex="-1" aria-labelledby="sidebarModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sidebar Widget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'Moments']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-75">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="moments_widget_sidebar[{{ $langMenu['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['moments_widget_sidebar'][$langMenu['langTag']] ?? '' }}</textarea>
                                                    <label for="floatingTextarea2">HTML</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Portal Modal --}}
    <div class="modal fade" id="portalModal" tabindex="-1" aria-labelledby="portalModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Portal Widget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'Moments']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-75">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="moments_widget_portal[{{ $langMenu['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['moments_widget_portal'][$langMenu['langTag']] ?? '' }}</textarea>
                                                    <label for="floatingTextarea2">HTML</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
