<?php $__env->startSection('title'); ?>
Settings Management
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2><i class="fa fa-cogs"></i> Settings</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <span class="label label-success float-right all_backgroud">Settings Table</span>
            </li>
        </ol>
    </div>
</div>
<?php 
    $checkPermission = \App\Helpers\Helper::checkPermission(['settings-edit']);
    $ListPermission = \App\Helpers\Helper::checkPermission(['settings-list']);
    ?>
    <?php if($ListPermission): ?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Settings Table</h5>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="">
                                    <th>CODE</th>
                                    <th>TYPE</th>
                                    <th>LABEL</th>
                                    <th>VALUE</th>
                                    <?php if($checkPermission): ?>
                                    <th>ACTIONS</th>
                                    <?php endif; ?>
                                </tr>
                                <tr class="">
                                    <form method="get">
                                        <th>
                                            <input class="form-control" name="search[code]" placeholder="CODE" value="<?php echo e($search['code']); ?>"/>
                                        </th>
                                        <th>
                                            <select class="form-control" name="search[type]">
                                                <option value="" <?php echo e($search['type'] == '' ?'disabled selected':''); ?>>
                                                SELECT TYPE</option>
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e($search['type'] == $key?'selected':''); ?>><?php echo e($type); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </th>
                                        <th>
                                            <input class="form-control" name="search[label]" placeholder="LABEL" value="<?php echo e($search['label']); ?>"/>
                                        </th>
                                        <th>
                                            <input class="form-control" name="search[value]" placeholder="VALUE" value="<?php echo e($search['value']); ?>"/>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-primary btn-circle"><i class="fa fa-search"></i></button>
                                            <a href="<?php echo e(url(config('settings.route'))); ?>" class="btn btn-warning btn-circle">
                                                <i class="fa fa-eraser"></i>
                                            </a>
                                        </th>
                                    </form>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr id="tr_<?php echo e($setting->id); ?>" class="<?php echo e($setting->hidden?'warning':''); ?>">
                                    <td><?php echo e($setting->code); ?></td>
                                    <td><?php echo e($setting->type); ?></td>
                                    <td><?php echo e($setting->label); ?></td>
                                    <td><?php echo e(str_limit($setting->getOriginal('value'),50)); ?></td>
                                    <?php if($checkPermission): ?>
                                    <td><a href="<?php echo e(url(config('settings.route') . '/' . $setting->id . '/edit')); ?>" class="btn btn-warning btn-circle btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                     <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5"><i class="fa fa-info-circle" aria-hidden="true"></i> No settings found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="pull-right"><?php echo e($settings->appends(\Request::except('page'))->links()); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/particle_role/resources/views/vendor/settings/index.blade.php ENDPATH**/ ?>