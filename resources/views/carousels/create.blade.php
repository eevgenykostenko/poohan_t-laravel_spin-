@extends('layouts.admin')

@section('admin_content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <h5 class="card-header">Carousel</h5>
                <div class="card-body">
                    <form action="{{ route('carousels.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image"/>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Create</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
