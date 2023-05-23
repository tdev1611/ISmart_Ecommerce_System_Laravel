@extends('admin.layouts.dashboard')
@section('title','Danh sách đơn hàng')
@section('content')
    <style>
        .detail {
            color: #59636e;
        }
        td span a {
            color: #fff;
        }
        td span a:hover {
            color: #59636e;
        }
    </style>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách đơn hàng </h5>
                <div class="form-search form-inline">
                    <form action="">
                        <input type="search" name="key" value="{{ request()->input('key') }}"
                            class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if (session('success'))
                <div id="notification" class="alert alert-success w-25 " role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div id="notification" class="alert alert-danger w-25 " role="alert">
                    {{ session('warning') }}
                </div>
            @endif
            <div class="card-body">
                {{-- 1: chờ xử lý, 2: Đang xử lý , 3: Thành công, 4 hủy --}}
                <div class="mb-3 ">
                    <a class="mr-3" href="{{ route('admin.listOrder') }}">Tất cả ({{ $total_Count }})</a>
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'trash']) }}"> Thùng rác ({{ $count_trash }})</a>
                </div>
                <div class="analytic">
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'success']) }}" class="text-primary">Hoàn
                        thành<span class="text-muted">({{ $counts->where('status', 3)->first()->total ?? 0 }})</span></a>
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'processing']) }}" class="text-primary">Đang xử
                        lý<span class="text-muted">({{ $counts->where('status', 2)->first()->total ?? 0 }})</span></a>
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'waitprocessing']) }}"class="text-primary">Chờ xử
                        lý<span class="text-muted">({{ $counts->where('status', 1)->first()->total ?? 0 }})</span></a>
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'cancel']) }}" class="text-primary">Hủy đơn
                        hàng<span class="text-muted">({{ $counts->where('status', 4)->first()->total ?? 0 }})</span></a>
                </div>
                <form class="action" action="{{ route('order.action') }}" method="post">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select name="action" class="form-control mr-1" id="">
                            <option value="">Chọn</option>
                            @if (request('status') == 'trash')
                                <option value="forceDelelte">Xóa vĩnh viễn</option>
                                <option value="restore">Khôi phục</option>
                            @else
                                <option value="delete">Xóa tạm thời</option>
                            @endif


                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>

                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Mã</th>
                                <th scope="col">Người đặt</th>
                                <th scope="col">Khách hàng</th>

                                <th scope="col">Giá trị</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Chi tiêt</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        @if ($orders->count() > 0)
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" data={{ $item->id }} value="{{ $item->id }}">
                                        </td>
                                        <th scope="row">
                                            {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            <b> {{ $item->customer->name }}</b>
                                            <br>
                                            <b>{{ $item->customer->username }}</b>
                                        </td>
                                        <td>
                                            {{ $item->fullname }} <br>
                                            {{ $item->phone }}
                                        </td>


                                        <td> {{ $item->totalCart }} đ </td>
                                        <td>
                                            {{-- <span class="badge badge-warning">Đang xử lý</span> --}}
                                            @if ($item->status == 1)
                                                <span class="badge badge-danger"><a href="{{ route('admin.detailOrder',$item->id) }}">Chờ xử lý</a> </span>
                                            @elseif ($item->status == 2)
                                                <span class="badge badge-warning"><a href="{{ route('admin.detailOrder',$item->id) }}">Đang xử lý</a> </span>
                                            @elseif ($item->status == 3)
                                                <span class="badge badge-success"><a href="{{ route('admin.detailOrder',$item->id) }}">Thành công</a> </span>
                                            @else
                                                <span class="badge badge-secondary"><a href="{{ route('admin.detailOrder',$item->id) }}">Hủy đơn hàng</a> </span>
                                            @endif

                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a href="{{ route('admin.detailOrder', $item->id) }}" class="detail">Chi
                                                tiết</a>
                                        </td>
                                        @if (request('status') == 'trash')
                                            <td class="d-flex">
                                                <a href="{{ route('order.restoreorder', $item->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 mr-1" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Khôi phục"><i
                                                        class="fas fa-trash-restore-alt"></i></a>

                                                <a onclick="return confirm('Bạn muốn xóa đơn hàng này!')"
                                                    href="{{ route('order.forceDelelte', $item->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white deleteOd"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Xóa vĩnh viễn"><i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <a onclick="return confirm('Bạn muốn xóa đơn hàng này!')"
                                                    href="{{ route('admin.deleteOrder', $item->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white deleteOd"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>
                        @else
                            <tr>
                                <td colspan="10">Không có đơn hàng nào</td>
                            </tr>
                        @endif

                    </table>
                </form>
                <nav aria-label="Page navigation example">
                    {{ $orders->appends(request()->all())->links() }}
                </nav>
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
