@extends('layout-client.layouts')



@section('content')
    <style>
        #feature-product-wp .section-title,
        #list-product-wp .section-title {
            font-size: 21px;
            text-transform: uppercase;
            line-height: normal;
            margin: 40px 0px 20px 0px;
        }
    </style>
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <div class="item">
                            <img src="{{ asset('/client/public/images/slider-01.png') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('/client/public/images/slider-02.png') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('/client/public/images/slider-03.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-1.png') }}">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển</h3>
                                <p class="desc">Tới tận tay khách hàng</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-2.png') }}">
                                </div>
                                <h3 class="title">Tư vấn 24/7</h3>
                                <p class="desc">1900.9999</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-3.png') }}">
                                </div>
                                <h3 class="title">Tiết kiệm hơn</h3>
                                <p class="desc">Với nhiều ưu đãi cực lớn</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-4.png') }}">
                                </div>
                                <h3 class="title">Thanh toán nhanh</h3>
                                <p class="desc">Hỗ trợ nhiều hình thức</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-5.png') }}">
                                </div>
                                <h3 class="title">Đặt hàng online</h3>
                                <p class="desc">Thao tác đơn giản</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($featured as $item)
                                <li style="height: 276px">
                                    <a href="{{ route('productDetail', $item->slug) }}" title="" class="thumb">
                                        <img src="{{ $item->images }}">
                                    </a>
                                    <a href="{{ route('productDetail', $item->slug) }}" title=""
                                        class="product-name">{{ $item->name }}</a>
                                    @if ($item->sale_price !== 0.0)
                                        <div class="discount-product">
                                            <p class="discount">
                                                {{ format_discount($item->price, $item->sale_price) }} %
                                            </p>
                                            <p class="" style="color: #fff">giảm</p>
                                        </div>
                                    @endif
                                    <div class="price">
                                        <span class="new">{{ number_format($item->price, 0, '', '.') }}đ </span>
                                        @if ($item->sale_price !== 0.0)
                                            <span class="old">{{ number_format($item->sale_price, 0, '', '.') }}
                                                đ</span>
                                        @endif
                                    </div>
                                    <div class="action clearfix" style="display: flex; justify-content: space-between;">
                                        <a href="" data-id="{{ $item->id }}" title="Thêm giỏ hàng"
                                            class="add-cart fl-left">Thêm giỏ
                                            hàng</a>
                                        <a href="{{ route('buyNow', $item->id) }}" title="Mua ngay"
                                            class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                {{-- product-sale --}}

                {{-- end-product-sale --}}
                @foreach ($categories as $category)
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            {{-- danh muc co sp thi duoc xuât lên --}}
                            @if ($category->productsWCRecursive()->count() > 0)
                                <h3 class="section-title">{{ $category->name }}</h3>
                            @endif
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                @foreach ($category->productsWCRecursive() as $product)
                                    <li style="height: 276px" class="li-product">
                                        {{-- {{ route('productDetail', $product->slug) }} --}}
                                        <a href="{{ route('productDetail',  $product->slug) }}"
                                            title="" class="thumb">
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

                                        {{-- <div class="price">
                                            <span class="new">{{ number_format($product->sale_price, 0, '', '.') }}
                                                đ</span>
                                            @if ($product->sale_price !== 0.0)
                                                <span class="old">{{ number_format($product->price, 0, '', '.') }}
                                                    đ</span>
                                            @endif
                                        </div> --}}
                                        @if ($product->sale_price !== 0.0)
                                            <div class="price">
                                                <span class="new">{{ number_format($product->sale_price, 0, '', '.') }}
                                                    đ</span>
                                                @if ($product->sale_price !== 0.0)
                                                    <span class="old">{{ number_format($product->price, 0, '', '.') }}
                                                        đ</span>
                                                @endif
                                            </div>
                                        @else
                                            <div class="price">
                                                @if ($product->sale_price !== 0.0)
                                                    <span class="old">{{ number_format($product->price, 0, '', '.') }}
                                                        đ</span>
                                                @else
                                                    <span class="new">{{ number_format($product->price, 0, '', '.') }}
                                                        đ</span>
                                                @endif
                                            </div>
                                        @endif



                                        <div class="action clearfix" style="display: flex; justify-content: space-between;">
                                            {{-- {{ route('cart.add', $product->id) }} --}}
                                            <a href="" data-id="{{ $product->id }}" title="Thêm giỏ hàng"
                                                class="add-cart fl-left">Thêm giỏ
                                                hàng</a>
                                            <a href="{{ route('buyNow', $product->id) }}" title="Mua ngay"
                                                class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                @endforeach

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
                                    <a href="{{ route('productDetail', $item['slug']) }}" title=""
                                        class="thumb fl-left">
                                        <img src="{{ url($item['images']) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('productDetail', $item['slug']) }}" title=""
                                            class="product-name">{{ $item['name'] }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($item['price'], 0, '', '.') }} đ</span>
                                            {{-- @if ($item->sale_price !== 0.0)
                                                <span class="old">{{ number_format($item->sale_price, 0, '', '.') }}
                                                    đ</span>
                                            @endif --}}
                                        </div>
                                        <a href="{{ route('buyNow', $item['product_id']) }}" title=""
                                            class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            {{-- <img src="{{ asset('client/public/images/banner.png') }}" alt=""> --}}
                        </a>
                    </div>
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
                    $('.qtys').text(response.cartCount);
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
