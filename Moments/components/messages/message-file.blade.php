{{-- Image --}}
@if ($file['type'] == 1)
    <a class="position-relative" data-fancybox="gallery" data-src="{{ $file['imageBigUrl'] }}">
        <img src="{{ $file['imageRatioUrl'] }}" loading="lazy" class="img-fluid" style="max-height:200px">
        @if ($file['imageLong'])
            <span class="position-absolute bottom-0 end-0 badge bg-light text-dark me-3 mb-2">{{ fs_lang('contentImageLong') }}</span>
        @endif
    </a>
@endif

{{-- Video --}}
@if ($file['type'] == 2)
    <video controls preload="metadata" controls="true" controlslist="nodownload" poster="{{ $file['videoPosterUrl'] }}">
        <source src="{{ $file['videoUrl'] }}" type="{{ $file['mime'] }}">
        <span class="alert alert-warning my-2" role="alert">Your browser does not support the video element.</span>
    </video>
@endif

{{-- Audio --}}
@if ($file['type'] == 3)
    <audio src="{{ $file['audioUrl'] }}" controls="controls" preload="metadata" controlsList="nodownload" oncontextmenu="return false">
        <span class="alert alert-warning my-2" role="alert">Your browser does not support the audio element.</span>
    </audio>
@endif

{{-- Document --}}
@if ($file['type'] == 4)
    <a href="{{ route('fresns.api.get', ['path' => "/api/fresns/v1/common/file/{$file['fid']}/link?type=conversation&fsid={$cmid}"]) }}" data-loading="false" data-name="{{ $file['name'] }}" data-mime="{{ $file['mime'] }}" class="btn document-box fresns-file-download" role="button">
        <span class="document-icon">
            @if ($file['extension'] == 'doc' || $file['extension'] == 'docx' || $file['extension'] == 'pages')
                <i class="fa-regular fa-file-word"></i>
            @elseif ($file['extension'] == 'xls' || $file['extension'] == 'xlsx' || $file['extension'] == 'numbers')
                <i class="fa-regular fa-file-excel"></i>
            @elseif ($file['extension'] == 'ppt' || $file['extension'] == 'pptx' || $file['extension'] == 'key' || $file['extension'] == 'pps' || $file['extension'] == 'ppts')
                <i class="fa-regular file-powerpoint"></i>
            @elseif ($file['extension'] == 'csv')
                <i class="fa-solid fa-file-csv"></i>
            @elseif ($file['extension'] == 'pdf')
                <i class="fa-regular fa-file-pdf"></i>
            @elseif ($file['extension'] == 'rar' || $file['extension'] == 'zip' || $file['extension'] == '7z' || $file['extension'] == 'tar' || $file['extension'] == 'gz' || $file['extension'] == 'tar.gz')
                <i class="fa-regular fa-file-zipper"></i>
            @elseif ($file['extension'] == 'epub' || $file['extension'] == 'mobi')
                <i class="fa-solid fa-book"></i>
            @elseif ($file['extension'] == 'md')
                <i class="fa-brands fa-markdown"></i>
            @elseif ($file['extension'] == 'txt')
                <i class="fa-regular fa-file-lines"></i>
            @else
                <i class="fa-regular fa-file"></i>
            @endif
        </span>
        <span class="document-name text-nowrap overflow-hidden mx-3">{{ $file['name'] }}</span>
    </a>
@endif
