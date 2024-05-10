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
        <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p>Nama Outlet : <?php echo e($o->nama_outlet); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p>Nama Kustomer : <?php echo e($c->nama); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $paket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p>Nama Paket : <?php echo e($p->nama_paket); ?></p>

            <p>Harga : <?php echo e('Rp. ' . number_format($p->harga, 2, ',', '.')); ?> / kg</p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p>Tanggal Terima : <u><?php echo e($d->tanggal); ?></u></p>

            <p>Berat Cucian : <u><?php echo e($c->berat); ?> kg</u></p>

            <p>Tanggal Selesai : <u><?php echo e($d->batas_waktu); ?></u></p>

            <p>Biaya Tambahan : <u><?php echo e($d->biaya_tambahan); ?></u></p>

            <p>Diskon : <u><?php echo e('Rp. ' . number_format($d->diskon, 2, ',', '.')); ?></u></p>

            <p>pajak : <u><?php echo e('Rp. ' . number_format($d->pajak, 2, ',', '.')); ?></u></p>

            <p>Status : <u><?php echo e($d->status); ?></u></p>

            <p>Status Pembayaran : <u><?php echo e($d->dibayar); ?></u></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <p>Pembuat Laporan : <u><?php echo e(Auth::user()->name); ?></u></p>

        
    </div>
    <div style="text-align: center">
        <p>Sering sering males ya nyucinya, biar sering ke sini</p>
        <br>
        Terimakasih Banyak!!
        <br>
        <br>
        <p>Tertanda <?php echo e(Auth::user()->name); ?></p>
    </div>
</body>

</html><?php /**PATH E:\laravel_laundry\resources\views/transaksi/invoice.blade.php ENDPATH**/ ?>