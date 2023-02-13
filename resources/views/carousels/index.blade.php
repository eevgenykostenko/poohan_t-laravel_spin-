@extends('layouts.admin')

@section('admin_content')
    <div class="card">
        <div class="d-flex card-header">
            <h5>Carousel List</h5>
            <a class="btn btn-primary btn-sm ms-auto" href="{{ route('carousels.create') }}">Add</a>
        </div>
        <div class="card-body">
            <table id="example" class="dataTable table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($carousels as $carousel)
                    <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td><img src="{{ asset("carousels/$carousel->img_path") }}" width="40" height="40" alt=""/></td>
                        <td>
                            <button type="button" class="delete-carousel btn btn-danger btn-sm"
                                    data-carousel-id="{{$carousel->id}}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @csrf

@endsection

@section('page_script')
    @parent

    <script>
        $(function () {
            $(document).on('click', '.delete-carousel', function () {
                const carouselId = $(this).data('carousel-id');
                $.ajax({
                    type: "DELETE",
                    url: `carousels/${carouselId}`,
                    data: {
                        "id": carouselId,
                        "_token": $('input[name=_token]').val(),
                    },
                    dataType: "JSON",
                    success: function (msg) {
                        swal(msg.status).then(() => {
                            location.reload()
                        })
                    }
                });
            })
        })
    </script>
@endsection

