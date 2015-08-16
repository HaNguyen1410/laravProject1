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

class PhancvController extends Controller
{
/*====================== Mã công việc tự tăng ====================================*/
    function macv_tutang(){
        $pre = "CV";
        $macuoi = DB::table('cong_viec')->orderBy('macv', 'desc')->value('macv'); 
        if(count($macuoi)>0){
            $ma = $macuoi['macv'];  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 2) + 1;
        }
            return  $mamoi = $pre .=$so;     
    }

/*========= Danh sách phân công ==============*/   
   public function DSPhanCV($mssv){
       $manth = DB::table('dangky_nhom')->where('mssv','=',$mssv)->value('manhomthuchien');
       $tiendonhom = DB::table('nhom_thuc_hien')->where('manhomthuchien','=',$manth)->first();
       $tendt = DB::table('dangky_nhom as dk')
               ->join('nhom_hocphan as hp','dk.manhomhp','=','hp.manhomhp')
               ->join('ra_de_tai as radt','hp.manhomhp','=','radt.manhomhp')
               ->join('de_tai as dt','radt.madt','=','dt.madt')
               ->where('radt.manhomthuchien','=',$manth)
               ->first();
       $dscvchinh = DB::table('cong_viec as cv')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->where('th.manhomthuchien',$manth)
               ->where('cv.phuthuoc_cv','=',0)->get();
      // 
       return view('sinhvien.phan-cong-nhiem-vu')->with('tendt',$tendt)->with('tiendonhom',$tiendonhom)
               ->with('dscvchinh',$dscvchinh);
   } 
/*========= Thêm công việc chính ==============*/ 
     public function ThemcvChinh($masv){
         $manth = DB::table('dangky_nhom')->where('mssv',$masv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('dangky_nhom as dk', 'sv.mssv','=','dk.mssv')
                ->where('dk.manhomthuchien',$manth)
                ->get();
         return view('sinhvien.them-cong-viec')->with('dstv',$dstv);
     }
     public function LuuThemcvChinh(){
         
     }
/*========= Cập nhật công việc chính ==============*/ 
     public function CapNhatcvChinh($masv,$macv){
         $manth = DB::table('dangky_nhom')->where('mssv',$masv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('dangky_nhom as dk', 'sv.mssv','=','dk.mssv')
                ->where('dk.manhomthuchien',$manth)
                ->get();
         $ndcv = DB::table('cong_viec')->where('macv',$macv)->first();
         return view('sinhvien.cap-nhat-cong-viec')->with('dstv',$dstv)->with('ndcv',$ndcv);
     }
     public function LuuCapNhatcvChinh(){
         
     }
/*========= Danh sách phân công chi tiết (công việc phụ thuộc) ==============*/ 
    public function DSPhanChiTiet($mssv,$macv){
        $dscvphu = DB::table('cong_viec')->where('phuthuoc_cv','=',$macv)->get();
        $cvchinh = DB::table('cong_viec')->where('macv','=',$macv)->first();
        return view('sinhvien.phan-cong-chi-tiet-cv')->with('dscvphu', $dscvphu)
            ->with('cvchinh',$cvchinh);
    }
/*========= Thêm công việc chi tiết (cv phụ) ==============*/ 
     public function ThemcvPhu(){
         //return view('sinhvien.them-cong-viec');
     }
    
}// End Class PhancvController
