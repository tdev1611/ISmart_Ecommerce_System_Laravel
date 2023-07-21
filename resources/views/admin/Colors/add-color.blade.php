@extends('admin/layouts.dashboard')
@section('Color', 'Màu sắc')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm màu
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.storeColor') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên Màu</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục <span class="text-muted">(Có danh mục)</span>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên màu </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                    <tr>

                                        <td scope="row">
                                            {{ ($colors->currentPage() - 1) * $colors->perPage() + $loop->index + 1 }}
                                        </td>
                                        <th scope="col">{{ $color->name }} </th>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>


                    </div>
                    {{ $colors->appends(request()->all())->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('create_slug')
    <script src="{{ asset('js/create_slug.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.deletebtn').click(function() {
                return confirm('bạn có muốn xóa ')
            });
        });
    </script>
@endsection
