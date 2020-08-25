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
        {{-- Marketing --}}
        @if (currentUser()->isAbleTo('*_marketing'))
        <li class="treeview {{ is_active_route('marketing') ? 'is-expanded' : '' }}">
            <a class="app-menu__item {{ is_active_route('marketing') ? 'active' : '' }}" href="#"
                data-toggle="treeview">
                <i class="app-menu__icon fa fa-handshake-o"></i>
                <span class="app-menu__label">التسويق</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('admin.marketing.offers') }}"><i
                            class="icon fa fa-diamond"></i>العروض</a></li>
                <li><a class="treeview-item" href="{{ route('admin.marketing.sales.company') }}"><i
                            class="icon fa fa-life-ring"></i>مبيعات الشركة</a></li>
                <li><a class="treeview-item" href="{{ route('admin.marketing.sales.out_company') }}"><i
                            class="icon fa fa-map-marker"></i>مبيعات خارج الشركة</a></li>
            </ul>
        </li>
        @endif

        {{-- Investments --}}
        @if (currentUser()->isAbleTo('*_investments'))
        <li class="treeview {{ is_active_route('investments') ? 'is-expanded' : '' }}">
            <a class="app-menu__item {{ is_active_route('investments') ? 'active' : '' }}" href="#"
                data-toggle="treeview">
                <i class="app-menu__icon fa fa-money"></i>
                <span class="app-menu__label">الاستثمارات</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @if (currentUser()->hasPermission('read_investments'))
                <li><a class="treeview-item" href="{{ route('admin.investments.rents') }}"><i
                            class="icon fa fa-lightbulb-o fa-lg"></i>
                        ايجار برنامج</a></li>
                <li><a class="treeview-item" href="{{ route('admin.investments.premiums') }}"><i
                            class="icon fa fa-credit-card-alt"></i>
                        عملاء الأقساط والتمويل</a></li>
                <li>
                    <a class="treeview-item" href="{{ route('admin.investments.manag_company_amalak') }}"><i
                            class="icon fa fa-black-tie"></i>
                        ادارة املاك الشركة</a>
                </li>
                <li>
                    <a class="treeview-item" href="{{ route('admin.investments.manag_clients_amalak') }}"><i
                            class="icon fa fa-black-tie"></i>
                        ادارة املاك عملاء اخرون</a>
                </li>
                <li>
                    <a class="treeview-item" href="{{ route('admin.investments.out_investments') }}"><i
                            class="icon fa fa-black-tie"></i>
                        ادارة استثمارات خارجية</a>
                </li>
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