@extends('admin/layouts.dashboard')
@section('title', 'List Role')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách vai trò</h5>
                <div class="form-search form-inline">
                    <form action="{{ route('role.search') }}" method="get">
                        <input type="" name="search_role" class="form-control form-search" placeholder="Tìm kiếm">
                        <button class="btn btn-primary" type="submit"> Ta</button>
                    </form>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">


                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Vai trò</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>


                                <th scope="row">
                                    {{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->index + 1 }}
                                </th>
                                <td><a href="{{ route('role.edit', $role->id) }}">{{ $role->name }}</a></td>
                                <td>{{ $role->desc }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td><a href="{{ route('role.edit', $role->id) }}" class="btn btn-success btn-sm rounded-0"
                                        type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Bạn muốn xóa vai trò này?')"
                                        href="{{ route('role.delete', $role->id) }}" class="btn btn-danger btn-sm rounded-0"
                                        type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                            class="fa fa-trash"></i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    không tồn tại bản ghi nào
                                </td>
                            </tr>
                        @endforelse




                    </tbody>
                </table>



            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 1000);


        })
    </script>
@endsection
