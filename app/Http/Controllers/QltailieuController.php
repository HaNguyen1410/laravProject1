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
    public function KhoTaiLieu($macb){
        //
        $dsdt = DB::table('de_tai as dt')->select('dt.madt','dt.tendt','chn.manhomthuchien','sv.hoten')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('dt.macb',$macb)
                ->where('chn.nhomtruong','=',1)
                ->get();
        
        return view('giangvien.kho-tai-lieu')->with('dsdt',$dsdt);
    }
/*========================= Giảng viên quản lý tài liệu chi tiết=============================*/
    public function KhoTaiLieuChiTiet($macb,$manth){
        $dt = DB::table('de_tai as dt')->select('dt.tendt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();
        $dstailieu = DB::table('tai_lieu as tl')
                ->select('tl.matl','tl.tentl','tl.kichthuoc','tl.mota','tl.ngaycapnhat',
                        'dg.nd_danhgia','dg.ngaydanhgia','cv.giaocho')
                ->leftjoin('thuc_hien as th','tl.macv','=','th.macv')
                ->leftjoin('danh_gia as dg','tl.matl','=','dg.matl')
                ->join('cong_viec as cv','tl.macv','=','cv.macv')
                ->where('th.manhomthuchien',$manth)
                ->get();
        
        return view('giangvien.kho-tai-lieu-chi-tiet')->with('dt',$dt)->with('dstailieu',$dstailieu);
    }
/*========================= Sinh viên nộp tài liệu =============================*/
    public function NopTaiLieu($mssv){
        $matl = $this->matl_tutang();
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $tendt = DB::table('de_tai as dt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->value('dt.tendt');
        $dscvchinh = DB::table('cong_viec as cv')->select('cv.macv','cv.congviec')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('th.manhomthuchien',$manth)
                ->where('cv.phuthuoc_cv','=',0)
                ->get();
        $dstailieu = DB::table('tai_lieu as tl')->distinct()
                ->select('tl.matl','tl.macv','tl.mssv','tl.tentl','tl.kichthuoc','tl.mota','tl.ngaycapnhat',
                        'tl.dieuchinh','cv.congviec','dg.nd_danhgia','dg.ngaydanhgia','sv.hoten')
                ->leftjoin('danh_gia as dg','dg.matl','=','tl.matl')
                ->join('cong_viec as cv','cv.macv','=','tl.macv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->join('sinh_vien as sv','tl.mssv','=','sv.mssv')
                ->where('th.manhomthuchien',$manth)
                ->get();
        return view('sinhvien.nop-tai-lieu')->with('tendt',$tendt)->with('dscvchinh',$dscvchinh)
                        ->with('matl',$matl)->with('dstailieu',$dstailieu)->with('mssv',$mssv);
    }
/*========================= Lưu UPLOAD TÀI LIỆU =============================*/
    public function LuuNopTaiLieu(Request $req){
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
            $tenbandau = Input::file('fTaiLieu')->getClientOriginalName(); 
            DB::table('tai_lieu')->insert(
                        [
                            'matl'        => $_POST['txtMaTL'],
                            'tentl'       => $tenbandau,
                            'mssv'        => $_POST['txtMaSV'],
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
                return Redirect('sinhvien/noptailieu/1111317')->with('message', 'Gửi tài liệu thành công!');
            }
        }
    }
 /*======================== Xóa tài liệu nào đó ========================*/
    public function XoaTaiLieu($mssv,$matl){
        $del1 = DB::table('tai_lieu')->where('matl',$matl)->delete();
        $del2 = DB::table('danh_gia')->where('matl',$matl)->delete();
        
        return Redirect('sinhvien/noptailieu/1111317');
    }
    
}//END Class QltailieuController
