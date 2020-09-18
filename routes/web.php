<?php

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    //   ========================= User Management Routes ================================
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('users', 'Admin\UserController');
    //   =========================End User Management Routes ================================

    Route::resource('companies', 'Admin\CompanyController');
    Route::resource('godowns', 'Admin\GodownController');
    Route::resource('products', 'Admin\ProductController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('sub-categories', 'Admin\SubCategoryController');
    Route::resource('product-batches', 'Admin\ProductBatchController');
    Route::resource('challans', 'Admin\ChallanInController');
    Route::resource('challan-out', 'Admin\ChallanOutController');
    Route::resource('product-returns', 'Admin\ProductReturnController');


    Route::get('company-godown/{id}',[
        'as'=>'company-godown.ajax',
        'uses'=>'Admin\GodownController@getGodownByCompany'
    ]);

    Route::get('change-profile',[
        'as' =>'change_profile',
        'uses' =>'Admin\ProfileSettingController@changeProfile']);
    Route::post('/change_profile',[
        'as' => 'update_profile',
        'uses' => 'Admin\ProfileSettingController@update_profile']);
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


