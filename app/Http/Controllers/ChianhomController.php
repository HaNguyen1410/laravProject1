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
use App\Http\Controllers\Auth;

class ChianhomController extends Controller
{
/*======================== IN Danh sách sinh viên ==================================*/    
    public function InDanhSachDeTaiNhom($mahp,$macb){
        $nguoiin = DB::table('giang_vien')->where('macb',$macb)->value('hoten');
        //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');        
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$namht)->where('nk.hocky',$hkht)
                ->value('nk.mank');
        $mahp = \Request::segment(3);
        if($mahp != null){
            $gv_hp = DB::table('nhom_hocphan as hp')->select('gv.macb','gv.hoten','hp.tennhomhp')
                    ->join('giang_vien as gv','gv.macb','=','hp.macb')
                    ->where('hp.manhomhp',$mahp)                    
                    ->first();
            $dssv = DB::table('sinh_vien as sv')
                    ->leftjoin('chia_nhom as chn','sv.mssv','=','chn.mssv')
                    ->leftjoin('ra_de_tai as radt','chn.manhomthuchien','=','radt.manhomthuchien')
                    ->leftjoin('de_tai as dt','radt.madt','=','dt.madt')
                    ->where('chn.manhomhp',$mahp)
                    ->orderBy('chn.manhomthuchien','asc')
                    ->get();
        }
        $view = \View::make('giangvien.in-danh-sach-de-tai-nhom',
                compact('macb','nguoiin','namht','hkht','gv_hp','dssv'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('landscape');
       
        return $pdf->stream("DanhSachDeTaiNhom.pdf");
    }    
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
/* ============== Lấy nhóm HP ============== */
    public function LayNhomHP(){
        $ma = Input::get('cbNhomHP');
        return redirect('giangvien/chianhom/'.$ma);
    }
/*====================  ======================*/
    public function ChiaNhomNL(){
        $macb = \Auth::user()->taikhoan;
        //Nếu selectbox có giá trị manhp thì lấy manhp
 
        //Lấy học kỳ niên khóa sau cùng của 1 cán bộ
        $namcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.nam');
        $hkcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.hocky');
    //Lấy giá trị một đoạn của chuỗi url
        $var = \Request::segment(3);
        if($var == null){
            //Lấy mã nhóm HP của năm hiện tại mà cán bộ phụ trách
            $mahp = DB::table('nhom_hocphan as hp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('hp.macb',$macb)
                ->where('nk.nam',$namcb)->where('nk.hocky',$hkcb)
                ->orderBy('hp.manhomhp','asc')
                ->value('hp.manhomhp');
        }
        else $mahp = $var;
        
        $dsmahp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->get();
        //Lấy những sinh viên chưa có nhóm thực hiện niên luận
        $dstensv = DB::table('chia_nhom as chn')->distinct()
                ->select('chn.mssv','sv.hoten','chn.nhomtruong')
                ->join('sinh_vien as sv','chn.mssv','=','sv.mssv')
                ->where('chn.manhomhp','=',$mahp)
                ->where('chn.manhomthuchien','=',"")
                ->get();         
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
        //Lấy tên đề tài của các nhóm trong hoc kỳ niên khóa của cán bộ đang dạy
        $detainhom = DB::table('de_tai as dt')->distinct()->orderBy('chn.manhomthuchien','asc')
                ->select('dt.tendt','dt.taptindinhkem','chn.manhomthuchien','hp.tennhomhp')
                ->join('ra_de_tai as radt','dt.madt','=','radt.madt')
                ->join('chia_nhom as chn','radt.manhomthuchien','=','chn.manhomthuchien')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('dt.macb',$macb)
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
            ->with('manth',$manth)->with('mahp',$mahp);           
    }
/*==================== Lưu chia nhóm thành viên ======================*/
    public function LuuChiaNhomNL(Request $req){
        $manth = $this->manth_tutang();
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'cbDeTai'          =>'required',
                    'txtNgayBatDauKH'  =>'required|date',
                    'txtNgayKetThucKH' =>'required|date',
                    'txtSoTuanKH'      =>'required|numeric', 
                    'chkThanhVien'     =>'required',
//                  'rdNhomTruong'     =>'sometimes|required'
                ]
        );       
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $masv_checked = Input::get('chkThanhVien'); //trả về 1 mảng mssv 
//            return var_dump($masv_checked);
                // has -> true nếu giá trị hiện tại có giá trị và không rỗng          
//           return $masv_checked.$nhomtruong;                
//           return count($masv_checked); 
            
            /*******Xem lại khi check một lần không reset trình duyệt thì nó lấy 2 check -> Input::has
             * Khi không có value
             *              
            $nhomtruong = $req->has('rdNhomTruong') == FALSE ? 1 : 0; 
             $nhomtruong = isset($_POST['rdNhomTruong']) ? 1 : 0; 
            return var_dump(Input::get('rdNhomTruong'));             * 
             */
            $nhomtruong = Input::get('rdNhomTruong');   
            $check_ntruong = implode('',$nhomtruong);
            
            for($i = 0; $i < count($masv_checked); $i++){
                if($check_ntruong == $masv_checked[$i]){
                    $ch = DB::table('chia_nhom')->where('mssv',$nhomtruong)
                            ->update([                        
                                    'manhomthuchien' => $manth,
                                    'nhomtruong'     => 1
                                ]);  
                }
                else if($nhomtruong != $masv_checked[$i]){
                    $ch = DB::table('chia_nhom')->where('mssv','<>',$check_ntruong)->whereIn('mssv',$masv_checked)
                            ->update([                        
                                    'manhomthuchien' => $manth,
                                    'nhomtruong'     => 0
                                ]); 
                }                
            }                       
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
                            'sotuan_kehoach'      => $_POST['txtSoTuanKH'],
                            'ngaytao'             => Carbon::now()
                        ]
                    );
               
             return redirect('giangvien/chianhom');            
        }
    }
/*====================== Xóa sinh viên ra khỏi nhóm =======================*/
    public function XoaSVTrongNhom($mssv){
        $macb = \Auth::user()->taikhoan;
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
        
        return redirect('giangvien/chianhom');         
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