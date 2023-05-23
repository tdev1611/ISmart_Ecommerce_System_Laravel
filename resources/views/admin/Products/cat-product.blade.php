@extends('admin/layouts.dashboard')
@section('title','Danh mục sản phẩm')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục sản phẩm
                    </div>
                    <div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.createCategory') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <div class="text-danger"> <small> {{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug category</label>
                                <input class="form-control" type="text" name="slug" id="slug">
                                @error('slug')
                                    <div class="text-danger"> <small> {{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prioty">Vị trí</label>
                                <input class="form-control" type="number" min="0" name="prioty" id="prioty"
                                    value="0" placeholder="0">
                                @error('prioty')
                                    <div class="text-danger"> <small> {{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select name="cat_parent" class="form-control" id="">

                                    <option value="">Chọn danh mục</option>
                                    @php
                                        showCategoriesParent($cat_products);
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
                        Danh sách danh mục
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">slug</th>
                                    <th scope="col">Vị trí</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    showCategoriesIndex($cat_products);
                                @endphp
                            </tbody>
                        </table>
                    </div>
                    <div class="ml-3">
                        {{ $cat_products->appends(request()->all())->links() }}
                    </div>
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
            echo '<td>' . $temp . '</td>';
            echo '<td>' . $char . $cat->name . '</td>';
            echo '<td>' . $cat->slug . '</td>';
            echo '<td>' . $cat->prioty . '</td>';
            echo '<td>';
            echo $cat->status == 1 ? 'Hiển thị' : 'Ẩn';
            echo '</td>';
            echo '<td>';
            echo '<a class = deletebtn href="' . route('admin.deletecatProduct', $cat->id) . '" >Xóa</a>';
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
