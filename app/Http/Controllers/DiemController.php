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

class DiemController extends Controller
{
/*========================== Tính tổng điểm của 1 sv =====================================*/
    function tongdiem($mssv){
        $dstongdiem = DB::table('chitiet_diem')->select('mssv',DB::raw('sum(diem) as tongdiem'))
                ->where('mssv','=',$mssv)
                ->groupBy('mssv')
                ->get();
        
        if(count($dstongdiem) > 0){           
            return $dstongdiem->tongdiem;
        } 
        else 
            return null;
    }
 /*========================== Quy điểm số ra điểm chữ =====================================*/ 
    function diemchu($mssv){
       $d = tongdiem($mssv);
        if($d<=0 && $d<4){
            return F;
        }
        else if($d<=4 || $d<=4.4){
            return 'D';
        }
        else if($d<=4.5 || $d<=4.9){
            return 'D+';
        }
        else if($d<=5.0 || $d<=5.9){
            return 'C';
        }
        else if($d<=6 || $d<=6.9){
            return 'C+';
        }
        else if($d<=7 || $d<=7.9){
            return 'B';
        }
        else if($d<=8 || $d<=8.9){
            return 'B+';
        }
        else     
            return 'A';
    }    
/*=========================== Danh sách điểm nhóm ==============================================*/
    public function XemDiem($mssv){
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $macb = DB::table('ra_de_tai as radt')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->value('dt.macb');
        $hk_nk = DB::table('nien_khoa as nk')->distinct()
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.manhomthuchien',$manth)
                ->first();
        $dsdt = DB::table('ra_de_tai as radt')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();        
        $tieuchi = DB::table('tieu_chi_danh_gia as tc')
                ->join('quy_dinh as qd','tc.matc','=','qd.matc')
                ->where('qd.macb',$macb)
                ->get();
        $dssv = DB::table('sinh_vien as sv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manth)
                ->get();
         //Lấy 1 mảng mssv của 1 nhóm thực hiện
        $masv = DB::table('sinh_vien as sv')->select('chn.mssv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manth)
                ->lists('chn.mssv');
        //Lấy điểm của mỗi sv trong mảng mssv trên       
        $dsdiem = DB::table('chitiet_diem')
                ->select('mssv','diem')->orderBy('mssv','asc')
                ->whereIn('mssv', $masv)
                ->get();              
        return view('sinhvien.xem-diem')->with('hk_nk',$hk_nk)->with('tieuchi',$tieuchi)
            ->with('dsdt',$dsdt)->with('dssv',$dssv)->with('dsdiem',$dsdiem);            
    }   
/*=========================== Nhập điểm nhóm ==============================================*/
    public function NhapDiem($macb){       
        $hk_nk = DB::table('nien_khoa as nk')->distinct()->orderby('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->first();
        $dsdt = DB::table('ra_de_tai as radt')->select('dt.madt','dt.tendt','radt.manhomthuchien')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('dt.macb',$macb)
                ->orderby('radt.manhomthuchien','asc')
                ->get();
        $tieuchi = DB::table('tieu_chi_danh_gia as tc')
                ->join('quy_dinh as qd','tc.matc','=','qd.matc')
                ->where('qd.macb',$macb)
                ->get();
        $dsNhomth = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('hp.macb',$macb)
                ->lists('chn.manhomthuchien');
        $dssv = DB::table('sinh_vien as sv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->whereIn('chn.manhomthuchien',$dsNhomth)
                ->get();
        //Lấy 1 mảng mssv của 1 nhóm thực hiện
        $masv = DB::table('sinh_vien as sv')->select('chn.mssv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->whereIn('chn.manhomthuchien',$dsNhomth)
                ->lists('chn.mssv');
        //Lấy điểm của mỗi sv trong mảng mssv trên       
        $dsdiem = DB::table('chitiet_diem')
                ->select('mssv','diem')->orderBy('mssv','asc')
                ->whereIn('mssv', $masv)
                ->get(); 
//         $tongdiem = $this->tongdiem($mssv);
//         $diemchu = $this->diemchu($mssv);
        return view('giangvien.nhap-diem')->with('hk_nk',$hk_nk)->with('tieuchi',$tieuchi)
                ->with('dsdt',$dsdt)->with('dssv',$dssv)->with('dsdiem',$dsdiem);
    }  
    
}//END Clas DiemController
/*
    SELECT mssv, diem
    from chitiet_diem
    WHERE mssv in (1111317, 1111308,1111324)
    ORDER BY mssv ASC
 */
