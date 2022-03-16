@extends('layouts.app')
@section('title')
    Edit Akun
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Account Controller</h1>
        </center>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $user->name }}" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="is_admin" class="col-md-4 col-form-label text-md-end">Status</label>
                    <div class="col-md-6">
                        <select name='is_admin' class="form-select">
                            @if ($user->is_admin == 1)
                                <option value='1' selected>Admin</option>
                                <option value='2'>SPV</option>
                                <option value='0'>User</option>
                            @elseif ($user->is_admin == 2)
                                <option value='1'>Admin</option>
                                <option value='2' selected>SPV</option>
                                <option value='0'>User</option>
                            @else
                                <option value='1'>Admin</option>
                                <option value='2'>SPV</option>
                                <option value='0' selected>User</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
