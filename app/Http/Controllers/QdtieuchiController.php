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

class QdtieuchiController extends Controller
{
/*====================== Mã tiêu chí tự tăng ====================================*/
    public function matc_tutang(){
//Lấy mã cuối cùng của nhóm thưc hiện
        $matc = DB::table('tieu_chi_danh_gia')->select('matc')->orderby('matc','desc')->lists('matc');
    //Lấy mã lớn nhất rồi ép kiểu về kiểu số nguyên và tăng 1    
        $i = 1;
        for($j = 0; $j < count($matc); $j++){
            if($i < (int)$matc[$j]){
                $i = (int)$matc[$j];
            }
        }
        if(count($matc)>0){  
            return $i + 1;
        }     
    }
/*====================== Lấy danh sách các tiêu chí đánh giá của 1 cán bộ ====================================*/
    public function DSTieuChi(){
        $macb = \Auth::user()->taikhoan;
        $ma = $this->matc_tutang();
        //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$namht)->where('hocky',$hkht)
                ->value('mank');
        //Lấy mảng các năm học và hoc kỳ
        $namhoc = DB::table('nien_khoa')->distinct()->select('nam')
                ->get();
        $hocky = DB::table('nien_khoa')->distinct()->select('hocky')
                ->get();
        //Lấy danh sách tiêu chí ở năm - hk hiện tại
        $dstc = DB::table('tieu_chi_danh_gia as dg')->distinct()
                ->select('dg.matc','dg.noidungtc','dg.heso','dg.ngaytao','qd.mank')
                ->join('quy_dinh as qd', 'dg.matc','=','qd.matc')
                ->where('qd.mank',$mank)
                ->where('qd.macb','=',$macb)
                ->get();
        
        return view('giangvien.quy-dinh-tieu-chi')->with('dstc',$dstc)->with('namhoc',$namhoc)
        ->with('hocky',$hocky)->with('ma',$ma)->with('hkht',$hkht)->with('namht',$namht);
    }
/*========= Xóa Tiêu chí đánh giá ==============*/    
    public function XoaTieuChi($matc){
        $macb = \Auth::user()->taikhoan;
        $Xoaqd = DB::table('quy_dinh')->where('matc',$matc)->delete();
        $Xoad = DB::table('chitiet_diem')->where('matc',$matc)->delete();
        $Xoatc = DB::table('tieu_chi_danh_gia')->where('matc',$matc)->delete();
        
        \Session::flash('ThongBaoXoa','Xóa thành công!');       
            
        return redirect('giangvien/dstieuchi');      
    }
/*========================= Thêm tiêu chí đánh giá ========================*/
    public function ThemTieuChi(){
        $macb = \Auth::user()->taikhoan;
        $ma = $this->matc_tutang();     
        //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');
        $mankht = DB::table('nien_khoa')->where('nam',$namht)->where('hocky',$hkht)
                ->value('mank');
        //Lấy danh sách tiêu chí ở năm trước đó của gv
        $dstc_cu = DB::table('tieu_chi_danh_gia as dg')->distinct()
                ->select('dg.matc','dg.noidungtc','dg.heso')
                ->join('quy_dinh as qd','dg.matc','=','qd.matc')
                ->where('qd.mank','<>',$mankht)
                ->where('qd.macb',$macb)
                ->get();
        
        return view('giangvien.them-tieu-chi')->with('ma',$ma)            
                    ->with('dstc_cu',$dstc_cu);
    }
/*========================= Lưu Thêm MỚI tiêu chí đánh giá ========================*/    
    public function LuuThemTieuChi(Request $req){
        $macb = \Auth::user()->taikhoan;
        $post = $req->all();
        //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$namht)->where('hocky',$hkht)
                ->value('mank');
        //Lấy ds mssv do 1 cán bộ dạy
        $dsmasv = DB::table('nhom_hocphan as hp')->select('chn.mssv')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('hp.macb',$post['txtMaCB'])
                ->where('hp.mank',$mank)
                ->lists('chn.mssv');
        $v = \Validator::make($req->all(),
                [
                    'txtMaTC'       => 'required',
                    'txtNoiDungTC'  => 'required',
                    'txtMucDiem'    => 'required|numeric|max:10' //Diểm không được lớn hơn 10
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {    //,DB::raw('SUM(dg.heso) as tong_heso')
            $diemTC = DB::table('tieu_chi_danh_gia as dg')->distinct()
                    ->select('dg.heso')
                    ->join('quy_dinh as qd','dg.matc','=','qd.matc')
                    ->join('nhom_hocphan as hp','qd.macb','=','hp.macb')
                    ->where('qd.macb',$macb)
                    ->where('hp.mank',$mank)
                    ->lists('dg.heso');
            $tongdiemTC = array_sum($diemTC) + $req->txtMucDiem;
            if($tongdiemTC > 10){
                \Session::flash('BaoLoi','Tổng hệ số điểm của các tiêu chí không được vượt quá 10.');
                return \Redirect::to('giangvien/dstieuchi');
            }
            else{
                $data1 = array(
                    'matc'       => $_POST['txtMaTC'],
                    'noidungtc'  => $_POST['txtNoiDungTC'],
                    'heso'       => $_POST['txtMucDiem'],
                    'ngaytao'    => Carbon::now()   
                );
                $data2 = array(
                        'macb'   => $macb,
                        'matc'   => $_POST['txtMaTC'],
                        'mank'   => $mank
                );

                $ch1 = DB::table('tieu_chi_danh_gia')->insert($data1);
                $ch2 = DB::table('quy_dinh')->insert($data2);
                for($i = 0; $i < count($dsmasv); $i++){
                    //echo $dsmasv[$i]."<br>";                
                    $ch3 = DB::table('chitiet_diem')->insert(
                            [   'matc' => $_POST['txtMaTC'],                          
                                'mssv' => $dsmasv[$i]
                            ]
                        );
                }
                return redirect('giangvien/dstieuchi');
            }        
        }
    }
/*========================= Lưu Thêm tiêu chí ĐÃ CÓ đánh giá ========================*/  
    public function LuuThemTCDaCo(Request $req){
        $macb = \Auth::user()->taikhoan;
        //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');
        $mank_ht = DB::table('nien_khoa')->where('nam',$namht)->where('hocky',$hkht)
                ->value('mank');
        //Lấy ds mssv do 1 cán bộ dạy
        $dsmasv = DB::table('nhom_hocphan as hp')->select('chn.mssv')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('hp.macb',$macb)
                ->where('hp.mank',$mank_ht)
                ->lists('chn.mssv');
        $v = \Validator::make($req->all(),
                [
                    'cbNoiDungTC' => 'required'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $matc_chon = $req->cbNoiDungTC;
            $ndtc = DB::table('tieu_chi_danh_gia')->where('matc',$matc_chon)->value('noidungtc');
            $hesotc = DB::table('tieu_chi_danh_gia')->where('matc',$matc_chon)->value('heso');
            $themtc = DB::table('tieu_chi_danh_gia')->where('matc',$matc_chon)->insert(
                        [
                            'matc'      => $_POST['txtMaTC'],
                            'noidungtc' => $ndtc,
                            'heso'      => $hesotc,
                            'ngaytao'   => Carbon::now()
                        ]                  
                    );
            $quydinh = DB::table('quy_dinh')->where('matc',$matc_chon)->insert(
                        [
                            'macb'      => $macb,
                            'matc'      => $_POST['txtMaTC'],
                            'mank'      => $mank_ht
                        ]                  
                    );
            for($i = 0; $i < count($dsmasv); $i++){
                    //echo $dsmasv[$i]."<br>";                
                    $ch3 = DB::table('chitiet_diem')->insert(
                            [   'matc' => $_POST['txtMaTC'],                          
                                'mssv' => $dsmasv[$i]
                            ]
                        );
            }
            return redirect('giangvien/dstieuchi');
        }
    }
    /*========================= Cập nhật tiêu chí đánh giá ========================*/
    public function CapNhatTieuChi($matc){
        $macb = \Auth::user()->taikhoan;
      //Hiển thị thông tin của 1 tiêu chí nào đó     
        $tc = DB::table('tieu_chi_danh_gia as dg')
                ->join('quy_dinh as qd', 'dg.matc','=','qd.matc')
                ->where('dg.matc','=',$matc)
                ->first();
        return view('giangvien.cap-nhat-tieu-chi')->with('tc',$tc);
    }
    public function LuuCapNhatTieuChi(Request $req){
        $macb = \Auth::user()->taikhoan;  
         //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$namht)->where('hocky',$hkht)
                ->value('mank');
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaTC'       => 'required',
                    'txtNoiDungTC'  => 'required',
                    'txtMucDiem'    => 'required|numeric|max:10'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {    
             $diemTC = DB::table('tieu_chi_danh_gia as dg')->distinct()
                    ->select('dg.heso')
                    ->join('quy_dinh as qd','dg.matc','=','qd.matc')
                    ->join('nhom_hocphan as hp','qd.macb','=','hp.macb')
                    ->where('qd.macb',$macb)
                    ->where('hp.mank',$mank)
                    ->where('dg.matc','<>',$req->txtMaTC)
                    ->lists('dg.heso');
            $tongdiemTC = array_sum($diemTC) + $req->txtMucDiem;
            if($tongdiemTC > 10){
                \Session::flash('BaoLoiCapNhat','Tổng hệ số điểm của các tiêu chí không được vượt quá 10.');               
                return \Redirect::to('giangvien/dstieuchi');
            }
            else{
                $data = array(
                    'noidungtc'  => $_POST['txtNoiDungTC'],
                    'heso'       => $_POST['txtMucDiem'],
                    'ngaytao'    => Carbon::now()   
                );
                $ch = DB::table('tieu_chi_danh_gia')->where('matc', $post['txtMaTC'])->update($data);
              //  if($ch > 0){
                    return redirect('giangvien/dstieuchi');
              //  }
            }
            
        }
    }
}

/*
 * select DISTINCT tieu_chi_danh_gia.matc, tieu_chi_danh_gia.noidungtc
FROM tieu_chi_danh_gia
join quy_dinh on tieu_chi_danh_gia.matc = quy_dinh.matc
join nhom_hocphan ON quy_dinh.macb = nhom_hocphan.macb
where quy_dinh.macb = '2134' AND nhom_hocphan.mank = 5
 */