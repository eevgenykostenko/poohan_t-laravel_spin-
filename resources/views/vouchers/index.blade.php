@extends('layouts.admin')

@section('admin_content')
    <div class="card">
        <div class="d-flex card-header">
            <h5>Voucher List</h5>
            <a class="btn btn-primary btn-sm ms-auto" href="{{ route('vouchers.create') }}">Add</a>
        </div>
        <div class="card-body">
            <table id="example" class="dataTable table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Voucher Code</th>
                    <th>Status</th>
                    <th>Expire Datetime</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vouchers as $voucher)
                    <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $voucher->username  }}</td>
                        <td>{{ $voucher->code  }}</td>
                        <td>{{ $voucher->status === 0 ? "available" : "assigned"  }}</td>
                        <td>{{ $voucher->expire_datetime  }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

