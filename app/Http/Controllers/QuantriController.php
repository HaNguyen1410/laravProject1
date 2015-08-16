<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Giangvien;
use DB;

class QuantriController extends Controller
{
/*######## Quản trị Giảng Viên  ###########*/
/*=========================== Thông tin quản trị viên ==============================================*/ 
    public function ThongTinQT($macb){
        $giangvien = Giangvien::find($macb);
        $tennhomhp = DB::table('giang_vien as gv')
                ->join('de_tai as dt','gv.macb','=','dt.macb')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('nhom_hocphan as hp','radt.manhomhp','=','hp.manhomhp')
                ->value('tennhomhp');
        return view('quantri.thong-tin-quan-tri-vien')->with('gv',$giangvien)->with('hp',$tennhomhp);
    }
 /*=========================== Đổi mật khẩu ==============================================*/   
    public function DoiMatKhauQT($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        return view('quantri.doi-mat-khau-qt')->with('gv', $row);
    } 
    public function LuuDoiMatKhauQT(Request $req){        
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
//                    'txtMaCB'      => 'required',
//                    'txtHoTen'     => 'required',
//                    'txtEmail'     => 'required',
                    'txtMatKhauCu' => 'required',
                    'txtMatKhauMoi1'  => 'required',
                    'txtMatKhauMoi2'  => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $hinhdaidien = DB::table('giang_vien')->where('macb','$post([txaCB])')->value('hinhdaidien');
            
            $data = array(
                    'hinhdaidien'   => ($_POST['fHinh'] != "") ? $_POST['fHinh'] : $hinhdaidien,
                    'matkhau'       => $_POST['txtMatKhau1']
            );
            $ch = DB::table('giang_vien')->where('macb',$post(['txtMaCB']))->update($data);
            if($ch > 0){
                return redirect('quantri/thongtinqt/9876');
            }
        }
    }
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachGV(){
        $ds = DB::table('giang_vien')->paginate(5);
        return view('quantri.quan-tri-giang-vien')->with('dsgv',$ds);
    }
/*=========================== Thêm giảng viên ==============================================*/ 
    public function ThemGV(){
        return view('quantri.them-giang-vien');
    }   

    public function LuuThemGV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaCB'     => 'required',
                    'txtHoTen'    => 'required',
                    'rdGioiTinh'  => 'required',
                    'rdGioiTinh'  => 'required',
                    'txtEmail'    => 'required',
                    'txtMatKhau1' => 'required',
                    'txtMatKhau2' => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'macb'     => $_POST['txtMaCB'],
                    'hoten'    => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh' => $_POST['txtNgaySinh'],
                    'email'    => $_POST['txtEmail'],
                    'sdt'      => $_POST['txtSDT'],
                    'matkhau' => $_POST['txtMatKhau1']
            );
            $ch = DB::table('giang_vien')->insert($data);
            if($ch > 0){
                return redirect('quantri/danhsachgv');
            }
        }
    }
/*=========================== Sửa thông tin Giảng viên ==============================================*/ 
    public function CapNhatGV($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        return view('quantri.cap-nhat-giang-vien')->with('gv',$row);
    } 
    
    public function LuuCapNhatGV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaCB'     => 'required',
                    'txtHoTen'    => 'required',
                    'txtNgaySinh' => 'required',
                    'txtEmail'    => 'required',
                    'txtSDT'      => 'required',
                    'txtMatKhauCu' => 'required',
                    'txtMatKhauMoi1' => 'required',
                    'txtMatKhauMoi2' => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'macb'      => $_POST['txtMaCB'],
                    'hoten'     => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh'  => $_POST['txtNgaySinh'],
                    'email'     => $_POST['txtEmail'],
                    'sdt'       => $_POST['txtSDT'],
                    'matkhau'   => $_POST['txtMatKhauMoi1'],
                    'khoa'      => isset($_POST['ckbKhoa']) ? 0 : 1 ,
                    'quantri'   => isset($_POST['ckbQuanTri']) ? 1 : 0
            );
            $ch = DB::table('giang_vien')->where('macb',$post['txtMaCB'])->update($data);
            if($ch > 0){
                return redirect('quantri/danhsachgv');
            }
        }
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaGV($macb){
        $delete = DB::table('giang_vien')->where('macb',$macb)->delete();
        $tencb = DB::table('giang_vien')->where('macb',$macb)->value('hoten');
        \Session::flash('ThongBao','Xóa '.$tencb.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('quantri/danhsachgv');
        }
    }

    /*########## Quản trị Sinh Viên #############*/
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachSV(){
        $ds = DB::table('sinh_vien')->paginate(5);
        return view('quantri.quan-tri-sinh-vien')->with('dssv',$ds);
    }  
/*=========================== Thêm sinh viên ==============================================*/ 
    public function ThemSV(){
        return view('quantri.them-sinh-vien');
    } 
    
    public function LuuThemSV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaSV'     => 'required',
                    'txtHoTen'    => 'required',
                    'rdGioiTinh'  => 'required',
                    'txtNgaySinh' => 'required',
                    'txtEmail'    => 'required',
                    'txtKhoaHoc'  => 'required',
                    'txtMatKhau1' => 'required',
                    'txtMatKhau2' => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'mssv'     => $_POST['txtMaSV'],
                    'hoten'    => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh' => $_POST['txtNgaySinh'],
                    'email'    => $_POST['txtEmail'],
                    'khoahoc'  => $_POST['txtKhoaHoc'],
                    'matkhau' => $_POST['txtMatKhau1']
            );
            $ch = DB::table('sinh_vien')->insert($data);
            if($ch > 0){
                return redirect('quantri/danhsachsv');
            }
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatSV($masv){
        $row = DB::table('sinh_vien')->where('mssv',$masv)->first();
        return view('quantri.cap-nhat-sinh-vien')->with('sv',$row);
    } 
    
    public function LuuCapNhatSV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaSV'     => 'required',
                    'txtHoTen'    => 'required',
                    'txtNgaySinh' => 'required',
                    'txtEmail'    => 'required',
                    'txtKhoaHoc'  => 'required',
                    'txtSDT'      => 'required',
                    'txtMatKhauCu' => 'required',
                    'txtMatKhauMoi1' => 'required',
                    'txtMatKhauMoi2' => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'mssv'      => $_POST['txtMaSV'],
                    'hoten'     => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh'  => $_POST['txtNgaySinh'],
                    'email'     => $_POST['txtEmail'],
                    'khoahoc'   => $_POST['txtKhoaHoc'],
                    'matkhau'   => $_POST['txtMatKhauMoi1'],
                    'khoa'      => isset($_POST['ckbKhoa']) ? 0 : 1
            );
            $ch = DB::table('sinh_vien')->where('mssv',$post['txtMaSV'])->update($data);
            if($ch > 0){
                return redirect('quantri/danhsachsv');
            }
        }
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaSV($masv){
        $delete = DB::table('sinh_vien')->where('mssv',$masv)->delete();
        $tensv = DB::table('sinh_vien')->where('mssv',$masv)->value('hoten');
        \Session::flash('ThongBao','Xóa '.$tensv.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('quantri/danhsachsv');
        }
    }
    
}
