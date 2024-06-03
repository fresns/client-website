{{-- Text Box --}}
@if ($extends['texts'] ?? null)
    <div class="mt-3 clearfix">
        @foreach($extends['texts'] as $text)
            <div class="position-relative">
                <div class="editor-frame-text">
                    {{ $text['content'] }}
                </div>

                {{-- Delete --}}
                <div class="position-absolute top-0 start-0 editor-btn-delete">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_lang('delete') }}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- Info Box --}}
@if ($extends['infos'] ?? null)
    <div class="mt-3 clearfix">
        @foreach($extends['infos'] as $info)
            <div class="position-relative">
                <div class="editor-frame-info clearfix editor-info-{{ $info['viewTypeString'] }}">
                    <div class="editor-info-img"><img src="{{ $info['cover'] }}" loading="lazy"></div>
                    <div class="editor-info-body">
                        <div class="editor-info-title" @if ($info['titleColor']) style="color:{{ $info['titleColor'] }};" @endif>{{ $info['title'] }}</div>
                        @if ($info['descPrimary'])
                            <div class="editor-info-desc" @if ($info['descPrimaryColor']) style="color:{{ $info['descPrimaryColor'] }};" @endif>{{ $info['descPrimary'] }}</div>
                        @endif
                        @if ($info['descSecondary'])
                            <div class="editor-info-desc" @if ($info['descSecondaryColor']) style="color:{{ $info['descSecondaryColor'] }};" @endif>{{ $info['descSecondary'] }}</div>
                        @endif
                    </div>
                    @if ($info['buttonName'])
                        <div class="editor-info-btn">
                            <a class="btn btn-info btn-sm text-nowrap disabled" href="#" role="button" @if ($info['buttonColor']) style="background-color:{{ $info['buttonColor'] }};border-color:{{ $info['buttonColor'] }};" @endif>{{ $info['buttonName'] }}</a>
                        </div>
                    @endif
                </div>

                {{-- Delete --}}
                <div class="position-absolute top-0 start-0 editor-btn-delete">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ fs_lang('delete') }}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endif
