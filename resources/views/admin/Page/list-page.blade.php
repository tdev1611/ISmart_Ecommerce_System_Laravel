@extends('admin/layouts.dashboard')
@section('title','Danh sách trang')

@section('style_css')
    <style>
        .custom-image {
            width: 80px;
            height: 80px;
        }
    </style>
@endsection
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control  form-search" name="key" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div id="notification" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <p class="text-danger ml-3">{{ session('warning') }}</p>
            @endif
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'active']) }}" class="text-primary">Hoạt động<span
                            class="text-muted">({{ $counts[0] }})</span></a>
                    <a href="{{ request()->fullUrlwithQuery(['status' => 'disable']) }}" class="text-primary">Vô hiệu
                        hóa<span class="text-muted">({{ $counts[1] }})</span></a>
                </div>

                {{-- form action --}}
                <form action="{{ url('admin/page/action') }}" method="post">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="action">
                            <option>Chọn</option>
                            @if (request()->status == 'disable')
                                <option value="restore">Khôi phục</option>
                                <option value="forceDelelte">Xóa vĩnh viễn</option>
                            @else
                                <option value="delete"> Xóa tạm thời</option>
                            @endif
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pages as $page)
                                <tr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <td>
                                                    <input type="checkbox" name="list_check[]" value="{{ $page->id }}">
                                                </td>
                                                <td scope="row">
                                                    {{ ($pages->currentPage() - 1) * $pages->perPage() + $loop->index + 1 }}
                                                </td>
                                                <td><img class="custom-image" src="{{ url($page->images) }}" alt="">
                                                </td>
                                            </div>
                                            <div class="col-md-9">
                                                <td><a href=""> {!! $page->title !!}</a></td>

                                                <td>{{ $page->created_at }}</td>
                                                <td>{{ $page->status == 1 ? 'Hiển thị' : 'Ẩn' }}</td>

                                                @if (request()->status == 'disable')
                                                    <td>
                                                        <a href="{{ route('admin.resotePage', $page->id) }}"
                                                            class="btn btn-success btn-sm rounded-0" type="button"
                                                            data-toggle="tooltip" data-placement="top" title="Khôi phục"><i
                                                                class="fas fa-trash-restore-alt"></i></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ url('admin/page/edit', $page->id) }}"
                                                            class="btn btn-success btn-sm rounded-0" type="button"
                                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="{{ url('admin/page/delete', $page->id) }}"
                                                            onclick="return confirm('Bạn có muốn xóa bài viết') "
                                                            class="btn btn-danger btn-sm rounded-0" type="button"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                @endif


                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                </form>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $pages->appends(request()->all())->links() }}

                    </ul>
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
