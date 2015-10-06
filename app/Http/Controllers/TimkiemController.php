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

class TimkiemController extends Controller
{
/*** TÌM KIẾM :
	->GV: Nhập tên sv -> kq: tensv, tendt, tennhom, cv, tiendo, noidung
	->SV: Nhập tên sv -> kq: tencv, ngaythuchien, tiendo, noidung,
 */
/*===================== Sinh viên thực hiện tìm kiếm ========================*/
    public function SVTimKiem(Request $req){
        $sv_dangnhap = \Auth::user()->taikhoan;
        $manth = DB::table('chia_nhom')->where('mssv',$sv_dangnhap)->value('manhomthuchien');
        $ht = $req->txtTimKiem;
        $ma_sv = DB::table('sinh_vien')->where('hoten','like',$ht)->value('mssv');
        $manth_svdangtim = DB::table('chia_nhom')->where('mssv',$ma_sv)->where('manhomthuchien',$manth)
                ->first(); 
        
        $v = \Validator::make($req->all(),
                    [
                        'txtTimKiem' => 'required|max:30'
                    ]
                );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else if(count($manth_svdangtim) == 0){
//            \Session::flash('ThongBao','Không thể tìm thông tin sinh viên thuộc nhóm khác! ');
            return Redirect::to('sinhvien/ketquatimkiem')->with('hoten',$hoten)->with('BaoLoi','Không thể tìm thông tin sinh viên thuộc nhóm khác! ');
        }
//        else{            
//             $hoten = $req->txtTimKiem;
//            return view('sinhvien.ket-qua-tim-kiem-sv')->with('hoten',$hoten)->with('manth',$manth);
//        }            
        
    }
    
}
