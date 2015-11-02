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

class DetaiController extends Controller
{
/*====================== Mã đề tài tự tăng ====================================*/
    function madt_tutang(){
        $macuoi = DB::table('de_tai')->select('madt')->orderby('madt','desc')->lists('madt');
     //Lấy mã lớn nhất rồi ép kiểu về kiểu số nguyên và tăng 1   
        $i = 1;
        //return var_dump($macuoi);
        for($j = 0; $j < count($macuoi); $j++){
            if($i <= (int)$macuoi[$j]){
                $i = (int)$macuoi[$j];
            }
        }
        
        if(count($macuoi) > 0)
        {
            //$ma = $macuoi->madt;  //Lấy mã cuối cùng của nhóm thưc hiện
            return $i + 1;
        }      
    }
/*=========================== Lấy danh sách đề tài của 1 cán bộ =================================================*/
    public function DsDeTai(){
        $macb = \Auth::user()->taikhoan;
        $dsdt = DB::table('de_tai')->where('macb',$macb)->paginate(5);
    //Lấy năm và học kỳ hiện tại
        //Lấy học kỳ niên khóa sau cùng của 1 cán bộ
        $namcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.nam');
        $hkcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.hocky');
    //Mảng năm và học kỳ
        $namhoc = DB::table('nien_khoa')->distinct()->select('nam')
                ->get();
        $hocky = DB::table('nien_khoa')->distinct()->select('hocky')
                ->get();
        $nhomhp = DB::table('nhom_hocphan as hp')->distinct()
                ->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->get();
        $nhomth = DB::table('ra_de_tai as radt')->select('dt.tendt','radt.manhomthuchien')
                    ->rightjoin('de_tai as dt','radt.madt','=','dt.madt')
                    ->get();
        return view('giangvien.danh-sach-de-tai')->with('dsdt',$dsdt)->with('nhomhp',$nhomhp)
                    ->with('namhoc',$namhoc)->with('hocky',$hocky)->with('nhomth',$nhomth)
            ->with('namcb',$namcb)->with('hkcb',$hkcb);
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaDeTai($madt){
        $delete2 = DB::table('ra_de_tai')->where('madt',$madt)->delete();
        $delete = DB::table('de_tai')->where('madt',$madt)->delete();
        $tendt = DB::table('de_tai')->where('madt',$madt)->value('tendt');
        \Session::flash('ThongBao','Xóa '.$tendt.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('giangvien/danhsachdetai');
        }
    }
/*=========================== Thêm đề tài ==============================================*/ 
    public function ThemDeTai(){
        $macb = \Auth::user()->taikhoan;
        $ma = $this->madt_tutang();
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
//        $nhomhp = DB::table('nhom_hocphan as hp')->distinct()
//                ->select('hp.manhomhp','hp.tennhomhp')
//                ->join('giang_vien as gv','hp.macb','=','gv.macb')
//                ->where('hp.mank',$mank)
//                ->where('hp.macb',$macb)
//                ->get();
//                ->with('nhomhp',$nhomhp)
        return view('giangvien.them-de-tai')->with('ma',$ma)
            ->with('macb',$macb)->with('nam',$nam)->with('hk',$hk);
    } 
    
    public function LuuThemDeTai(Request $req){
        $macb = \Auth::user()->taikhoan;
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtTenDeTai'   => 'required',
                    'txtSoNguoi'    => 'numeric',
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {            
            $data1 = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'macb'          => $macb,
                    'tendt'         => $_POST['txtTenDeTai'],
                    'songuoitoida'  => $_POST['txtSoNguoi'],
                    'motadt'        => $_POST['txtMoTa'],
                    'congnghe'      => $_POST['txtCongNghe'],
                    'ghichudt'      => $_POST['txtGhiChu'],
                    'trangthai'     => $_POST['txtTrangThai'],
                    'ngaytao'       => Carbon::now(),
                );  
            $ch1 = DB::table('de_tai')->insert($data1);
            if($ch1 > 0){
                return redirect('giangvien/danhsachdetai');                
            }                      
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatDeTai($madt){
        $macb = \Auth::user()->taikhoan;
        $row = DB::table('de_tai')->where('madt',$madt)->first();
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
//        $nhomhp = DB::table('nhom_hocphan as hp')->distinct()
//                ->select('hp.manhomhp','hp.tennhomhp')
//                ->join('giang_vien as gv','hp.macb','=','gv.macb')
//                ->where('hp.mank',$mank)
//                ->where('hp.macb',$macb)
//                ->get();
//                ->with('nhomhp',$nhomhp)
        
        return view('giangvien.cap-nhat-de-tai')->with('dt',$row)->with('macb',$macb)
                    ->with('nam',$nam)->with('hk',$hk);
    } 
    
    public function LuuCapNhatDeTai(Request $req){
         $macb = \Auth::user()->taikhoan;
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtTenDeTai'   => 'required',
                    'txtSoNguoi'    => 'numeric',
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'macb'          => $macb,
                    'tendt'         => $_POST['txtTenDeTai'],
                    'songuoitoida'  => $_POST['txtSoNguoi'],
                    'motadt'        => $_POST['txtMoTa'],
                    'congnghe'      => $_POST['txtCongNghe'],
                    'ghichudt'      => $_POST['txtGhiChu'],
                    'trangthai'     => $_POST['rdTrangThai'],
                    'ngaysua'       => Carbon::now(),
            );
            $ch = DB::table('de_tai')->where('madt',$post['txtMaDeTai'])->update($data);            
            
//            if($ch > 0){
                return redirect('giangvien/danhsachdetai');
//            }
        }
    }
/*================= Upload tập tin mô tả đề tài ========================*/
    public function UploadMoTaDeTai(Request $req){
         $macb = \Auth::user()->taikhoan;
        $post = $req->all();
        $dt = DB::table('de_tai')->where('madt',$post['txtMaDT'])->first();
        $v = \Validator::make($req->all(),
                    [
                        'txtTenDeTai' => 'required',
                        'fTapTinKem'  => 'mimes:pdf,doc,docx,ppt,pptm'
                    ]
                );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
             $luuden = public_path() . '/mota_detai/';
             $taptin = Input::file('fTapTinKem');
             $tenbandau = $taptin->getClientOriginalName();
            if(count($dt) > 0){
                DB::table('de_tai')->where('madt',$post['txtMaDT'])->update(                    
                            [
                                'tendt'         => $_POST['txtTenDeTai'],
                                'taptindinhkem' => $tenbandau,
                                'ngaysua'       => Carbon::now()
                            ]
                        );
            }
            else if(count($dt) == 0){
                DB::table('de_tai')->insert(                    
                            [
                                'madt'          => $_POST['txtMaDT'],
                                'macb'          => $macb,
                                'tendt'         => $_POST['txtTenDeTai'],
                                'taptindinhkem' => $tenbandau,
                                'trangthai'     => "Chưa làm",
                                'ngaytao'       => Carbon::now()
                            ]
                        );
            }
            
            //Lưu tập tin vào thư mục /public/mota_detai
            $upload_file = $taptin->move($luuden, $tenbandau);
            // sending back with message
            Session::flash('success', 'Upload tập tin thành công!'); 
            
            if($upload_file && count($dt) == 0){                
                return redirect('giangvien/danhsachdetai/themdetai');
            }
            else if($upload_file && count($dt) > 0){
                 return redirect('giangvien/danhsachdetai/capnhatdetai/'.$post['txtMaDT']);
            }
        }
        
    }
        
        
}
/*
SELECT de_tai.tendt, ra_de_tai.manhomthuchien
from ra_de_tai 
right join de_tai on ra_de_tai.madt = de_tai.madt
 */