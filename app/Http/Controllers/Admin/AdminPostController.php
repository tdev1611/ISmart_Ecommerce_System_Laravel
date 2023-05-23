<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_post;
use App\Models\Post;

class AdminPostController extends Controller
{
    function __construct()
    {
        // class active sidebar
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'posts']);
            return $next($request);
        });
    }

    // category - index
    function category()
    {
        $cats = Category_post::paginate(15);

        return view('admin.Posts.cat-post', compact('cats',));
    }

    // store cat
    function createCategory(Request $request)
    {

        $input = $request->all();

        $request->validate(
            [
                'name' => 'required|unique:category_posts,name',
                'slug' => 'required|unique:category_posts,slug',
                'status' => 'required'
            ],
            [],
            ['name' => 'Tên danh mục ']
        );

        Category_post::create($input);
        return redirect(route('admin.categoryPost'))->with('success', 'Thêm danh mục thành công');
    }
    //delete catgory
    function deletecategory($id)
    {

        $cat = Category_post::find($id);
        $cat->delete();
        return redirect(route('admin.categoryPost'))->with('success', 'Xóa danh mục thành công');
    }

    // posts
    //inedex
    function addPost()
    {
        $cats = Category_post::all(); // catgorypost


        return view('admin.Posts.add-post', compact('cats'));
    }

    function createPost(Request $request)
    {

        $input = $request->all();
        $request->validate(
            [
                'title' => 'required',
                'slug' => 'required',
                'content' => 'required',
                'desc' => 'required',
                'file' => 'required',
                'category_post_id' => 'required',
            ],
            [],
            [
                'name' => 'Tên bài viết',
                'slug' => 'slug',
                'category_id' => 'Danh mục'
            ]
        );

        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $request->slug . '-'  . '.' . $file->getClientOriginalExtension();
            $path = $file->move('public/uploads/posts', $filename);
            $img = "public/uploads/posts/" . $filename;
            $input['images'] = $img;
        }

        Post::create($input);
        return redirect(route('admin.addPost'))->with('success', 'Thêm bài viết thành công');
    }

    // list post-index

    function listPost(Request $request)
    {
        $posts = Post::paginate(15);
        $cat_posts = Category_post::all();

   
        return view('admin.Posts.list-post', compact('posts', 'cat_posts'));
    }



    //delte
    function deletePost($id)
    {
        $product = Post::find($id);
        $product->delete();
        return redirect(route('admin.listPost'))->with('success', 'xóa sản phẩm thành công');
    }

    //eidt product
    function editPost($id)
    {
        $post = Post::find($id);
        $cat_post = Category_post::all();
        return view('admin.Posts.edit-post', compact('post', 'cat_post'));
    }

    function  updatePost(Request $request, $id)
    {
        $update = $request->only('title', 'slug', 'content', 'desc',  'category_post_id', 'status');
        $request->validate(
            [
                'title' => 'required',
                'slug' => 'required',
                'content' => 'required',
                'desc' => 'required',
                'category_post_id' => 'required',
            ],
            [],
            [
                'name' => 'Tên bài viết',
                'slug' => 'slug',
                'category_post_id' => 'Danh mục'
            ]
        );

        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $request->slug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->move('public/uploads/posts', $filename);
            $img = "public/uploads/posts/" . $filename;
            $update['images'] = $img;
        }
        Post::where('id', $id)->update($update);
        return redirect(route('admin.listPost'))->with('success', 'Chỉnh sửa bài viết thành công');
    }
}
