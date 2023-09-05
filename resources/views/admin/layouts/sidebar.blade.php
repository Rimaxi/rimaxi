<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Food Factory</b></span>
    </a>

    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="sidebar-search-results">
                <div class="list-group"><a href="#" class="list-group-item">
                        <div class="search-title"><strong class="text-light"></strong>N<strong
                                class="text-light"></strong>o<strong class="text-light"></strong> <strong
                                class="text-light"></strong>e<strong class="text-light"></strong>l<strong
                                class="text-light"></strong>e<strong class="text-light"></strong>m<strong
                                class="text-light"></strong>e<strong class="text-light"></strong>n<strong
                                class="text-light"></strong>t<strong class="text-light"></strong> <strong
                                class="text-light"></strong>f<strong class="text-light"></strong>o<strong
                                class="text-light"></strong>u<strong class="text-light"></strong>n<strong
                                class="text-light"></strong>d<strong class="text-light"></strong>!<strong
                                class="text-light"></strong></div>
                        <div class="search-path"></div>
                    </a></div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('front') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Datatable</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('food.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('italian.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            italian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('country.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            countries
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('state.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            state
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('city.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            cities
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('hobby.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Hobbies
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('write.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Writer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('post.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Post
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
</head>
</html>

