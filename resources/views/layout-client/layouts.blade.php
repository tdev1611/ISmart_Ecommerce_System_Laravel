
<!DOCTYPE html>
<html>

<head>
    <title>TDEV STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/client/public/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/client/public/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/client/public/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/client/public/css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/client/public/css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/client/public/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/client/public/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/client/public/responsive.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('/client/public/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/client/public/js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/client/public/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/client/public/js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/client/public/js/main.js') }}"></script>
    
</head>

<body>
    @yield('style_css')
    <style>
        #cart-wp #dropdown .mess-order-header {
            color: #5e6054;
            text-align: center;
            margin: 0 auto;
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }
        .li-product {
            position: relative;
        }

        .discount-product {
            background: rgba(255, 212, 36, .9);
            right: 0;
            position: absolute;
            top: 0;
        }

        .discount {
            text-align: center;

            font-weight: 400;
            line-height: .8125rem;
            color: #ee4d2d;
            text-transform: uppercase;
            font-size: .75rem;
        }
    </style>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{ route('homes') }}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{ route('productShows') }}" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{ route('blogShows') }}" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="{{ route('intro') }}" title="">Giới thiệu</a>
                                </li>
                                {{-- <li>
                                    <a href="?page=detail_blog" title="">Liên hệ</a>
                                </li> --}}
                                {{-- <li>
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('logout') }}"> LOG OUT</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{ route('homes') }}" title="" id="logo" class="fl-left"><img
                                src="{{ asset('/client/public/images/logo.png') }}" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="get" action="{{ route('searchIndex') }}">
                                <input type="text" name="search" id="s"
                                    placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                        </div>
                        <div class="ajax_jquery">
                            <style>
                                .ajax_jquery {
                                    position: absolute;
                                    top: 100px;
                                    background-color: #fff;
                                    border-radius: 20px;
                                    right: 486px;
                                    width: 447px;
                                    max-height: 300px;
                                    z-index: 1;
                                    overflow: hidden;
                                }

                                .ajax_jquery ul {
                                    border-bottom: 1px solid #ab9d9d;
                                    display: none
                                }

                                .ajax_jquery ul li.search-ajax {
                                    display: flex;
                                    align-items: center;
                                    margin-bottom: 20px;
                                    padding: 10px 20px 0;
                                }
                            </style>
                            {{-- <ul id="ULsearch-ajax">
                                <li class="search-ajax"><a
                                        href="https://quydung.unitopcv.com/san-pham/iphone-13-promax/Trả"
                                        góp="" 0="" lãi="" xuất=""
                                        apple="" iphone="" 13pro="" 24g"=""
                                        style="flex-basis:10%;"><img
                                            src="https://quydung.unitopcv.com/public/uploads/s3.jpg "></a><a
                                        href="https://quydung.unitopcv.com/san-pham/iphone-13-promax/Trả góp 0 lãi xuất Apple Iphone 13Pro 24G"
                                        style="flex-basis: 82%; padding-left:50px; color:cadetblue; font-size:14px;">Trả
                                        góp 0 lãi xuất Apple Iphone 13Pro 24G</a> </li>
                            </ul> --}}



                        </div>

                        </form>
                        {{-- ạaxseq --}}
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0364.816.xxx</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            {{-- <a href="" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a> --}}
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{ route('cartshow') }}"> <i class="fa fa-shopping-cart "
                                            aria-hidden="true"style="
                                            color: white"></i></a>
                                    <span id="num" class="qtys">{{ Cart::count() }}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span class="qtys">{{ Cart::count() }} sản phẩm</span>
                                        trong
                                        giỏ hàng
                                    </p>
                                    <div id="show-dropcart">

                                        @if (Cart::count())
                                            <ul class="list-cart">
                                                @foreach (Cart::content() as $item)
                                                    <li class="clearfix">
                                                        <a href="{{ route('productDetail', $item->options->slug) }}"
                                                            title="" class="thumb fl-left">
                                                            <img src="{{ url($item->options->images) }}"
                                                                alt="">
                                                        </a>
                                                        <div class="info fl-right">
                                                            <a href="{{ route('productDetail', $item->options->slug) }}"
                                                                title=""
                                                                class="product-name">{{ $item->name }}</a>
                                                            <p class="price">
                                                                {{ number_format($item->price, 0, '', '.') }}đ
                                                            </p>
                                                            <p class="qty">Số lượng: 
                                                                <span id="qty_per" data-id="{{ $item->rowId }}">{{ $item->qty }}</span>
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="total-price clearfix">
                                                <p class="title fl-left">Tổng:</p>
                                                <p class="price fl-right total-price-lo">{{ Cart::total() }}đ</p>
                                            </div>
                                            <div class="action-cart clearfix">
                                                <a href="{{ route('cartshow') }}" title="Giỏ hàng"
                                                    class="view-cart fl-left">Giỏ hàng</a>
                                                <a href="{{ route('showCheckCount') }}" title="Thanh toán"
                                                    class="checkout fl-right">Thanh
                                                    toán</a>
                                            </div>
                                        @else
                                            <img src="https://bizweb.dktcdn.net/100/440/012/themes/839260/assets/empty_cart.png?1653287637639"
                                                alt="Trống giỏ hàng">
                                            <span class="mess-order-header">Hãy thêm các sản phẩm vào giỏ hàng của
                                                bạn!!!</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="main-content-wp" class="home-page clearfix">
                @yield('content')
            </div>
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">ISMART</h3>
                            <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ
                                ràng,
                                chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>36 - Lương Ngọc Quyến - Hà Đông - Hà Nội</p>
                                </li>
                                <li>
                                    <p>0364.816.xxx - 0886.567xxx</p>
                                </li>
                                <li>
                                    <p>johntr8cne@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <div id="form-reg">
                                <form method="get" action="">
                                    <input type="email" name="email" id="email" placeholder="email">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang chủ</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Điện thoại</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Nokia</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Máy tính bảng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        @yield('ajax')

</body>

</html>

