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
use App\Sinhvien;

class SinhvienController extends Controller
{
/*============================= Hiển thị thông tin của 1 sinh viên ========================================*/
    public function HienThiSV($masv){
        $sinhvien = Sinhvien::find($masv);
        $hp = DB::table('chia_nhom as chn')->select('hp.tennhomhp')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('chn.mssv',$masv)
                ->first();
        $manth = DB::table('chia_nhom')->where('mssv','=',$masv)->value('manhomthuchien');        
        $dstv = DB::table('sinh_vien as sv')
            ->join('chia_nhom as chn', 'sv.mssv','=','chn.mssv')
            ->where('chn.manhomthuchien',$manth)
            ->get();
        $ttgv = DB::table('chia_nhom as chn')->select('gv.macb','gv.hoten','gv.email','gv.sdt','chn.manhomthuchien')                
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('chn.manhomthuchien',$manth)
                ->first();        
        $detainhom = DB::table('ra_de_tai as radt')
                ->select('radt.manhomthuchien','dt.madt','dt.tendt','dt.taptindinhkem')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('radt.manhomthuchien',$manth)
                ->first();
        $nhomth = DB::table('nhom_thuc_hien')->select('tochucnhom','lichhop')
                ->where('manhomthuchien',$manth)->first();
        $dsthongbao = DB::table('thong_bao as tb')
                        ->select('tb.matb','tb.noidungtb','tb.dinhkemtb','tb.batdautb','tb.ketthuctb','tb.ngaytao',
                                'tb.ngaysua','tb.donghethong','ntb.manhomthuchien')
                        ->rightjoin('nhan_thong_bao as ntb','tb.matb','=','ntb.matb')
                        ->where('ntb.manhomthuchien',$manth)
                        ->Orwhere('ntb.manhomthuchien','like','Tất cả')
                        ->get();
                   
        return view('sinhvien.thong-tin-sinh-vien')->with('sv',$sinhvien)->with('hp',$hp)
                ->with('dstv',$dstv)->with('ttgv',$ttgv)->with('nhomth',$nhomth)
                ->with('detainhom',$detainhom)->with('dsthongbao',$dsthongbao);
    }
/*=========================== Sinh viên tự cập nhật thông tin ==============================================*/    
    public function LuuCapNhatThongTin(Request $request){
        $post = $request->all();
        $v = \Validator::make($request->all(),
                [
                    'txtDienThoai'  => 'required|numeric',
                    'txtLapTrinh'   => 'required',
                    'txtKinhNghiem' => 'required'
                ]
           );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $data = array(
                'sdt'              => $_POST['txtDienThoai'],
                'kynangcongnghe'   => $_POST['txtCongNghe'],
                'kienthuclaptrinh' => $_POST['txtLapTrinh'],
                'kinhnghiem'       => $_POST['txtKinhNghiem'],
            );
            $capnhat = DB::table('sinh_vien')->where('mssv',$post['txtMaSV'])->update($data);
            
                return redirect('sinhvien/thongtinsv/1111317');          
        }       
    }
    
/*============================= Công việc được giao của 1 sinh viên ========================================*/
    public function CongViecSV($masv,$hoten,$manth)
    {
       $dsDuocGiao = DB::table('cong_viec as cv')->distinct()
               ->select('cv.macv','cv.congviec','cv.giaocho','cv.ngaybatdau_kehoach','cv.ngayketthuc_kehoach'
                                 ,'cv.sogio_thucte','cv.phuthuoc_cv','cv.uutien','cv.trangthai','cv.tiendo','cv.noidungthuchien')
               ->join('thuc_hien as th','cv.macv','=','th.macv')
               ->join('nhom_thuc_hien as nth','th.manhomthuchien','=','nth.manhomthuchien')
               ->join('dangky_nhom as dk','nth.manhomthuchien','=','dk.manhomthuchien')
               ->where('nth.manhomthuchien','=',$manth)
               ->where('cv.giaocho','like',$hoten)->orwhere('cv.giaocho','like','cả nhóm')
               ->get();
        
        return view('sinhvien.xem-cong-viec-duoc-giao')->with('dscv',$dsDuocGiao);
    }
/*=========================== Đổi mật khẩu Sinh Viên ==============================================*/   
    public function DoiMatKhauSV($masv){
        $row = DB::table('sinh_vien')->where('mssv',$masv)->first();
        return view('sinhvien.doi-mat-khau-sv')->with('sv', $row);
    } 
    public function LuuDoiMatKhauSV(Request $req){        
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
//                    'txtMaSV'      => 'required',
//                    'txtHoTen'     => 'required',
//                    'txtEmail'     => 'required',
                    'txtMatKhauCu' => 'required',
                    'txtMatKhauMoi1'  => 'required|min:6|different:txtMatKhauCu',
                    'txtMatKhauMoi2'  => 'required|min:6|same:txtMatKhauMoi1'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }  
        else{
            $ch = DB::table('sinh_vien')->where('mssv', $post['txtMaSV'])
                    ->update(['matkhau' => md5($_POST['txtMatKhauMoi1'])]);
            if($ch > 0){
               return redirect('sinhvien/thongtinsv/1111317'); 
            }
        }
    }
/*=============================== (UPLOAD hình) Đổi hình đại diện ===============================*/
    public function DoiHinhDaiDienSV(Request $req){
        $masv = Input::get('txtMaSV');
        $hoten = DB::table('sinh_vien')->where('mssv',$masv)->value('hoten');
        
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'fHinh' => 'required|image|mimes:jpg,png'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }else{
            $file = Input::file('fHinh');
            // Đặt đường dẫn lưu file upload
            $luuden = public_path(). '/hinhdaidien/';
            // Lấy đuôi mở rộng        
    //           $extension = Input::file('fHinh')->getClientOriginalExtension();
            //Gắn đuôi mở rộng lúc nào cũng là png
            $extension = "png";
            // Đặt lại tên file vừa upload lên
            $gvctrl = new GiangvienController();
            $tachten = $gvctrl->lay_ten($hoten);               
            $fileName = $tachten . str_replace("/", "", str_replace(" ", "", $masv)) . '.' . $extension;

            //Lưu vào CSDL
            $cn = DB::table('sinh_vien')->where('mssv',$masv)->update(['hinhdaidien' => $fileName]);
            // Chuyển file upload vào thư mục lưu trữ đã đặt trươc đó
            $upload_success = $file->move($luuden, $fileName);

            if ($upload_success) {
                return Redirect('sinhvien/doimatkhausv/1111317')->with('message', 'Upload hình đại diện thành công!');
            }
        }
        
    }

     
}// END Class SinhvienController
