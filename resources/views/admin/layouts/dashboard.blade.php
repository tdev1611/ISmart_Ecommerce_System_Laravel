<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
    <link rel="shortcut icon" href="https://duchai.blog/blog-tdev/public/client/images/logo.png" type="image/x-icon">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="{{ asset('client/admin-template/css/style.css') }}" rel="stylesheet">
    @yield('Laravel-File-Manager')
    <title> @yield('title') </title>
</head>

<body>
    @yield('style_css')
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ url('admin') }}">
                    <img src="https://duchai.blog/blog-tdev/public/client/images/logo.png" alt="" style="position: absolute;
                    top: 10%;">
                    <span class="logo-compact"><img src="https://duchai.blog/blog-tdev/public/client/images/logo.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
             
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            {{ Auth::user()->name }}
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('client/admin-template/images/imgs/1.jpg') }}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="{{ route('admin.edit',Auth::user()->id) }}"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                     
                                        <li><a href="{{ route('logout.perform') }}"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Trang</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('admin.addPage') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.listPage') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Bình luận</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./form-basic.html">Danh sách</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i><span class="nav-text">Bài viết</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('admin.addPost') }}" aria-expanded="false">Thêm mới</a></li>
                            <li><a href="{{ route('admin.listPost') }}" aria-expanded="false">Danh sách</a></li>
                            <li><a href="{{ route('admin.categoryPost') }}" aria-expanded="false">Danh mục</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i><span class="nav-text">Sản
                                phẩm</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('admin.addProduct') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.listProduct') }}">Danh sách</a></li>
                            <li><a href="{{ route('admin.categoryProduct') }}">Danh mục</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="{{ route('admin.createColor') }}" aria-expanded="false">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i><span class="nav-text">Màu</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-first-order" aria-hidden="true"></i>
                            <span class="nav-text">Bán hàng</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('admin.listOrder') }}">Đơn hàng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('admin.adduser') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.listusers') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Phân quyền</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('permission_create') }}">Quyền</a></li>
                            <li><a href="{{ route('permission.index') }}">Thêm vai trò</a></li>
                            <li><a href="{{ route('permission_create') }}">Danh sách vai trò</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            @yield('content')
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Duchai -Tdev</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('client/admin-template/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('client/admin-template/js/custom.min.js') }}"></script>
    <script src="{{ asset('client/admin-template/js/settings.js') }}"></script>
    <script src="{{ asset('client/admin-template/js/gleek.js') }}"></script>
    <script src="{{ asset('client/admin-template/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('client/admin-template/js/dashboard/dashboard-1.js') }}"></script>


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
