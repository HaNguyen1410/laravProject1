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
use Carbon\Carbon;

class IntrangController extends Controller
{
 /*====================== Sinh viên in bảng điểm của cả nhóm làm cùng 1 đề tài =============================*/    
    public function InBangDiemSV($mssv){
        $manhom = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');        
        $pdf = \PDF::loadView('sinhvien.in-bang-diem-sv');
        
        //return $pdf->download('Nhom_'.$manhom.'.pdf'); //this code is used for the name pdf
        return $pdf->stream("Nhom_".$manhom.".pdf");
    }
/*====================== Giảng viên in bảng điểm của 1 nhóm hp hoặc tất cả các hp mà gv dạy =============================*/    
    public function InBangDiemGV($macb){
        $pdf = \PDF::loadView('giangvien.in-bang-diem-gv');
        
        //return $pdf->download('Nhom_'.$manhom.'.pdf'); //this code is used for the name pdf
        return $pdf->stream("Bangdiem".$macb.".pdf");
    }
}
