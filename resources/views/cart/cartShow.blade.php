@extends('layout-client.layouts')


@section('style_css')
    <style>
        .empty {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            padding: 72px 0;
        }

        .c-cart .btn-primary:hover {
            border: none;
        }

        .empty img {
            width: 100px;
            margin: 0 auto 8px;
        }

        .empty .text {
            margin-bottom: 16px;

        }

        .btn-lg {
            padding: 6px 16px;
            height: 36px;
            border-radius: 6px;
            display: inline-flex;

        }

        .btn-primarys {
            color: #fff;
            background: #cb1c22;
            outline: none;
        }

        .quantity-input,
        .price-input {
            width: 100px;
        }
    </style>
@endsection
@section('content')
    <div id="main-content-wp" class="cart-page">
        @if (Cart::count() > 0)
            <div class="section" id="breadcrumb-wp">
                <div class="wp-inner">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <a href="{{ route('homes') }}" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="{{ route('cartshow') }}" title="">Giỏ hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="wrapper" class="wp-inner clearfix">

                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        <form action="{{ route('cart.updateAjax') }}" class="update-cart">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Mã sản phẩm</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr name="rowId" data-id="{{ $item->rowId }}">
                                            <td>{{ $item->options->code }}</td>
                                            <td>
                                                {{-- {{ route('productDetail', $item->options->slug) }} --}}
                                                <a href="{{ route('productDetail', $item->options->slug) }}" title=""
                                                    class="thumb">
                                                    <img src="{{ url($item->options->images) }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" title=""
                                                    class="name-product">{{ $item->name }}</a>
                                            </td>
                                            <td data-price="{{ $item->price }}" class="price" name="price">
                                                {{ number_format($item->price, 0, '', '.') }}đ</td>
                                            <td>
                                                <input style="text-align: center" type="number" name="quantity"
                                                    min="1" data="{{ $item->rowId }}" value="{{ $item->qty }}"
                                                    class="quantity-input total-quantity">
                                            </td>
                                            <td class="subtotal">{{ number_format($item->total, 0, '', '.') }}đ</td>
                                            <td>
                                                <a href="{{ route('cart.remove', $item->rowId) }} " title=""
                                                    class="del-product"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span
                                                        class="total-price total-price-cart-show">{{ Cart::total() }}đ</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <div class="fl-right">

                                                    <a href="{{ route('showCheckCount') }}" title=""
                                                        id="checkout-cart">Thanh toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng
                            <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.
                        </p>
                        <a href="" title="" id="buy-more">Mua tiếp</a><br />
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa giỏ hàng')"
                            href="{{ route('cart.destroy') }}" title="" id="delete-cart">Xóa giỏ hàng</a>
                    </div>
                </div>
            @else
                <div class="c-cart">
                    <div class="empty"><img src="{{ asset('empty-cart.png') }}" alt="">
                        <div class="text">Không có sản phẩm nào trong giỏ hàng</div><a href="{{ route('homes') }}"
                            class="btn btn-primarys btn-lg">VỀ TRANG CHỦ</a>
                    </div>
                </div>


            </div>
        @endif
    </div>



@endsection


@section('ajax')
    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện thay đổi số lượng sản phẩm
            $('.total-quantity').change(function(event) {
             
                // Lấy giá trị số lượng sản phẩm và rowId của sản phẩm tương ứng
                var quantity = $(this).val();
                var rowId = $(this).closest('tr').data(
                    'id'); // lấy giá trị của thuộc tính data-id từ thẻ HTML cha gần nhất có chứa nó. 
                //Trong trường hợp này, thẻ HTML cha gần nhất có chứa thuộc tính data-id là thẻ tr,Do đó, $(this).closest('tr') sẽ trả về đối tượng jQuery của thẻ tr mà đang chứa phần tử được gọi, và .data('id') sẽ trả về giá trị của thuộc tính data-id của thẻ tr đó.
                // let id = $(this).attr('data')
                // Gửi yêu cầu Ajax đến route để update giỏ hàng
                $.ajax({
                    url: "{{ route('cart.updateAjax') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        rowId: rowId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        // Nếu update giỏ hàng thành công, cập nhật số lượng và giá tiền sản phẩm tương ứng
                        $('tr[data-id="' + rowId + '"] .subtotal').text(data.subtotal);
                        $('.total-price-lo').text(data.total);
                        $('.total-price-cart-show').text(data.total);
                        $('.qtys').text(data.cartCount); // só lượng ở layouts

                        //show qty_per layout
                        $('#qty_per[data-id="' + rowId + '"]').text(data.quantity);

                        console.log($('#qty_per[data-id="' + rowId + '"]').text(data.quantity));
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Xử lý lỗi nếu có
                    }
                });
            });

        });
    </script>
@endsection
