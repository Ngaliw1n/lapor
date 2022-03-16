@extends('layouts.app')
@section('title')
    Edit Perbaikan
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Perbaikan Controller</h1>
        </center>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div>
            <form action="{{ route('perbaikans.update', $perbaikan[0]->id_perbaikan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nm_outlet" class="col-md-4 col-form-label text-md-end">Nama Perbaikan</label>
                    <div class="col-md-6">
                        <input id="nm_perbaikan" type="text" class="form-control @error('nm_perbaikan') is-invalid @enderror"
                            name="nm_perbaikan" value="{{ $perbaikan[0]->nm_perbaikan }}" required autocomplete="nm_perbaikan" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="gmbr_perbaikan" class="col-md-4 col-form-label text-md-end">Gambar Perbaikan</label>
                    <div class="col-md-6">
                        <input type="file" name="gmbr_perbaikan" id="gmbr_perbaikan" class="form-control" placeholder="image">
                        <img class="my-3" src="/image/{{ $perbaikan[0]->gmbr_perbaikan }}" width="300px">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_outlet" class="col-md-4 col-form-label text-md-end">Cabang Outlet</label>
                    <div class="col-md-6">
                        <select id="id_outlet" name="id_outlet" class="form-select">
                            @foreach ($datas2 as $data1)
                                <option value="{{ $data1->id }}">
                                    {{ $data1->nm_outlet }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="tgl" class="col-md-4 col-form-label text-md-end">Tanggal Perbaikan</label>
                    <div class="col-md-6">
                        <input id="tgl" type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl"
                            value="{{ $perbaikan[0]->tgl }}" required autocomplete="tgl" autofocus>
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
