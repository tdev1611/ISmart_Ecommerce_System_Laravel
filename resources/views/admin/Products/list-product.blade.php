@extends('admin/layouts.dashboard')
@section('title','Danh sách sản phẩm')

@section('style_css')
    <style>
        img {
            width: 80px;
            height: 80px;
        }
    </style>
@endsection
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <div class="form-search form-inline">
                    <form action="{{ route('admin.listProduct') }}">
                        @csrf
                        <input type="" class="form-control form-search" name="key" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" id="notification">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <div class="analytic mb-2">
                    <a href="{{ route('admin.listProduct') }}" class="text-primary">Số lượng danh sách <span
                            class="text-muted">({{ $cat_products->count() }})</span></a>
                </div>

                <div class="analytic">
                    {{-- @foreach ($cat_products as $cat)
                        <a href="{{ request()->fullUrlwithQuery(['prodCount' => $cat->name]) }}"
                            class="text-primary">{{ $cat->name     }}
                            <span class="text-muted">({{ $cat->product->count()  }})
                            </span>
                        </a>
                    @endforeach --}}
                    {{-- @foreach ($arrays as $array)
                        <a href="" class="text-primary">{{ $array->name }}<span class="text-muted">({{ $array->count }} )</span></a>
                    @endforeach --}}


                </div>


                <form action="{{ route('admin.actionProduct') }}" method="post">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select name="action" class="form-control mr-1" id="">
                            <option>Chọn</option>
                            <option value="delete">Xóa</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    @if (session('warning'))
                        <p class="text-danger">{{ session('warning') }}</p>
                    @endif
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Sản phẩm nổi bật</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Lượt xem</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if ($products->total() > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <input value="{{ $product->id }}" type="checkbox" name="list_check[]">
                                        </td>
                                        <td scope="row">
                                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td><img src="{{ url($product->images) }}" alt=""></td>
                                        <td style="width: 257px;"><a href="#">{{ $product->name }}</a></td>
                                        <td>{{ $product->featured_products == 1 ? 'Có' : 'Không' }}</td>
                                        <td>{{ number_format($product->price, 0, '', '.') }}đ</td>
                                        <td>{{ $product->category_product->name }} </td>
                                        <td>
                                                {{ $product->views->sum('view_count') }}   
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                        {{-- <td><span class="badge badge-success">Còn hàng</span></td> --}}
                                        <td>{{ $product->status == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                                        <td style="display: flex;margin-top: 27px;">
                                            <a href="{{ route('admin.editProduct', $product->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white mr-1" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.deleteProduct', $product->id) }}"
                                                onclick="return confirm('Bạn muốn xóa sản phẩm này?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="9">
                                    <p class="text-muted">Không có bản ghi nào </p>
                                </td>
                            @endif
                        </tbody>

                    </table>
                </form>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $products->appends(request()->all())->links() }}
                    </ul>
                </nav>


            </div>
        </div>
    </div>
    <script>
        $('#notification').show()
        setTimeout(function() {
            $('#notification').fadeOut('slow');
        }, 1000);
    </script>
@endsection
