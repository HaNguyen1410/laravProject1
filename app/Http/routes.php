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

/***********************
 * =========================== ĐĂNG NHẬP ===========================================
 * ************************
 */
Route::get('dangnhap', 'DangNhapController@DangNhap');

Route::get('dangxuat', 'DangNhapController@DangXuat');
//Route::resource('sessions','SessionsController');
/*######### Góibestmomo/scafold": "dev-master" đăng nhập ################*/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
//Đường Link: http://localhost/laravProject1/public/auth/login

/***********************
 * =========================== Trang quản trị ===========================================
 * ************************
 */
Route::get('quantri/thongtinqt/{macb}','QuantriController@ThongTinQT');
Route::get('quantri/doimatkhauqt/{macb}','QuantriController@DoiMatKhauQT');
Route::post('luudoimatkhauqt','QuantriController@LuuDoiMatKhauQT');
Route::post('doihinhdaidienqt','QuantriController@DoiHinhDaiDienQT');
Route::get('quantri/saoluu', function () {
    return view('quantri.sao-luu-phuc-hoi-du-lieu')->with('giatri',1);
});
Route::post('quantri/saoluucsdl','QuantriController@SaoLuuCSDL');
//Route::get('quantri/saoluucsdl', function () {
//      $exitCode = Artisan::call('db:backup'); 
//      $run = new KetxuatCSDL();
//     App\Console\Commands\KetxuatCSDL::handle();
//    return view('quantri.sao-luu-phuc-hoi-du-lieu');
//});

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
Route::get('quantri/danhsachgv/xoagvkhoihocphan/{mahp}','QuantriController@RutGVTrongHP');

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
 * =========================== TRANG GIẢNG VIÊN ===========================================
 * ***********************
 */
Route::get('vidu','GiangvienController@ViDu');
/*======= Hiển thị trang thông tin giảng viên ==========*/
Route::get('thongtingv','GiangvienController@ThongTin_gv');
Route::get('giangvien/thongtingv/{macb}','GiangvienController@ThongTinGV');
/*======= Trang ĐỔI MẬT KHẨU giảng viên ==========*/
Route::get('giangvien/doimatkhaugv/{macb}','GiangvienController@DoiMatKhauGV');
Route::post('luudoimatkhaugv','GiangvienController@LuuDoiMatKhauGV');
route::post('doihinhdaidiengv','GiangvienController@DoiHinhDaiDienGV');
/*========= NHẬP ĐIỂM ==========*/
Route::get('giangvien/nhapdiem/{macb}','DiemController@NhapDiem');
Route::post('luunhapdiem','DiemController@LuuNhapDiem');
route::get('giangvien/nhapdiem/{macb}/inbangdiemgv','IntrangController@InBangDiemGV');
/*======= Quản lý TÀI LIỆU ==========*/
route::get('giangvien/khotailieu/{macb}','QltailieuController@KhoTaiLieu');
route::get('giangvien/khotailieu/{macb}/khotailieuchitiet/{manth}','QltailieuController@KhoTaiLieuChiTiet');
route::post('luudanhgia','QltailieuController@LuuDanhGia');
/*======= QUẢN LÝ ĐỀ TÀI ==========*/
Route::get('giangvien/danhsachdetai/{macb}','DetaiController@DsDeTai');
Route::get('giangvien/danhsachdetai/xoadt/{madt}','DetaiController@XoaDeTai');
Route::get('giangvien/danhsachdetai/{macb}/inchitietdetai/{madt}','IntrangController@InChiTietDeTai');
          /*  * Thêm đề tài mới */
Route::get('giangvien/danhsachdetai/{macb}/themdetai','DetaiController@ThemDeTai');
Route::post('luuthemdetai','DetaiController@LuuThemDeTai');
Route::post('uploadmotadetai','DetaiController@UploadMoTaDeTai');
         /*  * Cập nhật đề tài */
Route::get('giangvien/danhsachdetai/{macb}/capnhatdetai/{madt}','DetaiController@CapNhatDeTai');
Route::post('luucapnhatdetai','DetaiController@LuuCapNhatDeTai');
/*======= QUY ĐỊNH TIÊU CHÍ CHẤM ĐIỂM ==========*/
route::get('giangvien/dstieuchi/{macb}','QdtieuchiController@DSTieuChi');
route::post('luuthemtc','QdtieuchiController@LuuThemTieuChi');
        /*  * Cập nhật tiêu chí đánh giá  */
route::get('giangvien/dstieuchi/{macb}/capnhattieuchi/{matc}','QdtieuchiController@CapNhatTieuChi');
route::post('luucapnhattc','QdtieuchiController@LuuCapNhatTieuChi');
    /*======= Xóa thông tiêu chí đánh giá ==========*/
Route::get('giangvien/dstieuchi/{macb}/xoatieuchi/{matc}','QdtieuchiController@XoaTieuChi');
/*======= THEO DÕI KẾ HOẠCH làm niên luận của sinh viên ==========*/
route::get('giangvien/theodoikehoach/{macb}', 'TheodoikehoachController@TheoDoiKH');
//route::post('giangvien/theodoikehoach/{macb}/{mahp}', 'TheodoikehoachController@TheoDoiKH');
route::get('giangvien/theodoikehoach/cvchinh/{manth}', 'TheodoikehoachController@CVChinh');
route::get('giangvien/theodoikehoach/cvphuthuoc/{manth}/{macvchinh}', 'TheodoikehoachController@CVPhuThuoc');
/*============= CHIA NHÓM NIÊN LUẬN - GIAO ĐỀ TÀI CHO MỖI NHÓM ===================*/
route::get('giangvien/chianhom/{macb}','ChianhomController@ChiaNhomNL');
route::post('luuchianhomnienluan','ChianhomController@LuuChiaNhomNL');
route::get('giangvien/chianhom/{macb}/xoasvtrongnhom/{mssv}','ChianhomController@XoaSVTrongNhom');

/*======= QUẢN LÝ THÔNG BÁO ==========*/
route::get('giangvien/quanlythongbao/{macb}','QlthongbaoController@QuanLyThongBao');
route::post('luuthemthongbao','QlthongbaoController@LuuThemThongBao');
    /*======== Cập nhật thông báo ===========*/
route::get('giangvien/quanlythongbao/{macb}/capnhatthongbao/{matb}','QlthongbaoController@CapNhatThongBao');
route::post('luucapnhatthongbao','QlthongbaoController@LuuCapNhatThongBao');
/*======= Xóa Thông báo ==========*/
Route::get('giangvien/quanlythongbao/{macb}/xoathongbao/{matb}','QlthongbaoController@XoaThongBao');

/*********************
 * =========================== TRANG SINH VIÊN ===========================================
 * *************************
 */
/*======= Hiển thị TRANG THÔNG TIN SINH VIÊN ==========*/
Route::get('sinhvien/thongtinsv/{mssv}','SinhvienController@HienThiSV');
Route::get('sinhvien/thongtinsv/{mssv}/inchitietdetaisv/{madt}','IntrangController@InChiTietDeTaiSV');
Route::post('luucapnhatthongtin','SinhvienController@LuuCapNhatThongTin');
//Route::get('sinhvien/thongtinsv/{mssv}/xemtaptin/{tentaptin}','SinhvienController@XemTapTin');
/*======= Trang xem công việc được giao ==========*/
Route::get('sinhvien/xemviecduocgiao/{mssv}/{hoten}/{manth}','SinhvienController@CongViecSV');
/*======= TRANG ĐỔI MẬT KHẨU SINH VIÊN ==========*/
Route::get('sinhvien/doimatkhausv/{masv}','SinhvienController@DoiMatKhauSV');
Route::post('luudoimatkhausv','SinhvienController@LuuDoiMatKhauSV');
route::post('doihinhdaidiensv','SinhvienController@DoiHinhDaiDienSV');
/*======= XEM ĐIỂM ==========*/
Route::get('sinhvien/xemdiem/{mssv}','DiemController@XemDiem');
route::get('sinhvien/xemdiem/{mssv}/inbangdiemsv','IntrangController@InBangDiemSV');
/*======= THÔNG TIN NHÓM NIÊN LUẬN ==========*/
Route::get('sinhvien/themthongtinnhom/{mssv}','SVthongtinnhomController@ThemThongTinNhom');
Route::post('luuthemthongtinnhom','SVthongtinnhomController@LuuThemThongTinNhom');

/*======= PHÂN CÔNG NHIỆM VỤ ==========*/
/*======= XEM DANH SÁCH CÔNG VIỆC của cả nhóm ==========*/
Route::get('sinhvien/danhsachcv/{mssv}','PhancvController@DanhSachCV');
      /* ++ * CÔNG VIỆC CHÍNH  */
Route::get('sinhvien/phancv/{mssv}','PhancvController@DSPhanCV');
    /* ++ * Thêm Công việc chính  */
Route::get('sinhvien/phancv/{mssv}/themcvchinh','PhancvController@ThemcvChinh');
Route::post('luuthemcvchinh','PhancvController@LuuThemcvChinh');
    /* ++ * Cập nhật Công việc chính  */
Route::get('sinhvien/phancv/{mssv}/capnhatcvchinh/{macv}','PhancvController@CapNhatcvChinh');
Route::post('luucapnhatcvchinh','PhancvController@LuuCapNhatcvChinh');
/* ------ Xóa công việc chính -------- */
Route::get('sinhvien/phancv/{mssv}/xoacvchinh/{macv}','PhancvController@XoacvChinh');
     /* ++  * CÔNG VIỆC CHI TIẾT   */
Route::get('sinhvien/phancongchitiet/{mssv}/{macv}','PhancvController@DSPhanChiTiet');
    /* ++ * Thêm công việc chi tiết (công việc phụ thuộc)  */
Route::get('sinhvien/phancongchitiet/{mssv}/{macv}/themcvphu','PhancvController@ThemcvPhu');
Route::post('luuthemcvphu','PhancvController@LuuThemcvPhu');
    /* ++ * Cập nhật công việc chi tiết (công việc phụ thuộc)  */
Route::get('sinhvien/phancongchitiet/{mssv}/{macv}/capnhatcvphu/{macvphu}','PhancvController@CapNhatcvPhu');
Route::post('luucapnhatcvphu','PhancvController@LuuCapNhatcvPhu');
/* ------ Xóa công việc chi tiết (công việc phụ thuộc) -------- */
Route::get('sinhvien/phancongchitiet/{mssv}/{macv}/xoacvphu/{macvphu}','PhancvController@XoacvPhu');
/*======= NỘP TÀI LIỆU ==========*/
route::get('sinhvien/noptailieu/{mssv}','QltailieuController@NopTaiLieu');
route::post('luunoptailieu','QltailieuController@LuuNopTaiLieu');
/* ------ Xóa tài liệu đã chọn -------- */
Route::get('sinhvien/noptailieu/{mssv}/xoatailieu/{matl}','QltailieuController@XoaTaiLieu');