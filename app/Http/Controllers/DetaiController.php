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

class DetaiController extends Controller
{
    public function DsDeTai($macb){
        $dsdt = DB::table('de_tai')->where('macb',$macb)->get();
        return view('giangvien.danh-sach-de-tai')->with('dsdt',$dsdt);
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaDeTai($madt){
        $delete = DB::table('de_tai')->where('madt',$madt)->delete();
        $tendt = DB::table('de_tai')->where('madt',$madt)->value('tendt');
        \Session::flash('ThongBao','Xóa '.$tendt.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('giangvien/danhsachdetai/2134');
        }
    }
/*=========================== Thêm đề tài ==============================================*/ 
    public function ThemDeTai($macb){
        return view('giangvien.them-de-tai');
    } 
    
    public function LuuThemDeTai(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtTenDeTai'   => 'required',
                    'txtSoNguoi'    => 'required|numeric'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data1 = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'tendt'         => $_POST['txtTenDeTai'],
                    'songuoitoida'  => $_POST['txtSoNguoi'],
                    'motadt'        => $_POST['txtMoTa'],
                    'congnghe'      => $_POST['txtCongNghe'],
                    'ghichudt'      => $_POST['txtGhiChu'],
                    'phanloai'      => $_POST['cbmPhanLoai'],
                    'trangthai'     => $_POST['cbmTrangThai'],
                    //'taptindinhkem' => $_POST['ftTapTinKem']
            );
            $data2 = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'manhomhp'      => $_POST['cbNhomHP']
            );
            $ch1 = DB::table('de_tai')->insert($data1);
            $ch2 = DB::table('ra_de_tai')->insert($data2);
            if($ch1 > 0 && $ch2 > 0){
                return redirect('giangvien/danhsachdetai/2134');
            }
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatDeTai($macb,$madt){
        $row = DB::table('de_tai')->where('madt',$madt)->first();
        return view('giangvien.cap-nhat-de-tai')->with('dt',$row);
    } 
    
    public function LuuCapNhatDeTai(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtTenDeTai'   => 'required',
                    'txtSoNguoi'    => 'required|numeric'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'tendt'         => $_POST['txtTenDeTai'],
                    'songuoitoida'  => $_POST['txtSoNguoi'],
                    'motadt'        => $_POST['txtMoTa'],
                    'congnghe'      => $_POST['txtCongNghe'],
                    'ghichudt'      => $_POST['txtGhiChu'],
                    'phanloai'      => $_POST['rdPhanLoai'],
                    'trangthai'     => $_POST['rdTrangThai'],
                    'taptindinhkem' => $_POST['txtTapTinKem']
            );
            $ch = DB::table('de_tai')->where('madt',$post['txtMaDeTai'])->update($data);
            if($ch > 0){
                return redirect('giangvien/danhsachdetai/2134');
            }
        }
    }
    
}
