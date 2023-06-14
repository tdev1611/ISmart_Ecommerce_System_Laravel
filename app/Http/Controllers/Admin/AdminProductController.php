<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_product;
use App\Models\Product;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    //
    function __construct()
    {
        // class active sidebar
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'products']);
            return $next($request);
        });
    }

    // category
    function category()
    {
        //index
        $cat_products = Category_product::orderBy('name')->paginate(20);

        return view('admin.Products.cat-product', compact('cat_products'));
    }

    // add category
    function createCategory(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                'name' => 'required|unique:category_products,name',
                'slug' => 'required|unique:category_products,slug',
                'status' => 'required'
            ],
            [],
            [
                'name' => 'Tên danh mục',
                'status' => 'Trạng thái',
            ]
        );
        Category_product::create($input);
        return redirect(route('admin.categoryProduct'))->with('success', 'Thêm danh mục thành công');
    }

    //delete catgory
    function deletecategory($id)
    {

        $cat = Category_product::find($id);
        $cat->delete();
        return redirect(route('admin.categoryProduct'))->with('success', 'Xóa danh mục thành công');
    }


    // addProduct
    function addProduct()
    {
        $cat_products = Category_product::all();
        return view('admin.Products.add-product', compact('cat_products'));
    }
    // store
    function createProduct(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required|unique:products,slug',
                'price' => 'required|numeric',
                'sale_price' => 'numeric|lt:price',
                'desc' => 'required',
                'file' => 'required',
                'detail' => 'required',
                'featured_products' => 'required',
                'list_images' => 'required',
                'category_product_id' => 'required|exists:category_products,id',
                // 'category_product_id' => ''

            ],
            [
                'lt'=> 'Giá sale phải nhỏ hơn giá gốc'
            ],
            [
                'name' => 'Tên sản phẩm',
                'slug' => 'slug',
                'sale_price' => 'giá sale',
                'list_images' => 'Ảnh chi tiết',
                'file' => 'Ảnh',
                'detail' => 'Chi tiết sản phẩm',

            ]
        );
        $code = 'UNI#' . Str::random(6);
        $input['code'] = $code;
        // mitil files
        if ($request->hasFile('list_images')) {
            $list_images = [];
            $files = $request->file('list_images');
            foreach ($files as $file) {
                //uniqid duy nhất để duyệt k bị lặp
                $filename = uniqid() . '-' . $request->slug . '.' . strtolower($file->getClientOriginalExtension());
                $path = $file->move('public/uploads/products/list_images', $filename);
                $list_images[] = "public/uploads/products/list_images/" . $filename;
            }
            $input['list_images'] = json_encode($list_images);
        }

        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $request->slug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->move('public/uploads/products', $filename);
            $img = "public/uploads/products/" . $filename;
            $input['images'] = $img;
        }

        Product::create($input);
        return redirect(route('admin.addProduct'))->with('success', 'Thêm sản phẩm thành công');
    }

    function listProduct(Request $request)
    {

        $cat_products = Category_product::all();
        $products = Product::paginate(10);
        $key = request()->key;
        if (!empty($key)) {
            $products = Product::where('name', 'like', '%' . $key . '%')
                ->orderByDesc('created_at')
                ->paginate(10);
        }
        // $arrays = DB::table('products')
        //     ->leftJoin('category_products', 'category_products.id', '=', 'products.category_id')
        //     ->select('category_products.name', DB::raw('count(category_products.id) as count'))
        //     ->groupBy('category_products.name')
        //     ->get();
        return view('admin.Products.list-product', compact('products', 'cat_products'));
    }

    //delte
    function deleteProduct($id)
    {

        $product = Product::find($id);
        $product->delete();
        return redirect(route('admin.listProduct'))->with('success', 'xóa sản phẩm thành công');
    }

    //eidt product
    function editProduct($id)
    {
        $product = Product::find($id);
        $cat_products = Category_product::all();
        return view('admin.Products.edit-product', compact('product', 'cat_products'));
    }
    function updateProduct(Request $request, $id)
    {


        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required|unique:products,slug,' . Product::find($id)->id,
                'price' => 'required|numeric',
                'sale_price' => 'numeric|lt:price',
                'desc' => 'required',
                'detail' => 'required',
                'status' => 'required',
                'featured_products' => 'required',
                'category_product_id' => 'required|exists:category_products,id',
            ],
            [
                'lt'=> 'Giá sale phải nhỏ hơn giá gốc'
            ],
            [
                'name' => 'Tên sản phẩm',
                'slug' => 'slug',
                'sale_price' => 'giá sale',
                'list_images' => 'Ảnh chi tiết',
                'file' => 'Ảnh',
                'detail' => 'Chi tiết sản phẩm',
            ]
        );

        $update = $request->only('name', 'slug', 'price','sale_price', 'desc', 'detail', 'category_product_id', 'status', 'featured_products', 'list_images');
        // mitil files
        if ($request->hasFile('list_images')) {
            $list_images = [];
            $files = $request->file('list_images');
            foreach ($files as $file) {
                //uniqid duy nhất để duyệt k bị lặp
                $filename = uniqid() . '-' . $request->slug . '.' . strtolower($file->getClientOriginalExtension());
                $path = $file->move('public/uploads/products/list_images', $filename);
                $list_images[] = "public/uploads/products/list_images/" . $filename;
            }
            $update['list_images'] = json_encode($list_images);
        }

        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $request->slug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->move('public/uploads/products', $filename);
            $img = "public/uploads/products/" . $filename;
            $update['images'] = $img;
        }
        Product::where('id', $id)->update($update);
        return redirect(route('admin.listProduct'))->with('success', 'Cập nhật thông tin sản phẩm thành công');
    }


    //action 
    function action(Request $request)
    {
        // dd($request->all());
        // get list id từ request
        // 2foreach listID
        // 3 action   // restore : whereIn - 1 arr 
        $list_checks = $request->list_check;
        if ($list_checks) {
            foreach ($list_checks as $k => $id) {
            }
            ;
            //destroy
            $action = $request->action;
            if ($action == 'delete') {
                $page = Product::destroy($list_checks);
                return redirect(route('admin.listProduct'))->with('success', 'Đã xóa thành công');
            } else {
                return redirect(route('admin.listProduct'))->with('warning', 'Vui lòng chọn phương thức');
            }
        } else {
            return redirect(route('admin.listProduct'))->with('warning', 'Vui lòng chọn bản ghi');
        }
    }
}