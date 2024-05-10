

<?php $__env->startSection('content'); ?>
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
                                    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e => $tsk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($e + 1); ?></td>
                                            <td><?php echo e($tsk->outlet->nama_outlet); ?></td>
                                            <td><?php echo e($tsk->customer->nama); ?></td>
                                            <td><?php echo e($tsk->tanggal); ?></td>
                                            <td><?php echo e($tsk->customer->berat); ?> kg</td>
                                            <td><?php echo e($tsk->batas_waktu); ?></td>
                                            <td><?php echo e($tsk->tanggal_bayar); ?></td>
                                            <td><?php echo e(number_format($tsk->biaya_tambahan, 2, ',', '.') ?? '0'); ?></td>
                                            <td><?php echo e($tsk->status); ?></td>
                                            <td><?php echo e($tsk->dibayar); ?></td>
                                            <td><?php echo e(Auth::User()->name); ?></td>

                                            <?php if(Auth::user()->role == 1): ?>
                                            <td>
                                                <div style="width:60px">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?php echo e($tsk->id); ?>"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete<?php echo e($tsk->id); ?>" class="btn btn-danger"
                                                        id="delete">Hapus</a>
                                                        <td>
                                                    <a href="<?php echo e(route('transaksi.create')); ?>"
                                                            class="btn-sm btn btn-success mt-2">Print</a>        
                                                </td>
                                                </div>
                                            </td>
                                            <?php elseif(Auth::user()->role == 2): ?>
                                                <td>
                                                    <div style="width:60px">
                                                        <a href="<?php echo e(route('transaksi.create')); ?>"
                                                        class="btn-sm btn btn-outline-success mt-2">Print</a>
                                                    </div>
                                                </td>
                                            <?php elseif(Auth::user()->role == 3): ?>
                                                <td>
                                                    <div style="width:60px">
                                                        <a href="<?php echo e(route('transaksi.create')); ?>"
                                                        class="btn-sm btn btn-outline-success mt-2">Print</a>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal'); ?>
    
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('transaksi.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Outlet</label>
                            <select class="form-select form-select-md mb-3" name="outlet_id" required>
                                <option selected>Pilih Outlet</option>
                                <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($o->id); ?>"><?php echo e($o->nama_outlet); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['outlet_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggan</label>
                            <select class="form-select form-select-md mb-3" name="customer_id" required>
                                <option selected>Pilih Nama</option>
                                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal dengan benar">
                            <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Ambil</label>
                            <input type="date" class="form-control" name="batas_waktu" placeholder="Masukan Tanggal Ambil dengan benar">
                            <?php $__errorArgs = ['batas_waktu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bayar</label>
                            <input type="date" class="form-control" name="tanggal_bayar" placeholder="Masukan Tanggal Bayar dengan benar">
                            <?php $__errorArgs = ['tanggal_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Biaya Tambahan</label>
                            <input type="number" class="form-control" name="biaya_tambahan" placeholder="Masukan Biaya Tambahan Mencuci dengan benar">
                            <?php $__errorArgs = ['biaya_tambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diskon</label>
                            <input type="number" class="form-control" name="diskon" placeholder="Masukan Diskon Mencuci dengan benar">
                            <?php $__errorArgs = ['diskon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pajak</label>
                            <input type="number" class="form-control" name="pajak" placeholder="Masukan Pajak Mencuci dengan benar">
                            <?php $__errorArgs = ['pajak'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dibayar</label>
                            <select class="form-select form-select-md mb-3" name="dibayar" required>
                                <option selected>Dibayar?</option>
                                <option value="dibayar">Lunas</option>
                                <option value="belum_dibayar">Belum Bayar</option>
                            </select>
                            <?php $__errorArgs = ['dibayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Pembuat Laporan</label>
                            <input type="text" class="form-control" name="users_id"
                                <?php $__errorArgs = ['users_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            is-invalid
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                value="<?php echo e(Auth::User()->id); ?>" readonly>

                            <?php $__errorArgs = ['users_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    
    
    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tsk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="edit<?php echo e($tsk->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Outlet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('transaksi.update', $tsk->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Outlet</label>
                                <select class="form-select form-select-md mb-3" name="outlet_id" required>
                                    <option selected disabled>Pilih Outlet</option>
                                    <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($o->id); ?>" <?php echo e($tsk->outlet_id == $o->id ? 'selected' : ''); ?>>
                                        <?php echo e($o->nama_outlet); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        
                                <?php $__errorArgs = ['outlet_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Nama Pelanggan</label>
                                <select class="form-select form-select-md mb-3" name="customer_id" required>
                                    <option selected disabled>Pilih Nama </option>
                                    <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($c->id); ?>" <?php echo e($tsk->customer_id == $c->id ? 'selected' : ''); ?>>
                                        <?php echo e($c->nama); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        
                                <?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal" value="<?php echo e($tsk->tanggal); ?>" required>
                                <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Tanggal Ambil</label>
                                <input type="date" class="form-control" name="batas_waktu" value="<?php echo e($tsk->batas_waktu); ?>" required>
                                <?php $__errorArgs = ['batas_waktu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Tanggal Bayar</label>
                                <input type="date" class="form-control" name="tanggal_bayar" value="<?php echo e($tsk->tanggal_bayar); ?>">
                                <?php $__errorArgs = ['tanggal_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Diskon</label>
                                <input type="text" class="form-control" name="diskon" value="<?php echo e($tsk->diskon); ?>">
                                <?php $__errorArgs = ['diskon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Pajak</label>
                                <input type="text" class="form-control" name="pajak" value="<?php echo e($tsk->pajak); ?>">
                                <?php $__errorArgs = ['pajak'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select form-select-md mb-3" name="status" required>
                                    <option selected disabled>Pilih Status</option>
                                    <option value="baru" <?php echo e($tsk->status == 'baru' ? 'selected' : ''); ?>>Baru</option>
                                    <option value="proses" <?php echo e($tsk->status == 'proses' ? 'selected' : ''); ?>>Proses</option>
                                    <option value="selesai" <?php echo e($tsk->status == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                    <option value="diambil" <?php echo e($tsk->status == 'diambil' ? 'selected' : ''); ?>>Diambil</option>
                                </select>
                        
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Dibayar</label>
                                <select class="form-select form-select-md mb-3" name="dibayar" required>
                                    <option selected disabled>Dibayar?</option>
                                    <option value="dibayar" <?php echo e($tsk->dibayar == 'dibayar' ? 'selected' : ''); ?>>Lunas</option>
                                    <option value="belum_dibayar" <?php echo e($tsk->dibayar == 'belum_dibayar' ? 'selected' : ''); ?>>Belum Bayar</option>
                                </select>
                        
                                <?php $__errorArgs = ['dibayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Pembuat Laporan</label>
                                <input type="text" class="form-control" name="users_id"
                                    <?php $__errorArgs = ['users_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                is-invalid
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    value="<?php echo e(Auth::User()->id); ?>" readonly>
    
                                <?php $__errorArgs = ['users_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tsk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="delete<?php echo e($tsk->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <form action="<?php echo e(route('transaksi.destroy', $tsk->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel_laundry\resources\views/transaksi/index.blade.php ENDPATH**/ ?>