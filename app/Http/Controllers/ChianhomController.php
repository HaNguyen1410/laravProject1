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

class ChianhomController extends Controller
{
 /*====================== Mã nhóm thực hiện tự tăng ====================================*/
    function manth_tutang(){
        $pre = "NTH";
        $macuoi = DB::table('nhom_thuc_hien')->orderby('manhomthuchien','desc')->first();
        
        if(count($macuoi) > 0){
            $ma = $macuoi->manhomthuchien;  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 3) + 1;
        }
        if($so <= 9){
            $pre .="0";
           return  $mamoi = $pre .=$so;
        }
        else 
            return  $mamoi = $pre .=$so;        
    }   
/*====================  ======================*/
    public function ChiaNhomNL($macb){
        $mahp = DB::table('nhom_hocphan as hp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->value('manhomhp');
        $dstensv = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.mssv','sv.hoten')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('chn.manhomhp','=',$mahp)
                ->get();
        $dssv = DB::table('chia_nhom')->distinct()->where('manhomhp',$mahp)->get();
        //Lấy madt, tendt
        $dsdetai = DB::table('de_tai')->where('macb',$macb)->get();
        return view('giangvien.chia-nhom-nien-luan')->with('dstensv',$dstensv)->with('dssv',$dssv)
            ->with('dsdetai',$dsdetai);           
    }

/*==================== Lấy danh sách đề tài của 1 nhóm học phân ======================*/
    public function ChonDeTai($mssv){
        $mahp = DB::table('dangky_nhom as dk')
                ->join('nhom_hocphan as hp','dk.manhomhp','=','hp.manhomhp')
                ->where('dk.mssv',$mssv)
                ->value('hp.manhomhp');
        $dsdtHocPhan = DB::table('ra_de_tai as radt')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->where('radt.manhomhp',$mahp)
                ->get();
        return view('sinhvien.chon-de-tai')->with('dsdtHocPhan',$dsdtHocPhan);
    }
    public function LuuChonDeTai(){
        
    }
/*==================== Đăng ký thành viên Nhóm ======================*/
    public function ThemThanhVien($mssv){
        $mahp = DB::table('dangky_nhom')->where('mssv',$mssv)->value('manhomhp');
        $dstensv = DB::table('dangky_nhom as dk')->distinct()
                ->select('dk.mssv','sv.hoten')
                ->join('sinh_vien as sv','dk.mssv','=','sv.mssv')
                ->where('dk.manhomhp','=',$mahp)
                ->get();
        $dssv = DB::table('dangky_nhom')->distinct()->where('manhomhp',$mahp)->get();
        return view('sinhvien.dang-ky-thanh-vien')->with('dssv',$dssv)->with('dstensv',$dstensv); 
    }

    public function LuuThemThanhVien(Request $req){
        $manth = $this->manth_tutang();
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'chk'           =>'required',
                    //'rdNhomTruong'  =>'required'
                ]
        );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $masv_checked = Input::get('chk'); //trả về 1 mảng mssv 
                // has -> true nếu giá trị hiện tại có giá trị và không rỗng
            $nhomtruong = Input::has('rdNhomTruong')==TRUE ? 0 : 1; 
            //return $masv_checked.$nhomtruong;
            //return count($masv_checked);
            if(array_key_exists('chk', $masv_checked)){                    
                for($i=1; $i <= count($masv_checked['chk']); $i++){ 
                    return $masv_checked["chk.[$i]"];
//                    $ch = DB::table('dangky_nhom')->where('mssv')
//                            ->update([                        
//                                    'manhomthuchien'=>$manth,
//                                    'nhomtruong'=>$nhomtruong
//                               ]);
                }
            }
                
             //return redirect('sinhvien/dangkydt/1111317');
        }      
    }
    
}//END Class DangkydtController
 
/*
 * 
 * select DISTINCT dangky_nhom.mssv, sinh_vien.hoten 
 * from dangky_nhom join sinh_vien on dangky_nhom.mssv = sinh_vien.mssv 
 * WHERE dangky_nhom.manhomhp = 1
 * 
 */