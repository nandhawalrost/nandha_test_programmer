<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('nav/purchase_order')->group(function () { 
        $controller = 'PurchaseOrderController';

        Route::get('', $controller.'@purchase_order'); //view
        Route::post('/store_purchase_order', $controller.'@store_purchase_order'); //create 
        Route::get('/{id}/destroy_detail', $controller.'@destroy_detail'); //delete detail
        Route::get('/{id}/edit_detail', $controller.'@edit_detail'); //edit detail
        Route::post('{id}/update_detail', $controller.'@update_detail'); //update 
        Route::post('/buat_purchase_order_baru', $controller.'@buat_purchase_order_baru'); //generate
        Route::post('/cetak_purchase_order', $controller.'@cetak_purchase_order'); //print
    });

    Route::prefix('nav/list_purchase_order')->group(function () { 
        $controller = 'PurchaseOrderListController';
        
        Route::get('', $controller.'@purchase_order_list'); //list po
        Route::get('/store_purchase_order/filter_tanggal', $controller.'@filter_tanggal'); //filter_tanggal
        Route::get('/{id}/lihat_detail_po', $controller.'@lihat_detail_po'); //lihat detail po
        Route::post('/{id}/lihat_detail_po/store_purchase_order', $controller.'@store_purchase_order'); //create
        Route::get('/{id}/lihat_detail_po/destroy_detail', $controller.'@destroy_detail'); //destroy detail  
        Route::get('/{id}/lihat_detail_po/edit_detail', $controller.'@edit_detail'); //edit detail
        Route::post('/{id}/lihat_detail_po/update_detail', $controller.'@update_detail'); //update detail  
    });

    Route::get('nav/print_out/{id}/cetak_po', 'PrintOutController@cetak_po');
});