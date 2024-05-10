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
                                        <th scope="col">Nama Outlet</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paket as $e => $pkt)
                                        <tr>
                                            <td>{{ $e + 1 }}</td>
                                            <td>{{ $pkt->outlet->nama_outlet }}</td>
                                            <td>{{ $pkt->jenis_paket }}</td>
                                            <td>{{ $pkt->nama_paket }}</td>
                                            <td>{{ 'Rp. ' . number_format($pkt->harga, 2, ',', '.') }} / kg</td>
                                            
                                            <td>
                                                <div style="width:60px">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $pkt->id }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $pkt->id }}" class="btn btn-danger"
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('paket.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Outlet</label>
                            <select class="form-select form-select-md mb-3" name="outlet_id"
                                @error('outlet_id')
                                    is-invalid
                                @enderror
                                required>
                                <option selected>Pilih Outlet</option>
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
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Cucian</label>
                            <select class="form-select form-select-md mb-3" name="jenis_paket"
                                @error('jenis_paket')
                                    is-invalid
                                @enderror
                                required>
                                <option selected>Pilih Jenis Cucian</option>
                                <option value="kiloan">Kiloan (Baju, Celana)</option>
                                <option value="bed_cover">Bed Cover</option>
                                <option value="selimut">Selimut</option>
                            </select>

                            @error('jenis_paket')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Paket</label>
                            <input type="text" class="form-control"
                                @error('nama_paket')
                        is-valid
                    @enderror
                                name="nama_paket" placeholder="Masukan Nama Paket dengan benar">
                            @error('nama_paket')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control"
                                @error('harga')
                        is-valid
                    @enderror
                                name="harga" placeholder="Masukan Harga dengan benar">
                            @error('harga')
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
    @foreach ($paket as $pkt)
        <div class="modal fade" id="edit{{ $pkt->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('paket.update', $pkt->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Outlet</label>
                                <select class="form-select form-select-md mb-3" name="outlet_id" required>
                                    <option selected disabled>Pilih Outlet</option>
                                    @foreach ($outlet as $o)
                                    <option value="{{ $o->id }}" {{ $pkt->outlet_id == $o->id ? 'selected' : '' }}>
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
                            
                            <div class="mb-3">
                                <label class="form-label">Jenis</label>
                                <select class="form-select form-select-md mb-3" name="jenis_paket" required>
                                    <option selected>
                                        {{ old('jenis_paket',$pkt->jenis_paket) }}
                                    </option>
                                </select>

                                @error('jenis_paket')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Paket</label>
                                <input type="text" class="form-control"
                                    @error('nama_paket')
                        is-valid
                    @enderror
                                    name="nama_paket" value="{{ old('nama_paket', $pkt->nama_paket) }}"
                                    placeholder="Masukan Nama paket dengan benar">
                                @error('nama_paket')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="text" class="form-control"
                                    @error('harga')
                        is-valid
                    @enderror
                                    name="harga" value="{{ old('harga', $pkt->harga) }}"
                                    placeholder="Masukan Harga dengan benar">
                                @error('harga')
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
    @foreach ($paket as $pkt)
        <div class="modal fade" id="delete{{ $pkt->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data <b>{{ $pkt->nama_paket }}</b></p>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <form action="{{ route('paket.destroy', $pkt->id) }}" method="POST">
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
