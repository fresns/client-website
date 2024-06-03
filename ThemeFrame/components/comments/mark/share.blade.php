<span class="d-none" id="{{ $cid.'-url' }}">{{ $url }}</span>

<ul class="dropdown-menu" aria-labelledby="share">
    <li><span class="dropdown-item-text fw-bolder">{{ fs_lang('share') }}:</span></li>
    <li><a class="dropdown-item py-2" href="#" onclick="copyToClipboard('#{{ $cid.'-url' }}')"><i class="bi bi-link-45deg"></i> {{ fs_lang('copyLink') }}</a></li>
</ul>
