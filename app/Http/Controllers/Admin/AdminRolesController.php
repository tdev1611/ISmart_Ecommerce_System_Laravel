<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Role_permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminRolesController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'roles']);
            return $next($request);
        });
    }


    //add role
    function addRole()
    {
        $permissions =  Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });

        return view('admin.Permissions.add-role', compact('permissions'));
    }

    //store
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:roles,name|max:200',
                'desc' => 'required',
                'permission_id' => 'array',
                'permission_id.*' => 'exists:permissions,id', // tất cả permission_id phải có id trong bảng perrmissions 
            ],
            [],
            [
                'name' => 'Tên vai trò'
            ]
        );
        $input = $request->only('desc', 'name');
        $role = Role::create($input);
        // attach permission for role
        $permission = $request->input('permission_id');
        $role->permissions()->attach($permission); // role call đến method ->attach($perrmission) n-n

        return redirect()->back()->with('success', 'Thêm vai trò thành công!');
    }


    // list roles
    function listRole()
    {


        $roles = Role::paginate(10);

        return view('admin.Permissions.list-role', compact('roles'));
    }

    //edit-view
    function editRole(Role $role)   // Role $role, route(/{role})-> phải là role ở route:get()
    {

        $permissions =  Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        // return  $role->permissions->pluck('id');
        return view('admin.Permissions.edit-role', compact('role', 'permissions'));
    }

    function updateRole(Request $request, Role $role)
    {
        $request->validate(
            [
                'name' => 'required|max:200|unique:roles,name,' . $role->id,
                'desc' => 'required',
                'permission_id' => 'nullable|array',
                'permission_id.*' => 'exists:permissions,id'
            ],
            [],
            [
                'name' => 'Tên vai trò'
            ]
        );
        $input = $request->only('desc', 'name');
        $role->update($input); //update

        // attach permission for role
        $permission = $request->input('permission_id', []); // nếu k có input thì nhận về mảng rỗng
        $role->permissions()->sync($permission);

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
    //delte
    function deleteRole(Role $role)
    {
        $role->delete();

        return redirect()->back()->with('success', 'Xóa vai trò thành công');
    }



    //search 
    function searchRole(Request $request)
    {
        $roles = Role::paginate(10);
        $search_role = $request->search_role;
        if (!empty($search_role)) {
            $roles = Role::where('name', 'like', '%' . $search_role . '%')
                ->orWhere('desc', 'like', '%' . $search_role . '%')
                ->paginate(10);
        }

        return view('admin.Permissions.serach-list-role', compact('roles'));
    }
}
