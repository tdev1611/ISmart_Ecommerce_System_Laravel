<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'roles']);
            return $next($request);
        });
    }

    // view permission 
    function permission()
    {
        $permissions =  Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];    // posts.add , cắt . lấy phần tử dầu =>groupby
        });

        return view('admin.Permissions.permission', compact('permissions',));
    }
    // add permissions--------------------------------------------------------
    function create_permission(Request $request)
    {
        $input =  $request->all();

        $request->validate(
            [
                'name' => 'required|unique:permissions,name|max:200',
                'slug' => 'required|unique:permissions,slug'
            ],
            [],
            [
                'name' => 'Tên quyền'
            ]
        );
        Permission::create($input);
        return redirect()->back()->with('success', 'Thêm quyền thành công');
    }
    //edit perrmission
    //view
    function editPermission($id)
    {
        $permission = Permission::find($id);
        return view('admin.Permissions.edit-permission', compact('permission'));
    }
    // update 
    function updatePermission(Request $request, $id)
    {
        $input = $request->only('name', 'slug', 'desc');
        $request->validate(
            [
                'name' => 'required|max:200',
                'slug' => 'required'
            ],
            [],
            [
                'name' => 'Tên quyền'
            ]
        );
        Permission::find($id)->update($input);
        return redirect(route('permission.index'))->with('success', 'Chỉnh sửa quyền thành công');
    }
    //delte 
    function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->back()->with('success','Xóa quyền thành công');
    }






}
