@extends('admin.layouts.dashboard')
@section('title','Chi tiết đơn hàng')

@section('content')
    <style>
        .font-weight-bold {
            margin-bottom: 2px;
        }

        img {
            width: 100px;
            height: 100px;
        }
    </style>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-body">

                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Thông tin khách hàng</h5>
                </div>
                @if (session('success'))
                    <div id="notification" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div>
                    <div>
                        <p class="font-weight-bold">Mã đơn hàng</p>
                        <p>{{ $order->code }}</p>
                    </div>
                    <div>
                        <p class="font-weight-bold">Địa chỉ</p>
                        <p>{{ $order->address }}</p>
                    </div>
                    <div>
                        <p class="font-weight-bold">Số điện thoại</p>
                        <p>{{ $order->phone }}</p>
                    </div>
                    <div>
                        <p class="font-weight-bold">Email</p>
                        <p>{{ $order->email }}</p>
                    </div>
                    <div>
                        <p class="font-weight-bold">Ghi chú đơn hàng</p>
                        <p>{{ $order->note }}</p>
                    </div>
                    <div>
                        <P class="font-weight-bold">Hình thức thanh toán</P>
                        <p>{{ $order->payment_method == 1 ? 'Thanh toán tại nhà' : 'Thanh toán online' }}</p>
                    </div>
                    <div>
                        {{-- 1: chờ xử lý, 2: Đang xử lý , 3: Thành công --}}
                        <P class="font-weight-bold">Tình trạng đơn hàng</P>
                        <form action="{{ route('order.update_status', $order->id) }}" method="post">
                            @csrf
                            @if ($order['status'] == 1)
                                <select style="text-align: center; width: 144px;" class="btn btn-danger" name="status">
                                    <option value="1" class="badge badge-danger"> Chờ xử lý </option>
                                    <option value="2" class="badge badge-warning">Đang xử lý </option>
                                    <option value="3" class="badge badge-success">Thành công </option>
                                    <option value="4" class="badge badge-secondary">Hủy đơn </option>
                                </select>
                            @elseif ($order->status == 2)
                                <select style="text-align: center; width: 144px;" class="btn btn-warning" name="status">
                                    <option value="2" class="badge badge-warning">Đang xử lý </option>
                                    <option value="1" class="badge badge-danger"> Chờ xử lý </option>
                                    <option value="3" class="badge badge-success">Thành công </option>
                                    <option value="4" class="badge badge-secondary">Hủy đơn </option>
                                </select>
                            @elseif ($order->status == 3)
                                <select style="text-align: center; width: 144px;" class="btn btn-success" name="status">
                                    <option value="3" class="badge badge-success">Thành công </option>
                                    <option value="1" class="badge badge-danger"> Chờ xử lý </option>
                                    <option value="2" class="badge badge-warning">Đang xử lý </option>
                                    <option value="4" class="badge badge-secondary">Hủy đơn </option>
                                </select>
                            @else
                                <select style="text-align: center; width: 144px;" class="btn btn-secondary" name="status">
                                    <option value="4" class="badge badge-secondary">Hủy đơn </option>
                                    <option value="3" class="badge badge-success">Thành công </option>
                                    <option value="1" class="badge badge-danger"> Chờ xử lý </option>
                                    <option value="2" class="badge badge-warning">Đang xử lý </option>
                                </select>
                            @endif
                            <button type="submit" class="btn btn-primary ml-4">Cập nhật trạng thái</button>
                        </form>

                    </div>



                    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center mt-4">
                        <h5 class="m-0 ">Sản phẩm đơn hàng</h5>
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">Mã</th>
                                <th scope="col">Ảnh sản phẩm</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Màu sắc</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $detail_order = json_decode($order->order_detail, true);
                                $temp = 0;
                            @endphp
                            @foreach ($detail_order as $item)
                                @php
                                    
                                    $temp++;
                                @endphp
                                <tr>
                                    <th scope="row">
                                        {{ $temp }}
                                    </th>
                                    <td>{{ $item['options']['code'] }}</td>
                                    <td>
                                        <img class="img-fluid" src="{{ url($item['options']['images']) }}" alt="">
                                    </td>
                                    <td>{{ $item['name'] }} </td>
                                    <td style="width: 125px;">{{ number_format($item['price'], 0, '', '.') }} đ</td>
                                    <td class="text-center"> {{ $item['qty'] }} </td>
                                    <td> color </td>

                                    <td>{{ number_format($item['subtotal'], 0, '', '.') }}đ</td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                    <div>
                        <div class="font-weight-bold d-flex justify-content-between align-items-center mt-4  "
                            style="text-transform: uppercase">
                            <h5 class="mt-4 ">Giá trị đơn hàng</h5>
                        </div>
                        <p class="text-danger mt-4">Tổng đơn hàng : <b>{{ $order->totalCart }} đ </b> </p>
                        <p>
                            <a onclick="return confirm('Bạn muốn xóa đơn hàng này!')"
                                href="{{ route('admin.deleteOrder', $order->id) }}"
                                class="btn btn-danger btn-sm rounded-0 text-white deleteOd" type="button"
                                data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('#notification').fadeOut('slow');
                }, 1000);
            })
        </script>
    @endsection
