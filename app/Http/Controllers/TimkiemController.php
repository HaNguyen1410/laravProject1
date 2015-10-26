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
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$nam)->where('hocky',$hk)
                ->value('mank');
        //Lấy mã nhóm thực hiện của sv đang đăng nhập trong HK-NK hiện tại
        $manth = DB::table('chia_nhom as chn')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.mssv',$sv_dangnhap)->where('hp.mank',$mank)
                ->value('chn.manhomthuchien');
        $hoten = $req->txtTimKiem;
        $mssv = DB::table('sinh_vien')->where('hoten','like',$hoten)->value('mssv');
        //Tìm sv cần tìm có trong nhóm của sinh viên đang đăng nhập không
        $manth_sv = DB::table('chia_nhom as chn')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('hp.mank',$mank)
                ->where('chn.mssv',$mssv)->where('chn.manhomthuchien',$manth)
                ->get(); 
        //Lấy mã nhóm thực hiện đề tài của sv cần tìm
        $sv_manhomdt = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        if(count($manth_sv) == 0){
            //Hiện thông báo lỗi tìm kiếm không thấy
            \Session::flash('ThongBao','Không thể tìm sinh viên ở nhóm đề tài khác !');
            return view('sinhvien.ket-qua-tim-kiem-sv')->with('hoten',$hoten)->with('mssv',$mssv)
                    ->with('manth_sv',$manth_sv)->with('sv_manhomdt',$sv_manhomdt);
        }
        else if(count($manth_sv) != 0){
            $tendt = DB::table('de_tai as dt')
                    ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                    ->where('radt.manhomthuchien',$manth)
                    ->value('dt.tendt');
            $sv_cv = DB::table('cong_viec as cv')->distinct()
                    ->join('thuc_hien as th','cv.macv','=','th.macv')
                    ->where('cv.giaocho','like',$hoten)
                    ->where('th.manhomthuchien',$manth)
                    ->get();
            return view('sinhvien.ket-qua-tim-kiem-sv')->with('hoten',$hoten)->with('mssv',$mssv)
                ->with('manth_sv',$manth_sv)->with('tendt',$tendt)->with('sv_cv',$sv_cv)
                ->with('sv_manhomdt',$sv_manhomdt);
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
        
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$nam)->where('hocky',$hk)
                ->value('mank');
        
        if(count($sv) == 0){            
            $hp_sv = DB::table('chia_nhom as chn')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->where('chn.mssv',$mssv)->where('hp.mank',$mank)
                    ->value('hp.tennhomhp');
            \Session::flash('ThongBao','Không thể tìm thông tin sinh viên thuộc nhóm HP của giảng viên khác ! ');
            return view('giangvien.ket-qua-tim-kiem-gv')->with('hoten',$hoten)->with('hp_sv',$hp_sv)
                    ->with('mssv',$mssv)->with('sv',$sv);
        }
        else if(count($sv) != 0){  
            $manth = DB::table('chia_nhom as chn')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->where('hp.mank',$mank)
                    ->where('chn.mssv',$mssv)
                    ->value('chn.manhomthuchien'); 
            $hp_sv = DB::table('chia_nhom as chn')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->where('chn.mssv',$mssv)->where('hp.mank',$mank)
                    ->value('hp.tennhomhp');
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
