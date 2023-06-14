@extends('admin/layouts.dashboard')
@section('title', 'Chỉnh sửa sản phẩm')

@section('Laravel-File-Manager')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: '#desc', // selector để add tiny vào 
            height: 200,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss preview',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor| preview  | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | bold italic backcolor | removeformat ',

            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>

    <script>
        tinymce.init({
            selector: '#detail', // selector để add tiny vào 
            height: 498,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss preview',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor| preview  | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | bold italic backcolor | removeformat ',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',

        });
    </script>


@endsection

@section('style_css')
    <style>
        label {
            font-weight: 500;
        }

        .select_cate {
            font-weight: 500;
        }

        #image-list {
            border: 1px solid;
            display: flex;
            list-style: none;
            padding: 0;
            align-items: center;
            justify-content: center
        }

        #image-list li {
            margin-right: 5px;
        }

        .img_list {
            width: 100%;
            height: auto;
        }

        #image_show {
            width: 100px;
            height: 100px;
            border: 2px solid tan;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa sản phẩm
            </div>

            <div class="card-body">
                <form action="{{ route('admin.updateProduct', $product->id) }}" method="post"enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" value="{{ $product->name }}" name="name"
                                    id="name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug sản phẩm</label>
                                <input class="form-control" type="text" name="slug" id="slug"
                                    value="{{ $product->slug }}">
                                @error('slug')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Giá gốc</label>
                                <input class="form-control" type="number" min=0 name="price" id="price"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            {{-- sale --}}
                            <div class="form-group">
                                <label for="sale_price">Giá-sale</label>
                                <input class="form-control" type="number" min=0 name="sale_price" id="sale_price"
                                    value="{{ $product->sale_price }}">
                                @error('sale_price')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            @php
                                $list_images = json_decode($product->list_images, true);
                            @endphp

                            <div class="form-group w-50">
                                <label for="files">Upload Các ảnh khác </label>
                                <input name="list_images[]" multiple class="form-control" type="file" id="files">


                                <div class="img-list">
                                    <ul id="image-list">
                                        @foreach ($list_images as $item)
                                            <li>
                                                <img class="img-fluid" id="img-list"
                                                    src="{{ url(htmlspecialchars($item)) }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @error('list_images')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="desc">Mô tả sản phẩm</label>
                                <textarea name="desc" class="form-control" id="desc" cols="30" rows="5">{{ $product->desc }}</textarea>
                                @error('desc')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="desc">Upload image</label>
                                <input name="file" class="form-control" id="file" type="file"
                                    value="{{ $product->images }}">
                                <div class="mt-3">
                                    <img class="" id="image_show" src="{{ url($product->images) }}"
                                        alt="hiển thị ảnh">
                                </div>
                                @error('file')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group border w-75">
                            {{-- <style>
                                .img-list {
                                    width: 50%;
                                    height: 72px;
                                    display: flex;
                                }

                                .img-list img {
                                    /* padding-right: 5px; */
                                    padding: 20px;
                                }
                            </style> --}}



                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail">Chi tiết sản phẩm</label>
                        <textarea name="detail" class="form-control" id="detail" cols="30" rows="5">
                            {!! $product->detail !!}
                        </textarea>
                        @error('detail')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục sản phẩm</label>
                        <select name="category_product_id" class="form-control" id="">

                            <option class="select_cate" value="{{ $product->category_product->id }}">

                                {{ $product->category_product->name }}</option>
                            <option value="">Chọn danh mục</option>
                            @php
                                showCategoriesParent($cat_products);
                            @endphp
                        </select>
                        @error('category')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="">
                            <h5>Sản phẩm nổi bật</h5>
                        </label>
                        @if ($product->featured_products == 1)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured_products" id="Radios1"
                                    value="1" checked>
                                <label class="form-check-label" for="Radios1">
                                    Có
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured_products" id="Radios2"
                                    value="2">
                                <label class="form-check-label" for="Radios2">
                                    Không
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured_products" id="Radios1"
                                    value="1">
                                <label class="form-check-label" for="Radios1">
                                    Có
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured_products" id="Radios2"
                                    value="2" checked>
                                <label class="form-check-label" for="Radios2">
                                    Không
                                </label>
                            </div>
                        @endif

                    </div>


                    <div class="form-group">
                        <label for="">
                            <h5>Trạng thái</h5>
                        </label>
                        @if ($product->status == 1)
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
                        @else
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                    value="1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                    value="2" checked>
                                <label class="form-check-label" for="exampleRadios2">
                                    Chờ duyệt
                                </label>
                            </div>
                        @endif


                    </div>



                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('create_slug')
    <script src="{{ asset('js/create_slug.js') }}"></script>

    <script>
        // 
        $(document).ready(function() {
            $('#files').change(function() {
                var files = this.files;
                var imageList = $('#image-list');

                // Xóa tất cả các ảnh đã hiển thị trước đó
                imageList.empty();
                // Duyệt qua từng tệp tin đã chọn
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    // Hàm xử lý sự kiện khi tệp tin được đọc
                    reader.onload = (function(file) {
                        return function(e) {
                            // Tạo một phần tử <li> mới chứa phần tử <img>
                            var listItem = $('<li>');
                            var img = $('<img>').addClass('img_list').attr('src', e.target
                                .result);

                            // Thêm ảnh vào phần tử <li> và thêm vào danh sách
                            listItem.append(img);
                            imageList.append(listItem);
                        };
                    })(file);

                    // Đọc nội dung của tệp tin
                    reader.readAsDataURL(file);
                }
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
?>
