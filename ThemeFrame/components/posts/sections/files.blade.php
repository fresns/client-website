{{-- Image --}}
@if ($files['images'])
    @foreach($files['images'] as $image)
        @if (count($files['images']) == 1)
            {{-- One Image --}}
            @if (Route::is('fresns.post.detail'))
                {{-- Detail Style --}}
                <div class="position-relative image-box" style="width:auto;">
                    <img src="{{ $image['imageRatioUrl'] }}" data-fid="{{ $image['fid'] }}" data-zoom-src="{{ $image['imageBigUrl'] }}" loading="lazy" alt="{{ $image['name'] }}" class="img-fluid zoom-image">
                    @if ($image['imageLong'])
                        <span class="position-absolute bottom-0 end-0 badge bg-light text-dark me-3 mb-2">{{ fs_lang('contentImageLong') }}</span>
                    @endif
                </div>
            @else
                {{-- List Style --}}
                @if ($image['imageLong'])
                    <div class="position-relative image-box" style="width:auto;">
                        <img src="{{ $image['imageSquareUrl'] }}" data-fid="{{ $image['fid'] }}" data-zoom-src="{{ $image['imageBigUrl'] }}" loading="lazy" alt="{{ $image['name'] }}" class="img-fluid zoom-image">
                        <span class="position-absolute bottom-0 end-0 badge bg-light text-dark me-3 mb-2">{{ fs_lang('contentImageLong') }}</span>
                    </div>
                @else
                    <div class="position-relative image-box">
                        <img src="{{ $image['imageRatioUrl'] }}" data-fid="{{ $image['fid'] }}" data-zoom-src="{{ $image['imageBigUrl'] }}" loading="lazy" alt="{{ $image['name'] }}" class="img-fluid zoom-image">
                    </div>
                @endif
            @endif
        @else
            {{-- Multiple Images --}}
            <div class="position-relative image-box">
                <img src="{{ $image['imageSquareUrl'] }}" data-fid="{{ $image['fid'] }}" data-zoom-src="{{ $image['imageBigUrl'] }}" loading="lazy" alt="{{ $image['name'] }}" class="img-fluid zoom-image">
                @if ($image['imageLong'])
                    <span class="position-absolute bottom-0 end-0 badge bg-light text-dark me-3 mb-2">{{ fs_lang('contentImageLong') }}</span>
                @endif
            </div>
        @endif
    @endforeach
@endif

{{-- Video --}}
@if ($files['videos'])
    @foreach($files['videos'] as $video)
        <video class="mt-2" controls preload="metadata" controls="true" controlslist="nodownload" poster="{{ $video['videoPosterUrl'] }}" data-fid="{{ $video['fid'] }}">
            <source src="{{ $video['videoUrl'] }}" type="{{ $video['mime'] }}">
            <div class="alert alert-warning my-2" role="alert">Your browser does not support the video element.</div>
        </video>
    @endforeach
@endif

{{-- Audio --}}
@if ($files['audios'])
    @foreach($files['audios'] as $audio)
        <audio class="w-100 py-1 mt-2" src="{{ $audio['audioUrl'] }}" data-fid="{{ $audio['fid'] }}" controls="controls" preload="metadata" controlsList="nodownload" oncontextmenu="return false">
            <div class="alert alert-warning my-2" role="alert">Your browser does not support the audio element.</div>
        </audio>
    @endforeach
@endif

{{-- Document --}}
@if ($files['documents'])
    @foreach($files['documents'] as $document)
        <button type="button" class="btn document-box fresns-file-users" data-fid="{{ $document['fid'] }}" data-bs-toggle="modal" data-bs-target="#downloadModal-{{ $document['fid'] }}">
            <div class="document-icon">
                @if ($document['extension'] == 'doc' || $document['extension'] == 'docx' || $document['extension'] == 'pages')
                    <i class="bi bi-file-earmark-word"></i>
                @elseif ($document['extension'] == 'xls' || $document['extension'] == 'xlsx' || $document['extension'] == 'numbers')
                    <i class="bi bi-file-earmark-excel"></i>
                @elseif ($document['extension'] == 'ppt' || $document['extension'] == 'pptx' || $document['extension'] == 'key' || $document['extension'] == 'pps' || $document['extension'] == 'ppts')
                    <i class="bi bi-file-earmark-ppt"></i>
                @elseif ($document['extension'] == 'csv')
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                @elseif ($document['extension'] == 'pdf')
                    <i class="bi bi-file-earmark-pdf"></i>
                @elseif ($document['extension'] == 'rar' || $document['extension'] == 'zip' || $document['extension'] == '7z' || $document['extension'] == 'tar' || $document['extension'] == 'gz' || $document['extension'] == 'tar.gz')
                    <i class="bi bi-file-earmark-zip"></i>
                @elseif ($document['extension'] == 'epub' || $document['extension'] == 'mobi')
                    <i class="bi bi-book"></i>
                @elseif ($document['extension'] == 'md')
                    <i class="bi bi-markdown"></i>
                @elseif ($document['extension'] == 'txt')
                    <i class="bi bi-file-text"></i>
                @else
                    <i class="bi bi-file-earmark"></i>
                @endif
            </div>
            <div class="document-name text-nowrap overflow-hidden">{{ $document['name'] }}</div>
        </button>

        {{-- Document Modal --}}
        <div class="modal fade" id="downloadModal-{{ $document['fid'] }}" tabindex="-1" aria-labelledby="downloadModalLabel-{{ $document['fid'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="downloadModalLabel-{{ $document['fid'] }}">{{ fs_lang('contentDocumentDetail') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{ fs_lang('contentDocumentInfo') }}</p>
                        <p class="text-center text-info document-icon-fs">
                            @if ($document['extension'] == 'doc' || $document['extension'] == 'docx' || $document['extension'] == 'pages')
                                <i class="bi bi-file-earmark-word"></i>
                            @elseif ($document['extension'] == 'xls' || $document['extension'] == 'xlsx' || $document['extension'] == 'numbers')
                                <i class="bi bi-file-earmark-excel"></i>
                            @elseif ($document['extension'] == 'ppt' || $document['extension'] == 'pptx' || $document['extension'] == 'key' || $document['extension'] == 'pps' || $document['extension'] == 'ppts')
                                <i class="bi bi-file-earmark-ppt"></i>
                            @elseif ($document['extension'] == 'csv')
                                <i class="bi bi-file-earmark-spreadsheet"></i>
                            @elseif ($document['extension'] == 'pdf')
                                <i class="bi bi-file-earmark-pdf"></i>
                            @elseif ($document['extension'] == 'rar' || $document['extension'] == 'zip' || $document['extension'] == '7z' || $document['extension'] == 'tar' || $document['extension'] == 'gz' || $document['extension'] == 'tar.gz')
                                <i class="bi bi-file-earmark-zip"></i>
                            @elseif ($document['extension'] == 'epub' || $document['extension'] == 'mobi')
                                <i class="bi bi-book"></i>
                            @elseif ($document['extension'] == 'md')
                                <i class="bi bi-markdown"></i>
                            @elseif ($document['extension'] == 'txt')
                                <i class="bi bi-file-text"></i>
                            @else
                                <i class="bi bi-file-earmark"></i>
                            @endif
                        </p>
                        <p class="text-center fs-5">{{ $document['name'] }}</p>
                        <p class="text-center text-secondary">
                            {{ fs_lang('contentFileUploader') }}: {{ $author['nickname'] }}
                            <span class="mx-3">{{$document['size']}}</span>
                            {{ $createdDatetime }}
                        </p>
                        <p class="text-center">
                            <button type="button" class="btn btn-outline-success fresns-file-download"
                                data-url="{{ route('fresns.api.get', ['path' => "/api/fresns/v1/common/file/{$document['fid']}/link?type=post&fsid={$pid}"]) }}"
                                data-name="{{ $document['name'] }}"
                                data-mime="{{ $document['mime'] }}">
                                <i class="bi bi-download"></i> {{ fs_lang('download') }}
                            </button>
                        </p>
                    </div>

                    {{-- Downloader --}}
                    <hr class="dropdown-divider">
                    <div class="modal-body">
                        <p class="text-center">{{ fs_lang('contentFileDownloader') }}</p>
                        <div class="d-flex align-content-start flex-wrap file-download-user">
                            <div class="file-user-list">
                            </div>
                            <div class="text-muted ms-2 mt-2 fs-7">{{ fs_lang('contentFileDownloaderDesc') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
