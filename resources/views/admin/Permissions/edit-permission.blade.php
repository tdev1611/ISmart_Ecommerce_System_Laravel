@extends('admin/layouts.dashboard')
@section('title', 'Edit permission')
@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm quyền
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" id='alert-session' role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="post" action="{{ route('permission.update',$permission->id)}}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên quyền</label>
                                <input class="form-control" type="text " name="name" id="name"
                                    value="{{$permission->name  }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                                <input class="form-control" type="text" name="slug" id="slug"
                                    value="{{ $permission->slug }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">Mô tả</label>
                                <textarea class="form-control" type="text" name="desc" id="desc"> {{ $permission->desc }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert-session').fadeOut('slow');
            }, 1000);
        })
    </script>
@endsection
