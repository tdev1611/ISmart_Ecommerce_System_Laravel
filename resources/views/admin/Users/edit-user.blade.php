@extends('admin/layouts.dashboard')
@section('title', 'Chỉnh sửa thông tin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa người dùng
            </div>

            <div class="ml-3">
                @if (session('success'))
                    <div id="notification" class='alert alert-success w-25'>
                        {{ session('success') }}
                    </div>
                @endif

            </div>


            <div class="card-body">
                <form action="{{ route('admin.update', $user->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ $user->name }}">
                        @error('name')
                            <div class=" text-danger "> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Tài khoản</label>
                        <input class="form-control" readonly type="text" name="username" id="username"
                            value="{{ $user->username }}" disabled>
                        @error('username')
                            <div class=" text-danger "> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" readonly type="text" name="email" id="email"
                            value="{{ $user->email }}" disabled>
                        @error('email')
                            <div class=" text-danger "> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
                            <div class=" text-danger "> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-50">
                        <label for="roles">Nhóm quyền</label>
                        @php
                            $selectRoles = $user->roles->pluck('id')->toArray();
                        @endphp
                        <select class="form-control" name="roles[]" multiple id="roles">

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if (in_array($role->id, $selectRoles)) selected @endif>
                                    {{ $role->name }}</option>
                            @endforeach

                        </select>
                        @error('roles')
                            <div class=" text-danger "> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        @if ($user->access == 1)
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="access" id="access1" value="1"
                                    checked>
                                <label class="form-check-label" for="access1">
                                    admin-- manager
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="access" id="access2" value="2">
                                <label class="form-check-label" for="access2">
                                    Khách hàng
                                </label>
                            </div>
                        @else
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="access" id="access1" value="1">
                                <label class="form-check-label" for="access1">
                                    admin-- manager
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="access" id="access2" value="2" checked>
                                <label class="form-check-label" for="access2">
                                    Khách hàng
                                </label>
                            </div>
                        @endif

                        @error('access')
                            <div class=" text-danger "> {{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" value="Cập nhật" name="btn_update" class="btn btn-primary">

                </form>



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
