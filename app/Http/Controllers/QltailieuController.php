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

class QltailieuController extends Controller
{
/*========================= Giảng viên quản lý tài liệu =============================*/
    public function KhoTaiLieu($macb){
        return view('giangvien.kho-tai-lieu');
    }
/*========================= Sinh viên nộp tài liệu =============================*/
    public function NopTaiLieu(){
        
        return view('sinhvien.nop-tai-lieu');
    }
}
