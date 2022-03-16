@extends('layouts.app')
@section('title')
    Edit Outlet
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Outlet Controller</h1>
        </center>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div>
            <form action="{{ route('outlets.update', $outlets[0]->outlets_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nm_outlet" class="col-md-4 col-form-label text-md-end">Nama Outlet</label>
                    <div class="col-md-6">
                        <input id="nm_outlet" type="text" class="form-control @error('nm_outlet') is-invalid @enderror"
                            name="nm_outlet" value="{{ $outlets[0]->nm_outlet }}" required autocomplete="nm_outlet" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="detail" class="col-md-4 col-form-label text-md-end">
                        Detail Outlet
                    </label>
                    <div class="col-md-6">
                        <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror"
                            name="detail" value="{{ $outlet->detail }}" required autocomplete="detail" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="gmbr_outlet" class="col-md-4 col-form-label text-md-end">
                        Gambar Outlet
                    </label>
                    <div class="col-md-6">
                        <input type="file" name="gmbr_outlet" id="gmbr_outlet" class="form-control" placeholder="image"
                            required>
                        <img class="my-3" src="/image/{{ $outlet->gmbr_outlet }}" width="300px">
                    </div>
                </div>

                <div class="row mb-3">
                    <center>
                        <p>**Semua kolom wajib diisi**</p>
                        <p>**ukuran maksimal gambar 1mb**</p>
                    </center>
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
