@extends('commons.fresns')

@section('title', fs_lang('userExtcreditsRecords'))

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('me.sidebar')
            </div>

            {{-- Account Main --}}
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        {{ fs_lang('userExtcreditsRecords') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle text-nowrap">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordName') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordType') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordAmount') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordOpeningAmount') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordClosingAmount') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordApp') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordRemark') }}</th>
                                    <th scope="col">{{ fs_lang('userExtcreditsRecordTime') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">{{ $record['name'] }}</th>
                                        <td>{{ $record['type'] }}</td>
                                        <td>{{ $record['type'] == 'increment' ? '+' : '-' }}{{ $record['amount'] }}</td>
                                        <td>{{ $record['openingAmount'] }}</td>
                                        <td>{{ $record['closingAmount'] }}</td>
                                        <td>{{ $record['fskey'] }}</td>
                                        <td>{{ $record['remark'] }}</td>
                                        <td>
                                            <time class="text-secondary" datetime="{{ $record['datetime'] }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $record['datetime'] }}">
                                                {{ $record['timeAgo'] }}
                                            </time>
                                        </td>
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
