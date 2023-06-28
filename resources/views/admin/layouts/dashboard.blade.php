<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('Laravel-File-Manager')
    <title> @yield('title') </title>
</head>

<body>
    @yield('style_css')
    <div id="warpper" class="nav-fixed ">
        
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{ url('admin/dashboard') }}">TDEV STORE</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('admin/post/add') }}">Thêm bài viết</a>
                        <a class="dropdown-item" href="{{ url('admin/product/add') }}">Thêm sản phẩm</a>
                        <a class="dropdown-item" href="{{ url('admin/order/list') }}">Xem đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{-- <a class="dropdown-item" href="#">Tài khoản</a> --}}
                        <a class="dropdown-item" href="{{ route('logout.perform') }}">Log out</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- end nav  -->
        @php
            $modules_active = session('modules_active');
            //    dd($modules_active)
        @endphp


        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link {{ $modules_active == 'dashboard' ? 'active' : ' ' }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Dashboard
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    <li class="nav-link {{ $modules_active == 'pages' ? 'active' : '' }}">
                        <a href="{{ url('admin/page/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Page
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/page/add') }}">Add new</a></li>
                            <li><a href="{{ url('admin/page/list') }}">List</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $modules_active == 'posts' ? 'active' : '' }}">
                        <a href="{{ url('admin/post/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Posts
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/post/add') }}">Add new</a></li>
                            <li><a href="{{ url('admin/post/list') }}">List</a></li>
                            <li><a href="{{ url('admin/post/category') }}">Category</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $modules_active == 'products' ? 'active' : '' }}">
                        <a href="{{ url('admin/product/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Products
                        </a>
                        <i class="arrow fas fa-angle-down"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/product/add') }}">Add new</a></li>
                            <li><a href="{{ url('admin/product/list') }}">List</a></li>
                            <li><a href="{{ url('admin/product/category') }}">Category</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $modules_active == 'orders' ? 'active' : '' }}">
                        <a href="{{ url('admin/order/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                           Sale
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/order/list') }}">Orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $modules_active == 'users' ? 'active' : '' }}">
                        <a href="{{ route('admin.listusers') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Users
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.adduser') }}">Add new</a></li>
                            <li><a href="{{ route('admin.listusers') }}">List</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $modules_active == 'roles' ? 'active' : '' }}">
                        <a href="{{ url('admin/role/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Authorization Users
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/permission/add') }}">Permission</a></li>
                            <li><a href="{{ url('admin/role/add') }}">Add Role</a></li>
                            <li><a href="{{ url('admin/role/list') }}">List Role</a></li>
                        </ul>
                    </li>


                </ul>
            </div>


            <nav class="navbar navbar-expand-md navbar-light bg-light sidebar-menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar-nav"
                    aria-controls="sidebar-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="sidebar-nav">

                </div>
            </nav>



            <div id="wp-content">
                @yield('content')

            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    @yield('create_slug')
    <script>
        $(document).ready(function() {
            $('#file').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imageSrc = e.target.result;
                    $('#image_show').attr('src', imageSrc);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
</body>

</html>
