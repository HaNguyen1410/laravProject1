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
Route::get('dangnhap', 'Auth\AuthController@DangNhap');
Route::post('dangnhap', 'Auth\AuthController@GoiDangNhap');

Route::get('dangxuat', 'Auth\AuthController@DangXuat');
//Route::resource('sessions','SessionsController'); Theo RestfulController.

/*######### Gói bestmomo/scafold": "dev-master" đăng nhập ################*/
//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);
//Đường Link: http://localhost/laravProject1/public/auth/login

/***********************
 * =========================== Trang quản trị ===========================================
 * ************************
 */
//Route::get('quantri/saoluucsdl', function () {
//      $exitCode = Artisan::call('db:backup'); 
//      $run = new KetxuatCSDL();
//     App\Console\Commands\KetxuatCSDL::handle();
//    return view('quantri.sao-luu-phuc-hoi-du-lieu');
//});
Route::group(['prefix'=>'quantri','middleware'=>'auth'],function(){
    Route::get('thongtinqt','QuantriController@ThongTinQT');
     /* ========= Đổi mật khẩu và hình đại diện ==========*/
    Route::get('doimatkhauqt','QuantriController@DoiMatKhauQT');
    Route::post('luudoimatkhauqt','QuantriController@LuuDoiMatKhauQT');
    Route::post('doihinhdaidienqt','QuantriController@DoiHinhDaiDienQT'); 
    /* ========= SAO LƯU PHỤC HỒI CSDL ==========*/
    Route::get('saoluu', function () {
        return view('quantri.sao-luu-du-lieu')->with('saoluu',1);
    });
    Route::post('saoluucsdl','QuantriController@SaoLuuCSDL');
     /* ========= PHỤC HỒI CSDL ==========*/
    Route::get('phuchoi', function () {
        return view('quantri.phuc-hoi-du-lieu')->with('phuchoi',1);
    });
    Route::post('phuchoicsdl','QuantriController@PhucHoiCSDL');
/*
 * ######## Quản trị Giảng Viên ##################
 */
    Route::get('giangvien','QuantriController@DanhSachGV');
    Route::group(['prefix'=>'giangvien'],function(){
    /*======= Thêm giảng viên mới==========*/
        Route::get('themgv','QuantriController@ThemGV');
        Route::post('luuthemgv','QuantriController@LuuThemGV');
    /*======= Cập nhật thông tin giảng viên ==========*/
        Route::get('capnhatgv/{macb}','QuantriController@CapNhatGV');
        Route::post('luucapnhatgv','QuantriController@LuuCapNhatGV');
    /*======= Xóa thông tin Giảng viên ==========*/
        Route::get('khoagv/{macb}','QuantriController@KhoaGV');
         Route::get('mokhoagv/{macb}','QuantriController@MoKhoaGV');
        Route::get('xoagvkhoihocphan/{mahp}','QuantriController@RutGVTrongHP');
    });
 /*
 * ######## Quản trị Sinh Viên ##################
 */
    Route::get('sinhvien/{mahp?}','QuantriController@DanhSachSV');
    route::post('sinhvien/laynhomhp','QuantriController@LayNhomHP');
    Route::group(['prefix'=>'sinhvien/{mahp?}'],function(){
        /*=========== In danh sách sinh viên =============*/
        Route::get('indanhsachsinhvien/{macbqt}','QuantriController@InDanhSachSV');        
     });
    Route::group(['prefix'=>'sinhvien'],function(){
        /*======= Trang thêm sinh viên mới==========*/
            Route::get('0/themsv','QuantriController@ThemSV');
            Route::post('0/luuthemsv','QuantriController@LuuThemSV');
        /*======= Cập nhật thông tin sinh viên ==========*/    
            Route::get('0/capnhatsv/{masv}','QuantriController@CapNhatSV');
            Route::post('0/luucapnhatsv','QuantriController@LuuCapNhatSV');
        /*======= Xóa thông tin sinh viên ==========*/
            Route::get('khoasv/{masv}','QuantriController@KhoaSV');
            Route::get('mokhoasv/{masv}','QuantriController@MoKhoaSV');
            Route::get('xoasv/{masv}','QuantriController@XoaSV');
        });        
});

/**********************
 * =========================== TRANG GIẢNG VIÊN ===========================================
 * ***********************
 */
Route::get('vidu','GiangvienController@ViDu');
/*======= VÍ DỤ Hiển thị trang thông tin giảng viên ==========*/
Route::get('thongtingv','GiangvienController@ThongTin_gv');

Route::group(['prefix'=>'giangvien','middleware'=>'auth'], function(){
    /*======= Hiển Trang TÌM KIẾM ==========*/
    route::post('ketquatimkiem','TimkiemController@GVTimKiem');
    /*======= Trang THÔNG TIN giảng viên ==========*/
    Route::get('thongtingv','GiangvienController@ThongTinGV');
    /*======= Trang ĐỔI MẬT KHẨU giảng viên ==========*/
    Route::get('doimatkhaugv','GiangvienController@DoiMatKhauGV');
    Route::post('luudoimatkhaugv','GiangvienController@LuuDoiMatKhauGV');
    route::post('doihinhdaidiengv','GiangvienController@DoiHinhDaiDienGV');
    /*======= QUY ĐỊNH TIÊU CHÍ CHẤM ĐIỂM ==========*/
    route::get('dstieuchi','QdtieuchiController@DSTieuChi');
    Route::group(['prefix'=>'dstieuchi'],function(){
        /*  * Thêm tiêu chí đánh giá * */
        route::get('themtieuchi','QdtieuchiController@ThemTieuChi');
        route::post('luuthemtc','QdtieuchiController@LuuThemTieuChi');
        route::post('luuthemtcdaco','QdtieuchiController@LuuThemTCDaCo');
         /*  * Cập nhật tiêu chí đánh giá * */
        route::get('capnhattieuchi/{matc}','QdtieuchiController@CapNhatTieuChi');
        route::post('luucapnhattc','QdtieuchiController@LuuCapNhatTieuChi');
        /* *  Xóa thông tiêu chí đánh giá  *  */
        Route::get('xoatieuchi/{matc}','QdtieuchiController@XoaTieuChi');
    });
    /*========= NHẬP ĐIỂM ==========*/
    Route::get('nhapdiem/{mahp?}','DiemController@NhapDiem');
    Route::post('nhapdiem/laymanhomhp','DiemController@LayMaNhomHP');
    Route::group(['prefix'=>'nhapdiem'],function(){       
        Route::post('luunhapdiem','DiemController@LuuNhapDiem');
        route::get('{macb}/inbangdiemgv/{mahp}','IntrangController@InBangDiemGV');
    });
    /*======= Quản lý TÀI LIỆU ==========*/
    route::get('khotailieu','QltailieuController@KhoTaiLieu');
    Route::group(['prefix'=>'khotailieu'],function(){        
        route::get('khotailieuchitiet/{manth}','QltailieuController@KhoTaiLieuChiTiet');
        /*============== Đánh giá tài liệu ===========*/
        route::get('khotailieuchitiet/{manth}/danhgiatailieu/{matl}','QltailieuController@DanhGiaTaiLieu');
        route::post('luudanhgia','QltailieuController@LuuDanhGia');
    });
    /*======= QUẢN LÝ ĐỀ TÀI ==========*/
    Route::get('danhsachdetai','DetaiController@DsDeTai');
    Route::group(['prefix'=>'danhsachdetai'],function(){
        Route::get('xoadt/{madt}','DetaiController@XoaDeTai');
        Route::get('{macb}/inchitietdetai/{madt}','IntrangController@InChiTietDeTai');
           /*  * Thêm đề tài mới chỉ gồm tên và tập tin đính kèm*/
        Route::post('uploadmotadetai','DetaiController@UploadMoTaDeTai');
                  /*  * Thêm đề tài mới */
        Route::get('themdetai','DetaiController@ThemDeTai');
        Route::post('luuthemdetai','DetaiController@LuuThemDeTai');
                 /*  * Cập nhật đề tài */
        Route::get('capnhatdetai/{madt}','DetaiController@CapNhatDeTai');
        Route::post('luucapnhatdetai','DetaiController@LuuCapNhatDeTai');
    });
    /*============= CHIA NHÓM NIÊN LUẬN - GIAO ĐỀ TÀI CHO MỖI NHÓM ===================*/
    /*
     * {mahp?} : dấu ? thể hiện rằng biến 'mahp' có hay không url vẫn chạy
     */
    route::get('chianhom/{mahp?}','ChianhomController@ChiaNhomNL');
    Route::group(['prefix'=>'chianhom'],function(){
        route::post('laynhomhp','ChianhomController@LayNhomHP');
        route::post('luuchianhomnienluan','ChianhomController@LuuChiaNhomNL');
        route::get('xoasvtrongnhom/{mssv}','ChianhomController@XoaSVTrongNhom');
        /*======== In danh sách nhóm đề tài của mỗi nhóm hp ===========*/
        route::get('{mahp?}/indanhsachdetainhom/{macb}','ChianhomController@InDanhSachDeTaiNhom');  
        /*======== Chuyển thành viên sang nhóm khác ===========*/
        route::get('chuyenthanhvien/{mssv}','ChianhomController@ChuyenThanhVien'); 
        route::post('luuchuyenthanhvien/{mssv}','ChianhomController@LuuChuyenThanhVien');
    });
    /*======= THEO DÕI KẾ HOẠCH làm niên luận của sinh viên ==========*/
    route::get('theodoikehoach', 'TheodoikehoachController@TheoDoiKH');
    Route::group(['prefix'=>'theodoikehoach'],function(){
        route::get('cvchinh/{manth}', 'TheodoikehoachController@CVChinh');
        route::get('cvchinh/{manth}/cvphuthuoc/{macvchinh}', 'TheodoikehoachController@CVPhuThuoc');
        //In danh sách kế hoạch của nhóm đang xem
        route::get('cvchinh/{manth}/indanhsachphancv', 'TheodoikehoachController@InDSPhanCV');
    });
    //route::post('giangvien/theodoikehoach/{macb}/{mahp}', 'TheodoikehoachController@TheoDoiKH');
    /*======= QUẢN LÝ THÔNG BÁO ==========*/
    route::get('quanlythongbao','QlthongbaoController@QuanLyThongBao');
    Route::group(['prefix'=>'quanlythongbao'],function(){
        /*======== Thêm thông báo ===========*/
        route::get('themthongbao','QlthongbaoController@ThemThongBao');
        route::post('luuthemthongbao','QlthongbaoController@LuuThemThongBao');        
        /*======== Cập nhật thông báo ===========*/
        route::get('capnhatthongbao/{matb}','QlthongbaoController@CapNhatThongBao');
        route::post('luucapnhatthongbao','QlthongbaoController@LuuCapNhatThongBao');
        /*======= Xóa Thông báo ==========*/
        Route::get('xoathongbao/{matb}','QlthongbaoController@XoaThongBao');
    });
});   

/*********************
 * =========================== TRANG SINH VIÊN ===========================================
 * *************************
 */
Route::group(['prefix'=>'sinhvien','middleware'=>'auth'],function(){
    /*======= Hiển Trang TÌM KIẾM ==========*/
    route::post('ketquatimkiem','TimkiemController@SVTimKiem');
    /*======= Hiển thị TRANG THÔNG TIN SINH VIÊN ==========*/
    Route::get('thongtinsv','SinhvienController@HienThiSV');
    Route::group(['prefix'=>'thongtinsv'],function(){
        Route::get('inchitietdetaisv/{madt}','IntrangController@InChiTietDeTaiSV');
        Route::get('capnhatkynang','SinhvienController@CapNhatKyNang');
        Route::post('luucapnhatthongtin','SinhvienController@LuuCapNhatThongTin');
    });
    
    /*======= Trang xem công việc được giao ==========*/
    Route::get('xemviecduocgiao','SinhvienController@CongViecSV');
    /*======= TRANG ĐỔI MẬT KHẨU SINH VIÊN ==========*/
    Route::get('doimatkhausv','SinhvienController@DoiMatKhauSV');
    Route::post('luudoimatkhausv','SinhvienController@LuuDoiMatKhauSV');
    route::post('doihinhdaidiensv','SinhvienController@DoiHinhDaiDienSV');
    /*======= XEM ĐIỂM ==========*/
    Route::get('xemdiem','DiemController@XemDiem');
    route::get('xemdiem/inbangdiemsv','IntrangController@InBangDiemSV');
    /*======= THÔNG TIN NHÓM NIÊN LUẬN ==========*/
    Route::get('themthongtinnhom','SVthongtinnhomController@ThemThongTinNhom');
    Route::post('luuthemthongtinnhom','SVthongtinnhomController@LuuThemThongTinNhom');
    /*======= XEM DANH SÁCH CÔNG VIỆC của cả nhóm ==========*/
    Route::get('danhsachcvchinh','PhancvController@DanhSachCVChinh');
    Route::group(['prefix'=>'danhsachcvchinh'], function(){
        Route::get('danhsachcv/{macvchinh}','PhancvController@DanhSachCV');
        Route::get('indanhsachphancv/{manth}','PhancvController@InDanhSachPhanCV');        
    });
    
/*====##### Chức năng của NHÓM TRƯỞNG #####====*/
    /*======= PHÂN CÔNG NHIỆM VỤ ==========*/
      /* ++ * CÔNG VIỆC CHÍNH  */
    Route::get('phancv','PhancvController@DSPhanCV');
    Route::group(['prefix'=>'phancv'],function(){
         /* ++ * Thêm Công việc chính  */
        Route::get('themcvchinh','PhancvController@ThemcvChinh');
        Route::post('luuthemcvchinh','PhancvController@LuuThemcvChinh');
            /* ++ * Cập nhật Công việc chính  */
        Route::get('capnhatcvchinh/{macv}','PhancvController@CapNhatcvChinh');
        Route::post('luucapnhatcvchinh','PhancvController@LuuCapNhatcvChinh');
        /* ------ Xóa công việc chính -------- */
        Route::get('xoacvchinh/{macv}','PhancvController@XoacvChinh');
        /* ++  * CÔNG VIỆC CHI TIẾT   */
        Route::get('phancongchitiet/{macv}','PhancvController@DSPhanChiTiet');
            /* ++ * Thêm công việc chi tiết (công việc phụ thuộc)  */
        Route::get('phancongchitiet/{macv}/themcvphu','PhancvController@ThemcvPhu');
        Route::post('luuthemcvphu','PhancvController@LuuThemcvPhu');
            /* ++ * Cập nhật công việc chi tiết (công việc phụ thuộc)  */
        Route::get('phancongchitiet/{macv}/capnhatcvphu/{macvphu}','PhancvController@CapNhatcvPhu');
        Route::post('luucapnhatcvphu','PhancvController@LuuCapNhatcvPhu');
        /* ------ Xóa công việc chi tiết (công việc phụ thuộc) -------- */
        Route::get('phancongchitiet/{macv}/xoacvphu/{macvphu}','PhancvController@XoacvPhu');
    });      
    /*======= danh sách NỘP TÀI LIỆU ==========*/
    route::get('danhsachnoptailieu','QltailieuController@DanhSachNopTaiLieu');
    Route::group(['prefix'=>'danhsachnoptailieu'],function(){
        /* ------ Nộp tài liệu -------- */
        route::get('noptailieu','QltailieuController@NopTaiLieu');
        route::post('luunoptailieu','QltailieuController@LuuNopTaiLieu');
        /* ------ Cập nhật tài liệu -------- */
        route::get('capnhatnoptailieu/{matl}','QltailieuController@CapNhatNopTL');
        route::post('luucapnhatnoptailieu','QltailieuController@LuuCapNhatNopTL');
        /* ------ Xóa tài liệu đã chọn -------- */
        Route::get('xoatailieu/{matl}','QltailieuController@XoaTaiLieu');
        });          
});

     
