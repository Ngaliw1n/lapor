@extends('layouts.app')
@section('title')
    Outlet Admin
@endsection
@section('content')
    {{-- <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Dashboard Outlets</h1>
        </center>
        <div>
            <table class="table table-bordered table-responsive yajra-datatable" style="overflow-x: auto">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Outlet</th>
                        <th>Detail</th>
                        <th>Jumlah Mesin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('outlet.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nm_outlet',
                        name: 'outlets.nm_outlet'
                    },
                    {
                        data: 'detail',
                        name: 'outlets.detail'
                    },
                    {
                        data: 'jml_mesin',
                        name: 'jml_mesin'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script> --}}


    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Outlet Controller</h1>
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
                    'Berhasil Menambah Outlet',
                    'success'
                )
            </script>
        @elseif (session()->has('hapus'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Hapus Outlet',
                    'success'
                )
            </script>
        @elseif (session()->has('edit'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Edit Outlet',
                    'success'
                )
            </script>
        @endif
        <!-- Button add modal -->
        <button type="button" class="btn btn-primary mx-2 my-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i> Tambah Outlet</div>
        </button>
        <div class="my-2" style="float:right">
            <form action="/outlet/cari" method="GET" class="d-md-inline-block form-inline">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Cari Outlet" name='cari'
                        value="{{ old('cari') }}" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div>
            <table class="mx-2 table table-hover text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Outlet</th>
                    <th>Detail Outlet</th>
                    <th>Jumlah Mesin</th>
                    <th style="width: 200px">Aksi</th>
                </tr>
                <?php
                $i = 0;
                ?>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $data->nm_outlet }}</td>
                        <td class="p-2 flex-fill bd-highlight">{{ $data->detail }}</td>
                        <td>{{ $data->jml_mesin }}</td>
                        <td>
                            <form action="/outlet/detail" method="GET" class="d-md-inline-block form-inline">
                                <input class="form-control" type="hidden" placeholder="Cari akun" name='cari'
                                    value="{{ $data->outlets_id }}" />
                                <button class="btn btn-primary btn-sm" id="btnNavbarSearch" type="submit"><i
                                        class="fa fa-eye"></i></button>
                            </form>
                            {{-- @else
                                <form action="#" method="GET" class="d-md-inline-block form-inline">
                                    <input class="form-control" type="hidden" placeholder="Cari akun" name='cari'
                                        value="{{ $data->outlets_id }}" />
                                    <button class="btn btn-primary btn-sm" id="btnNavbarSearch" type="submit"><i
                                            class="fa fa-eye"></i></button>
                                </form>
                            @endif --}}
                            <form method="post" action="{{ route('outlets.destroy', $data->outlets_id) }}"
                                class="d-md-inline-block form-inline">
                                {{-- <a class="btn btn-primary btn-sm" href="{{ url('outlet/detail', $data->outlets_id) }}">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-eye"></i>
                                    </div>
                                </a> --}}

                                <a class="btn btn-success btn-sm" href="{{ route('outlets.edit', $data->outlets_id) }}">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Outlet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('outlets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nm_outlet" class="col-md-4 col-form-label text-md-end">Nama Outlet</label>
                            <div class="col-md-6">
                                <input id="nm_outlet" type="text"
                                    class="form-control @error('nm_outlet') is-invalid @enderror" name="nm_outlet"
                                    value="{{ old('nm_outlet') }}" required autocomplete="nm_outlet" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="detail" class="col-md-4 col-form-label text-md-end">Detail Outlet</label>
                            <div class="col-md-6">
                                {{-- <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror"
                                    name="detail" value="{{ old('detail') }}" required autocomplete="detail" autofocus> --}}
                                <textarea class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" rows="3" required
                                    autocomplete="detail" autofocus></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gmbr_outlet" class="col-md-4 col-form-label text-md-end">Gambar Outlet</label>
                            <div class="col-md-6">
                                <input type="file" name="gmbr_outlet" id="gmbr_outlet" class="form-control"
                                    placeholder="image">
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
                    title: 'Hapus Outlet?',
                    text: "Menyetujui berarti menghapus dat Outlet dan data mesin sesuai outlet yang dipilih",
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
