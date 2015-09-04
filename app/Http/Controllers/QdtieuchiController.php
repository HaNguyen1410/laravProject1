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

class QdtieuchiController extends Controller
{
/*====================== Mã tiêu chí tự tăng ====================================*/
    public function matc_tutang(){
//Lấy mã cuối cùng của nhóm thưc hiện
        $matc = DB::table('tieu_chi_danh_gia')->orderby('matc','desc')->first();
        
        if(count($matc)>0){
            $ma = $matc->matc;  
            return $so = (int)$ma + 1;
        }     
    }
/*====================== Lấy danh sách các tiêu chí đánh giá của 1 cán bộ ====================================*/
    public function DSTieuChi($macb){
        $ma = $this->matc_tutang();
        $namhoc = DB::table('nien_khoa')->distinct()->select('nam')
                ->get();
        $hocky = DB::table('nien_khoa')->distinct()->select('hocky')
                ->get();
        $dstc = DB::table('tieu_chi_danh_gia as dg')
                ->join('quy_dinh as qd', 'dg.matc','=','qd.matc')
                ->where('qd.macb','=',$macb)
                ->get();
         
        return view('giangvien.quy-dinh-tieu-chi')->with('dstc',$dstc)->with('namhoc',$namhoc)
        ->with('hocky',$hocky)->with('ma',$ma);
    }
/*========= Xóa Tiêu chí đánh giá ==============*/    
    public function XoaTieuChi($macb,$matc){
        $Xoaqd = DB::table('quy_dinh')->where('matc',$matc)->delete();
        $Xoatc = DB::table('tieu_chi_danh_gia')->where('matc',$matc)->delete();
        $Xoad = DB::table('chitiet_diem')->where('matc',$matc)->delete();
        
        \Session::flash('ThongBao','Xóa thành công!');       
            
        return redirect('giangvien/dstieuchi/2134');      
    }
/*========================= Thêm tiêu chí đánh giá ========================*/
//    public function ThemTieuChi($macb){ 
//        $ma = $this->matc_tutang();
//        return view('giangvien.them-tieu-chi')->with('ma',$ma);
//    }
    
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
                    'heso'       => $_POST['txtMucDiem'],
                    'ngaytao'    => Carbon::now()   
            );
            $data2 = array(
                    'macb'   => $_POST['txtMaCB'],
                    'matc'   => $_POST['txtMaTC']
            );
            $ch1 = DB::table('tieu_chi_danh_gia')->insert($data1);
            $ch2 = DB::table('quy_dinh')->insert($data2);
            
            return redirect('giangvien/dstieuchi/2134');
           
        }
    }
/*========================= Cập nhật tiêu chí đánh giá ========================*/
    public function CapNhatTieuChi($macb,$matc){
      //Hiển thị thông tin của 1 tiêu chí nào đó     
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
                    'heso'       => $_POST['txtMucDiem'],
                    'ngaytao'    => Carbon::now()   
            );
            $ch = DB::table('tieu_chi_danh_gia')->where('matc', $post['txtMaTC'])->update($data);
            if($ch > 0){
                return redirect('giangvien/dstieuchi/2134');
            }
        }
    }
}
