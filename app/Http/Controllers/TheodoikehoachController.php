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
use App\Http\Controllers\Auth;

class TheodoikehoachController extends Controller
{
/*================== Số thời gian thực hiện dự án của mỗi sinh viên ======================*/ 
    function GioLam($hoten){
        $tonggio = DB::table('cong_viec as cv')->select('chn.mssv',DB::raw('SUM(cv.sotuan_thucte) as tonggio'))
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->join('chia_nhom as chn','th.manhomthuchien','=','chn.manhomthuchien')
                ->where('cv.giaocho','like',$hoten)
                ->first();
        
        return $tonggio;
    }
/*================== Danh sách đề tài thực hiện ======================*/   
    public function TheoDoiKH(){
        $macb = \Auth::user()->taikhoan;
         //Lấy năm và học kỳ hiện tại
        //Lấy học kỳ niên khóa sau cùng của 1 cán bộ
        $namcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.nam');
        $hkcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.hocky');
        $mankcb = DB::table('nhom_hocphan')->where('macb',$macb)->value('mank');
        if(count($mankcb) == 0){
            //Lấy năm học và học kỳ hiện tại      
            $namcb = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
            $hkcb = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                    ->where('nam',$namcb)
                    ->value('hocky');
        }
        $dsdtnhom = DB::table('nhom_thuc_hien as nth')
                ->select('nth.manhomthuchien','dt.tendt','sv.hoten','nth.tochucnhom',
                        'nth.lichhop','nth.sotuan_thucte','nth.sotuan_kehoach','nth.tiendo')
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
                 ->with('namcb',$namcb)->with('hkcb',$hkcb)
                    ->with('namhoc',$namhoc)->with('hocky',$hocky);
    }
/*=========================== In Danh sách phân công việc của cả nhóm ==============================================*/   
    public function InDSPhanCV($manth){
        $date = date('Y-m-d');//Carbon::now();
        //Lấy năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->where('nam',$namht)->orderBy('hocky','desc')->value('hocky');
        $gv = DB::table('giang_vien as gv')->select('gv.macb','gv.hoten','gv.email')
                ->join('de_tai as dt','gv.macb','=','dt.macb')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();
        $thongtin = DB::table('de_tai as dt')
                ->select('dt.tendt','sv.hoten','sv.mssv','sv.email','hp.tennhomhp')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.nhomtruong',1)
                ->where('chn.manhomthuchien',$manth)
                ->first();
        $dscv = DB::table('cong_viec as cv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('th.manhomthuchien',$manth)
                ->get();
        
        $view = \View::make('giangvien.in-ke-hoach-phan-cong-nhomsv',
                compact('manth','date','thongtin','namht','hkht','dscv','gv'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        
        return $pdf->stream("KeHoach_".$manth.".pdf");
    }
/*======================= Theo dõi các công việc chính của 1 nhóm ==========================*/
    public function CVChinh($manth){
        $dstv = DB::table('sinh_vien as sv')
                ->select('chn.manhomthuchien','sv.mssv','sv.hoten','sv.email','nth.sotuan_thucte','chn.nhomtruong',
                        'sv.kynangcongnghe','sv.kienthuclaptrinh','sv.kinhnghiem')
                ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
                ->join('nhom_thuc_hien as nth','chn.manhomthuchien','=','nth.manhomthuchien')
                ->where('chn.manhomthuchien',$manth)
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
        $dstuan = DB::table('thuc_hien as th')->select('th.tuan')->distinct()
                ->where('th.tuan_lamlai','=',"")
                ->where('th.manhomthuchien',$manth) 
                //->paginate(2);
                ->get();
        $dscv = DB::table('thuc_hien as th')->distinct()
                ->join('cong_viec as cv','th.macv','=','cv.macv')
                ->where('cv.phuthuoc_cv','=',0)
                ->where('th.manhomthuchien',$manth)
                ->get();
        $dscvphu = DB::table('cong_viec')->select('macv','congviec','tiendo','phuthuoc_cv')
                ->where('phuthuoc_cv','<>',0)
                ->get();
 
        return view('giangvien.ke-hoach-cv-chinh')->with('dstv',$dstv)->with('dstuan',$dstuan)
            ->with('dscv',$dscv)->with('manth',$manth)->with('tendt',$tendt)->with('giolam',$giolam)
                ->with('dscvphu',$dscvphu);
    }
/*======================= Theo dõi các công việc phụ thuộc của 1 công việc chính ==========================*/
    public function CVPhuThuoc($manth,$macvchinh){ 
        $dscvphu = DB::table('cong_viec as cv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('phuthuoc_cv','=',$macvchinh)
                ->get();
        $cvchinh = DB::table('cong_viec as cv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('cv.macv','=',$macvchinh)
                ->first();
        return view('giangvien.ke-hoach-cv-phuthuoc')->with('dscvphu',$dscvphu)
            ->with('cvchinh',$cvchinh);
    }
 
/*============================ DUYỆT ĐỀ TÀI =====================================*/   
    public function LuuDuyetDeTai(){
        
    }
}
