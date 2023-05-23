@extends('admin/layouts.dashboard')
@section('title', 'Add Role')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Thêm mới vai trò</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success w-50">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ route('role.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="text-strong" for="name">Tên vai trò</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-strong" for="desc">Mô tả</label>
                        <textarea class="form-control" type="text" name="desc" id="desc">{{ old('desc') }}</textarea>
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <strong>Vai trò này có quyền gì?</strong>
                    <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn
                        quyền.</small>
                    <!-- List Permission  -->
                    @forelse ($permissions as $permissionName => $permissionAction)
                        <div class="card my-4 border">
                            <div class="card-header">
                                <input type="checkbox" class="check-all" id="{{ $permissionName }}">
                                <label for="{{ $permissionName }}" class="m-0">{{ 'Module ' . $permissionName }} </label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permissionAction as $action)
                                        <div class="col-md-3">
                                            <input type="checkbox" class="permission" value="{{ $action->id }}"
                                                name="permission_id[]" id="{{ $action->slug }}">
                                            <label for="{{ $action->slug }}">{{ $action->name }}</label>
                                            {{-- @error('permission_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @empty
                        <p>Hiện tại chưa có quyền nào được thêm</p>
                    @endforelse
                    <input type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.check-all').click(function() {
            $(this).closest('.card').find('.permission').prop('checked', this.checked)
        })

        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 1000);
        })
    </script>
@endsection
