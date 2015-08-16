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
Route::post('luudoimatkhauqt','QuantriController@LuuDoiMatKhauQT');

/*######## Giảng Viên ##################*/
Route::get('quantri/danhsachgv','QuantriController@DanhSachGV');
Route::get('quantri/danhsachgv/themgv','QuantriController@ThemGV');
/*======= Thêm giảng viên mới==========*/
Route::post('luuthemgv','QuantriController@LuuThemGV');
Route::get('quantri/danhsachgv/capnhatgv/{macb}','QuantriController@CapNhatGV');
/*======= Cập nhật thông tin giảng viên ==========*/
Route::post('luucapnhatgv','QuantriController@LuuCapNhatGV');
Route::get('quantri/danhsachgv/xoagv/{macb}','QuantriController@XoaGV');

/*######## Sinh Viên ##################*/
Route::get('quantri/danhsachsv','QuantriController@DanhSachSV');
Route::get('quantri/danhsachsv/themsv','QuantriController@ThemSV');
/*======= Trang thêm sinh viên mới==========*/
Route::post('luuthemsv','QuantriController@LuuThemSV');
Route::get('quantri/danhsachsv/capnhatsv/{masv}','QuantriController@CapNhatSV');
/*======= Cập nhật thông tin sinh viên ==========*/
Route::post('luucapnhatsv','QuantriController@LuuCapNhatSV');
Route::get('quantri/danhsachsv/xoasv/{masv}','QuantriController@XoaSV');

/*=========================== Trang giảng viên ===========================================*/
Route::get('vidu','GiangvienController@ViDu');
/*======= Hiển thị trang thông tin giảng viên ==========*/
Route::get('thongtingv','GiangvienController@ThongTin_gv');
Route::get('giangvien/thongtingv/{macb}','GiangvienController@ThongTinGV');
/*======= Trang đổi mật khẩu giảng viên ==========*/
Route::get('giangvien/doimatkhaugv/{masv}','GiangvienController@DoiMatKhauGV');
Route::post('luudoimatkhaugv','GiangvienController@LuuDoiMatKhauGV');

/*=========================== Trang sinh viên ===========================================*/
/*======= Hiển thị trang thông tin sinh viên ==========*/
Route::get('sinhvien/thongtinsv/{mssv}','SinhvienController@HienThiSV');
Route::post('sinhvien/capnhatthongtin','SinhvienController@CapNhatThongTin');
/*======= Trang xem công việc được giao ==========*/
Route::get('sinhvien/xemviecduocgiao/{mssv}/{hoten}/{manth}','SinhvienController@CongViecSV');
/*======= Trang đổi mật khẩu sinh viên ==========*/
Route::get('sinhvien/doimatkhausv/{masv}','SinhvienController@DoiMatKhauSV');
Route::post('luudoimatkhausv','SinhvienController@LuuDoiMatKhauSV');
/*======= Xem danh sách công việc của cả nhóm ==========*/
Route::get('sinhvien/danhsachcv/{mssv}','SinhvienController@DanhSachCV');
/*======= Xem điểm ==========*/
Route::get('sinhvien/xemdiem/{mssv}','SinhvienController@XemDiem');