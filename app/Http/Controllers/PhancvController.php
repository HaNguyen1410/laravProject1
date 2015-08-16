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
        $macuoi = DB::table('cong_viec')->orderBy('macv', 'desc')->first(); 
        if(count($macuoi)>0){
            $ma = $macuoi->macv;  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 2) + 1;
        }
            return  $mamoi = $pre .=$so;     
    }
/*====================== Mã công việc phụ thuộc tự tăng ====================================*/
    function macvphuthuoc_tutang($macvchinh){
        $pre = $macvchinh;
        $pre .=".";           
        $macuoi = DB::table('cong_viec')->where('phuthuoc_cv','=',$macvchinh)
                ->orderBy('macv', 'desc')->first();
        
        if(count($macuoi) > 0){
            $ma = $macuoi->macv;  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 4) + 1;
            return  $mamoi = $pre .= $so; 
        }
        else{
            return $mamoi = $pre .= 1;
        }       
    }
/*****
 * ########## CÔNG VIỆC CHÍNH #############
 * ***
 */
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
         $ma = $this->macv_tutang();
         return view('sinhvien.them-cong-viec')->with('dstv',$dstv)->with('manth',$manth)
             ->with('ma',$ma);
     }
     public function LuuThemcvChinh(Request $req){
         $post = $req->all();
         $v = \Validator::make($req->all(),
            [
                'txtTenCV'          => 'required',
                'txtNgayBatDauKH'   => 'required|date',
                'txtNgayKetThucKH'  => 'required|date',
                'cbGiaoCho'         => 'required',
                'txtNoiDungViec'    => 'required',
                'txtGioThucTe'      => 'required|numeric',
                'txtTienDo'         => 'required|numeric',
                'cbTrangThai'       => 'required',
                'cbUuTien'          => 'required'
            ]
         );
         if($v->fails()){
             return redirect()->back()->withErrors($v->errors());
         }
         else{
             $data1 = array(
                    'macv'                 => $_POST['txtMaCV'],
                    'congviec'             => $_POST['txtTenCV'],
                    'giaocho'              => $_POST['cbGiaoCho'],
                    'ngaybatdau_kehoach'   => $_POST['txtNgayBatDauKH'],
                    'ngayketthuc_kehoach'   => $_POST['txtNgayKetThucKH'],
                    //'ngaybatdau_thucte',
                    //'ngayketthuc_thucte',
                    'sogio_thucte'         => $_POST['txtGioThucTe'],
                    'phuthuoc_cv'          => 0,
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    //'ngaytao'
             );
             $data2 = array(
                 'manhomthuchien' => $_POST['txtMaNhomNL'],
                 'macv'           => $_POST['txtMaCV']
             );
             $ch1 = DB::table('cong_viec')->insert($data1);
             $ch2 = DB::table('thuc_hien')->insert($data2);
             if($ch1 >0 && $ch2 > 0){
                 return redirect('sinhvien/phancv/1111317');
             }
         }
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
     public function LuuCapNhatcvChinh(Request $req){
         $post = $req->all();
         $v = \Validator::make($req->all(),
                 [
                    'txtTenCV'              => 'required',
                    'txtNgayBatDauKH'       => 'required|date',
                    'txtNgayKetThucKH'      => 'required|date',
                    'txtNgayBatDauThucTe'   => 'required|date',
                    'txtNgayKTThucTe'       => 'required|date',                     
                    'cbGiaoCho'             => 'required',
                    'txtNoiDungViec'        => 'required',
                    'txtGioThucTe'          => 'required|numeric',
                    'txtTienDo'             => 'required|numeric',
                    'cbTrangThai'           => 'required',
                    'cbUuTien'              => 'required'
                 ]
          );
         if($v->fails()){
             return redirect()->back()->withErrors($v->errors());
         }
         else{
             $data = array(
                    'macv'                 => $_POST['txtMaCV'],
                    'congviec'             => $_POST['txtTenCV'],
                    'giaocho'              => $_POST['cbGiaoCho'],
                    'ngaybatdau_kehoach'   => $_POST['txtNgayBatDauKH'],
                    'ngayketthuc_kehoach'  => $_POST['txtNgayKetThucKH'],
                    'ngaybatdau_thucte'    => $_POST['txtNgayBatDauThucTe'],
                    'ngayketthuc_thucte'    => $_POST['txtNgayKTThucTe'],
                    'sogio_thucte'         => $_POST['txtGioThucTe'],
                    'phuthuoc_cv'          => 0,
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    //'ngaytao'
             );
             $ch = DB::table('cong_viec')->where('macv',$post['txtMaCV'])->update($data);
             if($ch >0){
                 return redirect('sinhvien/phancv/1111317');
             }
         }
     }
/*****************
 * ########## CÔNG VIỆC CHI TIẾT (công việc phụ thuộc) #############
 * *************
 */
/*========= Danh sách phân công chi tiết (công việc phụ thuộc) ==============*/ 
    public function DSPhanChiTiet($mssv,$macv){
        $dscvphu = DB::table('cong_viec')->where('phuthuoc_cv','=',$macv)->get();
        $cvchinh = DB::table('cong_viec')->where('macv','=',$macv)
                ->first();
        return view('sinhvien.phan-cong-chi-tiet-cv')->with('dscvphu', $dscvphu)
            ->with('cvchinh',$cvchinh);        
    }
/*========= Xóa chi tiết (công việc phụ thuộc) ==============*/    
    public function XoacvPhu($macv,$macvphu){
        $Xoacv = DB::table('cong_viec')->where('macv',$macvphu)->delete();
        $Xoath = DB::table('thuc_hien')->where('macv',$macvphu)->delete();
        
        \Session::flash('ThongBao','Xóa thành công!');
        if($Xoacv && $Xoath){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('sinhvien/phancongchitiet/1111317/'.$macv);
        }
    }
/*========= Thêm công việc chi tiết (cv phụ) ==============*/ 
     public function ThemcvPhu($mssv,$macv){
         $ma = $this->macvphuthuoc_tutang($macv);
         $manth = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('dangky_nhom as dk', 'sv.mssv','=','dk.mssv')
                ->where('dk.manhomthuchien',$manth)
                ->get();
         return view('sinhvien.them-cong-viec-phuthuoc')->with('macvchinh',$macv)
                 ->with('manth',$manth)->with('ma',$ma)->with('dstv',$dstv);
     }
     public function LuuThemcvPhu(Request $req){
         $post = $req->all();
         $v = \Validator::make($req->all(),
                 [
                     'txtMaCV'          => 'required',
                     'txtTenCV'         => 'required',
                     'txtNgayBatDauKH'  => 'required|date',
                     'txtNgayKetThucKH' => 'required|date',
                     'cbGiaoCho'        => 'required',
                     'txtNoiDungViec'   => 'required',
                     'txtGioThucTe'     => 'required|numeric',
                     'txtTienDo'        => 'required|numeric',
                     'cbTrangThai'      => 'required',
                     'cbUuTien'         => 'required'
                 ]
               );
         if($v->fails()){
             return redirect()->back()->withErrors($v->errors());
         }
         else{
             $data1 = array(
                    'macv'                 => $_POST['txtMaCV'],
                    'congviec'             => $_POST['txtTenCV'],
                    'giaocho'              => $_POST['cbGiaoCho'],
                    'ngaybatdau_kehoach'   => $_POST['txtNgayBatDauKH'],
                    'ngayketthuc_kehoach'   => $_POST['txtNgayKetThucKH'],
                    //'ngaybatdau_thucte',
                    //'ngayketthuc_thucte',
                    'sogio_thucte'         => $_POST['txtGioThucTe'],
                    'phuthuoc_cv'          => $_POST['txtMacvChinh'],
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    //'ngaytao'
             );
             $data2 = array(
                 'manhomthuchien' => $_POST['txtMaNhomNL'],
                 'macv'           => $_POST['txtMaCV']
             );
             $ch1 = DB::table('cong_viec')->insert($data1);
             $ch2 = DB::table('thuc_hien')->insert($data2);
             if($ch1 >0 && $ch2 > 0){
                 return redirect('sinhvien/phancongchitiet/1111317/'.$post['txtMacvChinh']);
             }
         }             
     }
/*========= Cập nhật công việc chi tiết (cv phụ) ==============*/ 
     public function CapNhatcvPhu($masv,$macv,$macvphu){
         $cv = DB::table('cong_viec')->where('macv',$macvphu)->first();
         $manth = DB::table('dangky_nhom')->where('mssv',$masv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('dangky_nhom as dk', 'sv.mssv','=','dk.mssv')
                ->where('dk.manhomthuchien',$manth)
                ->get();
         return view('sinhvien.cap-nhat-cong-viec-phuthuoc')->with('macvchinh',$macv)
                 ->with('cv',$cv)->with('dstv',$dstv);
     }
     public function LuuCapNhatcvPhu(Request $req){
         $post = $req->all();
         $v = \Validator::make($req->all(),
                 [
                    'txtTenCV'              => 'required',
                    'txtNgayBatDauKH'       => 'required|date',
                    'txtNgayKetThucKH'      => 'required|date',
                    'txtNgayBatDauThucTe'   => 'required|date',
                    'txtNgayKTThucTe'       => 'required|date',                     
                    'cbGiaoCho'             => 'required',
                    'txtNoiDungViec'        => 'required',
                    'txtGioThucTe'          => 'required|numeric',
                    'txtTienDo'             => 'required|numeric',
                    'cbTrangThai'           => 'required',
                    'cbUuTien'              => 'required'
                 ]
          );
         if($v->fails()){
             return redirect()->back()->withErrors($v->errors());
         }
         else{
             $data = array(
                    'macv'                 => $_POST['txtMaCV'],
                    'congviec'             => $_POST['txtTenCV'],
                    'giaocho'              => $_POST['cbGiaoCho'],
                    'ngaybatdau_kehoach'   => $_POST['txtNgayBatDauKH'],
                    'ngayketthuc_kehoach'  => $_POST['txtNgayKetThucKH'],
                    'ngaybatdau_thucte'    => $_POST['txtNgayBatDauThucTe'],
                    'ngayketthuc_thucte'   => $_POST['txtNgayKTThucTe'],
                    'sogio_thucte'         => $_POST['txtGioThucTe'],
                    'phuthuoc_cv'          => $_POST['txtMacvChinh'],
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    //'ngaytao'
             );
             $ch = DB::table('cong_viec')->where('macv',$post['txtMaCV'])->update($data);
             if($ch >0){
                 return redirect('sinhvien/phancongchitiet/1111317/'.$post['txtMacvChinh']);
             }
         }
     }
    
}// End Class PhancvController
