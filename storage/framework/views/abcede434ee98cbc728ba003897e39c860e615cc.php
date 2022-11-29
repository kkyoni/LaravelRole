<?php $__env->startSection('title'); ?>
Settings Management - Edit
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2><i class="fa fa-cogs"></i> Update Setting</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('admin/settings')); ?>">Setting Table</a>
            </li>
            <li class="breadcrumb-item active">
                <span class="label label-success float-right all_backgroud">Edit Setting Form</span>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Setting Form</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="<?php echo e(url(config('settings.route').'/'.$setting->id)); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="_method" value="PUT"/>
                            <?php echo $__env->make('settings::shared_input', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $__env->make('settings::types_value.'.strtolower($setting->type), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12 text-left">
                                    <a href="<?php echo e(url(config('settings.route'))); ?>">
                                        <button class="btn btn-danger btn-sm" type="button">Cancel</button>
                                    </a>
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style type="text/css">
.btn-info {display: none;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/admin/js/plugins/datapicker/bootstrap-datepicker.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    var editor = document.querySelector('.ck-editor');
    if (editor != undefined) {
        CKEDITOR.replace(editor, {});
        CKEDITOR.instances['value'].on('change', function () {
            CKEDITOR.instances['value'].updateElement()
        });
        CKEDITOR.config.allowedContent = true;
    }
    $('.datepicker').datepicker({
        format: '<?php echo e(config('settings.date_format')); ?>',
        orientation: "bottom auto"
    });
    if ($("#values-table").length > 0) {
        $(document).on('click', '#add-value', function () {
            var index = $('#values-table tr:last').data('index');
            if (isNaN(index)) {
                index = 0;
            } else {
                index++;
            }
            $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td>' +
                '<input name="<?php echo e($setting->code); ?>[' + index + '][key]" type="text"' +
                'value="" class="form-control"/></td><td>' +
                '<input name="<?php echo e($setting->code); ?>[' + index + '][value]" type="text"' +
                'value="" class="form-control"/></td>' +
                '<td><button type="button" class="btn btn-danger remove-value" data-index="' + index + '">'
                + '<i class="fa fa-remove"></i></button></td>' +
                '</tr>');
        });
        $(document).on('click', '.remove-value', function () {
            var index = $(this).data('index');
            $("#tr_" + index).remove();
        });
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/particle_role/resources/views/vendor/settings/edit.blade.php ENDPATH**/ ?>