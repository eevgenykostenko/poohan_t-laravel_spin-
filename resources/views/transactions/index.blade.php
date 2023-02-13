@extends('layouts.admin')

@section('admin_content')
    <div class="card">
        <div class="d-flex card-header">
            <h5>Transaction List</h5>
            <a class="btn btn-primary btn-sm ms-auto" href="{{ route('transactions.create') }}">Add</a>
        </div>
        <div class="card-body">
            <table class="dataTable table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Voucher Code</th>
                    <th>Reward</th>
                    <th>IP</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $transaction->username  }}</td>
                        <td>{{ $transaction->voucher_code  }}</td>
                        <td>{{ $transaction->reward_name  }}</td>
                        <td>{{ $transaction->ip_address  }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

