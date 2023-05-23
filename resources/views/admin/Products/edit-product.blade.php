@extends('admin/layouts.dashboard')
@section('title','Chỉnh sửa sản phẩm')

@section('Laravel-File-Manager')
    <script src="https://cdn.tiny.cloud/1/ycev3jqs96174pjltcois4npv3ucaz0uolrs5l7ra90v05qe/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
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
        var editor_config = {
            path_absolute: "https://duchai.unitopcv.com/",
            // path_absolute: "http://localhost/back-end/Laravel-Pro/lesson/Section-20-tiny-editor-form/project-name/",

            selector: '#detail',
            height: 420,
            relative_urls: false,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss preview',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor| preview  | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | bold italic backcolor | removeformat ',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Quản lý ảnh',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };
        tinymce.init(editor_config);
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
                                <label for="price">Giá</label>
                                <input class="form-control" type="number" min=0 name="price" id="price"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="files">Upload Các ảnh khác </label>
                                <input name="list_images[]" multiple class="form-control" type="file" id="files">
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
                                <input name="file" class="form-control" type="file" value="{{ $product->images }}">
                                @error('file')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group border w-75">
                            <style>
                                .img-list {
                                    width: 50%;
                                    height: 72px;
                                    display: flex;
                                }

                                .img-list img {
                                    /* padding-right: 5px; */
                                    padding: 20px;
                                }
                            </style>
                            @php
                                $list_images = json_decode($product->list_images, true);
                            @endphp

                            <div class="img-list">
                                @foreach ($list_images as $item)
                                    <img class="img-fluid" src="{{ url(htmlspecialchars($item)) }}" />
                                @endforeach
                            </div>
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
