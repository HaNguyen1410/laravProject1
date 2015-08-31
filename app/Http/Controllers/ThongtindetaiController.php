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

class ThongtindetaiController extends Controller
{
 /*====================== Mã nhóm thực hiện tự tăng ====================================*/
    function manth_tutang(){
        $pre = "NTH";
        $macuoi = DB::table('nhom_thuc_hien')->orderby('manhomthuchien','desc')->first();
        
        if(count($macuoi) > 0){
            $ma = $macuoi->manhomthuchien;  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 3) + 1;
        }
        if($so <= 9){
            $pre .="0";
           return  $mamoi = $pre .=$so;
        }
        else 
            return  $mamoi = $pre .=$so;        
    }   
/*====================  ======================*/
    public function ThemThongTinDeTai($mssv){
        $mahp = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomhp');
        $dstensv = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.mssv','sv.hoten')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('chn.manhomhp','=',$mahp)
                ->get();
        $dssv = DB::table('chia_nhom')->distinct()->where('manhomhp',$mahp)->get();
        return view('sinhvien.them-thong-tin-de-tai')->with('dssv',$dssv)->with('dstensv',$dstensv);           
    }

}//END Class DangkydtController
 
/*
 * 
 * select DISTINCT dangky_nhom.mssv, sinh_vien.hoten 
 * from dangky_nhom join sinh_vien on dangky_nhom.mssv = sinh_vien.mssv 
 * WHERE dangky_nhom.manhomhp = 1
 * 
 */