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

class DetaiController extends Controller
{
/*====================== Mã đề tài tự tăng ====================================*/
    function madt_tutang(){
        $macuoi = DB::table('de_tai')->orderby('madt','desc')->first();
        
        if(count($macuoi) > 0)
        {
            $ma = $macuoi->madt;  //Lấy mã cuối cùng của nhóm thưc hiện
            return $so = (int)$ma + 1;
        }      
    }
/*=========================== Lấy danh sách đề tài của 1 cán bộ =================================================*/
    public function DsDeTai($macb){
        $dsdt = DB::table('de_tai')->where('macb',$macb)->paginate(5);
        $namhoc = DB::table('nien_khoa')->distinct()->select('nam')
                ->get();
        $hocky = DB::table('nien_khoa')->distinct()->select('hocky')
                ->get();
        $nhomhp = DB::table('nhom_hocphan as hp')->distinct()
                ->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)->get();
        $nhomth = DB::table('ra_de_tai')->select('madt','manhomthuchien')
                    ->get();
        return view('giangvien.danh-sach-de-tai')->with('dsdt',$dsdt)->with('nhomhp',$nhomhp)
                    ->with('namhoc',$namhoc)->with('hocky',$hocky)->with('nhomth',$nhomth);
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaDeTai($madt){
        $delete = DB::table('de_tai')->where('madt',$madt)->delete();
        $tendt = DB::table('de_tai')->where('madt',$madt)->value('tendt');
        \Session::flash('ThongBao','Xóa '.$tendt.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('giangvien/danhsachdetai/2134');
        }
    }
/*=========================== Thêm đề tài ==============================================*/ 
    public function ThemDeTai($macb){
        $ma = $this->madt_tutang();
        $nhomhp = DB::table('nhom_hocphan as hp')->distinct()
                ->select('hp.manhomhp','hp.tennhomhp')
                ->join('giang_vien as gv','hp.macb','=','gv.macb')
                ->where('hp.macb',$macb)
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
        return view('giangvien.them-de-tai')->with('ma',$ma)->with('nhomhp',$nhomhp)
            ->with('macb',$macb)->with('namcb',$namcb)->with('hkcb',$hkcb);
    } 
    
    public function LuuThemDeTai(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtTenDeTai'   => 'required',
                    'txtSoNguoi'    => 'required|numeric'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data1 = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'macb'          => $_POST['txtMaCB'],
                    'tendt'         => $_POST['txtTenDeTai'],
                    'songuoitoida'  => $_POST['txtSoNguoi'],
                    'motadt'        => $_POST['txtMoTa'],
                    'congnghe'      => $_POST['txtCongNghe'],
                    'ghichudt'      => $_POST['txtGhiChu'],
                    'trangthai'     => $_POST['cbmTrangThai'],
                    'ngaytao'       => Carbon::now(),
                    //'taptindinhkem' => $_POST['ftTapTinKem']
                );  
            $ch1 = DB::table('de_tai')->insert($data1);
            if($ch1 > 0){
                return redirect('giangvien/danhsachdetai/2134');                
            }                      
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatDeTai($macb,$madt){
        $row = DB::table('de_tai')->where('madt',$madt)->first();
        //Lấy học kỳ niên khóa sau cùng của 1 cán bộ
        $namcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.nam');
        $hkcb = DB::table('nien_khoa as nk')->orderBy('nam','desc')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.hocky');
        return view('giangvien.cap-nhat-de-tai')->with('dt',$row)->with('macb',$macb)
                    ->with('namcb',$namcb)->with('hkcb',$hkcb);
    } 
    
    public function LuuCapNhatDeTai(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtTenDeTai'   => 'required',
                    'txtSoNguoi'    => 'required|numeric'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'madt'          => $_POST['txtMaDeTai'],
                    'macb'          => $_POST['txtMaCB'],
                    'tendt'         => $_POST['txtTenDeTai'],
                    'songuoitoida'  => $_POST['txtSoNguoi'],
                    'motadt'        => $_POST['txtMoTa'],
                    'congnghe'      => $_POST['txtCongNghe'],
                    'ghichudt'      => $_POST['txtGhiChu'],
                    'trangthai'     => $_POST['rdTrangThai'],
                    'ngaytao'       => Carbon::now(),
                    //'taptindinhkem' => $_POST['txtTapTinKem']
            );
            $ch = DB::table('de_tai')->where('madt',$post['txtMaDeTai'])->update($data);
            if($ch > 0){
                return redirect('giangvien/danhsachdetai/2134');
            }
        }
    }
    
}
