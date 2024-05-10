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
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Berat</th>
                                        <th scope="col">Tanggal Ambil</th>
                                        <th scope="col">Tanggal Bayar</th>
                                        <th scope="col">Biaya Tambahan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Status Bayar</th>
                                        <th scope="col">Petugas</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $e => $tsk)
                                        <tr>
                                            <td>{{ $e + 1 }}</td>
                                            <td>{{ $tsk->outlet->nama_outlet }}</td>
                                            <td>{{ $tsk->customer->nama }}</td>
                                            <td>{{ $tsk->tanggal }}</td>
                                            <td>{{ $tsk->customer->berat }} kg</td>
                                            <td>{{ $tsk->batas_waktu }}</td>
                                            <td>{{ $tsk->tanggal_bayar }}</td>
                                            <td>{{ number_format($tsk->biaya_tambahan, 2, ',', '.') ?? '0' }}</td>
                                            <td>{{ $tsk->status }}</td>
                                            <td>{{ $tsk->dibayar }}</td>
                                            <td>{{ Auth::User()->name }}</td>

                                            @if (Auth::user()->role == 1)
                                            <td>
                                                <div style="width:60px">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $tsk->id }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $tsk->id }}" class="btn btn-danger"
                                                        id="delete">Hapus</a>
                                                        <td>
                                                    <a href="{{ route('transaksi.create') }}"
                                                            class="btn-sm btn btn-success mt-2">Print</a>        
                                                </td>
                                                </div>
                                            </td>
                                            @elseif (Auth::user()->role == 2)
                                                <td>
                                                    <div style="width:60px">
                                                        <a href="{{ route('transaksi.create') }}"
                                                        class="btn-sm btn btn-outline-success mt-2">Print</a>
                                                    </div>
                                                </td>
                                            @elseif (Auth::user()->role == 3)
                                                <td>
                                                    <div style="width:60px">
                                                        <a href="{{ route('transaksi.create') }}"
                                                        class="btn-sm btn btn-outline-success mt-2">Print</a>
                                                    </div>
                                                </td>
                                            @endif
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Outlet</label>
                            <select class="form-select form-select-md mb-3" name="outlet_id" required>
                                <option selected>Pilih Outlet</option>
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->id }}">{{ $o->nama_outlet }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggan</label>
                            <select class="form-select form-select-md mb-3" name="customer_id" required>
                                <option selected>Pilih Nama</option>
                                @foreach ($customer as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal dengan benar">
                            @error('tanggal')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Ambil</label>
                            <input type="date" class="form-control" name="batas_waktu" placeholder="Masukan Tanggal Ambil dengan benar">
                            @error('batas_waktu')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bayar</label>
                            <input type="date" class="form-control" name="tanggal_bayar" placeholder="Masukan Tanggal Bayar dengan benar">
                            @error('tanggal_bayar')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Biaya Tambahan</label>
                            <input type="number" class="form-control" name="biaya_tambahan" placeholder="Masukan Biaya Tambahan Mencuci dengan benar">
                            @error('biaya_tambahan')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diskon</label>
                            <input type="number" class="form-control" name="diskon" placeholder="Masukan Diskon Mencuci dengan benar">
                            @error('diskon')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pajak</label>
                            <input type="number" class="form-control" name="pajak" placeholder="Masukan Pajak Mencuci dengan benar">
                            @error('pajak')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select form-select-md mb-3" name="status" required>
                                <option selected>Status</option>
                                <option value="baru">Baru</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="diambil">Diambil</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dibayar</label>
                            <select class="form-select form-select-md mb-3" name="dibayar" required>
                                <option selected>Dibayar?</option>
                                <option value="dibayar">Lunas</option>
                                <option value="belum_dibayar">Belum Bayar</option>
                            </select>
                            @error('dibayar')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Pembuat Laporan</label>
                            <input type="text" class="form-control" name="users_id"
                                @error('users_id')
                            is-invalid
                            @enderror
                                value="{{ Auth::User()->id }}" readonly>

                            @error('users_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- edit --}}
    @foreach ($transaksi as $tsk)
        <div class="modal fade" id="edit{{ $tsk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Outlet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi.update', $tsk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Outlet</label>
                                <select class="form-select form-select-md mb-3" name="outlet_id" required>
                                    <option selected disabled>Pilih Outlet</option>
                                    @foreach ($outlet as $o)
                                    <option value="{{ $o->id }}" {{ $tsk->outlet_id == $o->id ? 'selected' : '' }}>
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
                                <label class="form-label">Nama Pelanggan</label>
                                <select class="form-select form-select-md mb-3" name="customer_id" required>
                                    <option selected disabled>Pilih Nama </option>
                                    @foreach ($customer as $c)
                                    <option value="{{ $c->id }}" {{ $tsk->customer_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->nama }}
                                    </option>
                                    @endforeach
                                </select>
                        
                                @error('customer_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal" value="{{ $tsk->tanggal }}" required>
                                @error('tanggal')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Tanggal Ambil</label>
                                <input type="date" class="form-control" name="batas_waktu" value="{{ $tsk->batas_waktu }}" required>
                                @error('batas_waktu')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Tanggal Bayar</label>
                                <input type="date" class="form-control" name="tanggal_bayar" value="{{ $tsk->tanggal_bayar }}">
                                @error('tanggal_bayar')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Diskon</label>
                                <input type="text" class="form-control" name="diskon" value="{{ $tsk->diskon }}">
                                @error('diskon')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Pajak</label>
                                <input type="text" class="form-control" name="pajak" value="{{ $tsk->pajak }}">
                                @error('pajak')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select form-select-md mb-3" name="status" required>
                                    <option selected disabled>Pilih Status</option>
                                    <option value="baru" {{ $tsk->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="proses" {{ $tsk->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $tsk->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="diambil" {{ $tsk->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                                </select>
                        
                                @error('status')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Dibayar</label>
                                <select class="form-select form-select-md mb-3" name="dibayar" required>
                                    <option selected disabled>Dibayar?</option>
                                    <option value="dibayar" {{ $tsk->dibayar == 'dibayar' ? 'selected' : '' }}>Lunas</option>
                                    <option value="belum_dibayar" {{ $tsk->dibayar == 'belum_dibayar' ? 'selected' : '' }}>Belum Bayar</option>
                                </select>
                        
                                @error('dibayar')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Pembuat Laporan</label>
                                <input type="text" class="form-control" name="users_id"
                                    @error('users_id')
                                is-invalid
                                @enderror
                                    value="{{ Auth::User()->id }}" readonly>
    
                                @error('users_id')
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
    @foreach ($transaksi as $tsk)
        <div class="modal fade" id="delete{{ $tsk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data Transaksi Ini?</p>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <form action="{{ route('transaksi.destroy', $tsk->id) }}" method="POST">
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
