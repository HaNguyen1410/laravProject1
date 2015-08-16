<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*=========================== Trang quản trị ===========================================*/
/*######## Giảng Viên ##################*/
Route::get('danhsachgv','QuantriController@DanhSachGV');
Route::get('themgv','QuantriController@ThemGV');
Route::post('luugv','QuantriController@LuuGV');
Route::get('capnhatgv/{id}','QuantriController@CapNhatGV');
Route::post('luucapnhatgv','QuantriController@LuuCapNhatGV');

/*######## Sinh Viên ##################*/
Route::get('danhsachsv','QuantriController@DanhSachSV');
Route::get('themsv','QuantriController@ThemSV');
Route::post('luusv','QuantriController@LuuSV');
Route::get('capnhatsv/{id}','QuantriController@CapNhatSV');
Route::post('luucapnhatsv','QuantriController@LuuCapNhatSV');

/*=========================== Trang giảng viên ===========================================*/
Route::get('thongtin','GiangvienController@ThongTin');
Route::get('thongtingv','GiangvienController@ThongTinGV');
Route::get('thongtingv/{id}','GiangvienController@HienThiGV');

/*=========================== Trang sinh viên ===========================================*/
Route::get('thongtinsv/{mssv}','SinhvienController@HienThiSV');
Route::get('xemviecduocgiao/{mssv}/{hoten}/{manth}','SinhvienController@CongViecSV');