@extends('layouts.admin')

@section('admin_content')
    <div class="row">
        <div class="col-lg-6">
        <div class="card">
            <h5 class="card-header">Voucher</h5>
            <div class="card-body">
                <form action="{{ route('vouchers.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="expire_datetime" class="form-label">Expired Date(24-hour format)</label>
                        <input type="datetime-local" name="expire_datetime" id="expire_datetime" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Create</button>
                </form>

            </div>
        </div>

        </div>
    </div>
@endsection
