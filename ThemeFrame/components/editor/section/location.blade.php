@if ($geotag || $locationInfo)
    @php
        $name = $geotag ? $geotag['name'] : $locationInfo['name'];
        $locationInfo = $geotag ? $geotag['mapId'].','.$geotag['latitude'].','.$geotag['longitude'] : $locationInfo['mapId'].','.$locationInfo['latitude'].','.$locationInfo['longitude'];
    @endphp

    <div class="dropup me-auto" id="location-info">
        <button class="btn btn-outline-dark btn-sm" type="button" id="editorLocation" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-geo-alt-fill"></i> {{ $name }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="location">
            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $locationConfig['mapUrl'] ? '' : fs_lang('errorUnavailable') }}">
                <a class="dropdown-item py-2 {{ $locationConfig['mapUrl'] ? '' : 'disabled' }}" role="button" data-bs-toggle="modal" href="#fresnsModal"
                    data-title="{{ fs_lang('editorLocation') }}"
                    data-url="{{ $locationConfig['mapUrl'] }}"
                    data-draft-type="{{ $type }}"
                    data-did="{{ $did }}"
                    data-location-info="{{ $locationInfo }}"
                    data-post-message-key="fresnsEditorLocation">
                    {{ fs_lang('reselect') }}
                </a>
            </li>
            <li><a class="dropdown-item link-danger py-2" role="button" href="#" onclick="deleteLocation(this)">{{ fs_lang('delete') }}</a></li>
        </ul>
    </div>
@else
    @if ($locationConfig['mapUrl'])
        <button class="btn btn-outline-dark btn-sm" type="button" id="location-btn" data-bs-toggle="modal" data-bs-target="#fresnsModal"
            data-title="{{ fs_lang('editorLocation') }}"
            data-url="{{ $locationConfig['mapUrl'] }}"
            data-draft-type="{{ $type }}"
            data-did="{{ $did }}"
            data-location-info=""
            data-post-message-key="fresnsEditorLocation">
            <i class="bi bi-geo-alt-fill"></i> {{ fs_lang('editorLocation') }}
        </button>
    @endif
@endif
