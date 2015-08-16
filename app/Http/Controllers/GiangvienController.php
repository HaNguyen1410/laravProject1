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
    public function ThongTin(){         
        $name = "Nguyễn Thị Thu Hà";
        return view('giangvien.thong-tin')->with('name', $name);
    }
 /*=========================== Xem thông tin giảng viên theo mã cán bộ ==============================================*/   
    public function ThongTinGV(){
        $giangvien = Giangvien::all();
        return $giangvien; //view('giangvien.thong-tin-giang-vien')->with('gv',$giangvien);        
    }
    
    public function HienThiGV($macb){
        $giangvien = Giangvien::find($macb);
        
        return view('giangvien.thong-tin-giang-vien')->with('gv',$giangvien);
    }

}// END Class GiangvienController
