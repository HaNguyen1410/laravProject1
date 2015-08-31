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
        return view('giangvien.kho-tai-lieu');
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
