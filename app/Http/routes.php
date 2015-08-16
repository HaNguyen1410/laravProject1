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
/***********************
 * =========================== Trang quản trị ===========================================
 * ************************
 */
Route::get('quantri/thongtinqt/{macb}','QuantriController@ThongTinQT');
Route::get('quantri/doimatkhauqt/{macb}','QuantriController@DoiMatKhauQT');
Route::post('luudoimatkhauqt','QuantriController@LuuDoiMatKhauQT');

/*
 * ######## Giảng Viên ##################
 */
Route::get('quantri/danhsachgv','QuantriController@DanhSachGV');
/*======= Thêm giảng viên mới==========*/
Route::get('quantri/danhsachgv/themgv','QuantriController@ThemGV');
Route::post('luuthemgv','QuantriController@LuuThemGV');
/*======= Cập nhật thông tin giảng viên ==========*/
Route::get('quantri/danhsachgv/capnhatgv/{macb}','QuantriController@CapNhatGV');
Route::post('luucapnhatgv','QuantriController@LuuCapNhatGV');
/*======= Xóa thông tin Giảng viên ==========*/
Route::get('quantri/danhsachgv/xoagv/{macb}','QuantriController@XoaGV');

/*
 * ######## Sinh Viên ##################
 */
Route::get('quantri/danhsachsv','QuantriController@DanhSachSV');
/*======= Trang thêm sinh viên mới==========*/
Route::get('quantri/danhsachsv/themsv','QuantriController@ThemSV');
Route::post('luuthemsv','QuantriController@LuuThemSV');
/*======= Cập nhật thông tin sinh viên ==========*/
Route::get('quantri/danhsachsv/capnhatsv/{masv}','QuantriController@CapNhatSV');
Route::post('luucapnhatsv','QuantriController@LuuCapNhatSV');
/*======= Xóa thông tin sinh viên ==========*/
Route::get('quantri/danhsachsv/xoasv/{masv}','QuantriController@XoaSV');

/**********************
 * =========================== Trang giảng viên ===========================================
 * ***********************
 */
Route::get('vidu','GiangvienController@ViDu');
/*======= Hiển thị trang thông tin giảng viên ==========*/
Route::get('thongtingv','GiangvienController@ThongTin_gv');
Route::get('giangvien/thongtingv/{macb}','GiangvienController@ThongTinGV');
/*======= Trang đổi mật khẩu giảng viên ==========*/
Route::get('giangvien/doimatkhaugv/{masv}','GiangvienController@DoiMatKhauGV');
Route::post('luudoimatkhaugv','GiangvienController@LuuDoiMatKhauGV');
/*======= Nhập điểm ==========*/
Route::get('giangvien/nhapdiem/{macb}','DiemController@NhapDiem');
    
/*======= Quản lý TÀI LIỆU ==========*/
route::get('giangvien/khotailieu/{macb}','QltailieuController@KhoTaiLieu');
        
/*======= Quản lý ĐỀ TÀI ==========*/
Route::get('giangvien/danhsachdetai/{macb}','DetaiController@DsDeTai');
Route::get('giangvien/danhsachdetai/xoadt/{madt}','DetaiController@XoaDeTai');
          /*  * Thêm đề tài mới */
Route::get('giangvien/danhsachdetai/{macb}/themdetai','DetaiController@ThemDeTai');
Route::post('luuthemdetai','DetaiController@LuuThemDeTai');
         /*  * Cập nhật đề tài */
Route::get('giangvien/danhsachdetai/{macb}/capnhatdetai/{madt}','DetaiController@CapNhatDeTai');
Route::post('luucapnhatdetai','DetaiController@LuuCapNhatDeTai');
/*======= Quy định tiêu chí chấm điểm ==========*/
route::get('giangvien/dstieuchi/{macb}','QdtieuchiController@DSTieuChi');
        /*  * Thêm tiêu chí đánh giá  */
route::get('giangvien/dstieuchi/{macb}/themtieuchi','QdtieuchiController@ThemTieuChi');
route::post('luuthemtc','QdtieuchiController@LuuThemTieuChi');
        /*  * Cập nhật tiêu chí đánh giá  */
route::get('giangvien/dstieuchi/{macb}/capnhattieuchi/{matc}','QdtieuchiController@CapNhatTieuChi');
route::post('luucapnhattc','QdtieuchiController@LuuCapNhatTieuChi');
/*======= Theo Dõi kế hoạch làm niên luận của sinh viên ==========*/
route::get('giangvien/theodoikehoach/{macb}', 'TheodoikehoachController@TheoDoiKH');
route::get('giangvien/theodoikehoach/cvchinh/{manth}', 'TheodoikehoachController@CVChinh');
route::get('giangvien/theodoikehoach/cvphuthuoc/{manth}/{macvchinh}', 'TheodoikehoachController@CVPhuThuoc');

/*********************
 * =========================== Trang sinh viên ===========================================
 * *************************
 */
/*======= Hiển thị trang thông tin sinh viên ==========*/
Route::get('sinhvien/thongtinsv/{mssv}','SinhvienController@HienThiSV');
Route::post('luucapnhatthongtin','SinhvienController@LuuCapNhatThongTin');

/*======= Trang xem công việc được giao ==========*/
Route::get('sinhvien/xemviecduocgiao/{mssv}/{hoten}/{manth}','SinhvienController@CongViecSV');
/*======= Trang đổi mật khẩu sinh viên ==========*/
Route::get('sinhvien/doimatkhausv/{masv}','SinhvienController@DoiMatKhauSV');
Route::post('luudoimatkhausv','SinhvienController@LuuDoiMatKhauSV');
/*======= Xem danh sách công việc của cả nhóm ==========*/
Route::get('sinhvien/danhsachcv/{mssv}','SinhvienController@DanhSachCV');
/*======= Xem điểm ==========*/
Route::get('sinhvien/xemdiem/{mssv}','DiemController@XemDiem');
/*======= Đăng ký đề tài niên luận ==========*/
Route::get('sinhvien/dangkydt/{mssv}','DangkydtController@DangKyDT');

/*======= Phân công nhiệm vụ ==========*/
      /* ++ * Công việc chính  */
Route::get('sinhvien/phancv/{mssv}','PhancvController@DSPhanCV');
    /* ++ * Thêm Công việc chính  */
Route::get('sinhvien/phancv/{mssv}/themcvchinh','PhancvController@ThemcvChinh');
Route::post('luuthemcvchinh','PhancvController@LuuThemcvChinh');
    /* ++ * Cập nhật Công việc chính  */
Route::get('sinhvien/phancv/{mssv}/capnhatcvchinh/{macv}','PhancvController@CapNhatcvChinh');
Route::post('luucapnhatcvchinh','PhancvController@LuuCapNhatcvChinh');
     /* ++  * Công việc chi tiết   */
Route::get('sinhvien/phancongchitiet/{mssv}/{macv}','PhancvController@DSPhanChiTiet');
    /* ++ * Thêm công việc chi tiết (công việc phụ thuộc)  */
Route::get('sinhvien/phancv/{mssv}/{macv}/themcvphu','PhancvController@ThemcvPhu');

    /* ++ * Cập nhật công việc chi tiết (công việc phụ thuộc)  */
Route::get('sinhvien/phancv/{mssv}/{macv}/capnhatcvphu/{macvphu}','PhancvController@CapNhatcvPhu');

/*======= Nộp tài liệu ==========*/
route::get('sinhvien/noptailieu','QltailieuController@NopTaiLieu');