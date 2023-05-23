@extends('layout-client.layouts')
@section('style_css')
    <style>
        #order-success .section-head .mess-order>.img-alert {
            width: 50px;
            display: inline-block;
            height: 40px;
            object-fit: contain;
            margin-right: 8px;
        }

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

        #order-success #order-end .home {
            display: inline-block;
            padding: 10px 40px;
            text-transform: uppercase;
            border-radius: 3px;
            font-family: "Roboto Medium";
            font-weight: normal;
            border: none;
            outline: none;
            background: #1c59f5cd;
            color: #fff;
            transition: all 0.3s;
            margin-top: 24px;
        }

        #order-success .section-detail .product-bought .tfoot .total-price {
            text-align: center;
        }

        .table>tfoot>tr>td {
            border-top: none !important;
        }

        .table tbody {
            background: #fff;
        }

        .bg-white {
            background-color: #FFF !important;
        }

        #order-success .section-detail .product-bought .tfoot {
            text-transform: uppercase;
            font-weight: bold;
        }

        .product-bought tbody tr td.image-product-order img {
            max-width: 100px;
        }

        .tfoot td {
            border: 1px solid gray
        }

        #order-success .section-head .mess-order {
            color: #0dbf00;
            font-size: 30px;
            text-align: center;
            padding-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #order-success .section-detail .info-customer {
            font-size: 16px;
            color: green;
            margin-top: 18px;
            margin-bottom: 6px;
        }

        #order-success .section-head .mess-order~p,
        #order-end .mess-order-2 p {
            text-align: center;
            font-size: 18px;
            color: #796c6c;
        }
    </style>
@endsection
@section('content')
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="order-success">
            <div class="section-head">
                <p class="mess-order">
                    <img class="img-alert"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1024px-Flat_tick_icon.svg.png"
                        alt="">
                    <span>Đặt hàng thành công!</span>
                </p>
                <p> Cảm ơn quý khách đã đặt hàng tại hệ thống Ismart!</p>
                <p> Nhân viên chăm sóc Ismart sẽ liên hệ tới bạn sớm nhất có thể.</p>
            </div>
            <div class="section-detail mt-5">
                <h2 class="code_order" style="font-size: 17px"><b>Mã đơn hàng</b>:{{ $order->code }} </h2>
                <p> <b>Thời gian đặt hàng</b> : {{date_format($order->created_at,"d/m/Y - H:i:s" )}} </p>
                <h3 class="info-customer">Thông tin khách hàng</h3>
                <table class="table table-border mt-3">

                    <thead class="thead" style="background-color: #008000a8; color: #FFF;">
                        <tr>
                            <td>Họ và tên</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Địa chỉ</td>
                            <td>Ghi chú</td>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>

                            <td>{{ $order->fullname }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->note }}</td>

                    </tbody>
                </table>
            </div>
            <div class="section-detail mt-5">
                <h3 class="info-customer">Sản phẩm đã mua</h3>
                <table class="table table-border product-bought">

                    <thead class="thead" style="background-color: #008000a8; color: #FFF;">
                        <tr>
                            <td>STT</td>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                            $temp = 0;
                        @endphp
                        @foreach ($order_detail as $item)
                            @php
                                $temp++;
                            @endphp
                            <tr>
                                <td style="vertical-align: middle;">{{ $temp }}</td>
                                <td style="vertical-align: middle;">{{ $item['options']['code'] }}</td>
                                <td class="image-product-order"><img src="{{ url($item['options']['images']) }}"
                                        alt="">
                                </td>
                                <td style="vertical-align: middle;"> {{ $item['name'] }}</td>
                                <td style="vertical-align: middle;"> {{ number_format($item['price'], 0, '', '.') }}</td>
                                <td style="vertical-align: middle;"> {{ $item['qty'] }}</td>
                                <td style="vertical-align: middle;"> {{ number_format($item['subtotal'], 0, '', '.') }}đ
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="tfoot">
                        <tr>
                            <td class="total-price" colspan="5">Tổng tiền:</td>
                            <td colspan="5">{{ $order->totalCart }}đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div id="order-end" class="end-order mt-5">
                <p>Trước khi giao nhân viên sẽ gọi quý khách để xác nhận.</p>
                <p>Khi cần trợ giúp vui lòng gọi cho chúng tôi vào hotline: <a href="#">0364816xxx</a></p>
                <a href="{{ route('homes') }}" class="home">về trang chủ</a>
                <a target="_blank" href="https://mail.google.com/" class="btn-check-mail">Kiểm tra email</a>
            </div>
        </div>
    </div>

    {{-- <div id="order-end" class="end-order mt-5 " style="text-align: center">
            <p style="font-weight:600; font-size:1rem">Bạn chưa đặt hàng</p>
            <a href="{{ route('homes') }}" class="btn-check-mail">Về trang chủ</a>
        </div> --}}
@endsection
