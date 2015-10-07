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
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth;

class QltailieuController extends Controller
{
/*====================== Mã tài liệu tự tăng ====================================*/
    function matl_tutang(){
        $pre = "TL";
        $macuoi= DB::table('tai_lieu')->orderBy('matl','desc')->value('matl');
        
        if(count($macuoi) == 0){
            return $mamoi = "TL01";
        }
        else if(count($macuoi) > 0)
        {
            $so = (int)substr($macuoi, 2) + 1;
            if($so <= 9){
                $pre .="0";
                return $mamoi = $pre .= $so;
            }
            else if($so >= 10)
                return  $mamoi = $pre .=$so;
         }
        
    }
/*========================= Giảng viên quản lý tài liệu =============================*/
    public function KhoTaiLieu(){
        $macb = \Auth::user()->taikhoan;
        $dsdt = DB::table('de_tai as dt')->select('dt.madt','dt.tendt','chn.manhomthuchien','sv.hoten')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('dt.macb',$macb)
                ->where('chn.nhomtruong','=',1)
                ->get();
        //Lấy danh sách mã nhóm mà cán bộ này hướng dẫn
        $dsnhom = DB::table('nhom_hocphan as hp')->select('chn.manhomthuchien')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->lists('chn.manhomthuchien');
        $tailieu = DB::table('tai_lieu as tl')                
                ->select('th.manhomthuchien','tl.mota',
                        DB::raw('min(tl.ngaycapnhat) as ngaycapnhat,th.manhomthuchien'))
                ->join('thuc_hien as th','tl.macv','=','th.macv')
                ->whereIn('th.manhomthuchien',$dsnhom)
                ->groupBy('th.manhomthuchien')
                ->get();
        
        return view('giangvien.kho-tai-lieu')->with('dsdt',$dsdt)->with('tailieu',$tailieu);
    }
/*========================= Giảng viên quản lý tài liệu chi tiết=============================*/
    public function KhoTaiLieuChiTiet($manth){
        $macb = \Auth::user()->taikhoan;
        $dt = DB::table('de_tai as dt')->select('dt.madt','dt.tendt','dt.macb')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();
        $dstailieu = DB::table('tai_lieu as tl')
                ->select('tl.matl','tl.mssv','tl.tentl','tl.kichthuoc','tl.mota','tl.ngaycapnhat',
                        'dg.nd_danhgia','dg.ngaydanhgia','cv.macv','cv.congviec','cv.giaocho','th.tuan'
                        ,'sv.hoten')
                ->leftjoin('thuc_hien as th','tl.macv','=','th.macv')
                ->leftjoin('danh_gia as dg','tl.matl','=','dg.matl')
                ->join('sinh_vien as sv','tl.mssv','=','sv.mssv')
                ->join('cong_viec as cv','tl.macv','=','cv.macv')
                ->where('th.manhomthuchien',$manth)
                ->get();
        return view('giangvien.kho-tai-lieu-chi-tiet')->with('dt',$dt)->with('dstailieu',$dstailieu)
                     ->with('macb',$macb)->with('manth',$manth);
    }
/*==================== Nhận xét về 1 tài liệu =======================*/
    public function DanhGiaTaiLieu($manth,$matl){   
        $macb = \Auth::user()->taikhoan;
        $dt = DB::table('de_tai as dt')->select('dt.madt','dt.tendt','dt.macb')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();        
        $tailieu = DB::table('tai_lieu as tl')->select('tl.matl','tl.tentl','dg.nd_danhgia','cv.congviec')
                ->join('danh_gia as dg','tl.matl','=','dg.matl')
                ->join('cong_viec as cv','tl.macv','=','cv.macv')
                ->where('dg.matl',$matl)
                ->first();
        return view('giangvien.danh-gia-tai-lieu')->with('macb',$macb)->with('tailieu',$tailieu)
            ->with('dt',$dt)->with('manth',$manth)->with('matl',$matl);
    }
/*==================== Lưu nhận xét về tài liệu của 1 giảng viên =======================*/
    public function LuuDanhGia(Request $req){
        $post = $req->all();
        $manth = DB::table('danh_gia as dg')
                ->join('tai_lieu as tl','dg.matl','=','tl.matl')
                ->join('thuc_hien as th','tl.macv','=','th.macv')
                ->where('tl.matl',$post['txtMaTL'])
                ->value('th.manhomthuchien');
        $v = \Validator::make($req->all(),
                    [
                        'txtMaTL'     => 'required',
                        'txtDanhGia' => 'required'
                    ]
                );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $cn = DB::table('danh_gia')->where('matl',$post['txtMaTL'])->update(
                        [
                            'macb' => $_POST['txtMaCB'],
                            'nd_danhgia' => $_POST['txtDanhGia'],
                            'ngaydanhgia' => Carbon::now()
                        ]
                    );
            
            return redirect('giangvien/khotailieu/khotailieuchitiet/'.$manth);
        }
    }
    /*========================= Sinh viên nộp tài liệu =============================*/
    public function DanhSachNopTaiLieu(){
        $mssv = \Auth::user()->taikhoan;
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $tendt = DB::table('de_tai as dt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->value('dt.tendt');
        $dstailieu = DB::table('tai_lieu as tl')->distinct()
                ->select('tl.matl','tl.macv','tl.mssv','tl.tentl','tl.kichthuoc','tl.mota','tl.ngaycapnhat',
                        'cv.congviec','cv.giaocho','dg.nd_danhgia','dg.ngaydanhgia','sv.hoten','th.tuan')
                ->leftjoin('danh_gia as dg','dg.matl','=','tl.matl')
                ->join('cong_viec as cv','cv.macv','=','tl.macv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->join('sinh_vien as sv','tl.mssv','=','sv.mssv')
                ->where('th.manhomthuchien',$manth)
                ->orderBy('tl.ngaycapnhat','desc')
                ->get();
        return view('sinhvien.danh-sach-nop-tai-lieu')->with('tendt',$tendt)
                        ->with('dstailieu',$dstailieu)->with('mssv',$mssv);
    }
/*========================= UPLOAD TÀI LIỆU =============================*/
    public function NopTaiLieu(){
        $mssv = \Auth::user()->taikhoan;
        $matl = $this->matl_tutang();
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $dscvchinh = DB::table('cong_viec as cv')->select()
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('th.manhomthuchien',$manth)
                ->where('cv.phuthuoc_cv','=',0)
                ->get();
        
        return view('sinhvien.nop-tai-lieu')->with('matl',$matl)
            ->with('dscvchinh',$dscvchinh);
    }
    /*========================= Lưu UPLOAD TÀI LIỆU =============================*/
    public function LuuNopTaiLieu(Request $req){
        $mssv = \Auth::user()->taikhoan;
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'cbTenCV'  => 'required',
                    'fTaiLieu' => 'required|mimes:pdf,doc,docx,ppt,pptm'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $luuden = public_path() . '/tailieu/';
            $taptin = Input::file('fTaiLieu');
            $kichthuoc= $taptin->getClientSize();
            //Đổi kích thước file từ bytes sang Kb
            $kichthuoc_mb = $kichthuoc/(1024);
            //$extension = Input::file('fTaiLieu')->getClientOriginalExtension();
            //Lấy tên và cả đuôi của tập tin
            $tenbandau = Input::file('fTaiLieu')->getClientOriginalName(); 
            DB::table('tai_lieu')->insert(
                        [
                            'matl'        => $_POST['txtMaTL'],
                            'tentl'       => $tenbandau,
                            'mssv'        => $mssv,
                            'macv'        => $_POST['cbTenCV'],
                            'kichthuoc'   => $kichthuoc_mb,
                            'mota'        => $_POST['txtMoTa'],
                            'ngaycapnhat' => Carbon::now()
                        ]
                    );
            DB::table('danh_gia')->insert(
                        [
                            'matl' => $_POST['txtMaTL'],                            
                        ]
                    );
            $upload_success = $taptin->move($luuden, $tenbandau);
            
            if ($upload_success) {
                return Redirect::to('sinhvien/danhsachnoptailieu')->with('BaoThem', 'Gửi tài liệu thành công!');
            }
        }
    }
/*=================== Cập nhật nộp tài liệu =========================*/
    public function CapNhatNopTL($matl){
        $macvchinh = DB::table('tai_lieu')->where('matl',$matl)->value('macv');
        $tencv = DB::table('cong_viec as cv')->select('cv.macv','cv.congviec','tl.mota')
                ->join('tai_lieu as tl','cv.macv','=','tl.macv')
                ->where('cv.macv',$macvchinh)->first();
        return view('sinhvien.cap-nhat-nop-tai-lieu')->with('matl',$matl)
            ->with('tencv',$tencv);
    } 
/*=================== Lưu Cập nhật nộp tài liệu =========================*/
    public function LuuCapNhatNopTL(Request $req){
        $mssv = \Auth::user()->taikhoan;
//        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'fTaiLieu' => 'required|mimes:pdf,doc,docx,ppt,pptm'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $luuden = public_path() . '/tailieu/';
            $taptin = Input::file('fTaiLieu');
            $kichthuoc= $taptin->getClientSize();
            //Đổi kích thước file từ bytes sang Kb
            $kichthuoc_mb = $kichthuoc/(1024);
            //$extension = Input::file('fTaiLieu')->getClientOriginalExtension();
            $tenbandau = Input::file('fTaiLieu')->getClientOriginalName(); 
            DB::table('tai_lieu')->where('matl',$req->txtMaTL)->update(
                            [
                                'tentl'       => $tenbandau,
                                'mssv'        => $mssv,
                                'kichthuoc'   => $kichthuoc_mb,
                                'mota'        => $_POST['txtMoTa'],
                                'ngaycapnhat' => Carbon::now()
                            ]
                    );
            $upload_success = $taptin->move($luuden, $tenbandau);

            return Redirect::to('sinhvien/danhsachnoptailieu')
                    ->with('BaoCapNhat', 'Gửi cập nhật tài liệu thành công!');
        } 
    }
/*======================== Xóa tài liệu nào đó ========================*/
    public function XoaTaiLieu($matl){
        $mssv = \Auth::user()->taikhoan;
        $del1 = DB::table('tai_lieu')->where('matl',$matl)->delete();
        $del2 = DB::table('danh_gia')->where('matl',$matl)->delete();
        
        return Redirect('sinhvien/noptailieu/1111317');
    }
    
}//END Class QltailieuController

/*
 SELECT thuc_hien.manhomthuchien,tai_lieu.mota, min(tai_lieu.ngaycapnhat)
from tai_lieu
left join thuc_hien on tai_lieu.macv = thuc_hien.macv
GROUP BY thuc_hien.manhomthuchien
 */