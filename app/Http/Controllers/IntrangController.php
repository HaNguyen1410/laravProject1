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
    Session,
    PDF;
use Carbon\Carbon;
use App\Http\Controllers\Auth;

class IntrangController extends Controller
{
/*====================== Sinh viên In chi tiết đề tài - mô tả, công nghệ thực hiện đề tài =============================*/   
    public function InChiTietDeTaiSV($madt){ 
        $date = date('Y-m-d');//Carbon::now();
        $mssv = \Auth::user()->taikhoan;
        $tencb = DB::table('giang_vien as gv')->select('gv.macb','gv.hoten')
                ->join('nhom_hocphan as hp','gv.macb','=','hp.macb')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.mssv',$mssv)->first();
        $nk = DB::table('nien_khoa as nk')->select('nk.nam','nk.hocky')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('de_tai as dt','hp.macb','=','dt.macb')
                ->where('dt.madt',$madt)
                ->first();
        $detai = DB::table('de_tai')->where('madt',$madt)->first();
        
        $view = \View::make('sinhvien.in-chi-tiet-de-tai', 
                compact('tencb','nk','detai','date'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('portrait');
        
        $tendt = DB::table('de_tai')->select('tendt')
                ->where('madt',$madt)
                ->value('tendt');
        return $pdf->stream($tendt.".pdf");
    }   
/*====================== In chi tiết đề tài - mô tả, công nghệ thực hiện đề tài =============================*/   
    public function InChiTietDeTai($macb,$madt){ 
        $date = date('Y-m-d');//Carbon::now();
        $tencb = DB::table('giang_vien')->select('macb','hoten')->where('macb',$macb)->first();
        $nk = DB::table('nien_khoa as nk')->select('nk.nam','nk.hocky')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('de_tai as dt','hp.macb','=','dt.macb')
                ->where('dt.madt',$madt)
                ->first();
        $detai = DB::table('de_tai')->where('madt',$madt)->first();
        
        $view = \View::make('giangvien.in-chi-tiet-de-tai', 
                compact('tencb','nk','detai','date'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('portrait');
        
        $tendt = DB::table('de_tai')->select('tendt')
                ->where('madt',$madt)
                ->value('tendt');
        return $pdf->stream($tendt.".pdf");
    }
/*====================== Sinh viên in bảng điểm của cả nhóm làm cùng 1 đề tài =============================*/    
    public function InBangDiemSV(){
        $mssv = \Auth::user()->taikhoan;
        $mahp = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomhp');
        $tensv = DB::table('sinh_vien')->select('mssv','hoten')->where('mssv',$mssv)->first();
        $manhom = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien'); 
        $gv = DB::table('giang_vien as gv')->select('gv.macb','gv.hoten','hp.tennhomhp')
                ->join('nhom_hocphan as hp','gv.macb','=','hp.macb')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.manhomthuchien',$manhom)
                ->first();
        $tendt = DB::table('de_tai as dt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manhom)
                ->value('dt.tendt');
        $macb = DB::table('giang_vien as gv')
                ->join('nhom_hocphan as hp','gv.macb','=','hp.macb')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.mssv',$mssv)
                ->value('hp.macb');
        $dstieuchi = $this->LayDSTieuChi($macb,$mahp);
        $dssv = $this->LayDSNhomSV($macb,$mahp);
        $dsdiem = $this->LayDSDiem($macb,$mahp);
        $tongdiem = $this->LayTongDiem($macb,$mahp);
       //Lấy 1 mảng mssv của 1 nhóm thực hiện
        $masv = DB::table('sinh_vien as sv')->select('chn.mssv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manhom)
                ->orderBy('chn.mssv', 'asc')
                ->lists('chn.mssv');
        $nhanxet = DB::table('chia_nhom')->select('mssv','nhanxet')
                ->orderBy('mssv','asc')
                ->whereIn('mssv', $masv)
                ->get(); 
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $date = date('Y-m-d');//Carbon::now();
        $view =  \View::make('sinhvien.in-bang-diem-sv', 
                compact('nam', 'hk','date', 'manhom', 'gv', 'tendt', 'dstieuchi', 'dssv', 'dsdiem', 
                        'tongdiem','nhanxet','tensv'));
        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML($view);
        $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        
        //$pdf = \PDF::loadView('giangvien.in-bang-diem-gv');
        
        //return $pdf->download('Nhom_'.$manhom.'.pdf'); //this code is used for the name pdf        
        //$pdf = \PDF::loadView('sinhvien.in-bang-diem-sv');
        
        //return $pdf->download('Nhom_'.$manhom.'.pdf'); //this code is used for the name pdf
        return $pdf->stream("Nhom_".$manhom.".pdf");
    }

/*====================== Giảng viên in bảng điểm của 1 nhóm hp hoặc tất cả các hp mà gv dạy =====================*/    
    public function InBangDiemGV($macb){
        $tencb = DB::table('giang_vien')->select('macb','hoten')->where('macb',$macb)->first();
        $tieuchi = $this->LayDSTieuChi($macb);
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$nam)->where('hocky',$hk)->value('mank');
        //Lấy Mã nhóm HP trên url
        $mahp = \Request::segment(5);
        if($mahp == "all"){
            $gv_hp = DB::table('nhom_hocphan as hp')->select('gv.macb','gv.hoten','hp.tennhomhp','hp.manhomhp')
                    ->join('giang_vien as gv','gv.macb','=','hp.macb')
                    ->where('gv.macb',$macb)
                    ->where('hp.mank',$mank)
                    ->get();
            //Lấy mảng các mã nhóm HP của cán bộ này ở hk-nk hiện tại
            $ds_hpgv = DB::table('nhom_hocphan as hp')->select('hp.manhomhp')
                    ->join('giang_vien as gv','gv.macb','=','hp.macb')
                    ->where('gv.macb',$macb)
                    ->where('hp.mank',$mank)                    
                    ->lists('hp.manhomhp');
            $dssv = DB::table('sinh_vien as sv')->orderBy('chn.manhomthuchien','asc')
                ->select('chn.manhomthuchien','hp.tennhomhp', 'sv.mssv','sv.hoten','chn.nhomtruong')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->join('nhom_hocphan as hp','hp.manhomhp','=','chn.manhomhp')
                ->whereIn('chn.manhomhp',$ds_hpgv)
                ->where('chn.manhomthuchien','<>',"")
                ->get(); 
            //Lấy điểm của mỗi sv trong mảng mssv trên       
            $dsdiem = $this->LayDSDiemHP($macb,$ds_hpgv);
            $tongdiem = $this->LayTongDiemHP($macb,$ds_hpgv);
            $nhanxet = $this->LayNhanXetHP($macb,$ds_hpgv);
        }
        else if($mahp != "all"){
            $dssv = $this->LayDSNhomSV($macb,$mahp);
            $dsdiem = $this->LayDSDiem($macb,$mahp);
            $tongdiem = $this->LayTongDiem($macb,$mahp); 
            $nhanxet = $this->LayNhanXet($macb,$mahp);            
        }        
        $date = date('Y-m-d');//Carbon::now();
        $view =  \View::make('giangvien.in-bang-diem-gv', 
                compact('nam', 'hk','tencb','tieuchi', 'dssv', 'dsdiem', 'tongdiem', 'date', 'macb',
                        'nhanxet','mahp','gv_hp'));
        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML($view);
         $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        
        //$pdf = \PDF::loadView('giangvien.in-bang-diem-gv');
        
        //return $pdf->download('Nhom_'.$manhom.'.pdf'); //this code is used for the name pdf
        return $pdf->stream("Bangdiem".$macb.".pdf");
    }
/*====================== Lấy dữ danh sách tiêu chí =============================*/   
    public function LayDSTieuChi($macb){
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$nam)->where('hocky',$hk)->value('mank');
        $tieuchi = DB::table('tieu_chi_danh_gia as tc')
                ->join('quy_dinh as qd','tc.matc','=','qd.matc')
                ->where('qd.macb',$macb)
                ->where('qd.mank',$mank)
                ->get();        
        return $tieuchi;
    }
/*====================== Lấy dữ danh sách nhóm thực hiện =============================*/   
    public function LayDSNhomSV($macb,$mahp){
        $dsNhomth = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.manhomhp',$mahp)
                ->where('hp.macb',$macb)
                ->lists('chn.manhomthuchien');
        $dssv = DB::table('sinh_vien as sv')->orderBy('chn.manhomthuchien','asc')
                ->select('chn.manhomthuchien', 'sv.mssv','sv.hoten','chn.nhomtruong')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->whereIn('chn.manhomthuchien',$dsNhomth)
                ->where('chn.manhomthuchien','<>',"")
                ->get(); 
        
        return $dssv;
    } 
/*====================== Lấy dữ danh sách điểm của mỗi sinh viên =============================*/  
    public function LayDSDiem($macb,$mahp){
        $dsNhomth = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.manhomhp',$mahp)
                ->where('hp.macb',$macb)
                ->lists('chn.manhomthuchien');
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
//        $tongdiem = DB::table('chitiet_diem')->select('mssv',DB::raw('sum(diem) as tongdiem'))
//                ->orderBy('mssv','asc')
//                ->whereIn('mssv', $masv)
//                ->groupBy('mssv')
//                ->get();
        return $dsdiem;
    }
/*====================== Lấy danh sách điểm của mỗi sinh viên trong tất cả các nhóm HP của 1 GV =============================*/  
    public function LayDSDiemHP($macb,$ds_hpgv){
        $dsNhomth = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->whereIn('chn.manhomhp',$ds_hpgv)
                ->where('hp.macb',$macb)
                ->lists('chn.manhomthuchien');
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
        return $dsdiem;
    }
/*====================== Tổng điểm của tất cả các sinh viên trong 1 nhóm HP của 1 giảng viên =============================*/  
    public function LayTongDiem($macb,$mahp){
        $dsNhomth = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.manhomhp',$mahp)
                ->where('hp.macb',$macb)
                ->lists('chn.manhomthuchien');
        //Lấy 1 mảng mssv của 1 nhóm thực hiện
        $masv = DB::table('sinh_vien as sv')->select('chn.mssv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->whereIn('chn.manhomthuchien',$dsNhomth)
                ->lists('chn.mssv');
        $tongdiem = DB::table('chitiet_diem')->select('mssv',DB::raw('sum(diem) as tongdiem'))
                ->orderBy('mssv','asc')
                ->whereIn('mssv', $masv)
                ->groupBy('mssv')
                ->get();
        return $tongdiem;
    }
/*====================== Tổng điểm của tất cả các sinh viên ở tất cả các nhóm HP của 1 giảng viên =============================*/  
    public function LayTongDiemHP($macb,$ds_hpgv){
        $dsNhomth = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->whereIn('chn.manhomhp',$ds_hpgv)
                ->where('hp.macb',$macb)
                ->lists('chn.manhomthuchien');
        //Lấy 1 mảng mssv của 1 nhóm thực hiện
        $masv = DB::table('sinh_vien as sv')->select('chn.mssv')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->whereIn('chn.manhomthuchien',$dsNhomth)
                ->lists('chn.mssv');
        $tongdiem = DB::table('chitiet_diem')->select('mssv',DB::raw('sum(diem) as tongdiem'))
                ->orderBy('mssv','asc')
                ->whereIn('mssv', $masv)
                ->groupBy('mssv')
                ->get();
        return $tongdiem;
    }
/*====================== Lấy nhận xét =============================*/
    public function LayNhanXet($macb,$mahp){
        $dsmasv = DB::table('chia_nhom as chn')->select('chn.mssv','chn.nhanxet')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.manhomhp',$mahp)
                ->where('hp.macb',$macb)
                ->lists('chn.mssv');
        $dsNhanXet = DB::table('chia_nhom')->select('mssv','nhanxet')
                ->whereIn('mssv',$dsmasv)
                ->get();
        return $dsNhanXet;
    }
/*====================== Lấy nhận xét của mỗi sinh viên trong tất cả các nhóm HP của 1 GV =============================*/
    public function LayNhanXetHP($macb,$ds_hpgv){
        $dsmasv = DB::table('chia_nhom as chn')->select('chn.mssv','chn.nhanxet')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->whereIn('chn.manhomhp',$ds_hpgv)
                ->where('hp.macb',$macb)
                ->lists('chn.mssv');
        $dsNhanXet = DB::table('chia_nhom')->select('mssv','nhanxet')
                ->whereIn('mssv',$dsmasv)
                ->get();
        return $dsNhanXet;
    }

} //End class IntrangController
