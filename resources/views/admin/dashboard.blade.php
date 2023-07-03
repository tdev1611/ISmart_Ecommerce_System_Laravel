@extends('admin/layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <style>
        .detail {
            color: #59636e;
        }

        .card-header a {
            color: #fff;
        }

        .card-header a:hover {
            color: #025464;
        }

        td span a {
            color: #fff;
        }
        /* product_views */
        #product_views {
            background:#fff;
            margin-bottom:30px;
        }
    </style>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header" style="padding:0px 15px"> <a
                            href="{{ url('admin/order/list?status=success') }}">ĐƠN HÀNG THÀNH CÔNG</a></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $counts->where('status', 3)->first()->total ?? 0 }} </h5>

                        {{-- @if (empty($counts))
                            <h5 class="card-title">0</h5>
                        @else
                            @foreach ($counts as $count)
                                @if ($count->status == 3)
                                    <h5 class="card-title">{{ $count->total }}</h5>
                                @endif
                            @endforeach
                        @endif --}}

                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem; height:177px">
                    <div class="card-header" style="padding:0px 15px"><a
                            href="{{ url('admin/order/list?status=waitprocessing') }}">ĐƠN HÀNG CHỜ XỬ LÝ</a></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $counts->where('status', 1)->first()->total ?? 0 }} </h5>
                        <p class="card-text">Số lượng đơn hàng đang chờ xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #dbaf17">
                    <div class="card-header"> <a href="{{ url('admin/order/list?status=processing') }}">ĐANG XỬ LÝ</a></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $counts->where('status', 2)->first()->total ?? 0 }} </h5>
                        <p class="card-text"> Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem; height:174px;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $total_sum_success }} </h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header"><a href="{{ url('admin/order/list?status=cancel') }}">ĐƠN HÀNG HỦY</a></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $counts->where('status', 4)->first()->total ?? 0 + $count_trash }} </h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Người đặt</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">
                                    {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->index + 1 }}
                                </th>
                                <td>{{ $order->code }}</td>
                                <td>
                                    <b> {{ $order->customer->name }}</b>
                                    <br>
                                    <b>{{ $order->customer->username }}</b>
                                </td>
                                <td>
                                    {{ $order->fullname }} <br>
                                    {{ $order->phone }}
                                </td>
                                <td>{{ $order->totalCart }} đ</td>
                                <td>
                                    @if ($order->status == 1)
                                        {{-- 1: chờ xử lý, 2: Đang xử lý , 3: Thành công, 4 hủy --}}
                                        <span class="badge badge-danger"><a
                                                href="{{ route('admin.detailOrder', $order->id) }}">Chờ xử lý</a></span>
                                    @elseif ($order->status == 2)
                                        <span class="badge badge-warning"><a
                                                href="{{ route('admin.detailOrder', $order->id) }}">Đang xử lý</a></span>
                                    @elseif ($order->status == 3)
                                        <span class="badge badge-success"><a
                                                href="{{ route('admin.detailOrder', $order->id) }}">Thành công</a></span>
                                    @else
                                        <span class="badge badge-secondary"><a
                                                href="{{ route('admin.detailOrder', $order->id) }}">Hủy đơn hàng</a></span>
                                    @endif

                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.detailOrder', $order->id) }}" class="detail">Chi tiết</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    {{ $orders->appends(request()->all())->links() }}
                </nav>
            </div>
        </div>

        {{-- talbe --}}

    </div>

    {{-- <div id="product_views"> --}}
        <div class="container-fluid" id="product_views">
            <div class="row">
                <div class="col-12">
                    <h5>Sản phẩm được xem nhiều nhất</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-info">
                                <th scope="col">#</th>
                                <th scope="col">views</th>
                                <th scope="col"  class="text-center">products</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    $temp = 0;
                                ?>
                            @foreach ($product_views as $product)
                                    <?php  $temp++?>
                            <tr>
                                <th scope="row">{{ $temp }}</th>
                                <td>{{ $product->view_count }}</td>
                                <td class="text-center"> <a target="_blank" href="{{ route('productDetail',$product->product->slug) }}">{{ $product->product->name }}</a></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
            
    {{-- </div> --}}
    
@endsection
