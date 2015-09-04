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
        $tonggio = DB::table('cong_viec as cv')->select('chn.mssv',DB::raw('SUM(cv.sogio_thucte) as tonggio'))
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->join('chia_nhom as chn','th.manhomthuchien','=','chn.manhomthuchien')
                ->where('cv.giaocho','like',$hoten)
                ->first();
        
        return $tonggio;
    }
/*================== Danh sách đề tài thực hiện ======================*/   
    public function TheoDoiKH($macb){
        $dsdtnhom = DB::table('nhom_thuc_hien as nth')
                ->select('nth.manhomthuchien','dt.tendt','sv.hoten','nth.tochucnhom',
                        'nth.lichhop','nth.sogio_thucte','nth.tiendo')
                ->join('chia_nhom as chn','nth.manhomthuchien','=','chn.manhomthuchien')
                ->join('sinh_vien as sv', 'chn.mssv','=','sv.mssv')
                ->join('ra_de_tai as radt','nth.manhomthuchien','=','radt.manhomthuchien')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('dt.macb',$macb)
                ->where('chn.nhomtruong','=',1)
                ->get();
        $namhoc = DB::table('nien_khoa')->distinct()->select('nam')
                ->get();
        $hocky = DB::table('nien_khoa')->distinct()->select('hocky')
                ->get();
        $nhomhp = DB::table('nhom_hocphan as hp')->distinct()
                ->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->get();
        return view('giangvien.theo-doi-ke-hoach')->with('dsdtnhom',$dsdtnhom)->with('nhomhp',$nhomhp)
                    ->with('namhoc',$namhoc)->with('hocky',$hocky);
    }
/*======================= Theo dõi các công việc chính của 1 nhóm ==========================*/
    public function CVChinh($manth){
        $dstv = DB::table('sinh_vien as sv')
                ->select('chn.manhomthuchien','sv.mssv','sv.hoten','nth.sogio_thucte','chn.nhomtruong',
                        'sv.kynangcongnghe','sv.kienthuclaptrinh','sv.kinhnghiem')
                ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
                ->join('nhom_thuc_hien as nth','chn.manhomthuchien','=','nth.manhomthuchien')
                ->where('chn.manhomthuchien',$manth)
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
        $dsmanhom = DB::table('chia_nhom')->select('manhomthuchien')->lists('manhomthuchien');
        $tensv = DB::table('sinh_vien as sv')->select('sv.hoten')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->whereIn('chn.manhomthuchien',$dsmanhom)
                ->value('sv.hoten');
        $giolam = $this->GioLam($tensv);
 
        return view('giangvien.ke-hoach-cv-chinh')->with('dstv',$dstv)->with('dscvchinh',$dscvchinh)
            ->with('manth',$manth)->with('tendt',$tendt)->with('giolam',$giolam);
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
/*============================ DUYỆT ĐỀ TÀI =====================================*/   
    public function LuuDuyetDeTai(){
        
    }
}
