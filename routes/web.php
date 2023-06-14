<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//client

Route::get('/', 'WebcomeController@indexx')->name('homes');  // trang chủ

route::get('tim-kiem', 'WebcomeController@searchIndex')->name('searchIndex'); // index


// product, productDetail, danh mục
Route::group(['prefix' => 'san-pham'], function () {
    Route::get('/', 'ProductsController@productShows')->name('productShows');
    Route::get('/loc-san-pham', 'ProductsController@sortProduct')->name('products.sort');
    Route::get('/{slug}.html', 'ProductsController@productDetail')->name('productDetail');
    Route::get('/{slug}', 'ProductsController@productBycateID')->name('productBycateID');
    Route::get('/loc-san-cates/{slug}', 'ProductsController@softProductsByCate')->name('softProductsByCate'); //sortProductBycate--ajax
});


// cart.
Route::get('gio-hang', 'CartController@cartshow')->name('cartshow'); //layouts client cart
Route::get('addcart/{id}', 'CartController@addCart')->name('addCart'); //  add product to cart
Route::get('addCartDetail/{id}', 'CartController@addCartDetail')->name('addCartDetail'); //  add product to cart
Route::get('buynow/{id}', 'CartController@buyNow')->name('buyNow');
Route::get('buyNowDetail/{id}', 'CartController@buyNowDetail')->name('buyNowDetail'); //detailproduct
Route::get('removeCart/{id}', 'CartController@removeCart')->name('cart.remove');
Route::get('destroyCart', 'CartController@destroy')->name('cart.destroy');
Route::post('cart/update', 'CartController@update')->name('cart.updateAjax');

Route::post('/add-to-cart', 'CartController@addToCart')->name('cart.add'); //add cart = ajax qty =1 
Route::post('/add-to-cartDet', 'CartController@addCartDetailAjax')->name('cart.addDetailajax'); //add cart = ajax qty = qty



// order 
Route::get('thanh-toan', 'OrderController@checkOut')->name('showCheckCount'); // view
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('payment', 'OrderController@payment')->name('payment'); // view
    Route::get('dat-hang-thanh-cong', 'OrderController@orderSuccess')->name('thanksOrder');
});

// blog
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'BlogController@blogShows')->name('blogShows');
    Route::get('/{slug}.html', 'BlogController@detailBlog')->name('detailBlog');
});

//page -- giới thiệu 
Route::group(['prefix' => 'gioi-thieu'], function () {
    Route::get('/', 'PagesController@index')->name('intro');
});



// admin

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

//laravel-filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
//admin-module
// ,'CheckRole'
Route::group(['middleware' => ['auth', 'verified', 'CheckRole'], 'prefix' => 'admin'], function () {
    include('AdminDashboard.php');
});

// dasshboard 
// ,'CheckRole'
Route::group(['middleware' => ['auth', 'verified',], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/dashboard', 'DashboardController@dashboard')->can('orders.view');
    Route::get('/', 'DashboardController@dashboard')->can('orders.view');
});
Route::get('/logout', 'LogoutController@perform')->name('logout.perform')->middleware('auth');











// Route::group(['middleware'=>['auth','verified'],'prefix'=>'admin'],function(){
//     Route::get('users/add', 'AdminUsersController@adduser')->name('admin.adduser');
//     Route::get('users/list-user', 'AdminUsersController@listusers')->name('admin.listusers');
//     Route::post('user/store','AdminUsersController@create')->name('user.create');
//     Route::get('users/delete/{id}','AdminUsersController@delete')->name('admin.delete'); // xóa user
//     Route::get('users/edit/{id}','AdminUsersController@edit')->name('admin.edit'); // chỉnh sửa user
//     Route::post('users/update/{id}','AdminUsersController@update')->name('admin.update'); // chỉnh sửa user
//     Route::post('users/action/','AdminUsersController@action')->name('admin.action');  // 
// });



// //page
// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin/page',], function () {

//     Route::post('store', 'AdminPagesController@createPage')->name('admin.createPage');
//     Route::get('add', 'AdminPagesController@addPage')->name('admin.addPage');
//     Route::get('list', 'AdminPagesController@listPage')->name('admin.listPage');
//     Route::get('delete/{id}', 'AdminPagesController@delete')->name('admin.deletePage');
//     Route::get('edit/{id}', 'AdminPagesController@edit')->name('admin.editPage');
//     Route::post('update/{id}', 'AdminPagesController@update')->name('admin.updatePage');
//     Route::post('action', 'AdminPagesController@action')->name('admin.actionPage');  // action


// });

// // // posts
// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin/post',], function () {

//     Route::post('cat/store', 'AdminPostController@createCategory')->name('admin.createCategoryPost');
//     Route::get('category', 'AdminPostController@category')->name('admin.categoryPost');
//     Route::get('category/delete/{id}', 'AdminPostController@deletecategory')->name('admin.deletecatPost');
//     Route::get('add', 'AdminPostController@addPost')->name('admin.addPost');
//     route::post('store', 'AdminPostController@createPost')->name('admin.createPost');  // thêm post
//     Route::get('list', 'AdminPostController@listPost')->name('admin.listPost');
//     Route::get('delete/{id}', 'AdminPostController@deletePost')->name('admin.deletePost');
//     Route::get('edit/{id}', 'AdminPostController@editPost')->name('admin.editPost');
//     Route::post('update/{id}', 'AdminPostController@updatePost')->name('admin.updatePost');
// });

// // //product 
// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin/product', ], function () {
//     route::post('category/store', 'AdminProductController@createCategory')->name('admin.createCategory'); // thêm category
//     route::get('category', 'AdminProductController@category')->name('admin.categoryProduct');
//     route::get('category/delete/{id}', 'AdminProductController@deletecategory')->name('admin.deletecatProduct');
//     route::get('list', 'AdminProductController@listProduct')->name('admin.listProduct');
//     route::get('add', 'AdminProductController@addProduct')->name('admin.addProduct');
//     route::post('product/store', 'AdminProductController@createProduct')->name('admin.createProduct');  // thêm products
//     route::get('delete/{id}', 'AdminProductController@deleteProduct')->name('admin.deleteProduct');
//     route::get('edit/{id}', 'AdminProductController@editProduct')->name('admin.editProduct');
//     route::post('update/{id}', 'AdminProductController@updateProduct')->name('admin.updateProduct');
//     route::post('action', 'AdminProductController@action')->name('admin.actionProduct');
// });

// // //order

// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin/order', ], function () {
//     Route::get('list', 'AdminOrderConroller@index')->name('admin.listOrder');
// });
