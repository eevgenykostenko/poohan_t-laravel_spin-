@extends('layouts.admin')

@section('admin_content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <h5 class="card-header">Transaction</h5>
                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="voucher_code" class="form-label">Voucher</label>
                            <select name="voucher_code" class="form-control">
                                <option disabled selected>Select Voucher</option>
                                @foreach($vouchers as $voucher)
                                    <option value="{{ $voucher->id }}}">{{ $voucher->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
