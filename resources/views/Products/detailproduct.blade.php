@extends('layout-client.layouts')
@section('style_css')
    <style>
        #main-thumb {
            position: relative;
            padding-bottom: 100%
        }

        #zoom {
            max-width: 100%;
        }

        .buy-nowde {
            display: inline-block;
            padding: 10px 30px;
            font-size: 16px;
            background: #ee5f4a;
            color: #fff;
            border-radius: 5px;
            text-transform: uppercase;
        }
        #detail-product-wp .add-cart:hover {
            background: #ee5f4a;
        }
        #detail-product-wp .add-cart {
            background: gray;
        }
        .section-detail {

            overflow: hidden;
        }

        .section-detail.expanded p {
            height: auto;
        }

        #expandButton {
            display: block;
            color: #fff;
            margin: 0 auto;
            line-height: 50px;
            width: 30%;
            border-radius: 30px;
            text-decoration: none;
            border: 3px #ee5f4a solid;
            background: #ee5f4a;
            opacity: 0.7;
            margin-bottom: 50px;
            text-align: center;
            cursor: pointer;
        }

        #expandButton:hover {
            background: #bc341f;
        }
    </style>
@endsection
@section('content')
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{ route('homes') }}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('productShows') }}" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            {{-- {{ route('cart.add', $product->id) }} --}}

            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="#" title="" id="main-thumb">
                            <img id="zoom" src="{{ url($product->images) }}"
                                data-zoom-image="{{ url($product->images) }}" />
                        </a>

                        <div id="list-thumb">
                            {{-- @foreach ($product as $item)
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                            @endforeach --}}

                            @php
                                 $list_images = json_decode($product->list_images,true);
                            @endphp
                        @foreach ($list_images as $item)
                            
                        <a href=""
                            data-image="{{ url(htmlspecialchars($item)) }}"
                            data-zoom-image="{{ url(htmlspecialchars($item)) }}">
                            <img id="zoom" src="{{ url(htmlspecialchars($item)) }}" />
                        </a>
                        @endforeach
                    



                        </div>


                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{ url($product->images) }}" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{ $product->name }}</h3>

                        <div class="desc">
                            <div id="description">
                                {!! $product->desc !!}
                            </div>
                        </div>

                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">{{ $product->status == 1 ? 'Còn hàng' : 'Hết hàng' }}</span>
                        </div>
                        <p class="price">{{ number_format($product->price, 0, '', '.') }}đ</p>

                        <form action="{{ route('buyNowDetail', $product->id) }}" method="get">
                            <div id="num-order-wp">
                                <a title="" name="num" id="minus"><i class="fa fa-minus"></i></a>
                                {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> --}}
                                <input type="text" name="num_order" value="1" id="num-order">
                                <a title="" name="num" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <input type="submit" value="Thêm giỏ hàng" name="btn_add_cart" title="Thêm giỏ hàng"
                                data-id="{{ $product->id }}" class="add-cart">
                            <input value="Mua Ngay" type="submit" name="buy_now" class="buy-nowde">
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">

                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>

                <div class="section-detail" style="height: 600px;">
                    <p> {!! $product->detail !!}</p>
                </div>
                <span id="expandButton">Mở rộng</span>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">

                        @foreach ($relatedProducts as $item)
                            <li style="height: 276px">
                                <a href="{{ route('productDetail', $item->slug) }}" title="" class="thumb">
                                    <img src="{{ url($item->images) }}">
                                </a>
                                <a href="{{ route('productDetail', $item->slug) }}" title=""
                                    class="product-name">{{ $item->name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                    <span class="old">20.900.000đ</span>
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
            var qty = $('#num-order').val();
            $.ajax({
                url: "{{ route('cart.addDetailajax') }}",
                method: 'post',
                data: {
                    'product_id': productId,
                    'qty': qty,
                    // product_id: $request->input controller gửi qua  - productId lấy ở trên,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {

                    $('.qtys').text(response.cartCount); // Tổng gio hang layouts
                    // $('#qty_per').text(response.qty_per)  // số lượng của mỗi sản phẩm layouts
                    $('.total-price-lo').text(response.cartTotal);
                    $('#notification').show()
                    // $('.list-cart').show()
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

    <script>
        $(document).ready(function() {

            $('#expandButton').click(function() {
                $(this).toggleClass('expand');
                if ($(this).hasClass('expand')) {
                    $(this).prev().removeAttr('style')
                    $(this).text('Thu gọn');
                } else {
                    $(this).text('Mở rộng');
                    $(this).prev().css('height', '600px')
                }

            });
        });
    </script>
@endsection
