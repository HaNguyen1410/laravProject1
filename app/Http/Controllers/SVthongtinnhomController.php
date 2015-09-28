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
use App\Http\Controllers\Auth;

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
    public function ThemThongTinNhom(){
        $mssv = \Auth::user()->taikhoan;
        $thongtindt = DB::table('chia_nhom as chn')
                ->select('gv.macb','gv.hoten','dt.tendt')
                ->join('ra_de_tai as radt','chn.manhomthuchien','=','radt.manhomthuchien')
                ->join('de_tai as dt','radt.madt','=','dt.madt')
                ->join('giang_vien as gv','dt.macb','=','gv.macb')
                ->where('chn.mssv',$mssv)->first();
        $manth = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $thongtinNhom = DB::table('nhom_thuc_hien')
                ->select('lichhop','tochucnhom','phamvi_detai','congnghethuchien','ngaybatdau_thucte',
                        'ngayketthuc_thucte','sotuan_thucte','tiendo')
                ->where('manhomthuchien',$manth)
                ->first();
        return view('sinhvien.them-thong-tin-nhom-nien-luan')->with('thongtindt',$thongtindt)
            ->with('manth',$manth)->with('nhom',$thongtinNhom);           
    }
    public function LuuThemThongTinNhom(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                    [
                        'chkBuoiHop'          => 'required',
                        'txtNgayBatDauThucTe' => 'required|date',
                        'txtNgayKTThucTe'     => 'required|date',
                        'txtTuanThucTe'       => 'required|numeric',
                        'txtTienDo'           => 'required|numeric'
                    ]
                );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
                //Lấy 1 mảng các ngày được check
            $ngay_checked = Input::get('chkBuoiHop');
    //        return $ngay_checked;
            //Đưa mảng các phần tử thành 1 chuỗi
            $ngaychon = implode(', ', $ngay_checked);

            $data = array(
                'lichhop'            => $ngaychon,
                'ngaybatdau_thucte'  => $_POST['txtNgayBatDauThucTe'],
                'ngayketthuc_thucte' => $_POST['txtNgayKTThucTe'],
                'sotuan_thucte'      => $_POST['txtTuanThucTe'],
                'tiendo'             => $_POST['txtTienDo'],
                'hoanthanh'          => $_POST['txtTienDo'] == 100 ? 1 : NULL ,
                'tochucnhom'         => $_POST['txtToChucNhom'],
                'phamvi_detai'       => $_POST['txtPhamVi'],
                'congnghethuchien'   => $_POST['txtCongNgheThucHien']        
            );
            $ch = DB::table('nhom_thuc_hien')->where('manhomthuchien',$_POST['txtMaNhomNL'])
                    ->update($data);
            return redirect('sinhvien/themthongtinnhom');
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