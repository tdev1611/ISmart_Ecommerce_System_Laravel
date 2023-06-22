@extends('admin/layouts.dashboard')
@section('title', 'Thêm trang ')
@section('Laravel-File-Manager')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: 'textarea', // selector để add tiny vào 
            height: 498,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss preview',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor| preview  | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | bold italic backcolor | removeformat ',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',

        });
    </script>
    <style>
        #notification {
            display: none;
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 2.5rem 1.25rem;
            background-color: #59bf70;
            color: white;
            font-size: 1.0625rem;
            min-width: 18.75rem;
            z-index: 9999;
            border-radius: 15px;
            opacity: 0.8;
        }
    </style>
@endsection

{{-- content --}}
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>

            <div id="notification">
            </div>

            <div class="card-body">
                <div id="errors">

                </div>
                {{-- action="{{ url('admin/page/store') }}"  method="post" --}}
                <form id="create-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Tiêu đề">
                        @error('title')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">Slug</label>
                        <input class="form-control" type="text" name="slug" id="slug" placeholder="slug">
                        @error('slug')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content" class="font-weight-bold">Nội dung bài viết</label>
                        <textarea name="content" class="form-control" id="content" cols="30" rows="5" placeholder="Nội dung"></textarea>
                        @error('content')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input class="form-control w-25 " name="file" type="file" id="formFile"
                            placeholder="Chọn ảnh">
                        @error('file')
                            <div class="text-danger mt-2"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1"
                                checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                value="2">
                            <label class="form-check-label" for="exampleRadios1">
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
        $(document).ready(function() {
            $('#create-form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                // Gửi yêu cầu Ajax
                $.ajax({
                    url: "{{ route('admin.createPage') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    processData: false, // Không xử lý dữ liệu FormData
                    contentType: false,
                    success: function(response) {
                        $('#notification').show()
                        $('#notification').text(response.success)
                        setTimeout(function() {
                            $('#notification').fadeOut('slow');
                        }, 1500);
                        // Xóa các giá trị trong biểu mẫu
                        $('#create-form')[0].reset();
                        $('#errors').hide()
                        $('#image_show').hide()
                    },
                    error: function(xhr) {
                        // Xử lý lỗi
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        // Tạo HTML từ thông báo lỗi
                        let html_errors = '<div class="alert alert-danger">';
                        html_errors += '<strong>Lỗi</strong>';
                        for (var error in errors) {
                            // if (errors.hasOwnProperty(error)) {
                            html_errors += '<li>' + errors[error][0] + '</li>';
                            // }
                        }
                        html_errors += '</div>';
                        $('#errors').html(html_errors)

                    }
                });
            });
        });
    </script>

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
