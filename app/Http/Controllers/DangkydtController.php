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

class DangkydtController extends Controller
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
    public function DangKyDT($mssv){
        $mahp = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomhp');
        $dstensv = DB::table('dangky_nhom as dk')->distinct()
                ->select('dk.mssv','sv.hoten')
                ->join('sinh_vien as sv','dk.mssv','=','sv.mssv')
                ->where('dk.manhomhp','=',$mahp)
                ->get();
        $dssv = DB::table('dangky_nhom')->distinct()->where('manhomhp',$mahp)->get();
        return view('sinhvien.dang-ky-de-tai')->with('dssv',$dssv)->with('dstensv',$dstensv);           
    }
}
/*
 * 
 * select DISTINCT dangky_nhom.mssv, sinh_vien.hoten 
 * from dangky_nhom join sinh_vien on dangky_nhom.mssv = sinh_vien.mssv 
 * WHERE dangky_nhom.manhomhp = 1
 * 
 */