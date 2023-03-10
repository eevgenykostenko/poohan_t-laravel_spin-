@extends('layouts.admin')

@section('admin_content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <h5 class="card-header">Edit Profile</h5>
                <div class="card-body">
                    <form action="{{ route('edit-profile') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{Auth::user()->name}}"
                                   disabled//>
                        </div>
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control"/>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
