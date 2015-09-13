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
use Carbon\Carbon;

class QlthongbaoController extends Controller
{
/*=================== Mã thông báo tự tăng ===============================*/
    public function MaTB_tutang(){
        $pre = "TB";
        $macuoi = DB::table('thong_bao')->orderby('matb','desc')->first();
        
        if(count($macuoi) == 0){
            return $mamoi = "TB01";
        }
        else if(count($macuoi) > 0){
            $ma = $macuoi->matb;  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 3) + 1;
            if($so <= 9){
                $pre .="0";
               return  $mamoi = $pre .=$so;
            }
            else 
                return  $mamoi = $pre .=$so;   
        }
    }
    /*=================== Quản lý thông báo ===============================*/    
    public function QuanLyThongBao($macb){
        $ma = $this->MaTB_tutang();
        $dsthongbao = DB::table('thong_bao')->where('macb',$macb)->get();
        
        return view('giangvien.quan-ly-thong-bao')->with('dsthongbao',$dsthongbao)->with('macb',$macb)
            ->with('ma',$ma);
    }
/*=================== Lưu Thêm thông báo ===============================*/  
    public function LuuThemThongBao(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtNoiDungTB'  => 'required',
                    'txtBatDauNop'  => 'required|date',
                    'txtKetThucNop' => 'required|date'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $data = array(
                [
                    'matb'        => $_POST['txtMaTB'],
                    'macb'        => $_POST['txtMaCB'],
                    'noidungtb'   => $_POST['txtNoiDungTB'],
                    'batdautb'    => $_POST['txtBatDauNop'],
                    'ketthuctb'   => $_POST['txtKetThucNop'],
                    'donghethong' => isset($_POST['chkDongNop']) ? 1 : 0,
                    'ngaytao'     => Carbon::now()
                ]
            );
            $ch = DB::table('thong_bao')->insert($data);
            if($ch > 0){
                return redirect('giangvien/quanlythongbao/2134');
            }
        }
    }
/*=================== Cập nhật thông báo ===============================*/  
    public function CapNhatThongBao($macb,$matb){
        $tb = DB::table('thong_bao')->where('matb',$matb)->first();
        return view('giangvien.cap-nhat-thong-bao')->with('macb',$macb)->with('tb',$tb);
    } 
/*=================== Lưu Cập nhật thông báo ===============================*/  
    public function LuuCapNhatThongBao(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtNoiDungTB'  => 'required',
                    'txtBatDauNop'  => 'required|date',
                    'txtKetThucNop' => 'required|date'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $cn = DB::table('thong_bao')->where('matb',$post['txtMaTB'])->update(
                         [   
                            'noidungtb'   => $_POST['txtNoiDungTB'],
                            'batdautb'    => $_POST['txtBatDauNop'],
                            'ketthuctb'   => $_POST['txtKetThucNop'],
                            'donghethong' => isset($_POST['chkDongNop']) ? 1 : 0,
                            'ngaysua'     => Carbon::now()              
                        ]   
                    );
            if($cn > 0){
                return redirect('giangvien/quanlythongbao/2134');
            }
        }
    }
/*================= Xóa thông báo ========================================*/
    public function XoaThongBao($macb,$matb){
        $delete = DB::table('thong_bao')->where('macb',$macb)->where('matb',$matb)->delete();
        if($delete > 0){
            return redirect('giangvien/quanlythongbao/2134');
        }
    }

}
