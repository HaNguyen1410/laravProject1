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
        return view('sinhvien.nop-tai-lieu')->with('tendt',$tendt)->with('dscvchinh',$dscvchinh);
    }
}
