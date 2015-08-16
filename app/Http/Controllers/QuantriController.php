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
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachGV(){
        $ds = DB::table('giang_vien')->paginate(5);
        return view('quantri.quan-tri-giang-vien')->with('dsgv',$ds);
    }
/*=========================== Thêm giảng viên ==============================================*/ 
    public function ThemGV(){
        return view('quantri.them-giang-vien');
    }   

    public function LuuGV(Request $req){
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
                return redirect('danhsachgv');
            }
        }
    }
/*=========================== Sửa thông tin Giảng viên ==============================================*/ 
    public function CapNhatGV($id){
        $row = DB::table('giang_vien')->where('id',$id)->first();
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
            $ch = DB::table('giang_vien')->where('id',$post['ID'])->update($data);
            if($ch > 0){
                return redirect('danhsachgv');
            }
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
    
    public function LuuSV(Request $req){
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
                    'mssv'     => $_POST['txtMaCB'],
                    'hoten'    => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh' => $_POST['txtNgaySinh'],
                    'email'    => $_POST['txtEmail'],
                    'khoahoc'  => $_POST['txtKhoaHoc'],
                    'matkhau' => $_POST['txtMatKhau1']
            );
            $ch = DB::table('sinh_vien')->insert($data);
            if($ch > 0){
                return redirect('danhsachsv');
            }
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatSV($id){
        $row = DB::table('sinh_vien')->where('id',$id)->first();
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
            $ch = DB::table('sinh_vien')->where('id',$post['txtID'])->update($data);
            if($ch > 0){
                //return redirect('danhsachsv');
            }
        }
    }
    
}
