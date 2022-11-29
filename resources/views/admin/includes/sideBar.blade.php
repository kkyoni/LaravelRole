<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img src="{{ url(\Settings::get('application_logo')) }}" alt="image" class="rounded-circle" style="border-radius:0%!important; height: 60px; width: 60px;">
                </div>
                <div class="logo-element">
                    <img alt="image" class="rounded-circle" style="border-radius:20%!important; height:30px; width:30px;" src="{{ url(\Settings::get('favicon_logo')) }}">
                </div>
            </li>
            <li class="@if(Request::segment('2') == 'dashboard') active @endif" data-toggle="tooltip" title="Dashboard">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <!-- @php
            $cmsPermission = \App\Helpers\Helper::checkPermission(['cms-edit']);
            @endphp
            @if($cmsPermission)
            <li class="@if(Request::segment('2') == 'cms') active @endif" data-toggle="tooltip" title="CMS Pages">
                <a href="{{ route('admin.cms.index') }}">
                    <i class="fa fa-clipboard"></i>
                    <span class="nav-label">CMS Pages</span>
                </a>
            </li>
            @endif -->
            @php
            $settingsPermission = \App\Helpers\Helper::checkPermission(['settings-list','settings-create','settings-edit','settings-delete','settings-show']);
            @endphp
            @if($settingsPermission)
            <li class="@if(Request::segment('2') == 'settings') active @endif" data-toggle="tooltip" title="Setting">
                <a href="{{ url('admin/settings') }}">
                    <i class="fa fa-cogs"></i>
                    <span class="nav-label">Setting </span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>