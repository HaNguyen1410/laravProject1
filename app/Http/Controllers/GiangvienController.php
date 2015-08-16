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
use App\Giangvien;

class GiangvienController extends Controller
{
/*=========================== Ví dụ về đưa dữ liệu từ Controller vào Views ==============================================*/
    public function ViDu(){         
        $name = "Nguyễn Thị Thu Hà";
        return view('giangvien.thong-tin')->with('name', $name);
    }   
    public function ThongTin_gv(){
        $giangvien = Giangvien::all();
        return $giangvien; //view('giangvien.thong-tin-giang-vien')->with('gv',$giangvien);        
    }
    
/*=========================== Xem thông tin giảng viên theo mã cán bộ ==============================================*/     
    public function ThongTinGV($macb){
        $giangvien = Giangvien::find($macb);
        
        return view('giangvien.thong-tin-giang-vien')->with('gv',$giangvien);
    }
/*=========================== Đổi mật khẩu Giảng Viên ==============================================*/   
    public function DoiMatKhauGV($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        return view('giangvien.doi-mat-khau-gv')->with('gv', $row);
    } 
    public function LuuDoiMatKhauSV(Request $req){        
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
//                    'txtMaCB'      => 'required',
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
    }

}// END Class GiangvienController
