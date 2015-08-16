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
/*============================= Hiển thị Côn việc được giao của 1 sinh viên ========================================*/
    public function CongViecSV($masv,$hoten,$manth)
    {
       $dsDuocGiao = DB::table('cong_viec as cv')->distinct()
               ->select('cv.macv','cv.congviec','cv.giaocho','cv.ngaybatdau_kehoach','cv.ngayketthuc_kehoach'
                                 ,'cv.sogio_thucte','cv.phuthuoc_cv','cv.uutien','cv.trangthai','cv.tiendo','cv.noidungthuchien')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->join('nhom_thuc_hien as nth','th.manhomthuchien','=','nth.manhomthuchien')
               ->join('dangky_nhom as dk','nth.manhomthuchien','=','dk.manhomthuchien')
               ->where('nth.manhomthuchien','=',$manth)
               ->where('cv.giaocho','like','$hoten')->orwhere('cv.giaocho','like','cả nhóm')
               ->get();
        
        return view('sinhvien.xem-cong-viec-duoc-giao')->with('dscv',$dsDuocGiao);
    }
    
}
