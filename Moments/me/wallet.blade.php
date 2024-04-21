@extends('commons.fresns')

@section('title', fs_config('channel_me_wallet_name'))

@section('content')
    <div class="card border-0 hstack p-3">
        @desktop
            <div class="me-2 mt-1">
                <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        @enddesktop
        <div class="fs-5">{{ fs_config('channel_me_wallet_name') }}</div>
        <div class="vr mx-3"></div>
        <div class="">{{ fs_account('detail.wallet.currencyCode') }} {{ fs_account('detail.wallet.balance') }}</div>
        <div class="vr mx-3"></div>
        <div class="btn-group">
            @if (fs_account('items.walletRecharges'))
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('walletRecharge') }}</button>
                <ul class="dropdown-menu">
                    @foreach(fs_account('items.walletRecharges') as $item)
                        <li>
                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-title="{{ $item['name'] }}"
                                data-url="{{ $item['appUrl'] }}"
                                data-aid="{{ fs_account('detail.aid') }}"
                                data-uid="{{ fs_user('detail.uid') }}"
                                data-post-message-key="fresnsWalletRecharge">
                                {{ $item['name'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <button type="button" class="btn btn-primary" disabled>{{ fs_lang('walletRecharge') }}</button>
            @endif
        </div>
        <div class="vr mx-3"></div>
        <div class="btn-group">
            @if (fs_account('items.walletWithdraws'))
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('walletWithdraw') }}</button>
                <ul class="dropdown-menu">
                    @foreach(fs_account('items.walletWithdraws') as $item)
                        <li>
                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-title="{{ $item['name'] }}"
                                data-url="{{ $item['appUrl'] }}"
                                data-aid="{{ fs_account('detail.aid') }}"
                                data-uid="{{ fs_user('detail.uid') }}"
                                data-post-message-key="fresnsWalletWithdraw">
                                {{ $item['name'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <button type="button" class="btn btn-primary" disabled>{{ fs_lang('walletWithdraw') }}</button>
            @endif
        </div>
    </div>

    {{-- Wallet Logs --}}
    <div class="card border-0">
        <div class="card-header">
            {{ fs_lang('walletLogs') }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">{{ fs_lang('walletLogType') }}</th>
                            <th scope="col">{{ fs_lang('walletLogAmountTotal') }}</th>
                            <th scope="col">{{ fs_lang('walletLogAmount') }}</th>
                            <th scope="col">{{ fs_lang('walletLogSystemFee') }}</th>
                            <th scope="col">{{ fs_lang('walletLogOpeningBalance') }}</th>
                            <th scope="col">{{ fs_lang('walletLogClosingBalance') }}</th>
                            <th scope="col">{{ fs_lang('walletLogTime') }}</th>
                            <th scope="col">{{ fs_lang('walletLogRemark') }}</th>
                            <th scope="col">{{ fs_lang('walletLogUser') }}</th>
                            <th scope="col">{{ fs_lang('walletLogState') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <th scope="row">{{ fs_lang("walletLogType{$log['type']}") }}</th>
                                <td>{{ $log['amountTotal'] }}</td>
                                <td>{{ $log['transactionAmount'] }}</td>
                                <td>{{ $log['systemFee'] }}</td>
                                <td>{{ $log['openingBalance'] }}</td>
                                <td>{{ $log['closingBalance'] }}</td>
                                <td>
                                    <time class="text-secondary" datetime="{{ $log['datetime'] }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $log['datetime'] }}">
                                        {{ $log['timeAgo'] }}
                                    </time>
                                </td>
                                <td>{{ $log['remark'] }}</td>
                                <td>
                                    @if ($log['user'])
                                        @if ($log['user']['status'])
                                            <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $log['user']['fsid']]) }}">
                                                <img src="{{ $log['user']['avatar'] }}" loading="lazy" class="rounded-circle" width="24" height="24">
                                                {{ $log['user']['nickname'] }}
                                            </a>
                                        @else
                                            {{-- Deactivate --}}
                                            <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="user-avatar rounded-circle">
                                        @endif
                                    @endif
                                </td>
                                <td>{{ fs_lang("walletLogState{$log['state']}") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-3 table-responsive">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection
