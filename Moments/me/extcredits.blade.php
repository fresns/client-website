@extends('commons.fresns')

@section('title', fs_lang('userExtcreditsRecords'))

@section('content')
    <div class="card rounded-0">
        <div class="card-header">
            @desktop
                <span class="me-2">
                    <a class="btn btn-outline-secondary border-0 rounded-circle" href="javascript:goBack()" role="button"><i class="fa-solid fa-arrow-left"></i></a>
                </span>
            @enddesktop

            {{ fs_lang('userExtcreditsRecords') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">{{ fs_lang('userExtcreditsRecordName') }}</th>
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
                                <td title="{{ $record['type'] }}">{{ $record['type'] == 'increment' ? '+' : '-' }}{{ $record['amount'] }}</td>
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
            </div>

            <div class="my-3 table-responsive">
                {{ $records->links() }}
            </div>
        </div>
    </div>
@endsection
