<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session;
use App\Sinhvien;

class SinhvienController extends Controller
{
/*============================= Hiển thị thông tin của 1 sinh viên ========================================*/
    public function HienThiSV($masv){
        $sinhvien = Sinhvien::find($masv);
        
        return view('sinhvien.thong-tin-sinh-vien')->with('sv',$sinhvien);
    }
/*=========================== Sinh viên tự cập nhật thông tin ==============================================*/    
    public function CapNhatThongTin(Requests $request){
        $post = $request->all();
        $v = \Validator::make($request->all(),
                [
                    'txtSDT' => 'required|numeric'
                ]);
        $data = array(
             'sdt'              => $_post['txtDienThoai'],
             'kynangcongnghe'   => $_post['txtCongNghe'],
             'kienthuclaptrinh' => $_post['txtLapTrinh'],
             'kinhnghiem'       => $_post['txtKinhNghiem'],
        );
        $capnhat = DB::table('sinh_vien')->where('mssv',$post(''))->update($data);
        if($ch){
            return redirect(sinhvien/thongtinsv/1111317);
        }
        
    }
/*============================= Công việc được giao của 1 sinh viên ========================================*/
    public function CongViecSV($masv,$hoten,$manth)
    {
       $dsDuocGiao = DB::table('cong_viec as cv')->distinct()
               ->select('cv.macv','cv.congviec','cv.giaocho','cv.ngaybatdau_kehoach','cv.ngayketthuc_kehoach'
                                 ,'cv.sogio_thucte','cv.phuthuoc_cv','cv.uutien','cv.trangthai','cv.tiendo','cv.noidungthuchien')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->join('nhom_thuc_hien as nth','th.manhomthuchien','=','nth.manhomthuchien')
               ->join('dangky_nhom as dk','nth.manhomthuchien','=','dk.manhomthuchien')
               ->where('nth.manhomthuchien','=',$manth)
               ->where('cv.giaocho','like',$hoten)->orwhere('cv.giaocho','like','cả nhóm')
               ->get();
        
        return view('sinhvien.xem-cong-viec-duoc-giao')->with('dscv',$dsDuocGiao);
    }
/*=========================== Đổi mật khẩu Sinh Viên ==============================================*/   
    public function DoiMatKhauSV($masv){
        $row = DB::table('sinh_vien')->where('mssv',$masv)->first();
        return view('sinhvien.doi-mat-khau-sv')->with('sv', $row);
    } 
    public function LuuDoiMatKhauSV(Request $req){        
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
//                    'txtMaSV'      => 'required',
//                    'txtHoTen'     => 'required',
//                    'txtEmail'     => 'required',
                    'txtMatKhauCu' => 'required',
                    'txtMatKhauMoi1'  => 'required|min:6|different:txtMatKhauCu',
                    'txtMatKhauMoi2'  => 'required|min:6|same:txtMatKhauMoi1'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }        
    }
 /*=========================== Danh sách công việc nhóm ==============================================*/
    public function DanhSachCV($mssv){
        $manth = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $dscvnhom = DB::table('cong_viec as cv')->distinct()
               ->select('cv.macv','cv.congviec','cv.giaocho','cv.ngaybatdau_kehoach','cv.ngayketthuc_kehoach'
                                ,'cv.ngaybatdau_thucte','cv.ngayketthuc_thucte','cv.sogio_thucte'
                                 ,'cv.phuthuoc_cv','cv.uutien','cv.trangthai','cv.tiendo','cv.noidungthuchien')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->join('nhom_thuc_hien as nth','th.manhomthuchien','=','nth.manhomthuchien')
               ->join('dangky_nhom as dk','nth.manhomthuchien','=','dk.manhomthuchien')
               ->where('dk.mssv','=',$mssv)
               ->where('nth.manhomthuchien','=',$manth)
               ->get();
        
        return view('sinhvien.danh-sach-cong-viec')->with('dscv',$dscvnhom);
    }
     
}// END Class SinhvienController
