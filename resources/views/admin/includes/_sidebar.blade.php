        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
                <div>
                <p class="app-sidebar__user-name">John Doe</p>
                <p class="app-sidebar__user-designation">Frontend Developer</p>
                </div>
            </div>
            <ul class="app-menu">
                <li><a class="app-menu__item {{is_active_route('welcome')}}" href="{{route('admin.welcome')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسية</span></a></li>
                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">المنتجات</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i>عرض الكل</a></li>
                        <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i>أضافة منتج</a></li>
                    </ul>
                </li>
            </ul>
        </aside>
