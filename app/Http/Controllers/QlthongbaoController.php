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
        $dsthongbao = DB::table('thong_bao as tb')
                        ->select('tb.matb','tb.noidungtb','tb.batdautb','tb.ketthuctb','tb.ngaytao',
                                'tb.ngaysua','tb.donghethong','ntb.manhomthuchien')
                        ->leftjoin('nhan_thong_bao as ntb','tb.matb','=','ntb.matb')
                        ->where('tb.macb',$macb)
                        ->get();
       //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        //Lấy danh sách nhóm thực hiện trong hk niên khóa hiện tại
        $dsnhomth = DB::table('nhom_thuc_hien as nth')->distinct()->select('nth.manhomthuchien')
                    ->join('chia_nhom as chn','nth.manhomthuchien','=','chn.manhomthuchien')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                    ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                    ->where('hp.macb',$macb)
                    ->get();
        
        return view('giangvien.quan-ly-thong-bao')->with('dsthongbao',$dsthongbao)->with('macb',$macb)
            ->with('ma',$ma)->with('dsnhomth',$dsnhomth);
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
            $ch2 = DB::table('nhan_thong_bao')->insert(
                        [
                           'matb'           => $_POST['txtMaTB'],
                           'manhomthuchien' => $_POST['cbNhomNL']
                        ]
                    );
            if($ch2 > 0 && $ch > 0){
                return redirect('giangvien/quanlythongbao/2134');
            }
        }
    }
/*=================== Cập nhật thông báo ===============================*/  
    public function CapNhatThongBao($macb,$matb){
        $tb = DB::table('thong_bao')->where('matb',$matb)->first();
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        //Lấy danh sách nhóm thực hiện trong hk niên khóa hiện tại
        $dsnhomth = DB::table('nhom_thuc_hien as nth')->distinct()->select('nth.manhomthuchien')
                    ->join('chia_nhom as chn','nth.manhomthuchien','=','chn.manhomthuchien')
                    ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                    ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                    ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                    ->where('hp.macb',$macb)
                    ->get();
        return view('giangvien.cap-nhat-thong-bao')->with('macb',$macb)->with('tb',$tb)
            ->with('dsnhomth',$dsnhomth);
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
            $cn2 = DB::table('nhan_thong_bao')->where('matb',$post['txtMaTB'])->update(
                        [
                           'manhomthuchien' => $_POST['cbNhomNL']
                        ]
                    );
            
            return redirect('giangvien/quanlythongbao/2134');
            
        }
    }
/*================= Xóa thông báo ========================================*/
    public function XoaThongBao($macb,$matb){
        $delete = DB::table('thong_bao')->where('macb',$macb)->where('matb',$matb)->delete();
        $delete2 = DB::table('nhan_thong_bao')->where('matb',$matb)->delete();
        if($delete > 0 && $delete2 > 0){
            return redirect('giangvien/quanlythongbao/2134');
        }
    }

}
