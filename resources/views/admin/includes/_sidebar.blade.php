<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <a href="{{ route('admin.profile.show') }}">
            <img class="app-sidebar__user-avatar" width="48" height="48" src="{{ currentUser()->photo }}"
                alt="{{ currentUser()->name }}">
        </a>
        <div>
            <p class="app-sidebar__user-name"><a href="{{ route('admin.profile.show') }}">{{ currentUser()->name }}</a>
            </p>
            <p class="app-sidebar__user-designation">{{ currentUser()->roles()->first()->display_name }}</p>
        </div>
    </div>
    <ul class="app-menu">
        {{-- Dashboard --}}
        <li>
            <a class="app-menu__item {{is_active_route('')}}" href="{{route('admin.welcome')}}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">الرئيسية</span>
            </a>
        </li>
        {{-- Products --}}
        @if (currentUser()->isAbleTo('*_products'))
        <li class="treeview {{ is_active_route('products') ? 'is-expanded' : '' }}">
            <a class="app-menu__item {{ is_active_route('products') ? 'active' : '' }}" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-building"></i>
                <span class="app-menu__label">المنتجات</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @if (currentUser()->hasPermission('read_products'))
                <li><a class="treeview-item" href="{{ route('admin.products') }}"><i class="icon fa fa-list"></i>عرض
                        الكل</a></li>
                @endif
                @if (currentUser()->hasPermission('create_products'))
                <li><a class="treeview-item" href="{{ route('admin.products.create') }}"><i
                            class="icon fa fa-plus"></i>أضافة جديدة</a></li>
                @endif
            </ul>
        </li>
        @endif


        {{-- Roles --}}
        @if (currentUser()->isAbleTo('*_roles'))
        <li class="treeview {{ is_active_route('roles') ? 'is-expanded' : '' }}">
            <a class="app-menu__item {{ is_active_route('roles') ? 'active' : '' }}" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-lock"></i>
                <span class="app-menu__label">الصلاحيات</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @if (currentUser()->hasPermission('read_roles'))
                <li><a class="treeview-item" href="{{ route('admin.roles') }}"><i class="icon fa fa-list"></i>عرض
                        الكل</a></li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
</aside>