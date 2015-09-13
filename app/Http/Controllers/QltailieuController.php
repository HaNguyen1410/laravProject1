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

class QltailieuController extends Controller
{
/*====================== Mã tài liệu tự tăng ====================================*/
    function matl_tutang(){
        $pre = "TL";
        $macuoi= DB::table('tai_lieu')->orderBy('matl','desc')->value('matl');
        
        if(count($macuoi) == 0){
            return $mamoi = "TL01";
        }
        else if(count($macuoi) > 0)
        {
            $so = (int)substr($macuoi, 2) + 1;
            if($so <= 9){
                $pre .="0";
                return $mamoi = $pre .= $so;
            }
            else if($so >= 10)
                return  $mamoi = $pre .=$so;
         }
        
    }
/*========================= Giảng viên quản lý tài liệu =============================*/
    public function KhoTaiLieu($macb){
        //
        $dsdt = DB::table('de_tai as dt')->select('dt.madt','dt.tendt','chn.manhomthuchien','sv.hoten')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('dt.macb',$macb)
                ->where('chn.nhomtruong','=',1)
                ->get();
        
        return view('giangvien.kho-tai-lieu')->with('dsdt',$dsdt);
    }
/*========================= Giảng viên quản lý tài liệu chi tiết=============================*/
    public function KhoTaiLieuChiTiet($macb,$manth){
        $dt = DB::table('de_tai as dt')->select('dt.tendt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();
        $dstailieu = DB::table('tai_lieu as tl')
                ->select('tl.matl','tl.tentl','tl.kichthuoc','tl.mota','tl.ngaycapnhat',
                        'dg.nd_danhgia','dg.ngaydanhgia','cv.giaocho')
                ->leftjoin('thuc_hien as th','tl.macv','=','th.macv')
                ->leftjoin('danh_gia as dg','tl.matl','=','dg.matl')
                ->join('cong_viec as cv','tl.macv','=','cv.macv')
                ->where('th.manhomthuchien',$manth)
                ->get();
        
        return view('giangvien.kho-tai-lieu-chi-tiet')->with('dt',$dt)->with('dstailieu',$dstailieu);
    }
/*========================= Sinh viên nộp tài liệu =============================*/
    public function NopTaiLieu($mssv){
        $matl = $this->matl_tutang();
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $tendt = DB::table('de_tai as dt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->value('dt.tendt');
        $dscvchinh = DB::table('cong_viec as cv')->select('cv.macv','cv.congviec')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('th.manhomthuchien',$manth)
                ->where('cv.phuthuoc_cv','=',0)
                ->get();
        $dstailieu = DB::table('tai_lieu as tl')
                ->select('tl.matl','tl.macv','tl.tentl','tl.kichthuoc','tl.ngaycapnhat',
                        'tl.dieuchinh','cv.congviec','dg.nd_danhgia','dg.ngaydanhgia','sv.mssv','sv.hoten')
                ->join('danh_gia as dg','dg.matl','=','tl.matl')
                ->join('cong_viec as cv','cv.macv','=','tl.macv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->join('chia_nhom as chn','th.manhomthuchien','=','chn.manhomthuchien')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('th.manhomthuchien',$manth)
                ->get();
        return view('sinhvien.nop-tai-lieu')->with('tendt',$tendt)->with('dscvchinh',$dscvchinh)
                        ->with('matl',$matl)->with('dstailieu',$dstailieu);
    }
/*========================= Lưu UPLOAD TÀI LIỆU =============================*/
    public function LuuNopTaiLieu(Request $req){
        $post = $req->all();
        
    }
    
}//END Class QltailieuController
