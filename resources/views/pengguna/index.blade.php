@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                            class="btn btn-outline-light btn-sm">Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Outlet</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $e => $u)
                                        <tr>
                                            <td>{{ $e + 1 }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->outlet->nama_outlet }}</td>
                                            <td>
                                                <div style="width:60px">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $u->id }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $u->id }}" class="btn btn-danger"
                                                        id="delete">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    {{-- create --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Karyawan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control"
                                @error('name')
                        is-valid
                    @enderror name="name"
                                placeholder="Masukan Nama Paket dengan benar">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control"
                                @error('email')
                        is-valid
                    @enderror
                                name="email" placeholder="Masukan email dengan benar">
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">password</label>
                            <input type="text" class="form-control"
                                @error('password')
                        is-valid
                    @enderror
                                name="password" placeholder="Masukan password dengan benar">
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role Pengguna</label>
                            <select class="form-select form-select-md mb-3" name="role"
                                @error('role')
                                is-invalid
                            @enderror
                                required>
                                <option selected>Pilih Role</option>
                                <option value="2">Kasir</option>
                                <option value="3">Pemilik</option>
                            </select>

                            @error('role')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Outlet Pengguna</label>
                            <select class="form-select form-select-md mb-3" name="outlet_id"
                                @error('outlet_id')
                                is-invalid
                            @enderror
                                required>
                                <option selected>Outlet Pengguna</option>
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->id }}">{{ $o->nama_outlet }}</option>
                                @endforeach
                            </select>

                            @error('outlet_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit --}}
    @foreach ($user as $u)
        <div class="modal fade" id="edit{{ $u->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.update', $u->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control"
                                    @error('name')
                        is-valid
                    @enderror
                                    name="name" value="{{ old('name', $u->name) }}"
                                    placeholder="Masukan Nama paket dengan benar">
                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <input type="text" class="form-control"
                                    @error('email')
                        is-valid
                    @enderror
                                    name="email" value="{{ old('email', $u->email) }}"
                                    placeholder="Masukan email dengan benar">
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">password</label>
                                <input type="text" class="form-control"
                                    @error('password')
                        is-valid
                    @enderror
                                    name="password" value="{{ old('password', $u->password) }}"
                                    placeholder="Masukan password dengan benar">
                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role Pengguna</label>
                                <select class="form-select form-select-md mb-3" name="role"
                                    @error('role')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected>Pilih Role</option>
                                    <option value="1" @if (old('role', $u->role) == '1') selected @endif>Admin
                                    </option>
                                    <option value="2" @if (old('role', $u->role) == '2') selected @endif>Kasir
                                    </option>
                                    <option value="3" @if (old('role', $u->role) == '3') selected @endif>owner
                                    </option>
                                </select>
    
                                @error('role')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Outlet</label>
                                <select name="outlet_id" class="form-select form-select-md mb-3"
                                    @error('outlet_id') 
                                 is-invalid 
                                 @enderror>
                                    @foreach ($outlet as $o)
                                        <option value="{{ $o->id }}"
                                            {{ old('outlet_id') == $o->id ? 'selected' : '' }}>
                                            {{ $o->nama_outlet }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('outlet_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- hapus --}}
    @foreach ($user as $u)
        <div class="modal fade" id="delete{{ $u->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Karyawan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data <b>{{ $u->name }}</b></p>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <form action="{{ route('user.destroy', $u->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
