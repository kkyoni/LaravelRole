<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary bars them" href="#"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li><span class="m-r-sm text-muted welcome-message">Welcome to <?php echo e(Settings::get('application_title')); ?></span></li>
            <li>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="block m-t-xs font-bold"><?php echo e(\Auth::user()->user_name); ?><b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                    <li><a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">Profile</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div><?php /**PATH /var/www/html/particle_role/resources/views/admin/includes/topNavigation.blade.php ENDPATH**/ ?>