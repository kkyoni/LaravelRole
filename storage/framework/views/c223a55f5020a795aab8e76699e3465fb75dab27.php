<script src="<?php echo e(asset('assets/admin/js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/bootstrap.js')); ?>"></script>
<?php echo Notify::render(); ?>

<?php echo $__env->yieldContent('authScripts'); ?><?php /**PATH /var/www/html/particle_role/resources/views/admin/includes/scriptsAuth.blade.php ENDPATH**/ ?>