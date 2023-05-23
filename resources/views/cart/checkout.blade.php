@extends('layout-client.layouts')
@section('content')
    <style>
        #order-success #order-end {
            text-align: center;
            margin-top: 50px;
        }

        .btn-check-mail {
            display: inline-block;
            padding: 10px 40px;
            text-transform: uppercase;
            border-radius: 3px;
            font-family: "Roboto Medium";
            font-weight: normal;
            border: none;
            outline: none;
            background: #7b9662;
            color: #fff;
            transition: all 0.3s;
            margin-top: 24px;
            margin-left: 20px;
        }
    </style>
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('homes') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="#" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if (Cart::count() > 0)
            <form action="{{ route('payment') }}" method="post">
                <div id="wrapper" class="wp-inner clearfix">
                    @csrf
                    <div class="section" id="customer-info-wp">
                        <div class="section-head">
                            <h1 class="section-title">Thông tin khách hàng</h1>
                        </div>
                        <div class="section-detail">
                            <form method="POST" action="" name="form-checkout">
                                <div class="form-row clearfix">
                                    <div class="form-col fl-left">
                                        <label for="fullname">Họ tên</label>
                                        <input type="text" name="fullname" id="fullname"
                                            placeholder="Họ tên người nhận">
                                        @error('fullname')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-col fl-right">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="abc@gmail.com">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row clearfix">
                                    <div class="form-col fl-left">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" name="address" id="address"
                                            placeholder="Ví dụ: số nhà A, Phường B">
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-col fl-right">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="tel" name="phone" id="phone" placeholder="1233749">
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- width: 100%;
                                padding: 6px 12px;
                                border: 1px solid #cccccc; --}}
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label for="notes">Ghi chú</label>
                                        <textarea name="note" placeholder="Thông tin chi tiết"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="section" id="order-review-wp">
                        <div class="section-head">
                            <h1 class="section-title">Thông tin đơn hàng</h1>
                        </div>
                        <div class="section-detail">
                            <table class="shop-table">
                                <thead>
                                    <tr>
                                        <td>Sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td style="text-align:right">Tổng</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infoProduct as $item)
                                        <tr class="cart-item">
                                            <td class="product-name">{{ $item->name }}</td>
                                            <td><strong class="product-quantity">{{ $item->qty }}</strong></td>
                                            <td style="text-align:right" class="product-total">
                                                {{ number_format($item->price, 0, '', '.') }}đ </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td style="position: absolute;right: 84px;"><strong
                                                class="total-price">{{ Cart::total() }}đ</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div id="payment-checkout-wp">
                                <ul id="payment_methods">
                                    <li>
                                        <input type="radio" id="payment-home" name="payment-method" value="1"
                                            checked>
                                        <label for="payment-home">Thanh toán tại nhà</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="direct-payment" name="payment-method" value="2">
                                        <label for="direct-payment">Thanh toán tại cửa hàng</label>
                                    </li>

                                </ul>
                            </div>
                            <div class="place-order-wp clearfix">
                                <input type="submit" id="order-now" value="Đặt hàng">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div id="order-end" class="end-order mt-5 " style="text-align: center">
                <p style="font-weight:600; font-size:1rem">Bạn chưa có sản phẩm trong giỏ hàng </p>
                <a href="{{ route('homes') }}" class="btn-check-mail">Về trang chủ</a>
            </div>
        @endif


    </div>
@endsection
