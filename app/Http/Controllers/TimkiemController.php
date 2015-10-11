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
use Illuminate\Support\Facades\Redirect;

class TimkiemController extends Controller
{
/*** TÌM KIẾM :
	->GV: Nhập tên sv -> kq: tensv, tendt, tennhom, cv, tiendo, noidung
	->SV: Nhập tên sv -> kq: tencv, ngaythuchien, tiendo, noidung,
 */
/*===================== Sinh viên thực hiện tìm kiếm ========================*/
    public function SVTimKiem(Request $req){
        $sv_dangnhap = \Auth::user()->taikhoan;
        $manth = DB::table('chia_nhom')->where('mssv',$sv_dangnhap)->value('manhomthuchien');
        $ht = $req->txtTimKiem;
        $mssv = DB::table('sinh_vien')->where('hoten','like',$ht)->value('mssv');
        $manth_svdangtim = DB::table('chia_nhom')->where('mssv',$mssv)->where('manhomthuchien',$manth)
                ->first(); 
        if(count($manth_svdangtim) == 0){
            \Session::flash('ThongBao','Không thể tìm sinh viên ở nhóm đề tài khác!');
            return view('sinhvien.ket-qua-tim-kiem-sv')->with('ht',$ht)->with('manhom_sv',$manhom_sv)
                    ->with('mssv',$mssv)->with('manth_svdangtim',$manth_svdangtim);
        }
        else if(count($manth_svdangtim) != 0){
            return count($manth_svdangtim);
        }
//        else{            
//             $hoten = $req->txtTimKiem;
//            return view('sinhvien.ket-qua-tim-kiem-sv')->with('hoten',$hoten)->with('manth',$manth);
//        }            
        
    }
/*===================== Giảng viên thực hiện tìm kiếm ========================*/
    
    public function GVTimKiem(Request $req){        
        $hoten = $req->txtTimKiem;
        $gv_dangnhap = \Auth::user()->taikhoan;
        //Lấy các nhóm HP của giảng viên ở mã niên khóa lớn nhất <=> năm và hk hiện tại
        $mahp = DB::table('nhom_hocphan')->select('manhomhp')
                ->where('macb',$gv_dangnhap)->Orderby('mank','desc')
                ->lists('manhomhp');
        $mssv = DB::table('sinh_vien')->where('hoten',$hoten)->value('mssv');
        //Kiểm tra sv này có thuộc HP của giang viên đang tìm không?
        $sv = DB::table('chia_nhom')->whereIn('manhomhp',$mahp)->where('mssv',$mssv)->get();
        
        if(count($sv) == 0){            
            $hp_sv = DB::table('chia_nhom as chn')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->where('chn.mssv',$mssv)->value('hp.tennhomhp');
            \Session::flash('ThongBao','Không thể tìm thông tin sinh viên thuộc nhóm HP của giảng viên khác! ');
            return view('giangvien.ket-qua-tim-kiem-gv')->with('hoten',$hoten)->with('hp_sv',$hp_sv)
                    ->with('mssv',$mssv)->with('sv',$sv);
        }
        else if(count($sv) != 0){  
            $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien'); 
            $hp_sv = DB::table('chia_nhom as chn')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->where('chn.mssv',$mssv)->value('hp.tennhomhp');
            $tendt = DB::table('de_tai as dt')
                    ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                    ->where('radt.manhomthuchien',$manth)
                    ->value('dt.tendt');
            $sv_cv = DB::table('cong_viec as cv')->distinct()
                    ->join('thuc_hien as th','cv.macv','=','th.macv')
                    ->where('cv.giaocho','like',$hoten)
                    ->where('th.manhomthuchien',$manth)
                    ->get();
            
            return view('giangvien.ket-qua-tim-kiem-gv')->with('hoten',$hoten)->with('mssv',$mssv)
                    ->with('manth',$manth)->with('hp_sv',$hp_sv)->with('tendt',$tendt)
                ->with('sv',$sv)->with('sv_cv',$sv_cv);
        }
    }
    
}
