@extends('admin/layouts.dashboard')
@section('title', 'Thêm thành viên')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm người dùng
            </div>

            <div class="ml-3">
                @if (session('success'))
                    <div id="notification" class='alert alert-success w-25'>
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="card-body">
                {!! Form::open(['url' => 'admin/user/store', 'method' => 'post']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('fullname', 'Họ và tên', '') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'fullname']) !!}

                    @error('name')
                        <div class=" text-danger "> {{ $message }}</div>
                    @enderror
                </div>
                {{-- end fullname --}}
                <div class="form-group">
                    {!! Form::label('username', 'Tài khoản', '') !!}
                    {!! Form::text('username', old('username'), ['class' => 'form-control', 'id' => 'username']) !!}

                    @error('username')
                        <div class=" text-danger "> {{ $message }}</div>
                    @enderror
                </div>
                {{-- end username --}}
                <div class="form-group">
                    {!! Form::label('email', 'email', '') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}
                    @error('email')
                        <div class=" text-danger "> {{ $message }}</div>
                    @enderror
                </div>
                {{-- end -email --}}
                <div class="form-group">
                    {!! Form::label('password', 'Mật khẩu', '') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                    @error('password')
                        <div class=" text-danger "> {{ $message }}</div>
                    @enderror
                </div>
                {{-- end passowrd --}}
                {{-- <div class="form-group">
                    {!! Form::label('', 'Nhóm quyền', '') !!}
                    {!! Form::select('role', [0 => 'Chọn quyền', 1 => 'edit', 2 => 'admin', 3 => 'add'], 0, [
                        'class' => 'form-control',
                    ]) !!}
                </div> --}}
                <div class="form-group w-50">
                    <label for="roles">Nhóm quyền</label>
                    @php
                        $roles = \App\Models\Role::all();
                    @endphp
                    <select class="form-control" name="roles[]" multiple id="roles">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <div class=" text-danger "> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group ">
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="access" id="access1" value="1">
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
                    @error('access')
                        <div class=" text-danger "> {{ $message }}</div>
                    @enderror
                    {!! Form::submit('Thêm mới', ['class' => 'btn btn-primary mt-3', 'name' => 'btn-add']) !!}
                    {!! Form::close() !!}

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
