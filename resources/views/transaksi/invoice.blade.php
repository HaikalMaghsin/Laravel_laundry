<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laundry KU</title>
    <style>
        body {
            font-family: sans-serif;
            border: 1px solid;
            border-radius: 10px;
        }

        .title {
            text-align: center;
            font-size: 35px;
            margin-bottom: 20px;
            margin-top: 100px;
        }

        .head {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="title">
        Bukti Pembayaran KA-Laundry
    </div>
    <div class="head">
        @foreach ($outlet as $o)
            <p>Nama Outlet : {{ $o->nama_outlet }}</p>
        @endforeach
        @foreach ($customer as $c)
            <p>Nama Kustomer : {{ $c->nama }}</p>
        @endforeach
        @foreach ($paket as $p)
            <p>Nama Paket : {{ $p->nama_paket }}</p>

            <p>Harga : {{ 'Rp. ' . number_format($p->harga, 2, ',', '.') }} / kg</p>
        @endforeach
        @foreach ($data as $d)
            <p>Tanggal Terima : <u>{{ $d->tanggal }}</u></p>

            <p>Berat Cucian : <u>{{ $c->berat }} kg</u></p>

            <p>Tanggal Selesai : <u>{{ $d->batas_waktu }}</u></p>

            <p>Biaya Tambahan : <u>{{ $d->biaya_tambahan }}</u></p>

            <p>Diskon : <u>{{ 'Rp. ' . number_format($d->diskon, 2, ',', '.') }}</u></p>

            <p>pajak : <u>{{ 'Rp. ' . number_format($d->pajak, 2, ',', '.') }}</u></p>

            <p>Status : <u>{{ $d->status }}</u></p>

            <p>Status Pembayaran : <u>{{ $d->dibayar }}</u></p>
        @endforeach
        <p>Pembuat Laporan : <u>{{ Auth::user()->name }}</u></p>

        {{-- <p>Biaya Yang Dibayar : {{ $totalHarga }}</p> --}}
    </div>
    <div style="text-align: center">
        <p>Sering sering males ya nyucinya, biar sering ke sini</p>
        <br>
        Terimakasih Banyak!!
        <br>
        <br>
        <p>Tertanda {{ Auth::user()->name }}</p>
    </div>
</body>

</html>