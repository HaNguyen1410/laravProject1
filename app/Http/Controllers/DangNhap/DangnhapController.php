<?php

namespace App\Http\Controllers\Dangnhap;

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
use App\Giangvien;
use App\Sinhvien;
use App\Chianhom;

class DangnhapController extends Controller
{
/*=============== Hiển thị giao diện đăng nhập =====================*/    
    public function DangNhap(){
        return view('giaodienchung.dang-nhap');
    }
/*=====================  =======================*/    
    public function GoiDangNhap(Request $req){
        $post = $req->all();        
        $tendangnhap = $_POST['txtTenDangNhap'];
        $mkNhap = md5($_POST['txtMatKhau']);
        $tt_gv = DB::table('giang_vien')->select('macb','hoten')
                ->where('macb',$tendangnhap)
                ->where('matkhau',$mkNhap)
                ->lists('macb','hoten');
        $tt_sv = DB::table('sinh_vien')->select('mssv','hoten')
                ->where('mssv',$tendangnhap)
                ->where('matkhau',$mkNhap)
                ->lists('mssv','hoten');
        
        $v = \Validator::make($req->all(),
                [
                    'txtTenDangNhap'   => 'required',//|unique:sinh_vien
                    'txtMatKhau'       => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }        
        else{
//            return count($tt_gv);
            if(count($tt_gv) > 0){
                \Session::put('gv',$tt_gv);
                $tk = \Session::get('gv');
                return redirect('giangvien/thongtingv/'.$tk->macb)->with('tk',$tk);
            }
            else if(count($tt_sv) > 0){
                \Session::put('sv',$tt_sv);
                return $tk = \Session::get('sv');
            }
            else {
                \Session::forget('gv'); //Remove một đối tượng khỏi session
                \Session::forget('sv');
                return null;
            }
        }             
    }
    
}
