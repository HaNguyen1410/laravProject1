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
        $manth = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $macb = DB::table('ra_de_tai as radt')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->value('dt.macb');
        $hk_nk = DB::table('nien_khoa as nk')->distinct()
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('ra_de_tai as radt','hp.manhomhp','=','radt.manhomhp')
                ->where('radt.manhomthuchien',$manth)
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
                ->join('dangky_nhom as dk','sv.mssv','=','dk.mssv')
                ->where('dk.manhomthuchien',$manth)
                ->get();
        foreach($dssv as $sv)
            $dsdiem = DB::table('chitiet_diem')->select('diem')->where('mssv',$sv->mssv)->first();
        
        return view('sinhvien.xem-diem')->with('hk_nk',$hk_nk)->with('tieuchi',$tieuchi)
            ->with('dsdt',$dsdt)->with('dssv',$dssv)->with('dsdiem',$dsdiem);
    }   
/*=========================== Nhập điểm nhóm ==============================================*/
    public function NhapDiem($macb){       
        $hk_nk = DB::table('nien_khoa as nk')->distinct()
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('ra_de_tai as radt','hp.manhomhp','=','radt.manhomhp')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('dt.macb',$macb)
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
                
        return view('giangvien.nhap-diem')->with('hk_nk',$hk_nk)->with('dsdt',$dsdt)
                ->with('tieuchi',$tieuchi);
    }  
    
}
