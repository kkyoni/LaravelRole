<?php $__env->startSection('mainContent'); ?>

    <div class="ibox-content mt-lg-5">
        <h2 class="font-bold">Permission denied</h2>
        <div class="row">
            <div class="col-12">
                <?php if(isset($message)): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <?php echo e($message); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/particle_role/resources/views/errors/permission.blade.php ENDPATH**/ ?>