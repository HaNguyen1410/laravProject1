<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Giangvien;
use DB;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session;
use Carbon\Carbon;

class QuantriController extends Controller
{
 /*====================== Mã Giảng viên tự tăng ====================================*/
    public function macb_tutang(){
//Lấy mã cuối cùng của nhóm thưc hiện
        $macuoi = DB::table('giang_vien')->orderby('macb','desc')->first();
        
        if(count($macuoi)>0){
            $ma = $macuoi->macb;  
            return $so = (int)$ma + 1;
        }     
    }   
 /*====================== Mã Sinh viên tự tăng ====================================*/
    public function masv_tutang(){
//Lấy mã cuối cùng của nhóm thưc hiện
        $macuoi = DB::table('sinh_vien')->orderby('mssv','desc')->first();
        
        if(count($macuoi)>0){
            $ma = $macuoi->mssv;  
            return $so = (int)$ma + 1;
        }     
    }   
 /*====================== Sao lưu phục hồi CSDL ====================================*/
    public function SaoLuuCSDL(){
        
        return view('quantri.sao-luu-phuc-hoi-du-lieu');
    }
    /******************
 * ######## Quản trị Giảng Viên  ###########
 * *****************
 */
/*=========================== Thông tin quản trị viên ==============================================*/ 
    public function ThongTinQT($macb){
        $giangvien = Giangvien::find($macb);
        $tennhomhp = DB::table('giang_vien as gv')
                ->join('nhom_hocphan as hp','gv.macb','=','hp.macb')
                ->value('tennhomhp');
        return view('quantri.thong-tin-quan-tri-vien')->with('gv',$giangvien)->with('hp',$tennhomhp);
    }
 /*=========================== Đổi mật khẩu ==============================================*/   
    public function DoiMatKhauQT($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        return view('quantri.doi-mat-khau-qt')->with('gv', $row);
    } 
    public function LuuDoiMatKhauQT(Request $req){        
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
//                    'txtMaCB'      => 'required',
//                    'txtHoTen'     => 'required',
//                    'txtEmail'     => 'required',
                    'txtMatKhauCu' => 'required',
                    'txtMatKhauMoi1'  => 'required',
                    'txtMatKhauMoi2'  => 'required'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $hinhdaidien = DB::table('giang_vien')->where('macb','$post([txaCB])')->value('hinhdaidien');
            
            $data = array(
                    'hinhdaidien'   => ($_POST['fHinh'] != "") ? $_POST['fHinh'] : $hinhdaidien,
                    'matkhau'       => $_POST['txtMatKhau1']
            );
            $ch = DB::table('giang_vien')->where('macb',$post(['txtMaCB']))->update($data);
            if($ch > 0){
                return redirect('quantri/thongtinqt/9876');
            }
        }
    }
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachGV(){
        $gv = DB::table('giang_vien')->get();
        $n = count($gv);
        $ds = DB::table('giang_vien as gv')->skip($n)->take(5)->paginate(5);
        //Lấy danh sách năm học năm lớn nhất ở trên cùng
        $namhoc = DB::table('nien_khoa as nk')->distinct()->select('nam')->orderBy('nam','desc')->get(); 
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hocky = DB::table('nien_khoa')->select('hocky')->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->get();        
        //Lấy danh sách nhóm học phần mà mỗi giảng viên phụ trách
        $gv_hp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp','hp.macb','nk.nam','nk.hocky')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->get();
        return view('quantri.quan-tri-giang-vien')->with('dsgv',$ds)
            ->with('namhoc',$namhoc)->with('hocky',$hocky)->with('gv_hp',$gv_hp);
    }
/*=========================== Thêm giảng viên ==============================================*/ 
    public function ThemGV(){
        $ma = $this->macb_tutang();
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
        //Lấy ds nhóm học phần chưa có GV nào phụ trách giảng dạy
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->where('hp.macb','=',"")
                ->get();       
        return view('quantri.them-giang-vien',['ma' => $ma])->with('dshp',$dshp)
                ->with('nam',$nam)->with('hk',$hk)->with('mank',$mank);
    }   

    public function LuuThemGV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaCB'     => 'required',
                    'txtHoTen'    => 'required|max:255',
                    'rdGioiTinh'  => 'required',
                    'txtNgaySinh' => 'required|date',
                    'txtEmail'    => 'required|email|max:255',
                    'txtSDT'      => 'required|numeric|min:10',
                    'chkNhomHP'   => 'required',
                    'txtMatKhau1' => 'required|min:6',
                    'txtMatKhau2' => 'required|min:6|same:txtMatKhau1'                    
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data1 = array(
                    'macb'      => $_POST['txtMaCB'],
                    'hoten'     => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh'  => $_POST['txtNgaySinh'],
                    'email'     => $_POST['txtEmail'],
                    'sdt'       => $_POST['txtSDT'],
                    'matkhau'   => md5($_POST['txtMatKhau1']),
                    'ngaytao'   => Carbon::now() 
            );            
            $ch1 = DB::table('giang_vien')->insert($data1);
            //Lấy mảng manhomhp khi đã chon checkbox
            $nhomhp_checked = Input::get('chkNhomHP');
            $ch2 = DB::table('nhom_hocphan')->whereIn('manhomhp',$nhomhp_checked)->update(
                        [
                           'macb' => $_POST['txtMaCB']
                        ]
                   );
            
            return redirect('quantri/danhsachgv');           
        }
    }
/*=========================== Sửa thông tin Giảng viên ==============================================*/ 
    public function CapNhatGV($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
        //Lấy ds nhóm học phần chưa có GV nào phụ trách giảng dạy
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->where('hp.macb','=',"")
                ->get();  
        return view('quantri.cap-nhat-giang-vien')->with('gv',$row)->with('dshp',$dshp)
                ->with('nam',$nam)->with('hk',$hk)->with('mank',$mank);
    } 
    
    public function LuuCapNhatGV(Request $req){
        $post = $req->all();       
        $v = \Validator::make($req->all(),
                [
                    'txtMaCB'           => 'required',
                    'txtHoTen'          => 'required',
                    'txtNgaySinh'       => 'required|date',
                    'txtEmail'          => 'required|email',
                    'txtSDT'            => 'required|numeric|min:10',
                    //md5('txtMatKhauCu') => 'required|confirmed',
                    'txtMatKhauCu'      => 'required',
                    'txtMatKhauMoi1'    => 'required|min:6|different:txtMatKhauCu',
                    'txtMatKhauMoi2'    => 'required|min:6|same:txtMatKhauMoi1',
                    'ngaytao'           => Carbon::now()
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'macb'      => $_POST['txtMaCB'],
                    'hoten'     => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh'  => $_POST['txtNgaySinh'],
                    'email'     => $_POST['txtEmail'],
                    'sdt'       => $_POST['txtSDT'],
                    'matkhau'   => md5($_POST['txtMatKhauMoi1']),
                    'khoa'      => isset($_POST['ckbKhoa']) ? 0 : 1 ,
                    'quantri'   => isset($_POST['ckbQuanTri']) ? 1 : 0
            );
            $ch = DB::table('giang_vien')->where('macb',$post['txtMaCB'])->update($data);
            //Lấy mảng giá trị kho chọn nhiều checkbox Nhóm HP
            $nhomhp_checked = Input::get('chkNhomHP');
            $ch2 = DB::table('nhom_hocphan')->whereIn('manhomhp',$nhomhp_checked)
                    ->update(['macb' => $_POST['txtMaCB']]);
            return redirect('quantri/danhsachgv');
           
        }
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaGV($macb){
        $delete = DB::table('giang_vien')->where('macb',$macb)->delete();
        $tencb = DB::table('giang_vien')->where('macb',$macb)->value('hoten');
        \Session::flash('ThongBao','Xóa '.$tencb.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('quantri/danhsachgv');
        }
    }
/*=========================== Xóa Giảng viên Khỏi NHÓM HP ==============================================*/ 
    public function RutGVTrongHP($mahp){
        $reject = DB::table('nhom_hocphan')->where('manhomhp',$mahp)->update(['macb'=>""]);
        \Session::flash('ThongBaoRut','Xóa thành công!');
        
         return redirect('quantri/danhsachgv');
        
    }
/*********************
 * ########## Quản trị Sinh Viên #############
 * *******************
 */
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachSV(){
        $ds = DB::table('sinh_vien as sv')
                ->select('sv.mssv','sv.hoten','sv.ngaysinh','sv.khoahoc','sv.ngaytao','sv.email','sv.khoa','hp.tennhomhp',
                        'chn.manhomthuchien','chn.nhomtruong')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->paginate(5);
        $namhoc = DB::table('nien_khoa as nk')->distinct()->select('nam')->orderBy('nam','desc')->get();
        $hocky = DB::table('nien_khoa as nk')->distinct()->select('hocky')->get(); 
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->get();   
        return view('quantri.quan-tri-sinh-vien')->with('dssv',$ds)->with('namhoc',$namhoc)
                ->with('hocky',$hocky)->with('dshp',$dshp);
    }  
/*=========================== Thêm sinh viên ==============================================*/ 
    public function ThemSV(){
        $ma = $this->masv_tutang();
        //Lấy năm học và học kỳ hiện tại
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->get();  
        return view('quantri.them-sinh-vien')->with('ma',$ma)->with('dshp',$dshp)
            ->with('nam',$nam)->with('hk',$hk)->with('mank',$mank);
    } 
    
    public function LuuThemSV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaSV'     => 'required',
                    'txtHoTen'    => 'required',
                    'rdGioiTinh'  => 'required',
                    'txtNgaySinh' => 'required|date',
                    'txtEmail'    => 'required|email',
                    'txtKhoaHoc'  => 'required',
                    'txtMatKhau1' => 'required|min:6',
                    'txtMatKhau2' => 'required|min:6|same:txtMatKhau1'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'mssv'     => $_POST['txtMaSV'],
                    'hoten'    => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh' => $_POST['txtNgaySinh'],
                    'email'    => $_POST['txtEmail'],
                    'khoahoc'  => $_POST['txtKhoaHoc'],
                    'matkhau' => md5($_POST['txtMatKhau1']),
                    'ngaytao'   => Carbon::now()
            );
            $ch = DB::table('sinh_vien')->insert($data);            
            $ch2 = DB::table('chia_nhom')->insert(
                        [
                            'mssv'=>$_POST['txtMaSV'],
                            'manhomhp'=>$_POST['rdNhomHP'],
                            'manhomthuchien' => "",
                            'nhomtruong'=>0
                        ]
                    );
            
           return redirect('quantri/danhsachsv');
           
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatSV($masv){
        $row = DB::table('sinh_vien')->where('mssv',$masv)->first();
        //Lấy năm học và học kỳ hiện tại
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->get();  
        $sv_hp = DB::table('chia_nhom')->where('mssv',$masv)->value('manhomhp');
        return view('quantri.cap-nhat-sinh-vien')->with('sv',$row)->with('dshp',$dshp)
            ->with('nam',$nam)->with('hk',$hk)->with('mank',$mank)->with('sv_hp',$sv_hp);
    } 
    
    public function LuuCapNhatSV(Request $req){
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'txtMaSV'           => 'required',
                    'txtHoTen'          => 'required',
                    'txtNgaySinh'       => 'required|date',
                    'txtEmail'          => 'required|email',
                    'txtKhoaHoc'        => 'required',
                    'rdNhomHP'          => 'required',
                    'txtMatKhauCu'      => 'required',
                    'txtMatKhauMoi1'    => 'required|min:6|different:txtMatKhauCu',
                    'txtMatKhauMoi2'    => 'required|min:6|same:txtMatKhauMoi1'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $data = array(
                    'mssv'      => $_POST['txtMaSV'],
                    'hoten'     => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh'  => $_POST['txtNgaySinh'],
                    'email'     => $_POST['txtEmail'],
                    'khoahoc'   => $_POST['txtKhoaHoc'],
                    'matkhau'   => md5($_POST['txtMatKhauMoi1']),
                    'khoa'      => isset($_POST['ckbKhoa']) ? 0 : 1,
                    'ngaytao'   => Carbon::now()
            );
            $ch = DB::table('sinh_vien')->where('mssv',$post['txtMaSV'])->update($data);
            $nhomhp = Input::has('rdNhomHP') == TRUE ? : $_POST['rdNhomHP']; 
            $ch2 = DB::table('chia_nhom')->where('mssv',$post['txtMaSV'])->update(
                        [
                            'manhomhp' => $nhomhp,
                        ]
                    );
            return redirect('quantri/danhsachsv');
           
        }
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaSV($masv){
        $delete = DB::table('sinh_vien')->where('mssv',$masv)->delete();
        $tensv = DB::table('sinh_vien')->where('mssv',$masv)->value('hoten');
        \Session::flash('ThongBao','Xóa '.$tensv.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('quantri/danhsachsv');
        }
    }
    
}// END Class QuantriController
