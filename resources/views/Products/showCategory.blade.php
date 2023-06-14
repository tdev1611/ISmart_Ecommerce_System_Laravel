@extends('layout-client.layouts')
@section('content')
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                    {{-- {!! $renderBreadcrumb !!} --}}
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">

            {{-- @foreach ($Category as $cat)
                <div class="section" id="list-product-wp">
                    @if ($cat->productsRecursive()->count() > 0)
                        <div class="section-head">
                            <h3 class="section-title">{{ $cat->name }}</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item">
                                @foreach ($productByCate as $product)
                                    <li style="height: 276px">
                                        <a href="{{ route('productDetail', $product->slug) }}" title=""
                                            class="thumb">
                                            <img src="{{ url($product->images) }}">
                                        </a>
                                        <a href="{{ route('productDetail', $product->slug) }}" title=""
                                            class="product-name">{{ $product->name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($product->price, 0, '', '.') }}đ</span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="{{ route('addCart', $product->id) }}" title=""
                                                data-id="{{ $product->id }}" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="{{ route('buyNow', $product->id) }}" title="Mua ngay"
                                                class="buy-now fl-right">Mua
                                                ngay</a>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    @else
                        <style>
                            .out-of-stock {
                                background-color: #ff4d4d;
                                color: #ffffff;
                                padding: 10px;
                                text-align: center;
                                border-radius: 5px;
                                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                            }

                            .message {
                                font-weight: bold;
                                font-size: 18px;
                                text-transform: uppercase;
                            }
                        </style>
                        <h3 class="section-title">{{ $cat->name }}</h3>
                        <div class="section-detail">
                            <div class="out-of-stock">
                                <span class="message">Sản phẩm đã hết hàng</span>
                            </div>

                        </div>
                    @endif
                </div>
            @endforeach --}}
            <div class="section" id="list-product-wp">
                <div class="filter-wp fl-right">
                    {{-- <p class="desc">Hiển thị 45 trên 50 sản phẩm</p> --}}
                    <div class="form-filter">
                        {{-- softProductsByCate --}}
                        <form method="get" action="">
                            <select name="sortProdByCate">
                                <option value="name_asc">Sắp xếp</option>
                                <option value="name_asc">Từ A-Z</option>
                                <option value="name_desc">Từ Z-A</option>
                                <option value="price_desc">Giá cao xuống thấp</option>
                                <option value="price_asc">Giá thấp lên cao</option>
                            </select>
                            {{-- <button type="submit">Sắp xếp</button> --}}
                        </form>
                    </div>
                </div>
                @if ($category->productsRecursive()->count() > 0)
                    <div class="section-head">
                        <h3 class="section-title">{{ $category->name }}</h3>
                    </div>

                    <div class="section-detail">
                        <ul class="list-item" id="productByCate">
                            @foreach ($productByCate as $product)
                                <li style="height: 276px" class="li-product">
                                    <a href="{{ route('productDetail', $product->slug) }}" title="" class="thumb">
                                        <img src="{{ url($product->images) }}">
                                    </a>
                                    <a href="{{ route('productDetail', $product->slug) }}" title=""
                                        class="product-name">{{ $product->name }}</a>
                                        @if ($product->sale_price !== 0.0)
                                        <div class="discount-product">
                                            <p class="discount">
                                                {{ format_discount($product->price, $product->sale_price) }} %
                                            </p>
                                            <p class="" style="color: #fff">giảm</p>
                                        </div>
                                    @endif
                                    <div class="price">
                                        <span class="new">{{ number_format($product->price, 0, '', '.') }}đ </span>
                                        @if ($product->sale_price !== 0.0)
                                            <span class="old">{{ number_format($product->sale_price, 0, '', '.') }}
                                                đ</span>
                                        @endif
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('addCart', $product->id) }}" title=""
                                            data-id="{{ $product->id }}" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="{{ route('buyNow', $product->id) }}" title="Mua ngay"
                                            class="buy-now fl-right">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <style>
                        .out-of-stock {
                            background-color: #ff4d4d;
                            color: #ffffff;
                            padding: 10px;
                            text-align: center;
                            border-radius: 5px;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                        }

                        .message {
                            font-weight: bold;
                            font-size: 18px;
                            text-transform: uppercase;
                        }
                    </style>
                    <h3 class="section-title">{{ $Category->name }}</h3>
                    <div class="section-detail">
                        <div class="out-of-stock">
                            <span class="message">Sản phẩm đã hết hàng</span>
                        </div>

                    </div>
                @endif


            </div>

            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        {{-- {{ $productByCate->links() }} --}}

                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">

                    <ul class="list-item">
                        {!! $renderMenu !!}
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($bestSellingProducts as $item)
                            <li class="clearfix">
                                <a href="{{ route('productDetail', $item['slug']) }}" title="" class="thumb fl-left">
                                    <img src="{{ url($item['images']) }}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{ route('productDetail', $item['slug']) }}" title=""
                                        class="product-name">{{ $item['name'] }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($item['price'], 0, '', '.') }} đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="{{ route('buyNow', $item['product_id']) }}" title="" class="buy-now">Mua
                                        ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
        #notification {
            display: none;
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 2.5rem 1.25rem;
            background-color: rgba(0, 0, 0, .7);
            color: white;
            font-size: 1.0625rem;
            min-width: 18.75rem;
            z-index: 9999;
            border-radius: 15px;
            opacity: 0.8;
        }

        .checkmark {
            display: inline-block;
            width: 20px;
            height: 25px;
            font-size: 37px;
            margin-right: 10px;
            vertical-align: middle;
            color: #0F9D58;
        }
    </style>
    <div id="notification">
        Sản phẩm đã được thêm vào giỏ hàng thành công
        <span class="checkmark">&#10004;</span>
    </div>

    <script>
        $(document).on('click', '.add-cart', function(event) {
            event.preventDefault();
            var productId = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'post',
                data: {
                    'product_id': productId,
                    // product_id: controller gửi qua  : productId lấy ở trên,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    $('.qtys').text(response.cartCount); // Tổng gio hang layouts
                    $('.total-price-lo').text(response.cartTotal);
                           // show listcart
                           var list_cart = response.list_cart;
                    $('#show-dropcart').empty()
                    $('#show-dropcart').append(list_cart)
                    $('#notification').show()
                    setTimeout(function() {
                        $('#notification').fadeOut('slow');
                    }, 1000);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                },
            });
        });
    </script>

    {{-- /sort product --}}
    <script>
        $(document).ready(function() {
            $('select[name="sortProdByCate"]').on('change', function() {
                var sortValue = $(this).val();
                $.ajax({
                    url: "{{ route('softProductsByCate', $category->slug) }}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        sortProdByCate: sortValue
                    },
                    success: function(response) {
                        var html_cate = response.html_cate;
                        // console.log(html_cate);
                        $('#productByCate').empty();
                        $('#productByCate').append(html_cate);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
@php
  
function format_discount($price, $sale_price)
{
    if ($price != 0) {
        $discount = (($sale_price - $price) / abs($price)) * 100;
        $discount = round($discount, 2);
        return $discount;
    }
    // Trường hợp giá trị ban đầu là 0, không thể tính phần trăm thay đổi
    return null;
}

@endphp
