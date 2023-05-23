@extends('admin/layouts.dashboard')
@section('title','Danh mục bài viêt')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm danh mục
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.createCategoryPost') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">slug</label>
                                <input class="form-control" type="text" name="slug" id="slug">
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select name="cat_parent" class="form-control" id="">

                                    <option value="">Chọn danh mục</option>
                                    @php
                                        showCategoriesParent($cats);
                                    @endphp
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                        value="1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Công khai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                        value="2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Chờ duyệt
                                    </label>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục <span class="text-muted">(Có {{ $cats->count() }} danh mục)</span>
                    </div>
                    <div class="card-body">
                        @if ($cats)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">slug</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @php
                                        showCategoriesIndex($cats);
                                    @endphp


                                </tbody>
                            </table>
                        @else
                            <th colspan="3">Không có danh mục nào!</th>
                        @endif

                    </div>
                    {{ $cats->appends(request()->all())->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('create_slug')
    <script src="{{ asset('js/create_slug.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.deletebtn').click(function() {
                return confirm('bạn có muốn xóa ')
            });
        });
    </script>
@endsection


<?php
function showCategoriesParent($categories, $cat_parent = null, $char = '')
{
    foreach ($categories as $key => $cat) {
        // Nếu là chuyên mục con thì hiển thị
        if ($cat->cat_parent == $cat_parent) {
            // Xử lý hiển thị chuyên mục
            echo " <option value='$cat->id'> $char  $cat->name </option>";
            // Xóa chuyên mục đã lặp
            unset($categories->key);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategoriesParent($categories, $cat->id, $char . ' -- ');
        }
    }
}

function showCategoriesIndex($categories, $cat_parent = null, $char = '')
{
    $temp = 0;
    foreach ($categories as $key => $cat) {
        // Nếu là chuyên mục con thì hiển thị
        $temp++;
        if ($cat->cat_parent == $cat_parent) {
            // Xử lý hiển thị chuyên mục

            echo '<tr>';
            echo '<td>' . $temp. '</td>';
            echo '<td>' . $char . $cat->name . '</td>';
            echo '<td>' . $cat->slug . '</td>';
            echo '<td>';
            echo $cat->status == 1 ? 'Hiển thị' : 'Ẩn';
            echo '</td>';
            echo '<td>';
            echo '<a class = deletebtn href="' . route('admin.deletecatPost', $cat->id) . '" >Xóa</a>';
            echo '</td>';
            echo '</tr>';

            // Xóa chuyên mục đã lặp
            unset($categories->key);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategoriesIndex($categories, $cat->id, $char . ' -- ');
        }
    }
}

?>
