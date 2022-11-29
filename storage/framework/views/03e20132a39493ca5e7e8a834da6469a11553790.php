<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img src="<?php echo e(url(\Settings::get('application_logo'))); ?>" alt="image" class="rounded-circle" style="border-radius:0%!important; height: 60px; width: 60px;">
                </div>
                <div class="logo-element">
                    <img alt="image" class="rounded-circle" style="border-radius:20%!important; height:30px; width:30px;" src="<?php echo e(url(\Settings::get('favicon_logo'))); ?>">
                </div>
            </li>
            <li class="<?php if(Request::segment('2') == 'dashboard'): ?> active <?php endif; ?>" data-toggle="tooltip" title="Dashboard">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <!-- <?php
            $cmsPermission = \App\Helpers\Helper::checkPermission(['cms-edit']);
            ?>
            <?php if($cmsPermission): ?>
            <li class="<?php if(Request::segment('2') == 'cms'): ?> active <?php endif; ?>" data-toggle="tooltip" title="CMS Pages">
                <a href="<?php echo e(route('admin.cms.index')); ?>">
                    <i class="fa fa-clipboard"></i>
                    <span class="nav-label">CMS Pages</span>
                </a>
            </li>
            <?php endif; ?> -->
            <?php
            $settingsPermission = \App\Helpers\Helper::checkPermission(['settings-list','settings-create','settings-edit','settings-delete','settings-show']);
            ?>
            <?php if($settingsPermission): ?>
            <li class="<?php if(Request::segment('2') == 'settings'): ?> active <?php endif; ?>" data-toggle="tooltip" title="Setting">
                <a href="<?php echo e(url('admin/settings')); ?>">
                    <i class="fa fa-cogs"></i>
                    <span class="nav-label">Setting </span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav><?php /**PATH /var/www/html/particle_role/resources/views/admin/includes/sideBar.blade.php ENDPATH**/ ?>