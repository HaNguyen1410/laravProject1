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
        $dsmahp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->get();
        $mahp = DB::table('nhom_hocphan as hp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->value('manhomhp');
        //Lấy những sinh viên chưa có nhóm thực hiện niên luận
        $dstensv = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.mssv','sv.hoten')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('chn.manhomhp','=',$mahp)
                ->where('chn.manhomthuchien','=',"")
                ->get(); 
        //Lấy học kỳ niên khóa sau cùng của 1 cán bộ
        $namcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.nam');
        $hkcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.hocky');
        //Lấy ds nhóm của học kỳ niên khóa hiện tại mà cán bộ đang dạy
        $dsNhom = DB::table('sinh_vien as sv')->distinct()
                ->select('chn.manhomthuchien','sv.mssv','sv.hoten','chn.nhomtruong')
                ->orderby('chn.manhomthuchien','asc')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('chn.manhomthuchien','<>',"")
                ->where('nk.nam',$namcb)
                ->where('nk.hocky',$hkcb)
                ->get();      
        //Lấy tên đề tài của các nhóm trong hoc kỳ niên khóa hiện tại
        $detainhom = DB::table('de_tai as dt')->distinct()
                ->select('dt.tendt','chn.manhomthuchien')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('dt.macb',$macb)
                ->where('nk.nam',$namcb)
                ->where('nk.hocky',$hkcb)
                ->where('chn.manhomthuchien','<>',"")
                ->get();
        //Lấy madt, tendt của 1 cán bộ
        $dsdetai = DB::table('de_tai as dt')->distinct()
                ->select('dt.madt','dt.tendt')
                ->join('nhom_hocphan as hp','dt.macb','=','hp.macb')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('dt.macb',$macb)
                ->where('nk.nam',$namcb)
                ->where('nk.hocky',$hkcb)
                ->get();
        return view('giangvien.chia-nhom-nien-luan')->with('dstensv',$dstensv)->with('dsmahp',$dsmahp)
            ->with('dsdetai',$dsdetai)->with('dsNhom',$dsNhom)->with('detainhom',$detainhom)
                ->with('namcb',$namcb)->with('hkcb',$hkcb);           
    }
/*==================== Lưu chia nhóm thành viên ======================*/
    public function LuuChiaNhomNL(Request $req){
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
//                    $ch = DB::table('dangky_nhom')->whereIn('mssv')
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