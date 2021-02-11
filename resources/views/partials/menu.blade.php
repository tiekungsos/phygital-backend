<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('slider_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.sliders.index") }}" class="nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-backward">

                            </i>
                            <p>
                                {{ trans('cruds.slider.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('growup_page_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/growup-categories*") ? "menu-open" : "" }} {{ request()->is("admin/growup-blogs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-clipboard-list">

                            </i>
                            <p>
                                {{ trans('cruds.growupPage.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('growup_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.growup-categories.index") }}" class="nav-link {{ request()->is("admin/growup-categories") || request()->is("admin/growup-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.growupCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('growup_blog_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.growup-blogs.index") }}" class="nav-link {{ request()->is("admin/growup-blogs") || request()->is("admin/growup-blogs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bookmark">

                                        </i>
                                        <p>
                                            {{ trans('cruds.growupBlog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('our_page_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/our-teams*") ? "menu-open" : "" }} {{ request()->is("admin/our-clients*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-align-justify">

                            </i>
                            <p>
                                {{ trans('cruds.ourPage.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('our_team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.our-teams.index") }}" class="nav-link {{ request()->is("admin/our-teams") || request()->is("admin/our-teams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-address-card">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ourTeam.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('our_client_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.our-clients.index") }}" class="nav-link {{ request()->is("admin/our-clients") || request()->is("admin/our-clients/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-address-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ourClient.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('work_page_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/work-categories*") ? "menu-open" : "" }} {{ request()->is("admin/works*") ? "menu-open" : "" }} {{ request()->is("admin/serch-tags*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-handshake">

                            </i>
                            <p>
                                {{ trans('cruds.workPage.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('work_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.work-categories.index") }}" class="nav-link {{ request()->is("admin/work-categories") || request()->is("admin/work-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.workCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('work_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.works.index") }}" class="nav-link {{ request()->is("admin/works") || request()->is("admin/works/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-clipboard-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.work.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('serch_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.serch-tags.index") }}" class="nav-link {{ request()->is("admin/serch-tags") || request()->is("admin/serch-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.serchTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('contact_us_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.contactuses.index") }}" class="nav-link {{ request()->is("admin/contactuses") || request()->is("admin/contactuses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-address-card">

                            </i>
                            <p>
                                {{ trans('cruds.contactUs.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('metadata_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.metadata.index") }}" class="nav-link {{ request()->is("admin/metadata") || request()->is("admin/metadata/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.metadata.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>