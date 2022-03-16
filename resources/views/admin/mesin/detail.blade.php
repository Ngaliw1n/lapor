@extends('layouts.app')
@section('title')
    Detail Mesin
@endsection
@section('content')
    <div class="container-fluid">
        <center>
            <h1>Detail Mesin</h1>
            <h2>{{ $data[0]->nm_mesin }}</h2>
        </center>
        <div class="row d-flex justify-content-around">
            <div class="col-md-6">
                <form>
                    <div class="row mb-3">
                        <label for="nm_outlet" class="col-sm-2 col-form-label">Nama Mesin: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nm_outlet" value="{{ $data[0]->nm_mesin }}"
                                readonly>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <label for="detail" class="col-sm-2 col-form-label">Detail Outlet: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="detail" value="{{ $data[0]->detail }}" readonly>
                        </div>
                    </div> --}}
                </form>
            </div>
            <div class="col-md-6 text-center">
                <figure>
                    <img src="/image/{{ $data[0]->gbr_mesin }}" width="200px" alt="gambar mesin">
                    <figcaption>Tampilan {{ $data[0]->nm_mesin }}</figcaption>
                </figure>
            </div>
        </div>
        <hr>
        <center>
            <h3 class="mt-4">Riwayat Mesin</h3>
        </center>
        <table class="mx-2 table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Keusakan</th>
                <th>Tanggal Kerusakan</th>
                <th>Gambar Kerusakan</th>
                <th>Detail</th>
                <th>Status Perbaikan</th>
            </tr>
            <?php
            $i = 0;
            ?>
            @foreach ($data2 as $datas)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $datas->nm_kerusakan }}</td>
                    <td>{{ $datas->tgl }}</td>
                    <td>{{ $datas->gmbr_kerusakan }}</td>
                    <td>{{ $datas->detail }}</td>
                    {{-- <td><img src="/image/{{ $datas->gbr_mesin }}" width="200px"></td> --}}
                    {{-- <td>{{ $datas->status }}</td> --}}
                    @if ('{{ $datas->status }}' == 1)
                        <td>Sudah Diperbaiki</td>
                    @else
                        <td>Belum Diperbaiki</td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endsection
