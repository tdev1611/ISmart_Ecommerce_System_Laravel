<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// user
Route::group(['namespace' => 'Admin'], function () {
    Route::get('users/add', 'AdminUsersController@adduser')->name('admin.adduser')->can('users.add');
    Route::post('user/store', 'AdminUsersController@create')->name('user.create')->can('users.add');
    Route::get('users/list-user', 'AdminUsersController@listusers')->name('admin.listusers')->can('users.view');
    Route::get('users/edit/{user}', 'AdminUsersController@edit')->name('admin.edit')->can('users.edit'); // chỉnh sửa user
    Route::post('users/update/{user}', 'AdminUsersController@update')->name('admin.update')->can('users.edit'); // chỉnh sửa user
    Route::get('users/delete/{id}', 'AdminUsersController@delete')->name('admin.delete')->can('users.delete'); // xóa user
    Route::get('users/forceDelelte/{id}', 'AdminUsersController@forceDelelte')->name('admin.forceDelelte')->can('users.delete'); // xóa user
    Route::get('users/restore/{id}', 'AdminUsersController@resote')->name('admin.restoreUser')->can('users.delete'); // xóa user
    Route::post('users/action/', 'AdminUsersController@action')->name('admin.action')->can('users.delete');  // 
});

//page
Route::group(['prefix' => 'page', 'namespace' => 'Admin'], function () {
    Route::get('add', 'AdminPagesController@addPage')->name('admin.addPage')->can('pages.add');
    Route::post('store', 'AdminPagesController@createPage')->name('admin.createPage')->can('pages.add');
    Route::get('list', 'AdminPagesController@listPage')->name('admin.listPage')->can('pages.view');
    Route::get('edit/{id}', 'AdminPagesController@edit')->name('admin.editPage')->can('pages.edit');
    Route::post('update/{id}', 'AdminPagesController@update')->name('admin.updatePage')->can('pages.edit');
    Route::get('delete/{id}', 'AdminPagesController@delete')->name('admin.deletePage')->can('pages.delete');
    Route::get('resote/{id}', 'AdminPagesController@resote')->name('admin.resotePage')->can('pages.delete');
    Route::post('action', 'AdminPagesController@action')->name('admin.actionPage')->can('pages.delete');  // action
});



// post
Route::group(['prefix' => 'post', 'namespace' => 'Admin'], function () {
    Route::post('cat/store', 'AdminPostController@createCategory')->name('admin.createCategoryPost')->can('posts.add');
    Route::get('category', 'AdminPostController@category')->name('admin.categoryPost')->can('posts.view');
    Route::get('category/delete/{id}', 'AdminPostController@deletecategory')->name('admin.deletecatPost')->can('posts.delete');
    Route::get('add', 'AdminPostController@addPost')->name('admin.addPost')->can('posts.add');
    route::post('store', 'AdminPostController@createPost')->name('admin.createPost')->can('posts.add');  // thêm post
    Route::get('list', 'AdminPostController@listPost')->name('admin.listPost')->can('posts.view');
    Route::get('delete/{id}', 'AdminPostController@deletePost')->name('admin.deletePost')->can('posts.delete');
    Route::get('edit/{id}', 'AdminPostController@editPost')->name('admin.editPost')->can('posts.edit');
    Route::post('update/{id}', 'AdminPostController@updatePost')->name('admin.updatePost')->can('posts.edit');
});

// products
Route::group(['prefix' => 'product', 'namespace' => 'Admin'], function () {
    route::post('category/store', 'AdminProductController@createCategory')->name('admin.createCategory')->can('products.add'); // thêm category
    route::get('category', 'AdminProductController@category')->name('admin.categoryProduct')->can('products.view');
    route::get('category/delete/{id}', 'AdminProductController@deletecategory')->name('admin.deletecatProduct')->can('products.delete');
    route::get('list', 'AdminProductController@listProduct')->name('admin.listProduct')->can('products.view');
    route::get('add', 'AdminProductController@addProduct')->name('admin.addProduct')->can('products.add');
    route::post('product/store', 'AdminProductController@createProduct')->name('admin.createProduct')->can('products.add');  // thêm products
    route::get('delete/{id}', 'AdminProductController@deleteProduct')->name('admin.deleteProduct')->can('products.delete');
    route::get('edit/{id}', 'AdminProductController@editProduct')->name('admin.editProduct')->can('products.delete');
    route::post('update/{id}', 'AdminProductController@updateProduct')->name('admin.updateProduct')->can('products.edit');
    route::post('action', 'AdminProductController@action')->name('admin.actionProduct')->can('products.delete');
});



//order
Route::group(['prefix' => 'order', 'namespace' => 'Admin'], function () {
    Route::get('list', 'AdminOrderConroller@index')->name('admin.listOrder')->can('orders.view');
    Route::get('detail/{id}', 'AdminOrderConroller@detail')->name('admin.detailOrder')->can('orders.edit');
    Route::get('delete/{id}', 'AdminOrderConroller@delete')->name('admin.deleteOrder')->can('orders.delete'); //deletele
    Route::get('restore/{id}', 'AdminOrderConroller@restore')->name('order.restoreorder')->can('orders.delete'); // restore
    Route::get('forceDelelte/{id}', 'AdminOrderConroller@forceDelelte')->name('order.forceDelelte')->can('orders.delete'); // delete forever
    Route::post('action/', 'AdminOrderConroller@action')->name('order.action')->can('orders.delete');  // 
    Route::post('order-update-status/{id}', 'AdminOrderConroller@update_status')->name('order.update_status')->can('orders.edit'); // update trạng thái đơn hàng

});

//permission 
// roles.delete roles.add roles.view roles.edit
Route::group(['prefix' => 'permission', 'namespace' => 'Admin'], function () {
    Route::get('add', 'AdminPermissionController@permission')->name('permission.index')->can('roles.add');
    Route::post('create-permission', 'AdminPermissionController@create_permission')->name('permission_create')->can('roles.add'); //store
    Route::get('edit-permission/{id}', 'AdminPermissionController@editPermission')->name('permission_edit')->can('roles.edit'); //view edit
    Route::post('update-permission/{id}', 'AdminPermissionController@updatePermission')->name('permission.update')->can('roles.edit'); //edit
    Route::get('delete-permission/{id}', 'AdminPermissionController@deletePermission')->name('permission.delete')->can('roles.delete'); //edit

});
// role
Route::group(['prefix' => 'role', 'namespace' => 'Admin'], function () {
    Route::get('add', 'AdminRolesController@addRole')->name('role.add')->can('roles.add');
    Route::post('store', 'AdminRolesController@store')->name('role.store')->can('roles.add'); //adđ
    Route::get('list', 'AdminRolesController@listRole')->name('role.list')->can('roles.view');
    Route::get('edit/{role}', 'AdminRolesController@editRole')->name('role.edit')->can('roles.edit'); //edit
    Route::post('update/{role}', 'AdminRolesController@updateRole')->name('role.update')->can('roles.edit'); //update
    Route::get('delete/{role}', 'AdminRolesController@deleteRole')->name('role.delete')->can('roles.delete'); //del

    Route::get('search', 'AdminRolesController@searchRole')->name('role.search'); //del

});
