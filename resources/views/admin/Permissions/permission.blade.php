@extends('admin/layouts.dashboard')
@section('title', 'Add permission')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
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
                        <form method="post" action="{{ route('permission_create') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên quyền</label>
                                <input class="form-control" type="text " name="name" id="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                                <input class="form-control" type="text" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">Mô tả</label>
                                <textarea class="form-control" type="text" name="desc" id="desc"> {{ old('desc') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách quyền
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên quyền</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Mô tả</th>

                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($permissions as $moduleName => $modulePermission)
                                    <tr>
                                        <td></td>
                                        <td><strong>{{ 'Module ' . ucfirst($moduleName) }}</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    @foreach ($modulePermission as $item)
                                        <tr class="permission-item">
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>|-- {{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->desc }}</td>
                                            <td class="">
                                                <a href="{{ route('permission_edit', $item->id) }}" class="mr-2"> <i
                                                        class="fas fa-edit"> </i></a>
                                                <a href="{{ route('permission.delete', $item->id) }}" class="trash"> <i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                            {{-- {{ route('permission_trash',$item->id) }} --}}
                                        </tr>
                                    @endforeach
                                @endforeach


                            </tbody>
                        </table>
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

            // delete alert  

            $('.trash').click(function() {
               return confirm('bạn muốn xóa ?')
            })

        })
    </script>
@endsection
