@extends('layouts.app')
@section('title')
    Detail Outlet
@endsection
@section('content')
    <div class="container-fluid">
        <center>
            <h1 class="mt-4">Detail Outlet</h1>
            <h2>{{ $data[0]->nm_outlet }}</h2>
        </center>
        <div class="row d-flex justify-content-around">
            <div class="col-md-6">
                <form>
                    <div class="row mb-3">
                        <label for="nm_outlet" class="col-sm-2 col-form-label">Nama Outlet: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nm_outlet" value="{{ $data[0]->nm_outlet }}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="detail" class="col-sm-2 col-form-label">Detail Outlet: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="detail" value="{{ $data[0]->detail }}" readonly>
                        </div>
                    </div>
                </form>
                {{-- <label for="nm_outlet">Nama Outlet:</label>
                <input type="text" id="nm_outlet" name="nm_outlet" value="{{ $data[0]->nm_outlet }}" readonly> --}}
                {{-- <br>
                <label for="detail">detail Outlet:</label>

                <textarea id="detail" name="detail" rows="3" readonly>{{ $data[0]->detail }}</textarea> --}}
            </div>
            <div class="col-md-6 text-center">
                <figure>
                    <img src="/image/{{ $data[0]->gmbr_outlet }}" width="200px" alt="gambar mesin">
                    <figcaption>Tampilan {{ $data[0]->nm_outlet }}</figcaption>
                </figure>

            </div>
        </div>
        <hr>
        <center>
            <h3 class="mt-4">Daftar Mesin</h3>
        </center>
        <table class="mx-2 table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Mesin</th>
                <th>Gambar Mesin</th>
                <th>Tanggal Mesin</th>
            </tr>
            <?php
            $i = 0;
            ?>
            @foreach ($data as $data)
                @if ($data->id_mesin != 0)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $data->nm_mesin }}</td>
                        <td><img src="/image/{{ $data->gbr_mesin }}" width="200px"></td>
                        <td>{{ $data->tgl }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Data Kosong</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection
