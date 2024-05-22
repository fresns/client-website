@extends('commons.fresns')

@section('title', fs_config('channel_me_wallet_name'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            {{-- Account Main --}}
            <div class="col-sm-9">
                <div class="card hstack p-3 mb-3">
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
                <div class="card">
                    <div class="card-header">
                        {{ fs_lang('walletRecords') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle text-nowrap">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">{{ fs_lang('walletRecordType') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordAmountTotal') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordAmount') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordSystemFee') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordOpeningBalance') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordClosingBalance') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordTime') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordRemark') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordUser') }}</th>
                                    <th scope="col">{{ fs_lang('walletRecordState') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">{{ fs_lang("walletRecordType{$record['type']}") }}</th>
                                        <td>{{ $record['amountTotal'] }}</td>
                                        <td>{{ $record['transactionAmount'] }}</td>
                                        <td>{{ $record['systemFee'] }}</td>
                                        <td>{{ $record['openingBalance'] }}</td>
                                        <td>{{ $record['closingBalance'] }}</td>
                                        <td>
                                            <time class="text-secondary" datetime="{{ $record['datetime'] }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $record['datetime'] }}">
                                                {{ $record['timeAgo'] }}
                                            </time>
                                        </td>
                                        <td>{{ $record['remark'] }}</td>
                                        <td>
                                            @if ($record['user'])
                                                @if ($record['user']['status'])
                                                    <a href="{{ route('fresns.profile.index', ['uidOrUsername' => $record['user']['fsid']]) }}">
                                                        <img src="{{ $record['user']['avatar'] }}" loading="lazy" class="rounded-circle" width="24" height="24">
                                                        {{ $record['user']['nickname'] }}
                                                    </a>
                                                @else
                                                    {{-- Deactivate --}}
                                                    <img src="{{ fs_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="user-avatar rounded-circle">
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ fs_lang("walletRecordState{$record['state']}") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="my-3 table-responsive">
                            {{ $records->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
