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
Route::get('/dangnhap', function(){
    return view('giaodienchung.dang-nhap');    
});
/*=========================== Trang quản trị ===========================================*/
Route::get('quantri/thongtinqt/{macb}','QuantriController@ThongTinQT');
Route::get('quantri/doimatkhauqt/{macb}','QuantriController@DoiMatKhauQT');
Route::post('luudmkqt','QuantriController@LuuDoiMatKhauQT');

/*######## Giảng Viên ##################*/
Route::get('quantri/danhsachgv','QuantriController@DanhSachGV');
Route::get('quantri/danhsachgv/themgv','QuantriController@ThemGV');
Route::post('luuthemgv','QuantriController@LuuThemGV');
Route::get('quantri/danhsachgv/capnhatgv/{macb}','QuantriController@CapNhatGV');
Route::post('luucapnhatgv','QuantriController@LuuCapNhatGV');
Route::get('quantri/danhsachgv/xoagv/{macb}','QuantriController@XoaGV');

/*######## Sinh Viên ##################*/
Route::get('quantri/danhsachsv','QuantriController@DanhSachSV');
Route::get('quantri/danhsachsv/themsv','QuantriController@ThemSV');
Route::post('luuthemsv','QuantriController@LuuThemSV');
Route::get('quantri/danhsachsv/capnhatsv/{masv}','QuantriController@CapNhatSV');
Route::post('luucapnhatsv','QuantriController@LuuCapNhatSV');
Route::get('quantri/danhsachsv/xoasv/{masv}','QuantriController@XoaSV');

/*=========================== Trang giảng viên ===========================================*/
Route::get('vidu','GiangvienController@ViDu');
Route::get('thongtingv','GiangvienController@ThongTin_gv');
Route::get('thongtingv/{macb}','GiangvienController@ThongTinGV');

/*=========================== Trang sinh viên ===========================================*/
Route::get('thongtinsv/{mssv}','SinhvienController@HienThiSV');
Route::get('xemviecduocgiao/{mssv}/{hoten}/{manth}','SinhvienController@CongViecSV');