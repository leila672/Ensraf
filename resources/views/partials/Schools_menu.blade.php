<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("schools.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("schools.students.index") }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.student.title') }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("schools.my-parents.index") }}" class="c-sidebar-nav-link {{ request()->is("schools/my-parents") || request()->is("schools/my-parents/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-male c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.myParent.title') }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("schools.screens.index") }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.screen.title') }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
