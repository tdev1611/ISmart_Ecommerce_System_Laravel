@extends('admin/layouts.dashboard')
@section('title', 'Danh sách thành viên')

@section('content')
    <div id="content" class="container-fluid">
        @if ($users)
            <div class="card">

                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center w-75">
                    <h5 class="m-0 ">Danh sách thành viên</h5>
                    <div class="form-search ">
                        {{-- search --}}
                        <form action="" class="d-flex">
                            <input type="search" class="form-control" name="key" value="{{ request()->input('key') }}"
                                placeholder="Tìm theo tài khoản hoặc email">
                            <button type="submit" class="btn btn-primary ml-2 ">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="ml-3">
                    @if (session('success'))
                        <div id="notification" class='alert alert-success w-25'>
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- ---required    --}}

                    @if (session('required'))
                        <span class="text-danger"> {{ session('required') }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="{{ request()->fullUrlwithQuery(['status' => 'active']) }}" class="text-primary">Hoạt
                            động<span class="text-muted">({{ $counts[0] }})</span></a>
                        <a href="{{ request()->fullUrlwithQuery(['status' => 'disable']) }}" class="text-primary">Vô hiệu
                            hóa<span class="text-muted">({{ $counts[1] }})</span></a>
                    </div>
                    {{-- // form --}}
                    <form action="{{ url('admin/users/action') }}" method="post">
                        @csrf
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" name="action" id="">
                                <option>Chọn</option>
                                @if (request()->status == 'active')
                                    <option value="delete">Xóa tạm thời </option>
                                @elseif (request()->status == 'disable')
                                    <option value="restore">Khôi phục</option>
                                    <option value="forceDelelte">Xóa vĩnh viễn</option>
                                @elseif (request()->status == 'disable')
                                @else
                                    <option value="delete">Xóa tạm thời </option>
                                @endif


                            </select>
                            <input type="submit" name="btn-action" value="Áp dụng" class="btn btn-primary">
                        </div>
                        {{-- table --}}
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Tài Khoản</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            @if ($users->total() > 0)
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                            </td>
                                            <th scope="row">
                                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}
                                            </th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>

                                                @forelse ($user->roles as $role)
                                                    @if (($role->name == 'Admin') | ($role->name == 'ADMIN') | ($role->name == 'admin'))
                                                        <span class="badge badge-danger">
                                                            <a class="text-light"
                                                                href="{{ route('role.edit', $role->id) }}" target="_blank">
                                                                {{ $role->name }}</a>
                                                        </span>
                                                    @elseif (($role->name == 'Khách hàng') | ($role->name == 'KHÁCH HÀNG') | ($role->name == 'khách hàng'))
                                                        <span class="badge badge-primary">
                                                            {{ $role->name }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            <a class="text-dark" href="{{ route('role.edit', $role->id) }}"
                                                                target="_blank"> {{ $role->name }}</a>
                                                        </span>
                                                    @endif

                                                @empty
                                                    <span class="badge badge-primary">
                                                        Khách hàng
                                                    </span>
                                                @endforelse
                                            </td>
                                            <td> {{ $user->created_at }}</td>

                                            @if ($status == 'disable')
                                                <td>
                                                    <a href="{{ route('admin.restoreUser', $user->id) }}"
                                                        class="btn btn-success btn-sm rounded-0" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Khôi phục"><i
                                                            class="fas fa-trash-restore-alt"></i></a>

                                                    <a onclick="return confirm('Bạn muốn xóa vĩnh viễn thành viên này?')"
                                                        href="{{ route('admin.forceDelelte',$user->id) }}"
                                                        class="btn btn-danger btn-sm rounded-0 text-white deleteOd"
                                                        type="button" data-toggle="tooltip" data-placement="top"
                                                        title="Xóa vĩnh viễn"><i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td>
                                                    {{-- edit --}}
                                                    <a href="{{ url('admin/users/edit', $user->id) }}"
                                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                            class="fa fa-edit"></i></a>

                                                    @if (Auth::id() != $user->id)
                                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa thành viên này')"
                                                            href="{{ route('admin.delete', $user->id) }}"
                                                            class="btn btn-danger -sm rounded-0 text-white" type="button"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tr>
                                    <td colspan="8">Không tìm thấy bản ghi nào</td>
                                </tr>
                            @endif
                        </table>
                    </form>
                    <nav aria-label="Page navigation example">
                        {{ $users->appends(request()->all())->links() }}
                    </nav>

                </div>
            </div>
        @else
            <div>
                <h2>Danh sách thành viên</h2>
                <p>Hiện tại không có thành viên nào!</p>

            </div>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#notification').fadeOut('slow');
            }, 1000);
        })
    </script>
@endsection
