<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class AdminUsersController extends Controller
{

    function __construct()
    {

        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'users']);
            return $next($request);
        });
    }




    // add user
    function adduser()
    {
        return view('admin.Users.add-user');
    }
    //create user
    function create(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required|min:5|unique:users,username',
                'email' => 'required|string|email|unique:users,email|min:5|max:40',
                'password' => ['required', Password::min(8)->mixedCase()->numbers()],
                'roles' => 'nullable|array',
                'roles.*' => 'exists:roles,id',
                'access' => 'required',

            ],
            [],
            [
                'name' => 'Họ và tên',
                'password' => 'Mật khẩu',
            ]

        );
        //password validate
        $password = bcrypt($_POST['password']);
        $input['password'] = $password;   // Thêm passowrd
        $user =  User::create($input);        // add user

        $role = $request->input('roles');
        $user->roles()->attach($role);  // add quyền

        return redirect()->back()->with('success', 'Thêm thành viên mới thành công');
    }
    // Danh sách thnahf viên
    function listusers(Request $request)
    {



        $users = User::paginate(10);
        $key = request()->key;
        $status = $request->status;   // $status  = $request->input('status'); //  lấy giá trị status trên url
        if ($status == 'disable') {
            $users = User::onlyTrashed()->where('email', 'like', '%' . $key . '%')->orderByDesc('created_at')
                ->paginate(10);    // data ở softdelete

        } else {
            //data active users
            if ($key) {    // nghĩa là request()->input('name input'    )
                $users = User::where('username', 'like', '%' . $key . '%')
                    ->orWhere('email', 'like', '%' . $key . '%')
                    ->paginate(10);
            }
        }

        $user_active = User::count();
        $user_disable = User::onlyTrashed()->count();
        $counts = [$user_active, $user_disable];

        // $users = User::orderby('name', 'desc')->paginate(3);
        // if ($key = request()->key) {    //   y là name của input search
        //     $users = User::orderby('name', 'desc')->where('username', 'like','%'.$key.'%')->paginate(3);   //search
        // }

        return    view('admin.Users.list-user', compact('users', 'counts', 'status'));
    }


    // delte usre 
    function delete($id)
    {
        if (Auth::id() != $id) {

            $user = User::find($id)->delete();
        }
        return redirect(route('admin.listusers'))->with('success', 'Đã xã thành viên thành công');
    }

    //forceDelelte
    function forceDelelte($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'Xóa vĩnh viễn thành công');
    }

    //resoter
    function resote($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->back()->with('success', 'Khôi phục thành viên thành công');
    }
    // route('admin.listusers')
    // unipdate update
    function edit(User $user)
    {


        $roles =  Role::all();

        return view('admin.Users.edit-user', compact('user', 'roles',));
    }

    function update(Request $request, User $user)
    {

        $update = $request->only('name', 'password', 'access');

        $request->validate(
            [
                'name' => 'required',
                'password' => ['required', Password::min(8)->mixedCase()->numbers()],
                'access' => 'required',
                'roles' => 'nullable|array',
                'roles.*' => 'exists:roles,id'
            ],
            [],
            [
                'name' => 'Họ và tên',
                'password' => 'Mật khẩu',
                'access' => 'Quyền truy cập'
            ]
        );
        //password validate
        $password = hash::make($_POST['password']);
        $update['password'] = $password;
        // dd($update);
        $user->update($update);
        //user_role
        $role = $request->input('roles');
        $user->roles()->sync($role);  // cập nhật quyền

        return redirect(route('admin.listusers'))->with('success', 'Cập nhật thành công');
    }


    // action  : delete all , restore all
    function action(Request $request)
    {
        // không được xóa chính người đang login
        $list_checks = $request->list_check;   // chỉ đến name của input
        if ($list_checks) {
            foreach ($list_checks as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_checks[$k]); // unset: loại bỏ 1 hoặc nhiều biến truyền vào, tr hợp này loại trừ người đang login 
                }
            }
            //delete -- all - destroy()- xóa nhiều theo dạng mảng
            if (!empty($list_checks)) {
                $action = $request->action;  // $request->input('action') | name của select, khi có dữ liêu của $list_checks
                if ($action == 'delete') {
                    $user =  User::destroy($list_checks);
                    return redirect(route('admin.listusers'))->with('success', 'Xóa thành công');
                }
                // restore
                if ($action == 'restore') {
                    $user =  User::wherein('id', $list_checks)->restore();
                    return redirect(route('admin.listusers'))->with('success', 'Khôi phục thành công');
                }
                //delete permanently
                if ($action == 'forceDelelte') {
                    $user =  User::withTrashed()->whereIn('id', $list_checks)->forceDelete();
                    return redirect(route('admin.listusers'))->with('success', 'Xóa vĩnh viễn thành công');
                }
            }
            return redirect(route('admin.listusers'))->with('required', 'Vui lòng  chọn chức năng');
        } else {
            return redirect(route('admin.listusers'))->with('required', 'Vui lòng  chọn bản ghi để thực hiện');
        }
    }
}
