@extends('layouts.app')
@section('page_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css"/>
@endsection

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Bocor88</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('edit-profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout&nbsp;<i class="fas fa-sign-out-alt"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <section class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark" id="sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="{{ route('dashboard')  }}" class="nav-link px-0 align-middle text-secondary">
                                <i class="fas fa-tachometer-alt"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{ route('rewards')  }}" class="nav-link px-0 align-middle text-secondary">
                                <i class="fas fa-gifts"></i><span class="ms-1 d-none d-sm-inline">Rewards</span></a>
                        </li>
                        <!--
                        <li>
                            <a href="" class="nav-link px-0 align-middle text-secondary">
                                <span class="ms-1">Vouchers</span></a>
                        </li>
                        <li>
                            <a href="" class="nav-link px-0 align-middle"><span class="ms-1">Transactions</span></a>
                        </li>
                        <li>
                            <a href="" class="nav-link px-0 align-middle"><span class="ms-1">Clear DB</span></a>
                        </li>
                        -->
                    </ul>
                </div>
            </section>
            <div class="col py-3">
                @yield('admin_content')
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script>$('.dataTable').DataTable();</script>
@endsection
