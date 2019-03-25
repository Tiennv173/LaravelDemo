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
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dangnhap','UserController@getdangnhapAdmin');
Route::post('admin/dangnhap','UserController@postdangnhapAdmin');
Route::get('admin/logout','UserController@getdangxuatAdmin');

Route::get('test',function (){
    $theloai = TheLoai::find(4);
    foreach ($theloai->loaitin as $loaitin)
    {
        echo $loaitin->Ten."<br>";
    }
});

Route::get('test2',function (){
    return view('admin.theloai.list');
});

//Route group truy nhap trang admin
Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function (){
    //Route the loai
    Route::group(['prefix'=>'theloai'],function(){
        Route::get('list','TheLoaiController@getList');

        Route::get('edit/{id}','TheLoaiController@getEdit');
        Route::post('edit/{id}','TheLoaiController@postEdit');

        Route::get('add','TheLoaiController@getAdd');
        Route::post('add','TheLoaiController@postAdd');

        Route::get('delete/{id}','TheLoaiController@getDelete');
    });
    //Route Loaitin
    Route::group(['prefix'=>'loaitin'],function(){
        Route::get('list','LoaiTinController@getList');

        Route::get('edit/{id}','LoaiTinController@getEdit');
        Route::post('edit/{id}','LoaiTinController@postEdit');

        Route::get('add','LoaiTinController@getAdd');
        Route::post('add','LoaiTinController@postAdd');

        Route::get('delete/{id}','LoaiTinController@getDelete');
    });

    //Route Tin Tuc
    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('list','TinTucController@getList');

        Route::get('edit/{id}','TinTucController@getEdit');
        Route::post('edit/{id}','TinTucController@postEdit');

        Route::get('add','TinTucController@getAdd');
        Route::post('add','TinTucController@postAdd');

        Route::get('delete/{id}','TinTucController@getDelete');
    });

    //Route Slide
    Route::group(['prefix'=>'slide'],function(){
        Route::get('list','SlideController@getList');

        Route::get('edit/{id}','SlideController@getEdit');
        Route::post('edit/{id}','SlideController@postEdit');

        Route::get('add','SlideController@getAdd');
        Route::post('add','SlideController@postAdd');

        Route::get('delete/{id}','SlideController@getDelete');
    });

    //Route User
    Route::group(['prefix'=>'user'],function(){
        Route::get('list','UserController@getList');

        Route::get('edit/{id}','UserController@getEdit');
        Route::post('edit/{id}','UserController@postEdit');

        Route::get('add','UserController@getAdd');
        Route::post('add','UserController@postAdd');

        Route::get('delete/{id}','UserController@getDelete');
    });

    Route::group(['prefix'=>'ajax'],function (){
       Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });


});

Route::get('trangchu','PageController@trangchu');
Route::get('lienhe','PageController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
Route::get('tintuc/{id}/{TenKhongDau}.html','PageController@tintuc');


Route::get('dangnhap','PageController@getdangnhap');
Route::post('dangnhap','PageController@postdangnhap');
Route::get('dangxuat','PageController@getdangxuat');
