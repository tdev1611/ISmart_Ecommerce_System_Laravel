@extends('admin/layouts.dashboard')
@section('title','Danh sách bài viết')



@section('style_css')
    <style>
        img {
            height: 80px;
            width: 80px;
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
                        <input type="" class="form-control form-search" name="key" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <div class="analytic">
                    @foreach ($cat_posts as $cat_post)
                    <a href="{{ request()->fullUrlwithQuery(['status' =>$cat_post->name]) }}" class="text-primary">{{ $cat_post->name }}<span class="text-muted">({{ $cat_post->post->count() }})</span></a>
                    @endforeach
                   
                </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option>Tác vụ 1</option>
                        <option>Tác vụ 2</option>
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
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row">  {{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->index + 1 }}</td>
                                <td><img src="{{ url($post->images) }}" alt=""></td>
                                <td><a href="">{{ $post->title }}</a>
                                </td>
                                <td>{{ $post->category_post->name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.editPost', $post->id) }}"
                                        class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.deletePost', $post->id) }}"
                                        class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                        data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $posts->appends(request()->all())->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
