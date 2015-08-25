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

class TheodoikehoachController extends Controller
{
/*================== Số thời gian thực hiện dự án của mỗi sinh viên ======================*/ 
    function GioLam($hoten){
        $sogio = DB::table('nhom_thuc_hien as nth')->select('cv.sogio_thucte')
                ->join('dangky_nhom as dk','nth.manhomthuchien','=','dk.manhomthuchien')
                ->join('thuc_hien as th','th.manhomthuchien','=','dk.manhomthuchien')
                ->join('cong_viec as cv','th.macv','=','cv.macv')
                ->where('cv.giaocho','like',$hoten)
                ->get();
        foreach($sogio as $gio){
            $h = $gio->sogio_thucte;
            $tonggio = $h++;
        }
        return $tonggio;
    }
/*================== Danh sách đề tài thực hiện ======================*/   
    public function TheoDoiKH($macb){
        $dsdtnhom = DB::table('nhom_thuc_hien as nth')
                ->select('nth.manhomthuchien','dt.tendt','sv.hoten','nth.tochucnhom',
                        'nth.lichhop','nth.sogio_thucte','nth.tiendo')
                ->join('dangky_nhom as dk','nth.manhomthuchien','=','dk.manhomthuchien')
                ->join('sinh_vien as sv', 'dk.mssv','=','sv.mssv')
                ->join('ra_de_tai as radt','nth.manhomthuchien','=','radt.manhomthuchien')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('dt.macb',$macb)
                ->where('dk.nhomtruong','=',1)
                ->get();
        return view('giangvien.theo-doi-ke-hoach')->with('dsdtnhom',$dsdtnhom);
    }
/*======================= Theo dõi các công việc chính của 1 nhóm ==========================*/
    public function CVChinh($manth){
        $dstv = DB::table('sinh_vien as sv')
                ->select('dk.manhomthuchien','sv.mssv','sv.hoten','nth.sogio_thucte','dk.nhomtruong',
                        'sv.kynangcongnghe','sv.kienthuclaptrinh','sv.kinhnghiem')
                ->join('dangky_nhom as dk', 'sv.mssv','=','dk.mssv')
                ->join('nhom_thuc_hien as nth','dk.manhomthuchien','=','nth.manhomthuchien')
                ->where('dk.manhomthuchien',$manth)
                ->get();
        $dscvchinh = DB::table('nhom_thuc_hien as nth')
                ->join('thuc_hien as th','nth.manhomthuchien','=','th.manhomthuchien')
                ->join('cong_viec as cv','th.macv','=','cv.macv')
                ->where('nth.manhomthuchien',$manth)
                ->where('cv.phuthuoc_cv','=',0)
                ->get();
        $tendt = DB::table('ra_de_tai as radt')->select('dt.tendt')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->first(); 
//        foreach($dstv as $tv){
//            $giolam = $this->GioLam($tv->hoten);
//        }
        return view('giangvien.ke-hoach-cv-chinh')->with('dstv',$dstv)->with('dscvchinh',$dscvchinh)
            ->with('manth',$manth)->with('tendt',$tendt);
    }
/*======================= Theo dõi các công việc phụ thuộc của 1 công việc chính ==========================*/
    public function CVPhuThuoc($manth,$macv){ 
        $tencvchinh = DB::table('cong_viec as cv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('cv.macv',$macv)
                ->first();
        $dscvphu = DB::table('cong_viec')
                ->where('phuthuoc_cv','=',$macv)
                ->get();
        return view('giangvien.ke-hoach-cv-phuthuoc')->with('dscvphu',$dscvphu)->with('tencvchinh',$tencvchinh);
    }
    
}
