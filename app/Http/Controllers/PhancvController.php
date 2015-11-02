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
use App\Http\Controllers\Auth;

class PhancvController extends Controller
{
/*=========================== Danh sách phân công việc của cả nhóm ==============================================*/
    public function DanhSachCVChinh(){
        $mssv = \Auth::user()->taikhoan;
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');        
        $tiendonhom = DB::table('nhom_thuc_hien')->select('sotuan_kehoach','sotuan_thucte','tiendo'
                ,'ngaybatdau_kehoach','ngayketthuc_kehoach')
               ->where('manhomthuchien','=',$manth)->first();
    //lấy tuần hiện tại chính là tuần làm công việc có mã cv lớn nhất
        $tuancv = DB::table('cong_viec as cv')->select('th.tuan')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('cv.phuthuoc_cv','=',0)
                ->where('th.manhomthuchien',$manth)
                ->orderBy('cv.macv','desc')
                ->first();
        $dscvnhom = DB::table('cong_viec as cv')->distinct()
               ->select('cv.macv','cv.congviec','cv.giaocho','cv.ngaybatdau_kehoach','cv.ngayketthuc_kehoach'
                        ,'cv.ngaybatdau_thucte','cv.ngayketthuc_thucte','cv.sotuan_thucte','cv.phuthuoc_cv'
                         ,'cv.uutien','cv.trangthai','cv.tiendo','cv.noidungthuchien','th.tuan','th.tuan_lamlai')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->join('nhom_thuc_hien as nth','th.manhomthuchien','=','nth.manhomthuchien')
               ->join('chia_nhom as chn','nth.manhomthuchien','=','chn.manhomthuchien')
               ->where('chn.mssv','=',$mssv)
               ->where('nth.manhomthuchien','=',$manth)
               ->where('cv.phuthuoc_cv','=',0)
               ->paginate(5);
               //->get();        
       //Lấy thông tin để vẽ sơ đồ cột
        $dscvchinh = DB::table('cong_viec as cv')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->where('th.manhomthuchien',$manth)
               ->where('cv.phuthuoc_cv','=',0)
               ->get();
        $dscvphu = DB::table('cong_viec')->select('macv','congviec','tiendo','phuthuoc_cv')
                ->where('phuthuoc_cv','<>',0)
                ->get();
        
        return view('sinhvien.danh-sach-cong-viec-chinh')->with('dscv',$dscvnhom)
            ->with('tiendonhom',$tiendonhom)->with('manth',$manth)->with('tuancv',$tuancv)
            ->with('dscvchinh',$dscvchinh)->with('dscvphu',$dscvphu);
    }
/*=========================== Danh sách phân công việc của cả nhóm ==============================================*/
    public function DanhSachCV($macvphu){
        $mssv = \Auth::user()->taikhoan;
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $dscvnhom = DB::table('cong_viec as cv')->distinct()
               ->select('cv.macv','cv.congviec','cv.giaocho','cv.ngaybatdau_kehoach','cv.ngayketthuc_kehoach'
                        ,'cv.ngaybatdau_thucte','cv.ngayketthuc_thucte','cv.sotuan_thucte','cv.phuthuoc_cv'
                         ,'cv.uutien','cv.trangthai','cv.tiendo','cv.noidungthuchien','th.tuan','th.tuan_lamlai')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->join('nhom_thuc_hien as nth','th.manhomthuchien','=','nth.manhomthuchien')
               ->join('chia_nhom as chn','nth.manhomthuchien','=','chn.manhomthuchien')
               ->where('chn.mssv','=',$mssv)
               ->where('cv.phuthuoc_cv',$macvphu)
               ->where('nth.manhomthuchien','=',$manth)
               ->get();
               //->paginate(5);
        
        return view('sinhvien.danh-sach-cong-viec')->with('dscv',$dscvnhom);
    }
/**********
 * ########## CÔNG VIỆC CHÍNH #############
 * *********
 */ 
/*====================== Mã công việc tự tăng ====================================*/
    function macv_tutang(){
        $pre = "CV";
        $macuoi = DB::table('cong_viec')->select('macv')->orderBy('macv', 'desc')->lists('macv'); 
     //Lấy mã lớn nhất rồi ép kiểu về kiểu số nguyên và tăng 1   
        $i = 1;
        for($j = 0; $j < count($macuoi); $j++){
            if($i < (int)substr($macuoi[$j], 2)){
                $i = (int)substr($macuoi[$j], 2);
            }
        }
        if(count($macuoi)>0){
            $so = $i + 1;
        }
            return  $mamoi = $pre .=$so;     
    }
/*====================== Mã công việc phụ thuộc tự tăng ===================================*/
    function macvphuthuoc_tutang($macvchinh){
        $pre = $macvchinh;
        $pre .="."; // cộng chuỗi $pre thêm dấu '.' phía sau => $pre($macvchinh = CV1) .= "." = CV1.1          
        $macuoi = DB::table('cong_viec')->select('macv')->where('phuthuoc_cv','=',$macvchinh)
                ->orderBy('macv', 'desc')->lists('macv'); 
     
        if(count($macuoi) > 0){
            if($macvchinh == "1"){
                //Lấy mã lớn nhất rồi ép kiểu về kiểu số nguyên và tăng 1   
                $i = 1;
                for($j = 0; $j < count($macuoi); $j++){
                    if($i < (int)substr($macuoi[$j], 2)){
                        $i = (int)substr($macuoi[$j], 2);
                    }
                }
                $so = $i + 1;
                return  $mamoi = $pre .= $so;
            }
            else 
            {
                //Lấy mã lớn nhất rồi ép kiểu về kiểu số nguyên và tăng 1   
                $i = 1;
                for($j = 0; $j < count($macuoi); $j++){
                    if($i < (int)substr($macuoi[$j], 4)){
                        $i = (int)substr($macuoi[$j], 4);
                    }
                }
                $so = $i + 1;
                return  $mamoi = $pre .= $so;                 
            }
        }
        else{
            return $mamoi = $pre .= 1;
        }       
    }
/*========= Danh sách quản lý phân công nhiệm vụ ==============*/   
   public function DSPhanCV(){
       $mssv = \Auth::user()->taikhoan;
       $manth = DB::table('chia_nhom')->where('mssv','=',$mssv)->value('manhomthuchien');
       $tiendonhom = DB::table('nhom_thuc_hien')->select('sotuan_kehoach','sotuan_thucte','tiendo')
               ->where('manhomthuchien','=',$manth)->first();
       //lấy tuần hiện tại chính là tuần làm công việc có mã cv lớn nhất
        $tuancv = DB::table('cong_viec as cv')->select('th.tuan')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('cv.phuthuoc_cv','=',0)
                ->where('th.manhomthuchien',$manth)
                ->orderBy('cv.macv','desc')
                ->first();
       //Lấy tên đề tài của 1 nhóm
       $tendt = DB::table('de_tai as dt')
               ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
               ->join('nhom_thuc_hien as nth','radt.manhomthuchien','=','radt.manhomthuchien')
               ->where('radt.manhomthuchien','=',$manth)
               ->first();
       $dscvchinh = DB::table('cong_viec as cv')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->where('th.manhomthuchien',$manth)
               ->where('cv.phuthuoc_cv','=',0)->paginate(5);
               //->get();

       return view('sinhvien.phan-cong-nhiem-vu')->with('tendt',$tendt)->with('tiendonhom',$tiendonhom)
               ->with('dscvchinh',$dscvchinh)->with('manth',$manth)->with('tuancv',$tuancv);           
   }
/*========= Xóa công việc chính ==============*/    
    public function XoacvChinh($macv){
        $mssv = \Auth::user()->taikhoan;
        $dscvphu = DB::table('cong_viec')->where('phuthuoc_cv',$macv)->get();
        if(count($dscvphu) > 0){
            \Session::flash('ThongBao','Phải xóa công việc phụ thuộc trước!');
            return redirect('sinhvien/phancv');
        }
        else{
            $Xoath = DB::table('thuc_hien')->where('macv',$macv)->delete();
            $Xoacv = DB::table('cong_viec')->where('macv',$macv)->delete();

            $tencv = DB::table('cong_viec')->where('macv',$macv)->value('congviec');
            \Session::flash('ThongBao','Xóa thành công '.$tencv.'!');
            
            return redirect('sinhvien/phancv');
            
        }        
    }
/*========= Thêm công việc chính ==============*/ 
     public function ThemcvChinh(){
         $mssv = \Auth::user()->taikhoan;
         $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manth)
                ->get();
         $ma = $this->macv_tutang();
         return view('sinhvien.them-cong-viec')->with('dstv',$dstv)->with('manth',$manth)
             ->with('ma',$ma);
     }
/*========= LƯU Thêm công việc chính ==============*/ 
     public function LuuThemcvChinh(Request $req){
         $post = $req->all();
         $v = \Validator::make($req->all(),
            [
                'txtTenCV'          => 'required',
                'txtNgayBatDauKH'   => 'required|date',
                'txtNgayKetThucKH'  => 'required|date',
                'chkGiaoCho'        => 'required',
                'txtTuan'           => 'required',
                'txtNoiDungViec'    => 'required',
                'txtTienDo'         => 'required|numeric',
                'cbTrangThai'       => 'required',
                'cbUuTien'          => 'required'
            ]
         );
         if($v->fails()){
             return redirect()->back()->withErrors($v->errors());
         }
         else{
             $masv_checked = Input::get('chkGiaoCho'); //Trả về 1 mảng mã số sv
             $chuoima = implode(', ', $masv_checked);
             $data1 = array(
                    'macv'                 => $_POST['txtMaCV'],
                    'congviec'             => $_POST['txtTenCV'],
                    'giaocho'              => $chuoima,
                    'ngaybatdau_kehoach'   => $_POST['txtNgayBatDauKH'],
                    'ngayketthuc_kehoach'  => $_POST['txtNgayKetThucKH'],
             //       'ngaybatdau_thucte',
             //       'ngayketthuc_thucte',
             //       'sotuan_thucte'         => $_POST['txtTuanThucTe'],
                    'phuthuoc_cv'          => 0,
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    'ngaytao'              => Carbon::now()
             );
             $data2 = array(
                 'manhomthuchien' => $_POST['txtMaNhomNL'],
                 'macv'           => $_POST['txtMaCV'],
                 'tuan'           => $_POST['txtTuan']
             );
             $ch1 = DB::table('cong_viec')->insert($data1);
             $ch2 = DB::table('thuc_hien')->insert($data2);
             if($ch1 > 0 && $ch2 > 0){
                 return redirect('sinhvien/phancv');
             }
         }
     }
/*========= Cập nhật công việc chính ==============*/ 
     public function CapNhatcvChinh($macv){
         $mssv = \Auth::user()->taikhoan;
         $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manth)
                ->get();
         $ndcv = DB::table('cong_viec as cv')
                 ->join('thuc_hien as th','cv.macv','=','th.macv')
                 ->where('cv.macv',$macv)->first();
         $giaocho = DB::table('cong_viec')->where('macv',$macv)->value('giaocho');
         return view('sinhvien.cap-nhat-cong-viec')->with('dstv',$dstv)->with('ndcv',$ndcv)
             ->with('giaocho',$giaocho);
     }
/*============= Lưu cập nhật cv chính ================*/
     public function LuuCapNhatcvChinh(Request $req){
         $post = $req->all();
         $v = \Validator::make($req->all(),
                 [
                    'txtTenCV'              => 'required',
                    'txtNgayBatDauKH'       => 'required|date',
                    'txtNgayKetThucKH'      => 'required|date',                    
                    'chkGiaoCho'            => 'required',
                    'txtTuan'               => 'required',
                    'txtNoiDungViec'        => 'required',
                    'txtTienDo'             => 'required|numeric',
                    'cbUuTien'              => 'required'
                 ]
          );
         if($v->fails()){
             return redirect()->back()->withErrors($v->errors());
         }
         else{
             $masv_checked = Input::get('chkGiaoCho'); //Trả về 1 mảng mã số sv
             $chuoima = implode(', ', $masv_checked);
             //Lấy trạng thái trong csdl
//             $trangthai = DB::table('cong_viec')->where('macv',$post['txtMaCV'])->value('trangthai');
             $data = array(
                    'macv'                 => $_POST['txtMaCV'],
                    'congviec'             => $_POST['txtTenCV'],
                    'giaocho'              => $chuoima,
                    'ngaybatdau_kehoach'   => $_POST['txtNgayBatDauKH'],
                    'ngayketthuc_kehoach'  => $_POST['txtNgayKetThucKH'],
//                    'ngaybatdau_thucte'    => $_POST['txtNgayBatDauThucTe'],
//                    'ngayketthuc_thucte'   => $_POST['txtNgayKTThucTe'],
//                    'sotuan_thucte'         => $_POST['txtTuanThucTe'],
                    'phuthuoc_cv'          => 0,
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['txtTienDo'] == 100 ? 'Hoàn thành' : $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['cbTrangThai'] == 'Hoàn thành' ? 100 : $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    'ngaytao'              => Carbon::now()
             );
             $ch = DB::table('cong_viec')->where('macv',$post['txtMaCV'])->update($data);
             $ch2 = DB::table('thuc_hien')->where('macv',$post['txtMaCV'])->update(
                        [
                            'tuan'        => $_POST['txtTuan'],
                            'tuan_lamlai' => $_POST['txtTuanLamLai']
                        ]
                     );
            return redirect('sinhvien/phancv');
         }
     }
/*========= Xóa công việc chính ==============*/  
     
/*****************
 * ########## CÔNG VIỆC CHI TIẾT (công việc phụ thuộc) #############
 * *************
 */
/*========= Danh sách phân công chi tiết (công việc phụ thuộc) ==============*/ 
    public function DSPhanChiTiet($macv){
        $mssv = \Auth::user()->taikhoan;
        $dscvphu = DB::table('cong_viec as cv')
                ->join('thuc_hien as th','cv.macv','=','th.macv')
                ->where('cv.phuthuoc_cv','=',$macv)->get();
        $cvchinh = DB::table('cong_viec')->where('macv','=',$macv)
                ->first();
        return view('sinhvien.phan-cong-nhiem-vu-phu-thuoc')->with('dscvphu', $dscvphu)
            ->with('cvchinh',$cvchinh);        
    }
/*========= Xóa chi tiết (công việc phụ thuộc) ==============*/    
    public function XoacvPhu($macv,$macvphu){
        $mssv = \Auth::user()->taikhoan;
        $Xoath = DB::table('thuc_hien')->where('macv',$macvphu)->delete();
        $Xoacv = DB::table('cong_viec')->where('macv',$macvphu)->delete();
        
        $tencvphu = DB::table('cong_viec')->where('macv',$macvphu)->value('congviec');
        \Session::flash('ThongBao','Xóa thành công '.$tencvphu.'!');
        if($Xoath && $Xoacv){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('sinhvien/phancv/phancongchitiet/'.$macv);
        }
    }
/*========= Thêm công việc chi tiết (cv phụ) ==============*/ 
     public function ThemcvPhu($macvchinh){
         $mssv = \Auth::user()->taikhoan;
         $ma = $this->macvphuthuoc_tutang($macvchinh);
         $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manth)
                ->get();
         return view('sinhvien.them-cong-viec-phuthuoc')->with('macvchinh',$macvchinh)
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
                     'txtTuan'          => 'required',
                     'txtNoiDungViec'   => 'required',
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
                    'ngayketthuc_kehoach'  => $_POST['txtNgayKetThucKH'],
            //         'ngaybatdau_thucte',
            //         'ngayketthuc_thucte',
            //         'sotuan_thucte'        => $_POST['txtTuanThucTe'],
                    'phuthuoc_cv'          => $_POST['txtMacvChinh'],
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    'ngaytao'              => Carbon::now()
             );
             $data2 = array(
                 'manhomthuchien' => $_POST['txtMaNhomNL'],
                 'macv'           => $_POST['txtMaCV'],
                 'tuan'           => $_POST['txtTuan'],
                 'tuan_lamlai'    => $_POST['txtTuanLamLai']  
             );
             $ch1 = DB::table('cong_viec')->insert($data1);
             $ch2 = DB::table('thuc_hien')->insert($data2);
//             if($ch1 >0 && $ch2 > 0){
                 return redirect('sinhvien/phancv/phancongchitiet/'.$post['txtMacvChinh']);
//             }
         }             
     }
/*========= Cập nhật công việc chi tiết (cv phụ) ==============*/ 
     public function CapNhatcvPhu($macv,$macvphu){
         $mssv = \Auth::user()->taikhoan;
         $cv = DB::table('cong_viec as cv')
                 ->join('thuc_hien as th','cv.macv','=','th.macv')
                 ->where('cv.macv',$macvphu)->first();
         $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
         $dstv = DB::table('sinh_vien as sv')
                ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
                ->where('chn.manhomthuchien',$manth)
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
                    'cbGiaoCho'             => 'required',
                    'txtTuan'               => 'required',
                    'txtNoiDungViec'        => 'required',
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
//                    'ngaybatdau_thucte'    => $_POST['txtNgayBatDauThucTe'],
//                    'ngayketthuc_thucte'   => $_POST['txtNgayKTThucTe'],
//                    'sotuan_thucte'        => $_POST['txtTuanThucTe'],
                    'phuthuoc_cv'          => $_POST['txtMacvChinh'],
                    'uutien'               => $_POST['cbUuTien'],
                    'trangthai'            => $_POST['txtTienDo'] == 100 ? 'Hoàn thành' : $_POST['cbTrangThai'],
                    'tiendo'               => $_POST['cbTrangThai'] == 'Hoàn thành' ? 100 : $_POST['txtTienDo'],
                    'noidungthuchien'      => $_POST['txtNoiDungViec'],
                    'ngaytao'              => Carbon::now(),
             );
             $ch = DB::table('cong_viec')->where('macv',$post['txtMaCV'])->update($data);
             $ch2 = DB::table('thuc_hien')->where('macv',$post['txtMaCV'])->update(
                        [                            
                            'tuan'           => $_POST['txtTuan'],
                            'tuan_lamlai'    => $_POST['txtTuanLamLai'] 
                        ]
                     );
             
//             if($ch > 0 && ch2 > 0){
                 return redirect('sinhvien/phancv/phancongchitiet/'.$post['txtMacvChinh']);
//             }
         }
     }
    
}// End Class PhancvController
