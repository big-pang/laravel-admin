<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('test',['uses'=>'IndexController@index']);

Route::get('index',[ 'as'=>'admin.index','uses'=>function(){
    return redirect('/admin/log-viewer');
}]);

$this->group(['namespace' => 'Admin','prefix' => '/admin',], function () {
    Route::auth();
});

$router->group(['namespace' => 'Admin', 'middleware' => ['auth','menu','authAdmin']], function () {

    //权限管理路由
    Route::get('admin/permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('admin/permission/manage', ['as' => 'admin.permission.manage', 'uses' => 'PermissionController@index']);
    Route::get('admin/permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('admin/permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::resource('admin/permission','PermissionController',['names' => ['update' => 'admin.permission.edit','store' => 'admin.permission.create']]);


    //角色管理路由
    Route::get('admin/role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('admin/role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('admin/role', 'RoleController',['names'=>['update'=>'admin.role.edit','store'=>'admin.role.create']]);


    //用户管理路由
    Route::get('admin/user/manage', ['as' => 'admin.user.manage', 'uses' => 'UserController@index']);  //用户管理
    Route::post('admin/user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('admin/user', 'UserController' ,['names'=>['update'=>'admin.role.edit','store'=>'admin.role.create']]);

});

Route::get('admin', function () {
    return redirect('/admin/index');
});

Route::get('/', function () {
    return redirect('/admin/index');
});




