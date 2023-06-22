<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Page;

class AdminPagesController extends Controller
{
    //
    function __construct()
    {
        // class active sidebar
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'pages']);
            return $next($request);
        });
    }
    // thêm bài viết
    function addPage()
    {

        return view('admin.Page.add-page');
    }

    //store
    function createPage(Request $request)
    {
        $input = $request->all();
        // $validator = $request->validate(
        //     [
        //         'title' => 'required',
        //         'slug' => 'required',
        //         'content' => 'required',
        //         'file' => 'required',
        //     ],
        // );
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'file' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // upload file
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $request->slug . '-' . '.' . $file->getClientOriginalExtension();
            $path = $file->move('public/uploads/pages', $filename);
            $img = "public/uploads/pages/" . $filename;
            $input['images'] = $img;
        }

        //up  
        if ($validator->validated()) {
            Page::create($input);
            return response()->json([
                'success' => 'Bản ghi đã được thêm thành công',
            ]);
        }




        // return redirect(route('admin.addPage'))->with('success', 'Thêm bài viết thành công');
    }

    // Danh sách
    function listPage(Request $request)
    {
        $pages = Page::paginate(10);

        $key = request()->key;
        $status = request()->status;

        if ($status == 'disable') {
            $pages = Page::onlyTrashed()->where('title', 'like', '%' . $key . '%')->orderByDesc('created_at')->paginate(10);
            // data ở softdelete
        } else {
            $pages = Page::where('title', 'like', '%' . $key . '%')->paginate(10);
        }

        $pages_active = Page::count();
        $page_disable = Page::onlyTrashed()->count();
        $counts = [$pages_active, $page_disable];
        return view('admin.Page.list-page', compact('pages', 'counts'));
    }

    // delele page
    function delete($id)
    {
        $page = Page::find($id)->delete();
        return redirect(route('admin.listPage'))->with('success', 'Đã xóa thành công');
    }
    //resoter
    function resote($id)
    {
        $page = Page::withTrashed()->find($id);
        $page->restore();
        return redirect(route('admin.listPage'))->with('success', 'Khôi phục bài viết thành công');
    }
    // edit 
    function edit($id)
    {

        $page = Page::find($id);
        return view('admin.Page.edit-page', compact('page'));
    }

    function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);
        // upload file
        $update = $request->only('title', 'content', 'slug', 'status');
        //uplaod file 
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $request->slug . '-' . '.' . $file->getClientOriginalExtension();
            $path = $file->move('public/uploads/pages', $filename);
            $img = "public/uploads/pages/" . $filename;
            $update['images'] = $img;
        }

        Page::where('id', $id)->update($update);

        return redirect(route('admin.listPage'))->with('success', 'Cập nhật bài viết thành công');
    }


    // action : permanently deleted, delete, resotre
    function action(Request $request)
    {
        // get list id từ request
        // 2foreach listID
        // 3 action   // restore : whereIn - 1 mảng 
        $list_checks = $request->list_check;
        if ($list_checks) {

            if (!empty($list_checks)) {
                $action = $request->action;
                if ($action == 'delete') {
                    $page = Page::destroy($list_checks);
                    return redirect(route('admin.listPage'))->with('success', 'Đã xóa thành công');
                }
                if ($action == 'restore') {
                    $page = Page::wherein('id', $list_checks)->restore();

                    return redirect(route('admin.listPage'))->with('success', 'Đã khôi phục thành công');
                }
                if ($action == 'forceDelelte') {
                    $page = Page::withTrashed()->whereIn('id', $list_checks)->forceDelete();
                    return redirect(route('admin.listPage'))->with('success', 'Xóa vĩnh viễn thành công');
                } else {
                    return redirect(route('admin.listPage'))->with('warning', 'Bạn cần chọn hành động');
                }
            }
        } else {
            return redirect(route('admin.listPage'))->with('warning', 'Bạn vui lòng chọn bản ghi!');
        }
    }

    // ------------------------------------------



}