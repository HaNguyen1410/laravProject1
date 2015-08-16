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

class DiemController extends Controller
{
/*=========================== Danh sách công việc nhóm ==============================================*/
    public function XemDiem($mssv){
        $manth = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $tieuchi = DB::table();
       
        
        return view('sinhvien.danh-sach-cong-viec')->with('dscv',$dscvnhom);
    }   
}
