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
        $manth = DB::table('dangky_nhom')->where('mssv','=',$masv)->value('manhomthuchien');
        $dstv = DB::table('sinh_vien as sv')
                ->join('dangky_nhom as dk', 'sv.mssv','=','dk.mssv')
                ->where('dk.manhomthuchien',$manth)
                ->get();
        $ttgv = DB::table('ra_de_tai as radt')->select('gv.macb','gv.hoten','gv.email','gv.sdt','radt.manhomthuchien')                
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->join('giang_vien as gv','dt.macb','=','gv.macb')
                ->where('radt.manhomthuchien',$manth)
                ->first();
        $hp = DB::table('dangky_nhom as dk')->select('hp.tennhomhp')
                ->join('nhom_hocphan as hp','dk.manhomhp','=','hp.manhomhp')
                ->where('dk.mssv',$masv)
                ->first();
        $nhomth = DB::table('nhom_thuc_hien')->where('manhomthuchien',$manth)->first();
        
        return view('sinhvien.thong-tin-sinh-vien')->with('sv',$sinhvien)->with('dstv',$dstv)
            ->with('ttgv',$ttgv)->with('hp',$hp)->with('nhomth',$nhomth);
    }
/*=========================== Sinh viên tự cập nhật thông tin ==============================================*/    
    public function LuuCapNhatThongTin(Request $request){
        $post = $request->all();
        $v = \Validator::make($request->all(),
                [
                    'txtDienThoai'        => 'required|numeric',
                    'txtLapTrinh'   => 'required',
                    'txtKinhNghiem' => 'required'
                ]
           );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $data = array(
                'sdt'              => $_POST['txtDienThoai'],
                'kynangcongnghe'   => $_POST['txtCongNghe'],
                'kienthuclaptrinh' => $_POST['txtLapTrinh'],
                'kinhnghiem'       => $_POST['txtKinhNghiem'],
            );
            $capnhat = DB::table('sinh_vien')->where('mssv',$post['txtMaSV'])->update($data);
            if($capnhat > 0){
                return redirect('sinhvien/thongtinsv/1111317');
            }
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
