<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DangNhapController extends Controller
{
/*=============== Đăng Nhập ====================*/ 
    public function DangNhap(){
        
        return view('giaodienchung.dang-nhap');  
    }
/*=============== Đăng xuất ====================*/  
    public function DangXuat(){
        
        return view('giaodienchung.dang-nhap');  
    }       
}
