<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>
                
                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(Auth::user()->role == 1): ?>
                        selamat datang admin
                    <?php elseif(Auth::user()->role == 2): ?>
                        selamat datang kasir
                    <?php elseif(Auth::user()->role == 3): ?>
                        selamat datang mas haikal yang paling ganteng unch unch
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel_laundry\resources\views/home.blade.php ENDPATH**/ ?>