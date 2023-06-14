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
    </style>
@endsection
@section('content')
    <div class="wp-inner">
        @if ($products->count() > 0)
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('homes') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('productShows') }}" title="">Điện thoại</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main-content fl-right">
                <h3 style="font-size: 24px; margin-bottom:30px">Kết quả tìm kiếm cho từ khóa: <b>'{{ $searchIndex }}'</b>
                </h3>
                <div class="section " id="list-product-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">

                            @foreach ($products as $item)
                                <li style="height: 276px">
                                    <a href="{{ route('productDetail', $item->slug) }}" title="" class="thumb">
                                        <img src="{{ url($item->images) }}">
                                    </a>
                                    <a href="{{ route('productDetail', $item->slug) }}" title="" class="product-name">
                                        {{ $item->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('addCart', $item->id) }}" data-id="{{ $item->id }}"
                                            title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                            hàng</a>
                                        <a href="{{ route('buyNow', $item->id) }}" title="Mua ngay"
                                            class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach


                        </ul>

                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            {{ $products->appends(request()->all())->links() }}
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
                    <div class="section-detail">
                        {{-- <form method="POST" action="">
                                <table>
                                    <thead>
                                        <tr>
                                            <td colspan="2">Giá</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>Dưới 500.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>500.000đ - 1.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>1.000.000đ - 5.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>5.000.000đ - 10.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>Trên 10.000.000đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <td colspan="2">Hãng</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="r-brand"></td>
                                            <td>Acer</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-brand"></td>
                                            <td>Apple</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-brand"></td>
                                            <td>Hp</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-brand"></td>
                                            <td>Lenovo</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-brand"></td>
                                            <td>Samsung</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-brand"></td>
                                            <td>Toshiba</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <td colspan="2">Loại</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>Điện thoại</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="r-price"></td>
                                            <td>Laptop</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form> --}}
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
        @else
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('homes') }}" title="">Trang chủ</a>
                        </li>

                    </ul>
                </div>
            </div>
            <style>
                .not-found {
                    border-bottom: 1px solid #ddd;
                }

                .no-products-found {
                    background-color: #f9f9f9;

                    border-radius: 5px;
                    padding: 20px;
                    text-align: center;
                    margin: 6.25rem 0 7.5rem;
                }

                .no-products-found img {
                    width: 8.375rem;
                }

                .img {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .no-products-found h2 {
                    font-size: 28px;
                    margin-bottom: 10px;
                }

                .no-products-found p {
                    font-size: 16px;
                    margin-bottom: 0;
                }
            </style>
            <div class="not-found">
                <div class="no-products-found">
                    <div class="img">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/a60759ad1dabe909c46a817ecbf71878.png"
                            class="shopee-search-empty-result-section__icon ">
                    </div>
                    <h2>Không tìm thấy sản phẩm nào</h2>
                    <p>Xin lỗi, không có sản phẩm nào khớp với kết quả tìm kiếm của bạn.</p>
                </div>
            </div>
        @endif
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
