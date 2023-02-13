@extends('layouts.admin')

@section('admin_content')
    <div class="card">
        <h5 class="card-header">Setting</h5>
        <div class="card-body">
            <button class="btn btn-warning btn-sm me-auto" id="clearDbBtn">Clear DB</button>
        </div>
    </div>
@endsection

@section('page_script')
    @parent
    <script>
        $(function () {
            $('#clearDbBtn').click(function () {
                swal({
                    title: "Are you sure?",
                    text: "Once cleared, all rewards, vouchers, transactions will be deleted!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        location.href = `{{ route('settings.clear_db') }}`
                    } else {

                    }
                });
            })
        })
    </script>
@endsection
