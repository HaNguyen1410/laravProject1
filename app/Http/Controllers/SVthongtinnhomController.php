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

class SVthongtinnhomController extends Controller
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
    public function ThemThongTinNhom($mssv){
        $thongtindt = DB::table('chia_nhom as chn')->select('gv.macb','gv.hoten','dt.tendt')
                ->join('ra_de_tai as radt','chn.manhomthuchien','=','radt.manhomthuchien')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->join('giang_vien as gv','dt.macb','=','gv.macb')
                ->where('chn.mssv',$mssv)->first();
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $thongtinNhom = DB::table('nhom_thuc_hien')
                ->select('lichhop','tochucnhom','phamvi_detai','congnghethuchien')
                ->where('manhomthuchien',$manth)
                ->first();
        return view('sinhvien.them-thong-tin-nhom-nien-luan')->with('thongtindt',$thongtindt)
            ->with('manth',$manth)->with('nhom',$thongtinNhom);           
    }
    public function LuuThemThongTinNhom(Request $req){
        $post = $req->all();
        //Lấy 1 mảng các ngày được check
        $ngay_checked = Input::get('chkBuoiHop');  
//        return $ngay_checked;
        $data = array(
            'lichhop'          => $ngay_checked,
            'tochucnhom'       => $_POST['txtToChucNhom'],
            'phamvi_detai'     => $_POST['txtPhamVi'],
            'congnghethuchien' => $_POST['txtCongNgheThucHien']        
        );
        $ch = DB::table('nhom_thuc_hien')->where('manhomthuchien',$_POST['txtMaNhomNL'])
                ->update($data);
        return redirect('sinhvien/themthongtinnhom/1111317');
    }

}//END Class DangkydtController
 
/*
 * 
 * select DISTINCT dangky_nhom.mssv, sinh_vien.hoten 
 * from dangky_nhom join sinh_vien on dangky_nhom.mssv = sinh_vien.mssv 
 * WHERE dangky_nhom.manhomhp = 1
 * 
 */