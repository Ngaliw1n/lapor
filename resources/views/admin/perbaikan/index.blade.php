@extends('layouts.app')
@section('title')
    Perbaikan Admin
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1>Perbaikan Controller</h1>
        </center>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('sukses'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Menambah Perbaikan',
                    'success'
                )
            </script>
        @elseif (session()->has('hapus'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Hapus Perbaikan',
                    'success'
                )
            </script>
        @elseif (session()->has('edit'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Edit Perbaikan',
                    'success'
                )
            </script>
        @endif
        <!-- Button add modal -->
        <button type="button" class="btn btn-primary mx-2 my-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i> Tambah Perbaikan</div>
        </button>
        <div class="my-2" style="float:right">
            <form action="/perbaikan/cari" method="GET" class="d-md-inline-block form-inline">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Cari Perbaikan" name='cari'
                        value="{{ old('cari') }}" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div>
            <table class="mx-2 table table-hover text-center" border="1px">
                <tr>
                    <th>No</th>
                    <th>Nama Perbaikan</th>
                    <th>Gambar Perbaikan</th>
                    <th>Detail</th>
                    <th>Mesin</th>
                    <th>Outlet</th>
                    <th>Pelapor</th>
                    <th>Tanggal Perbaikan</th>
                    <th style="width: 200px">Aksi</th>
                </tr>
                <?php
                $i = 0;
                ?>
                @foreach ($datas as $data)
                    @if ($data->id_perbaikan != 0)
                        <tr align='center'>
                            <td>{{ ++$i }}</td>
                            <td>{{ $data->nm_perbaikan }}</td>
                            <td><img src="/image/{{ $data->gmbr_perbaikan }}" width="200px"></td>
                            <td>{{ $data->detail}}</td>
                            <td>{{ $data->nm_mesin}}</td>
                            <td>{{ $data->nm_outlet }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->tgl }}</td>
                            <td>
                                <form action="" method="GET" class="d-md-inline-block form-inline">
                                    <input class="form-control" type="hidden" placeholder="Cari akun" name='cari'
                                        value="{{ $data->id_perbaikan }}" />
                                    <button class="btn btn-primary btn-sm" id="btnNavbarSearch" type="submit"><i
                                            class="fa fa-eye"></i></button>
                                </form>
                                <form method="post" action="{{ route('perbaikans.destroy', $data->id_perbaikan) }}"
                                    class="d-md-inline-block form-inline">
                                    <a class="btn btn-success btn-sm" href="{{ route('perbaikans.edit', $data->id_perbaikan) }}">
                                        <div class="sb-nav-link-icon">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                    </a>
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm">
                                        <div class="sb-nav-link-icon">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @else
                    @endif
                @endforeach
            </table>

            {{ $datas->links() }}
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Perbaikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('perbaikans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nm_perbaikan" class="col-md-4 col-form-label text-md-end">Nama Perbaikan</label>
                            <div class="col-md-6">
                                <input id="nm_perbaikan" type="text"
                                    class="form-control @error('nm_perbaikan') is-invalid @enderror" name="nm_perbaikan"
                                    value="{{ old('nm_perbaikan') }}" required autocomplete="nm_perbaikan" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gmbr_perbaikan" class="col-md-4 col-form-label text-md-end">Gambar Perbaikan</label>
                            <div class="col-md-6">
                                <input type="file" name="gmbr_perbaikan" id="gmbr_perbaikan" class="form-control"
                                    placeholder="image">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="detail" class="col-md-4 col-form-label text-md-end">Detail</label>
                            <div class="col-md-6">
                                <input id="detail" type="text"
                                    class="form-control @error('detail') is-invalid @enderror" name="detail"
                                    value="{{ old('detail') }}" required autocomplete="detail" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="id_mesins" class="col-md-4 col-form-label text-md-end">Nama Mesin</label>
                            <div class="col-md-6">
                                {{-- <input id="id_mesins" type="text"
                                    class="form-control @error('id_mesins') is-invalid @enderror" name="id_mesins"
                                    value="{{ old('id_mesins') }}" required autocomplete="id_mesins" autofocus> --}}

                                <select id="id_mesins" name="id_mesins" class="form-select">
                                    @foreach ($datas3 as $data1)
                                        <option value="{{ $data1->id_mesin }}">
                                            {{ $data1->nm_mesin }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_outlets" class="col-md-4 col-form-label text-md-end">Cabang Outlet</label>
                            <div class="col-md-6">
                                {{-- <input id="id_outlets" type="text"
                                    class="form-control @error('id_outlets') is-invalid @enderror" name="id_outlets"
                                    value="{{ old('id_outlets') }}" required autocomplete="id_outlets" autofocus> --}}

                                <select id="id_outlets" name="id_outlets" class="form-select">
                                    @foreach ($datas2 as $data1)
                                        <option value="{{ $data1->outlets_id }}">
                                            {{ $data1->nm_outlet }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_pelapor" class="col-md-4 col-form-label text-md-end">Pelapor</label>
                            <div class="col-md-6">
                                {{-- <input id="id_pelapor" type="text"
                                    class="form-control @error('id_pelapor') is-invalid @enderror" name="id_pelapor"
                                    value="{{ old('id_pelapor') }}" required autocomplete="id_pelapor" autofocus> --}}

                                <select id="id_pelapor" name="id_pelapor" class="form-select">
                                    @foreach ($datas4 as $data1)
                                        <option value="{{ $data1->id }}">
                                            {{ $data1->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgl" class="col-md-4 col-form-label text-md-end">Tanggal Perbaikan</label>
                            <div class="col-md-6">
                                <input id="tgl" type="date" class="form-control @error('tgl') is-invalid @enderror"
                                    name="tgl" value="{{ old('tgl') }}" required autocomplete="tgl" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <center>
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
        </div>
    </div>                
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: 'Hapus Perbaikan ?',
                    text: "Menyetujui berarti menghapus data data perbaikan permanen",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
