<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
          integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @yield('page_style')
    <title>Spinner</title>
</head>
<body>
@yield('content')
<script type="text/javascript" src="{{ asset('js/jquery-3.6.3.min.js')  }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js')  }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($errors->any())
    <script>
        swal(`@foreach ($errors->all() as $error)
        {{ $error }} \n
            @endforeach`);
    </script>
@endif
@if (session('status'))
    <script>
        swal(`{{ session('status') }}`)
    </script>
@endif
@yield('page_script')
</body>
</html>
