@extends('layout-client.layouts')
@section('style_css')
    <style>
        #feature-product-wp .section-title,
        #list-product-wp .section-title {
            font-size: 21px;
            text-transform: uppercase;
            line-height: normal;
            margin: 2px 0px 56px 0px;
        }

        #filter_product_by_price h3 {
            font-size: 20px;
            margin-bottom: 12px;
            font-weight: 550;
            color: #333333;
        }

        #filter_product_by_price .filter_content_item {
            margin-bottom: 8px;
            display: block;
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
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Sản Phẩm</h3>
                    <div class="filter-wp fl-right">
                        {{-- <p class="desc">Hiển thị 45 trên 50 sản phẩm</p> --}}
                        <div class="form-filter">
                            <form method="get" action="{{ route('products.sort') }}">
                                <select name="sort">
                                    <option value="name_asc">Sắp xếp</option>
                                    <option value="name_asc">Từ A-Z</option>
                                    <option value="name_desc">Từ Z-A</option>
                                    <option value="price_desc">Giá cao xuống thấp</option>
                                    <option value="price_asc">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Sắp xếp</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section" id="list-product-wp">

                    <div class="section-detail">
                        <ul class="list-item clearfix" id="filteredResults">
                            @foreach ($sortdProducts as $product)
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
                                        <span class="new">{{ number_format($product->price, 0, '', '.') }} đ</span>
                                        @if ($product->sale_price !== 0.0)
                                            <span class="old">{{ number_format($product->sale_price, 0, '', '.') }}
                                                đ</span>
                                        @endif
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('addCart', $product->id) }}" title="Thêm giỏ hàng"
                                            data-id="{{ $product->id }}" class="add-cart fl-left">Thêm giỏ
                                            hàng</a>
                                        <a href="{{ route('buyNow', $product->id) }}" title="Mua ngay"
                                            class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                          
                        </ul>
                    </div>
                </div>

            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        {{ $sortdProducts->appends(request()->all())->links() }}

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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail" id="filter_product_by_price">
                    <h3>Giá</h3>
                    <form action="" method="get" id="filterForm">
                        @csrf
                        <input type="hidden" name="_token" value="">
                        <div class="filter_content">
                            <div class="filter_content_item">
                                <input type="radio" name="filter_price_ajax" id="price_1" value="500000">
                                <label for="price_1">Dưới 500.000 VNĐ</label>
                            </div>
                            <div class="filter_content_item">
                                <input type="radio" name="filter_price_ajax" id="price_2" value="1000000">
                                <label for="price_2">500.000 VNĐ - 1.000.000 VNĐ</label>
                            </div>
                            <div class="filter_content_item">
                                <input type="radio" name="filter_price_ajax" id="price_3" value="5000000">
                                <label for="price_3">1.000.000 VNĐ - 5.000.000 VNĐ</label>
                            </div>
                            <div class="filter_content_item">
                                <input type="radio" name="filter_price_ajax" id="price_4" value="10000000">
                                <label for="price_4">5.000.000 VNĐ - 10.000.000 VNĐ</label>
                            </div>
                            <div class="filter_content_item">
                                <input type="radio" name="filter_price_ajax" id="price_5" value="10000001">
                                <label for="price_5">Trên 10.000.000 VNĐ</label>
                            </div>
                            <div class="filter_content_item">
                                <input type="radio" name="filter_price_ajax" id="price_6" value="999999999">
                                <label for="price_6">Tất cả các sản phẩm</label>
                            </div>
                        </div>
                        <button type="submit">Lọc</button>

                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- add ajax --}}
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
    {{-- // fullter prodcut --}}



    <script></script>
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
