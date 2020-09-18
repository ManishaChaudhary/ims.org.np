<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{asset('admin/images/logo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{Auth::user()->name}}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('/dashboard')}}" class="nav-link {{Request::is('admin/dashboard')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('moderator'))
                    <li class="nav-item">
                        <a href="{{route('admin.companies.index')}}"
                           class="nav-link {{Request::is('admin/companies')?'active':''}}">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Companies
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.godowns.index')}}"
                           class="nav-link {{Request::is('admin/godowns')?'active':''}}">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                Godown
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.products.index')}}"
                           class="nav-link {{Request::is('admin/products')?'active':''}}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Categories
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.categories.index')}}" class="nav-link {{Request::is('admin/categories')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.sub-categories.index')}}" class="nav-link {{Request::is('admin/sub-categories')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('admin.product-batches.index')}}"
                       class="nav-link {{Request::is('admin/product-batches')?'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Product Batch
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.challans.index')}}"
                       class="nav-link {{Request::is('admin/challans')?'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Challan In
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.challan-out.index')}}"
                       class="nav-link {{Request::is('admin/challan-out')?'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Challan Out
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.product-returns.index')}}"
                       class="nav-link {{Request::is('admin/product-returns')?'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Returns
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                       class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('moderator'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                User Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}"
                                   class="nav-link {{Request::is('admin/users')?'active':''}}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.roles.index')}}"
                                   class="nav-link {{Request::is('admin/roles')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.permissions.index')}}"
                                   class="nav-link {{Request::is('admin/permissions')?'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>