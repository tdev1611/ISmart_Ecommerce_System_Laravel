@extends('layout-client.layouts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

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

        .text-danger {
            color: red
        }

        /* loading */

        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;

        }

        .loading-text {
            position: absolute;
            top: 40%;
            left: 34%;
            font-size: 20px;
            color: white;
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
                                        <input type="text" name="fullname" id="fullname" placeholder="Họ tên người nhận"
                                            value="{{ old('fullname', session('fullname')) }}">
                                        @error('fullname')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-col fl-right">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="abc@gmail.com"
                                            value="{{ old('email', session('email')) }}">
                                        @error('email')
                                            <p class="text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row clearfix">
                                    <div class="form-col fl-left">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" name="address" id="address"
                                            placeholder="Ví dụ: số nhà A, Phường B"
                                            value="{{ old('address', session('address')) }}">
                                        @error('address')
                                            <p class="text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-col fl-right">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="tel" name="phone" id="phone" placeholder="1233749"
                                            value="{{ old('phone', session('phone')) }}" pattern="[0-9]{10}">
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
                                        <textarea name="note" placeholder="Thông tin chi tiết"> {{ old('note') }}</textarea>
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
                                        <input type="radio" id="payment-home" name="payment_method" value="1"
                                            checked>
                                        <label for="payment-home" class="btn ">Thanh toán tại nhà</label>

                                    </li>
                                    <li>
                                        <input type="radio" id="direct-payment"   name="payment_method" value="2">
                                        <label for="direct-payment" data-toggle="modal" data-target="#exampleModal"
                                            class="btn ">Thanh toán online</label>

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
    <!-- Modal -->

    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chuyển khoản online
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="PaymentContent_container-modal d-flex container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="PaymentContent_left-modal">
                                    <div class="course-name"><span class="PaymentContent_modal-subtitle__JcvUU">Tên
                                            khóa học:</span>
                                        <h2 class="PaymentContent_sub-title__9eyIH Title_wrapper__QLUyI">
                                            <p>HTML CSS Pro</p>
                                        </h2>
                                    </div>
                                    <div class="PaymentContent_order-code"><span class="PaymentContent_modal-subtitle">Mã
                                            đơn
                                            hàng:</span>
                                        <h2 lass="PaymentContent_sub-title">
                                            <p>F8C1A7QU</p>
                                        </h2>
                                    </div>
                                    <hr class="PaymentContent_divider__8tgr5">

                                    <hr class="PaymentContent_divider__8tgr5">
                                    <div class="PaymentContent_modal-price"><span
                                            class="PaymentContent_modal-subtitle">Chi
                                            tiết thanh toán:</span>
                                        <div class="PaymentContent_price-wrapper">
                                            <div class="PaymentContent_price-box"><span
                                                    class="PaymentContent_price-desc">Giá
                                                    bán:</span>
                                                <span
                                                    class="PaymentContent_price-detail"><del>2,499,000đ</del><span>1,299,000đ</span></span>
                                            </div>
                                            <div class="PaymentContent_divider"></div>
                                            <div class="PaymentContent_price-box PaymentContent_total-price">
                                                <span class="PaymentContent_price-desc">Tổng
                                                    tiền:</span>
                                                <span class="PaymentContent_price-final">1,299,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="PaymentContent_right-modal">
                                    <div class="right-modal-middle">
                                        <h2 class="PaymentContent_title">
                                            <p class="pay-option">Chuyển khoản bằng QR
                                            </p>
                                        </h2>
                                        <div class="container_PaymentContent_qr-code">
                                            <div class="PaymentContent_qr-code">
                                                <img
                                                    src="https://img.vietqr.io/image/Vietcombank-9353538222-znVvEh.jpg?accountName=Cong%20Ty%20Co%20Phan%20Cong%20Nghe%20Giao%20duc%20F8&amp;amount=1299000&amp;addInfo=F8C1A7QU">
                                            </div>
                                            <ul class="PaymentContent_instruction">
                                                <li>Bước 1: Mở app ngân hàng hoặc Momo
                                                    và quét
                                                    mã QR.</li>
                                                <li>Bước 2: Đảm bảo nội dung chuyển
                                                    khoản là
                                                    <span class="order-code">F8C1A7QU</span>.
                                                </li>
                                                <li>Bước 3: Thực hiện thanh toán.</li>
                                            </ul>
                                        </div>
                                        <h2 class="PaymentContent_title Title_wrapper">
                                            <p class="pay-option">Chuyển khoản thủ công
                                            </p>
                                        </h2>
                                        <div class="PaymentContent_bank-info">
                                            <div class="PaymentContent_bank-info-item">
                                                <div class="PaymentContent_label">
                                                    Số
                                                    tài khoản</div>
                                                <div class="PaymentContent_content">
                                                    03891815401
                                                </div>
                                            </div>
                                            <div class="PaymentContent_bank-info-item">
                                                <div class="PaymentContent_label">
                                                    Tên tài khoản</div>
                                                <div class="PaymentContent_content">
                                                    Trịnh Đức Hải</div>
                                            </div>
                                            <div class="PaymentContent_bank-info-item">
                                                <div class="PaymentContent_label">
                                                    Nội dung</div>
                                                <div class="PaymentContent_content">
                                                    <span class="order-code">F8C1A7QU</span>
                                                </div>

                                            </div>
                                            <div class="PaymentContent_bank-info-item">
                                                <div class="PaymentContent_label">
                                                    Chi nhánh</div>
                                                <div class="PaymentContent_content">
                                                    Hà Nội</div>
                                            </div>
                                        </div>
                                        <h2 class="PaymentContent_title Title_wrapper">
                                            <p class="pay-option"> Lưu ý
                                            </p>
                                            <p>Sau khi chuyển khoản thành công bạn nhấn vào <b>Xác nhận</b>
                                                và ra bên ngoài nhấn <b>Đặt hàng</b>
                                                và thông tin sẽ được gửi đến mail của bạn
                                            </p>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Xác nhận</button>

                </div>
            </div>
        </div>
    </div> --}}


 

    {{-- end-modaul  --}}
    <div id="loading-overlay">
        <div class="loading-text">Đang gửi thông tin đơn hàng đến email của bạn!
            <div class="spinner-border text-warning">
                <span class="sr-only">Loading</span>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#order-now').click(function() {
                //hiệu ứng chờ
                $('#loading-overlay').show();

                $.ajax({
                    url: "{{ route('payment') }}",
                    type: 'POST',
                    success: function(response) {
                        // Trả về view 'thank-order' 
                        $('#loading-overlay').hide();
                        window.location.href = '/dat-hang-thanh-cong';
                    },
                    error: function(xhr) {

                    }
                });
            });
        });
    </script>


@endsection
