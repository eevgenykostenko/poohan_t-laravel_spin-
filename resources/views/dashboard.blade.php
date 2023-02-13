@extends('layouts.admin')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex">
                        <div>
                            <h3>{{ $vouchers_count }}</h3>
                            <p>Number of Vouchers</p>
                        </div>
                        <div class="badge">
                            <h3 class="text-primary">
                                <i class="fas fa-ticket-alt"></i>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <div>
                            <h3>{{ $users_count }}</h3>
                            <p>Number of Members</p>
                        </div>
                        <div class="badge">
                            <h3 class="text-primary">
                                <i class="fas fa-users"></i>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br/>

    <div class="card">
        <h5 class="card-header">Transactions Today</h5>
        <div class="card-body">
            <table class="dataTable table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Voucher Code</th>
                    <th>Reward</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($today_transactions as $transaction)
                    <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $transaction->username  }}</td>
                        <td>{{ $transaction->voucher_code  }}</td>
                        <td>{{ $transaction->reward_name  }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
