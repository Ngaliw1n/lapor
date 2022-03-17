@extends('layouts.app')
@section('title')
    Edit Sparepart
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Sparepart Controller</h1>
        </center>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div>
            <form action="{{ route('spareparts.update', $spareparts[0]->id_spareparts) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nm_spareparts" class="col-md-4 col-form-label text-md-end">Nama Sparepart</label>
                    <div class="col-md-6">
                        <input id="nm_spareparts" type="text" class="form-control @error('nm_spareparts') is-invalid @enderror"
                            name="nm_spareparts" value="{{ $spareparts[0]->nm_spareparts }}" required autocomplete="nm_spareparts" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="gmbr_spareparts" class="col-md-4 col-form-label text-md-end">Gambar Sparepart</label>
                    <div class="col-md-6">
                        <input type="file" name="gmbr_spareparts" id="gmbr_spareparts" class="form-control" placeholder="image">
                        <img class="my-3" src="/image/{{ $spareparts[0]->gmbr_spareparts }}" width="300px">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kategori" class="col-md-4 col-form-label text-md-end">Kategori</label>
                    <div class="col-md-6">
                        <input id="kategori" type="text" class="form-control @error('kategori') is-invalid @enderror"
                            name="kategori" value="{{ $spareparts[0]->kategori }}" required autocomplete="kategori" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="spareparts_detail" class="col-md-4 col-form-label text-md-end">Sparepart Detail</label>
                    <div class="col-md-6">
                        <input id="spareparts_detail" type="text" class="form-control @error('spareparts_detail') is-invalid @enderror"
                            name="spareparts_detail" value="{{ $spareparts[0]->spareparts_detail }}" required autocomplete="spareparts_detail" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_mesins" class="col-md-4 col-form-label text-md-end">Nama Mesin</label>
                    <div class="col-md-6">
                        <select id="id_mesins" name="id_mesins" class="form-select">
                            @foreach ($datas3 as $data1)
                                <option value="{{ $data1->id_mesin}}">
                                    {{ $data1->nm_mesin }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_outlets" class="col-md-4 col-form-label text-md-end">Cabang Outlet</label>
                    <div class="col-md-6">
                        <select id="id_outlets" name="id_outlets" class="form-select">
                            @foreach ($datas2 as $data1)
                                <option value="{{ $data1->outlets_id}}">
                                    {{ $data1->nm_outlet }}</option>
                            @endforeach
                        </select>
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
