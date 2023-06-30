{{-- @extends('layout-client.layouts') --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


{{-- @section('content') --}}
<link rel="stylesheet" href="{{ url('resources/css/pay-online.css') }}">

<div id="wrapper" class="wp-inner clearfix">
    <div class="section">
        <!-- Modal -->
        <div class=" " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Thanh toán online
                        </h4>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="PaymentContent_container-modal d-flex container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="PaymentContent_left-modal">
                                        {{-- <div class="course-name"><span class="PaymentContent_modal-subtitle__JcvUU">Tên
                                        khóa học:</span>
                                    <h2 class="PaymentContent_sub-title__9eyIH Title_wrapper__QLUyI">
                                        <p>HTML CSS Pro</p>
                                    </h2>
                                </div> --}}
                                        <div class="PaymentContent_order-code">
                                            <span class="PaymentContent_modal-subtitle">Mã
                                                đơn
                                                hàng:</span>
                                            <h2 lass="PaymentContent_sub-title">
                                                <p class="order-code">{{ $order->code }}</p>
                                            </h2>
                                        </div>
                                        <hr class="PaymentContent_divider__8tgr5">
                                   
                                            
                                        
                                        
                                       

                                        <hr class="PaymentContent_divider__8tgr5">
                                        <div class="PaymentContent_modal-price"><span
                                                class="PaymentContent_modal-subtitle">Thanh toán:</span>
                                            <div class="PaymentContent_price-wrapper">
                                                
                                                <div class="PaymentContent_divider"></div>
                                                <div class="PaymentContent_price-box PaymentContent_total-price">
                                                    <span class="PaymentContent_price-desc"><b>Tổng
                                                        tiền:</b></span>
                                                    <span
                                                        class="PaymentContent_price-final">{{ $order->totalCart }}đ</span>
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
                                                        <span class="order-code">{{ $order->code }}</span>.
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
                                                        <span class="order-code">{{ $order->code }}</span>
                                                    </div>

                                                </div>
                                                <div class="PaymentContent_bank-info-item">
                                                    <div class="PaymentContent_label">
                                                        Chi nhánh</div>
                                                    <div class="PaymentContent_content">
                                                        Hà Nội</div>
                                                </div>
                                            </div>
                                            <div class="PaymentContent_title Title_wrapper">
                                                <p class="pay-option"> Lưu ý </p>
                                                <p>Sau khi chuyển khoản thành công bạn vui lòng nhấn <b>Xác nhận</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('thanksOrder') }}" type="button" class="btn btn-secondary">Xác nhận</a>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
{{-- @endsection --}}
