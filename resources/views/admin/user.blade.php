@extends('layouts.app')
@section('title')
    Account Manage
@endsection
@section('content')
    <div class="container-fluid px-4">
        <center>
            <h1 class="mt-4">Account Controller</h1>
        </center>

        @if (session()->has('sukses'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Menambah Akun',
                    'success'
                )
            </script>
        @elseif (session()->has('hapus'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Hapus Akun',
                    'success'
                )
            </script>
        @elseif (session()->has('edit'))
            <script>
                Swal.fire(
                    'Sukses',
                    'Berhasil Edit Akun',
                    'success'
                )
            </script>
        @endif
        <!-- Button add modal -->
        <button type="button" class="btn btn-primary mx-2 my-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i> Tambah Akun</div>
        </button>
        <div style="float:right">
            <form action="/user/cari" method="GET" class="d-md-inline-block form-inline">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Cari akun" name='cari'
                        value="{{ old('cari') }}" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div>
            <table class="mx-2 table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="width: 100px">Aksi</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_admin == 1)
                                Admin
                            @elseif ($user->is_admin == 2)
                                SPV
                            @else
                                User
                            @endif
                        </td>
                        <td>
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
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

            {{ $users->links() }}
        </div>
        <!-- Add Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="is_admin" class="col-md-4 col-form-label text-md-end">Status</label>
                                <div class="col-md-6">
                                    <select name='is_admin' class="form-select">
                                        <option value='1'>Admin</option>
                                        <option value='2'>SPV</option>
                                        <option value='0'>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: 'Hapus Akun?',
                    text: "Menyetujui berarti menghapus akun selamanya",
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
