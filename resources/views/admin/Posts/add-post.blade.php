@extends('admin/layouts.dashboard')
@section('title','Thêm bài viết')
@section('Laravel-File-Manager')
    <script src="https://cdn.tiny.cloud/1/ycev3jqs96174pjltcois4npv3ucaz0uolrs5l7ra90v05qe/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        var editor_config = {
            // path_absolute: là đường dẫn của dự án (project) để có thể upload file 
            path_absolute: "http://localhost/back-end/Laravel-Pro/project/ismart/",
           

            selector: '#content-post',
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

        .label_radio {
            font-weight: 400;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            @if (session('success'))
                <div class="alert alert-success w-50">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">
                <form action="{{ url('admin/post/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Tiêu đề bài viết</label>
                                <input class="form-control" type="text" name="title" id="title" value="{{ old('name') }}">
                                @error('title')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">slug</label>
                                <input class="form-control" type="text" name="slug" id="slug"  value="{{ old('slug') }}">
                                @error('slug')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group w-50">
                                <label for="file">Upload ảnh</label>
                                <input type="file" name="file" id="file" class="form-control"  value="{{ old('file') }}">
                                @error('file')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc">Mô tả bài viết</label>
                                <textarea name="desc" class="form-control" id="desc" cols="30" rows="8"> {{ old('desc') }}</textarea>
                                @error('desc')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content-post">Nội dung bài viết</label>
                        <textarea name="content" class="form-control" id="content-post" cols="30" rows="5"> {{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group w-25">
                        <label for="select">Danh mục</label>
                        <select name="category_post_id" class="form-control" id="select">
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <p class="text-danger"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="1"
                                value="option1" checked>
                            <label class="form-check-label label_radio" for="exampleRadios1">
                                Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="2"
                                value="option2">
                            <label class="form-check-label label_radio" for="exampleRadios2">
                                Chờ duyệt
                            </label>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('create_slug')
    <script>
        $('input#title').keyup(function(event) {
            var title, slug;
            //Lấy text từ thẻ input title 
            title = $(this).val();

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấus
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
                '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”

            $('input#slug').val(slug)
        })
    </script>
@endsection
