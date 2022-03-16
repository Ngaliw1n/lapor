@extends('layouts.app')
@section('title')
    Dashboard Admin
@endsection
@section('style')
    <style>
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Dashboard</h1>
        </center>
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div class="align-self-center">
                                <i class="fas fa-user-alt text-info fa-3x"></i>
                            </div>
                            <div class="text-end">
                                <h3>{{ $users }}</h3>
                                <p class="mb-0">
                                    <a href="{{ route('users.index') }}" class="stretched-link">Total User
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div class="align-self-center">
                                <i class="fas fa-user-alt text-info fa-3x"></i>
                            </div>
                            <div class="text-end">
                                <h3>{{ $mesins }}</h3>
                                <p class="mb-0">
                                    <a href="{{ route('mesins.indexAdmin') }}" class="stretched-link">Total Mesin
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div class="align-self-center">
                                <i class="fas fa-user-alt text-info fa-3x"></i>
                            </div>
                            <div class="text-end">
                                <h3>{{ $outlets }}</h3>
                                <p class="mb-0">
                                    <a href="{{ route('outlet.indexAdmin') }}" class="stretched-link">Total Outlets
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <li class="breadcrumb-item active">Selamat Datang</li> --}}
    </div>
@endsection
