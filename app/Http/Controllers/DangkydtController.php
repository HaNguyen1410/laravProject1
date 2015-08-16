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

class DangkydtController extends Controller
{
    public function DangKyDT($mssv){
        $mahp = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomhp');
        $dstensv = DB::table('sinh_vien as sv')->select('hoten')
                ->join('dangky_nhom as dk','sv.mssv','=','dk.mssv')
                ->where('dk.manhomhp','=',$mahp)
                ->where('dk.mssv','=',$mssv)->get();
        $dssv = DB::table('dangky_nhom')->distinct()->where('manhomhp',$mahp)->get();
        return view('sinhvien.dang-ky-de-tai')->with('dssv',$dssv)->with('dstensv',$dstensv);
    }
}
