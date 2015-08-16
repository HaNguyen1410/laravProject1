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

class QdtieuchiController extends Controller
{
    public function DSTieuChi($macb){
        $dstc = DB::table('tieu_chi_danh_gia as dg')
                ->join('quy_dinh as qd', 'dg.matc','=','qd.matc')
                ->where('qd.macb','=',$macb)
                ->get();
        return view('giangvien.quy-dinh-tieu-chi')->with('dstc',$dstc);
    }
/*========================= Thêm tiêu chí đánh giá ========================*/
    public function ThemTieuChi($macb){        
        return view('giangvien.them-tieu-chi');
    }
    public function LuuThemTieuChi(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaTC'       => 'required',
                    'txtNoiDungTC'  => 'required',
                    'txtMucDiem'    => 'required|numeric'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {            
            $data1 = array(
                    'matc'       => $_POST['txtMaTC'],
                    'noidungtc'  => $_POST['txtNoiDungTC'],
                    'heso'       => $_POST['txtMucDiem']
                    //'ngaytao'    => today()   
            );
            $data2 = array(
                    'macb'   => $_POST['txtMaCB'],
                    'matc'   => $_POST['txtMaTC']
            );
            $ch1 = DB::table('tieu_chi_danh_gia')->insert($data1);
            $ch2 = DB::table('quy_dinh')->insert($data2);
            if($ch1 > 0 && $ch2 > 0){
                return redirect('giangvien/dstieuchi/2134');
            }
        }
    }
/*========================= Cập nhật tiêu chí đánh giá ========================*/
    public function CapNhatTieuChi($macb,$matc){
        $tc = DB::table('tieu_chi_danh_gia as dg')
                ->join('quy_dinh as qd', 'dg.matc','=','qd.matc')
                ->where('dg.matc','=',$matc)
                ->first();
        return view('giangvien.cap-nhat-tieu-chi')->with('tc',$tc);
    }
    public function LuuCapNhatTieuChi(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaTC'       => 'required',
                    'txtNoiDungTC'  => 'required',
                    'txtMucDiem'    => 'required|numeric'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {            
            $data = array(
                    'noidungtc'  => $_POST['txtNoiDungTC'],
                    'heso'       => $_POST['txtMucDiem']
                    //'ngaytao'    => today()   
            );
            $ch = DB::table('tieu_chi_danh_gia')->where('matc', $post['txtMaTC'])->update($data);
            if($ch > 0){
                return redirect('giangvien/dstieuchi/2134');
            }
        }
    }
}
