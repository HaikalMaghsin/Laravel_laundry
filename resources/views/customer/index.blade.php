@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                            class="btn btn-outline-light btn-sm">Tambah Data</a>

                        @if ($message = Session('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($message = Session('update'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($message = Session('delete'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">No Hp</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Paket</th>
                                        <th scope="col">Berat</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $e => $dt)
                                        <tr>
                                            <td>{{ $e + 1 }}</td>
                                            <td>{{ $dt->email }}</td>
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->jenis_kelamin }}</td>
                                            <td>{{ $dt->no_hp }}</td>
                                            <td>{{ $dt->alamat }}</td>
                                            <td>{{ $dt->paket->nama_paket }}</td>
                                            <td>{{ $dt->berat }}</td>
                                            <td>
                                                <div style="width:60px">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $dt->id }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $dt->id }}" class="btn btn-danger"
                                                        id="delete">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->links() }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Pelanggan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control"
                                @error('email')
                        is-valid
                    @enderror
                                name="email" placeholder="Masukan Email dengan benar">
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control"
                                @error('nama')
                        is-valid
                    @enderror name="nama"
                                placeholder="Masukan Nama dengan benar">
                            @error('nama')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select form-select-md mb-3"
                                @error('jenis_kelamin')
                                is-valid
                            @enderror>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Hp</label>
                            <input type="text" class="form-control"
                                @error('no_hp')
                        is-valid
                    @enderror
                                name="no_hp" placeholder="Masukan no hp dengan benar">
                            @error('no_hp')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <br>
                            <textarea name="alamat" class="form-control"cols="30" rows="5"
                                @error('alamat')
                                is-valid
                            @enderror
                                placeholder="Masukkan Alamat dengan benar"></textarea>
                            @error('jenis_kelamin')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('alamat')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Paket</label>
                            <select class="form-select form-select-md mb-3" name="paket_id"
                                @error('paket_id')
                                        is-invalid
                                    @enderror
                                required>
                                <option selected>Pilih Paket</option>
                                @foreach ($paket as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->nama_paket }}</option>
                                @endforeach
                            </select>

                            @error('paket_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Berat</label>
                            <input type="text" class="form-control"
                                @error('berat')
                        is-valid
                    @enderror
                                name="berat" placeholder="Masukan berat cucian dengan benar">
                            @error('berat')
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
    @foreach ($data as $dt)
        <div class="modal fade" id="edit{{ $dt->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('customer.update', $dt->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control"
                                    @error('email')
                        is-valid
                    @enderror
                                    name="email" value="{{ old('email', $dt->email) }}"
                                    placeholder="Masukan Email dengan benar">
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control"
                                    @error('nama')
                        is-valid
                    @enderror
                                    name="nama" value="{{ old('nama', $dt->nama) }}"
                                    placeholder="Masukan Nama dengan benar">
                                @error('nama')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select form-select-md mb-3"
                                    @error('jenis_kelamin')
                                is-valid
                            @enderror>
                                    <option value="L" @if (old('jenis_kelamin', $dt->jenis_kelamin) == 'L') selected @endif>Laki-Laki
                                    </option>
                                    <option value="P" @if (old('jenis_kelamin', $dt->jenis_kelamin) == 'P') selected @endif>Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Hp</label>
                                <input type="text" class="form-control"
                                    @error('no_hp')
                        is-valid
                    @enderror
                                    name="no_hp" value="{{ old('no_hp', $dt->no_hp) }}"
                                    placeholder="Masukan no hp dengan benar">
                                @error('no_hp')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <br>
                                <textarea name="alamat" class="form-control"cols="30" rows="5"
                                    @error('alamat')
                                is-valid
                            @enderror
                                    placeholder="Masukkan Alamat dengan benar">{{ old('alamat', $dt->alamat) }}</textarea>
                                @error('jenis_kelamin')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Paket</label>
                                <select name="paket_id" class="form-select form-select-md mb-3"
                                    @error('paket_id') 
                                 is-invalid 
                                 @enderror>
                                    @foreach ($paket as $pkt)
                                        <option value="{{ $pkt->id }}"
                                            {{ old('paket_id') == $pkt->id ? 'selected' : '' }}>
                                            {{ $pkt->nama_paket }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('paket_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Berat</label>
                                <input type="text" name="berat" class="form-control"
                                    @error('berat') is-invalid @enderror value="{{ old('berat',$dt->berat) }}"
                                    placeholder="Masukkan berat Mencuci dengan benar">

                                @error('berat')
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
    @foreach ($data as $dt)
        <div class="modal fade" id="delete{{ $dt->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data <b>{{ $dt->nama }}</b></p>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <form action="{{ route('customer.destroy', $dt->id) }}" method="POST">
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
