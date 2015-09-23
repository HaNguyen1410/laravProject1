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

class ChianhomController extends Controller
{
 /*====================== Mã nhóm thực hiện tự tăng ====================================*/
    function manth_tutang(){
        $pre = "NTH";
        $macuoi = DB::table('nhom_thuc_hien')->orderby('manhomthuchien','desc')->first();
        if(count($macuoi) == 0){
            return $mamoi = "NTH01";
        }
        else if(count($macuoi) > 0){
            $ma = $macuoi->manhomthuchien;  //Lấy mã cuối cùng của nhóm thưc hiện
            $so = (int)substr($ma, 3) + 1;
            if($so <= 9){
                $pre .="0";
               return  $mamoi = $pre .=$so;
            }
            else 
                return  $mamoi = $pre .=$so;   
        } 
    }   
/*====================  ======================*/
    public function ChiaNhomNL($macb,Request $req){
        //Nếu selectbox có giá trị manhp thì lấy manhp
        //$mahp = $req->cbNhomHP;
        $mahp = $req->cbNhomHP;
        $dsmahp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->get();
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
                ->where('hp.manhomhp',$mahp)
                ->where('nk.nam',$namcb)
                ->where('nk.hocky',$hkcb)
                ->get();      
        //Lấy tên đề tài của các nhóm trong hoc kỳ niên khóa hiện tại
        $detainhom = DB::table('de_tai as dt')->distinct()->orderBy('chn.manhomthuchien','asc')
                ->select('dt.tendt','dt.taptindinhkem','chn.manhomthuchien')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('dt.macb',$macb)
                ->where('hp.manhomhp',$mahp)
                ->where('nk.nam',$namcb)
                ->where('nk.hocky',$hkcb)
                ->where('chn.manhomthuchien','<>',"")
                ->get();
        //Lấy mã đề tài trong bảng ra_de_tai
        $madt = DB::table('ra_de_tai')->select('madt')->lists('madt');     
        //Lấy madt, tendt của 1 cán bộ mà chưa có nhóm nào thực hiện, ở bất cứ năm học, học kỳ nào
        $dsdetai = DB::table('de_tai')->distinct()
                ->select('madt','tendt','taptindinhkem')
                ->where('macb',$macb)
                ->whereNotIn('madt',$madt)
                ->get();
        $manth = $this->manth_tutang();
        return view('giangvien.chia-nhom-nien-luan')->with('dstensv',$dstensv)->with('dsmahp',$dsmahp)
            ->with('dsdetai',$dsdetai)->with('dsNhom',$dsNhom)->with('detainhom',$detainhom)
                ->with('namcb',$namcb)->with('hkcb',$hkcb)->with('macb',$macb)
            ->with('manth',$manth);           
    }
/*==================== Lưu chia nhóm thành viên ======================*/
    public function LuuChiaNhomNL(Request $req){
        $manth = $this->manth_tutang();
        $post = $req->all();
//        $v = \Validator::make($req->all(),
//                [
//                    'cbDeTai'          =>'required',
//                    'txtNgayBatDauKH'  =>'required|date',
//                    'txtNgayKetThucKH' =>'required|date',
//                    'chk'              =>'required',
//                    //'rdNhomTruong'  =>'required'
//                ]
//        );
//        if($v->fails()){
//            return redirect()->back()->withErrors($v->errors());
//        }
//        else
        {
            $masv_checked = Input::get('chk'); //trả về 1 mảng mssv 
                // has -> true nếu giá trị hiện tại có giá trị và không rỗng
            
            /*******Xem lại khi check một lần không reset trình duyệt thì nó lấy 2 check -> Input::has*/
            //$nhomtruong = Input::has('rdNhomTruong') == TRUE ? 0 : 1; 
            $nhomtruong = isset($_POST['rdNhomTruong']) == null ? 0 : 1; 
//            return $masv_checked.$nhomtruong;
//              return count($masv_checked);               
            $ch = DB::table('chia_nhom')->whereIn('mssv',$masv_checked)
                            ->update([                        
                                    'manhomthuchien'=>$manth,
                                    'nhomtruong'=>$nhomtruong
                               ]);
            $ch2 = DB::table('ra_de_tai')->insert(
                    [
                        'madt'           => $_POST['cbDeTai'],
                        'manhomthuchien' => $manth
                    ]
                );
            $ch3 = DB::table('nhom_thuc_hien')->insert(
                        [                            
                            'manhomthuchien'      => $manth,
                            'ngaybatdau_kehoach'  => $_POST['txtNgayBatDauKH'],
                            'ngayketthuc_kehoach' => $_POST['txtNgayKetThucKH'],
                            'ngaytao'             => Carbon::now()
                        ]
                    );
               
             return redirect('giangvien/chianhom/2134');            
        }
    }
/*====================== Xóa sinh viên ra khỏi nhóm =======================*/
    public function XoaSVTrongNhom($macb,$mssv){
        $manth = DB::Table('nhom_thuc_hien as nth')
                ->join('chia_nhom as chn','nth.manhomthuchien','=','chn.manhomthuchien')
                ->where('chn.mssv',$mssv)
                ->value('chn.manhomthuchien');
        
        DB::table('chia_nhom')->where('mssv',$mssv)->update(
                    [
                        'manhomthuchien' => " ",
                        'nhomtruong' => 0
                    ]
                );        
        
        $nhomsv = DB::Table('chia_nhom')->select('mssv')                
                ->where('manhomthuchien',$manth)
                ->get();        
        
        if(count($nhomsv) == 0){
            DB::table('nhom_thuc_hien')->where('manhomthuchien',$manth)->delete();
            DB::table('ra_de_tai')->where('manhomthuchien',$manth)->delete();
        }
        
        $tensv = DB::table('sinh_vien')->where('mssv',$mssv)->value('hoten');
        \Session::flash('ThongBao','Xóa --'.$tensv.'-- thành công!');
        
        return redirect('giangvien/chianhom/'.$macb);         
    }

    
}//END Class DangkydtController
 
/*
 * 
 * //Lấy madt, tendt của 1 cán bộ
        $dsdetai = DB::table('de_tai as dt')->distinct()
                ->select('dt.madt','dt.tendt')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('nhom_hocphan as hp','dt.macb','=','hp.macb')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('dt.macb',$macb)
                ->where('nk.nam',$namcb)->where('nk.hocky',$hkcb)
                ->whereNotIn('dt.madt',$madt)
                ->get();
 * 
 */