<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Console\Command;
use App\Config\database;
use Illuminate\Support\Facades\File;
use DB;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session,
    Artisan,
    Hash,
    PDF;
use Carbon\Carbon;
use App\Commands;
use App\Giangvien;
use App\Sinhvien;
use App\User;
use App\Http\Controllers\Auth;

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
/*====================== SAO LƯU CSDL ====================================*/
    public function SaoLuuCSDL(Request $req){
            $host = \Config::get('database.connections.mysql.host');
            $database = \Config::get('database.connections.mysql.database');
            $username = \Config::get('database.connections.mysql.username');
    //        $password = \Config::get('database.connections.mysql.password');
            $backupPath = storage_path() . "\dumps\\";
            if($_POST['txtTenCSDL'] == null){
                $backupFileName = date("Y-m-d_H-i-s") . '.sql';
            }
            else if($_POST['txtTenCSDL'] != null){
                $gv = new GiangvienController();
                $tenkhongdau = $gv->bo_dau_cau($req->txtTenCSDL);
            //Loại bỏ các khoảng trắng trong tên nhập vào từ Input (textbox) 
            //vì tên file có khoảng trắng thì lệnh không thực thi được  
                $tenfile = str_replace(" ", "", $tenkhongdau);                
                $backupFileName = $tenfile . "_" . date("Y-m-d_H-i-s") . '.sql';    
            }
        //Đường dẫn chạy mysqldump trong xampp của MySQL.
            $path = "C:\\xampp\mysql\bin\mysqldump"; 
        //without password
            $command = $path . " -h " .$host. " -u " .$username. " " .$database." > " .$backupPath . $backupFileName;
            system($command); 
        /*Cách 2 để chạy lệnh sao lưu CSDL
            exec($path . " -h " .$host. " -u " .$username. " " .$database." > " .$backupPath . $backupFileName);
        */
        /* Cách 3 để chạy lệnh sao lưu dùng Artian
                $exitCode = Artisan::call('db:backup'); Không lấy được tên file cscl đã lưu để đưa ra view
         */        
        
        return view('quantri.sao-luu-du-lieu')->with('saoluu',0)
            ->with('tenfile',$backupFileName);                    
    }
/*====================== PHỤC HỒI CSDL ====================================*/
    public function PhucHoiCSDL(Request $req){
            $host = \Config::get('database.connections.mysql.host');
            $database = \Config::get('database.connections.mysql.database');
            $username = \Config::get('database.connections.mysql.username');
    //        $password = \Config::get('database.connections.mysql.password');
        $v = \Validator::make($req->all(),
                    [
                        'fTenCSDL' => 'required' // 
                    ]
        );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }        
        else
        {                    
            $tenfile = Input::file('fTenCSDL');            
//            $backupPath = base_path();
//            $backupPath = pathinfo($tenfile->getRealPath(),PATHINFO_DIRNAME);
//            $backupPath = $tenfile->getPathName();
            $pathToFile = storage_path() . "\phuchoicsdl\\";"";
            $tenfile_dachon = Input::file('fTenCSDL')->getClientOriginalName();
            
            $extension = Input::file('fTenCSDL')->getClientOriginalExtension();
        //Đưa file vừa upload vào thư mục storage/phuhoicsdl
            $luuden = storage_path() . '/phuchoicsdl/';    
            $upload_success = $tenfile->move($luuden, $tenfile_dachon);
        //Kiểm tra file upload lên có phải là đuôi .sql không    
            if($extension != "sql"){
                \Session::flash('ThongBao','Vui lòng chọn file có đuôi .sql !');
                return Redirect::to('quantri/phuchoi');
            }
            else{
                //Đường dẫn chạy mysql trong xampp của MySQL.
                $path = "C:\\xampp\mysql\bin\mysql"; 
                /* Cách 1:
                 * $command = $path . " -h " .$host. " -u " .$username. " " .$database." < " .$backupPath. $tenfile_dachon;
                 * $command2 = $path . " -h " .$host. " -u " .$username." -p ".$password." " .$database." < " .$backupPath. $tenfile_dachon
                 * system($command);
                 * 
                 *   ->with('backupPath',$backupPath)->with('command',$command)
                 */
            //without password
                $command = $path . " -h " .$host. " -u " .$username. " " .$database." < " .$pathToFile. $tenfile_dachon;
                $kq = exec($path . " -h " .$host. " -u " .$username. " " .$database." < " .$pathToFile. $tenfile_dachon);
                
                $pathfile = $luuden.$tenfile_dachon;
                File::delete($pathfile);
                return view('quantri.phuc-hoi-du-lieu')->with('phuchoi',0)
                        ->with('kq',$kq)->with('command',$command);
            }        
        }      
    }
/******************
 * ######## Quản trị Giảng Viên  ###########
 * *****************
 */
/*=========================== Thông tin quản trị viên ==============================================*/ 
    public function ThongTinQT(){
        $macb = \Auth::user()->taikhoan;
        $giangvien = Giangvien::find($macb);
        $tennhomhp = DB::table('giang_vien as gv')
                ->join('nhom_hocphan as hp','gv.macb','=','hp.macb')
                ->value('tennhomhp');
        return view('quantri.thong-tin-quan-tri-vien')->with('gv',$giangvien)->with('hp',$tennhomhp);
    }
 /*=========================== Đổi mật khẩu ==============================================*/   
    public function DoiMatKhauQT(){
        $macb = \Auth::user()->taikhoan;
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
            $mk = Hash::make($_POST['txtMatKhauMoi1']);
            $ch = DB::table('giang_vien')->where('macb',$post['txtMaCB'])
                    ->update(['matkhau' => $mk]);
   //Lưu cập nhật mật khẩu vào bảng Users        
            $idqt = DB::table('users')->where('taikhoan',$post['txtMaCB'])->value('id');
            $thanhvien = User::find($idqt);
            $thanhvien->password = $mk;
            $thanhvien->save();
                        
            if($ch > 0){
                return redirect('quantri/thongtinqt');
            }
        }
    }
/*=============================== (UPLOAD hình) Đổi hình đại diện ===============================*/
    public function DoiHinhDaiDienQT(Request $req){
        $macb = \Auth::user()->taikhoan;
        $hoten = DB::table('giang_vien')->where('macb',$macb)->value('hoten');
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'fHinh' => 'required|image'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }else{
             // Đặt đường dẫn lưu file upload
            $luuden = public_path(). '/hinhdaidien/';
            // Lấy đuôi mở rộng        
    //           $extension = Input::file('fHinh')->getClientOriginalExtension();
            //Gắn đuôi mở rộng lúc nào cũng là png
            $extension = "png";
            // Đặt lại tên file vừa upload lên
            $name = new GiangvienController();
            $tachten = $name->lay_ten($hoten);               
            $fileName = $tachten . str_replace("/", "", str_replace(" ", "", $macb)) . '.' . $extension;

            //Lưu Hình Vào CSDL
            DB::table('giang_vien')->where('macb',$macb)->update(['hinhdaidien' => $fileName]);
            // Chuyển file upload vào thư mục lưu trữ đã đặt trươc đó
            $upload_success = Input::file('fHinh')->move($luuden, $fileName);

            if ($upload_success) {
                return Redirect::to('quantri/doimatkhauqt')->with('message', 'Upload hình đại diện thành công!');
            }
        } 
    }
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachGV(){
        $gv = DB::table('giang_vien')->get();
        $n = count($gv);
        $ds = DB::table('giang_vien as gv')->skip($n)->take(5)->paginate(5);
        //Lấy năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->where('nam',$namht)->value('hocky');
        //Lấy danh sách năm học năm lớn nhất ở trên cùng
        $namhoc = DB::table('nien_khoa as nk')->distinct()->select('nam')->orderBy('nam','desc')->get(); 
        $hocky = DB::table('nien_khoa')->select('hocky')->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->get();        
        //Lấy danh sách nhóm học phần mà mỗi giảng viên phụ trách
        $gv_hp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp','hp.macb','nk.nam','nk.hocky')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->get();
        return view('quantri.quan-tri-giang-vien')->with('dsgv',$ds)->with('namhoc',$namhoc)->with('hocky',$hocky)
            ->with('namht',$namht)->with('hkht',$hkht)->with('gv_hp',$gv_hp);
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
//                    'chkNhomHP'   => 'required',
                    'txtMatKhau1' => 'required|min:6',
                    'txtMatKhau2' => 'required|min:6|same:txtMatKhau1'                    
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
//            $data1 = array(
//                    'macb'      => $req->txtMaCB,
//                    'hoten'     => $req->txtHoTen,
//                    'gioitinh'  => $req->rdGioiTinh,
//                    'ngaysinh'  => $req->txtNgaySinh,
//                    'email'     => $req->txtEmail,
//                    'sdt'       => $req->txtSDT,
//                    'matkhau'   => Hash::make($req->txtMatKhau1),
//                    'ngaytao'   => Carbon::now() 
//            );            
//            $ch1 = DB::table('giang_vien')->insert($data1);
            
            $gv = new Giangvien();
            $gv->macb = $req->txtMaCB;
            $gv->hoten = $req->txtHoTen;
            $gv->gioitinh = $req->rdGioiTinh;
            $gv->ngaysinh = $req->txtNgaySinh;
            $gv->email = $req->txtEmail;
            $gv->sdt = $req->txtSDT;
            $gv->matkhau = Hash::make($req->txtMatKhau1);
            $gv->nguoitao = \Auth::user()->name;
            $gv->ngaytao = Carbon::now();
            $gv->save();
//Thêm macb, hoten, email, matkhau vào bảng Users        
            $thanhvien = new User;
            $thanhvien->taikhoan = $req->txtMaCB;
            $thanhvien->name = $req->txtHoTen;
            $thanhvien->email = $req->txtEmail;
            $thanhvien->password = Hash::make($req->txtMatKhau1);
            $thanhvien->quyen = 'gv';
            $thanhvien->remember_token= $req->_token;
            $thanhvien->save();           

            //Lấy mảng manhomhp khi đã chon checkbox
            $nhomhp_checked = Input::get('chkNhomHP');
            $ch2 = DB::table('nhom_hocphan')->whereIn('manhomhp',$nhomhp_checked)->update(
                        [
                           'macb' => $_POST['txtMaCB']
                        ]
                   );
            
            return redirect('quantri/giangvien');           
        }
    }
/*=========================== Sửa thông tin Giảng viên ==============================================*/ 
    public function CapNhatGV($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        //Lấy năm học và học kỳ của giảng viên đang dạy      
        $nam = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nam');
        $hk = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('hp.macb',$macb)
                ->value('nk.mank');
        //Lấy ds nhóm học phần chưa có GV nào phụ trách giảng dạy
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->where('hp.macb','=',"")
                ->Orwhere('hp.macb',$macb)
                ->get(); 
        $gv_hp = DB::table('nhom_hocphan')->where('mank',$mank)->value('manhomhp');
        
        return view('quantri.cap-nhat-giang-vien')->with('gv',$row)->with('dshp',$dshp)
                ->with('nam',$nam)->with('hk',$hk)->with('mank',$mank)->with('gv_hp',$gv_hp);
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
//                    'txtMatKhauCu'      => 'required',
//                    'txtMatKhauMoi1'    => 'required|min:6|different:txtMatKhauCu',
//                    'txtMatKhauMoi2'    => 'required|min:6|same:txtMatKhauMoi1',
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
                    'matkhau'   => Hash::make($_POST['txtMatKhauMoi1']),
                    'khoa'      => isset($_POST['ckbKhoa']) ? 0 : 1 ,
//                    'quantri'   => isset($_POST['ckbQuanTri']) ? 1 : 0,
                    'ngaytao'           => Carbon::now()
            );
            $ch = DB::table('giang_vien')->where('macb',$post['txtMaCB'])->update($data);
//Lưu cập nhật mật khẩu vào bảng Users      
            $idgv = DB::table('users')->where('taikhoan',$req->txtMaCB)->value('id');
            $thanhvien = User::find($idgv); 
            $thanhvien->taikhoan= $req->txtMaCB;
            $thanhvien->name = $req->txtHoTen;
            $thanhvien->email = $req->txtEmail;
            $thanhvien->password = Hash::make($req->txtMatKhauMoi1);
    //      $thanhvien->quyen = 'gv';
            $thanhvien->remember_token= $req->_token;
            $thanhvien->save();
            
            //Lấy mảng giá trị kho chọn nhiều checkbox Nhóm HP
            $nhomhp_checked = Input::get('chkNhomHP');
            $ch2 = DB::table('nhom_hocphan')->whereIn('manhomhp',$nhomhp_checked)
                    ->update(['macb' => $_POST['txtMaCB']]);
            return redirect('quantri/giangvien');
           
        }
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaGV($macb){
        $delete = DB::table('giang_vien')->where('macb',$macb)->delete();
        $tencb = DB::table('giang_vien')->where('macb',$macb)->value('hoten');
        \Session::flash('ThongBao','Xóa '.$tencb.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa            
            return redirect('quantri/giangvien');
        }
    }
/*=========================== Xóa Giảng viên Khỏi NHÓM HP ==============================================*/ 
    public function RutGVTrongHP($mahp){
        $reject = DB::table('nhom_hocphan')->where('manhomhp',$mahp)->update(['macb'=>""]);
        \Session::flash('ThongBaoRut','Xóa thành công!');
        
         return redirect('quantri/giangvien');
        
    }
/*********************
 * ########## Quản trị Sinh Viên #############
 * *******************
 */
/*============== Lấy Mã nhóm HP khi chọn selectbox =============*/
    public function LayNhomHP(){
        $mahp = Input::get('cbNhomHP');
        return redirect('quantri/sinhvien/'.$mahp);           
    }
/*======================== IN Danh sách sinh viên ==================================*/    
    public function InDanhSachSV($mahp,$macbqt){
        $nguoiin = DB::table('giang_vien')->where('macb',$macbqt)->value('hoten');
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
                    ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                    ->where('chn.manhomhp',$mahp)
                    ->orderBy('chn.manhomthuchien','asc')
                    ->get();
        }
        $view = \View::make('quantri.in-danh-sach-sinh-vien',compact('macbqt','nguoiin','namht','hkht','gv_hp','dssv'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadHTML($view)->setPaper('a4')->setOrientation('portrait');
       
        return $pdf->stream("DanhSachSV.pdf");
    }
/*=========================== Danh sách cán bộ hướng dẫn niên luận ==============================================*/ 
    public function DanhSachSV(){  
        $mahp = \Request::segment(3);
        //Lấy mảng các năm và để năm lớn nhất (năm hiện tại) trên cùng
        $namhoc = DB::table('nien_khoa as nk')->distinct()->select('nam')->orderBy('nam','desc')->get();
        $hocky = DB::table('nien_khoa')->distinct()
                ->select('hocky')
                ->get(); 
        //Lấy giá trị năm học và học kỳ hiện tại      
        $namht = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hkht = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$namht)
                ->value('hocky');        
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$namht)->where('nk.hocky',$hkht)
                ->value('nk.mank');
        //Lấy danh sách sinh viên ở hk hiện tại        
        if($mahp == null || $mahp == 0){
           $dssv = DB::table('sinh_vien as sv')
                ->select('sv.mssv','sv.hoten','sv.ngaysinh','sv.khoahoc','sv.ngaytao','sv.email','sv.khoa','hp.tennhomhp',
                        'chn.manhomthuchien','chn.nhomtruong')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('hp.mank',$mank)
                ->orderBy('chn.manhomthuchien','desc')
                ->orderBy('hp.tennhomhp','asc')   
                ->paginate(10);
        }
        else if($mahp != null){
            $dssv = DB::table('sinh_vien as sv')
                ->select('sv.mssv','sv.hoten','sv.ngaysinh','sv.khoahoc','sv.ngaytao','sv.email','sv.khoa','hp.tennhomhp',
                        'chn.manhomthuchien','chn.nhomtruong')
                ->join('chia_nhom as chn','sv.mssv','=','chn.mssv')
                ->join('nhom_hocphan as hp','chn.manhomhp','=','hp.manhomhp')
                ->where('hp.mank',$mank)
                ->where('hp.manhomhp',$mahp)
                ->orderBy('chn.manhomthuchien','desc')
                ->paginate(10);
        }
        //Lấy danh sách nhóm hp ở hk-nk hiện tại
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->get();
           
        return view('quantri.quan-tri-sinh-vien')->with('dssv',$dssv)->with('namhoc',$namhoc)
                ->with('hocky',$hocky)->with('dshp',$dshp)->with('namht',$namht)->with('hkht',$hkht)
            ->with('mahp',$mahp);
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
                    'rdNhomHP'    => 'required',
                    'txtMatKhau1' => 'required|min:6',
                    'txtMatKhau2' => 'required|min:6|same:txtMatKhau1',                    
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
//            $data = array(
//                    'mssv'     => $_POST['txtMaSV'],
//                    'hoten'    => $_POST['txtHoTen'],
//                    'gioitinh' => $_POST['rdGioiTinh'],
//                    'ngaysinh' => $_POST['txtNgaySinh'],
//                    'email'    => $_POST['txtEmail'],
//                    'khoahoc'  => $_POST['txtKhoaHoc'],
//                    'matkhau'  => Hash::make($_POST['txtMatKhau1']),
//                    'ngaytao'  => Carbon::now()
//            );
//            $ch = DB::table('sinh_vien')->insert($data); 
    //Thêm thông tin sinh viên vào bảng sinh_vien
            $sv = new Sinhvien();
            $sv->mssv = $req->txtMaSV;
            $sv->hoten = $req->txtHoTen;
            $sv->gioitinh = $req->rdGioiTinh;
            $sv->ngaysinh = $req->txtNgaySinh;
            $sv->email = $req->txtEmail;
            $sv->sdt = $req->txtSDT;
            $sv->matkhau = Hash::make($req->txtMatKhau1);
            $sv->nguoitao = \Auth::user()->name;
            $sv->ngaytao = Carbon::now();
            $sv->save();
//Thêm macb, hoten, email, matkhau vào bảng Users        
            $thanhvien = new User;
            $thanhvien->taikhoan = $req->txtMaSV;
            $thanhvien->name = $req->txtHoTen;
            $thanhvien->email = $req->txtEmail;
            $thanhvien->password = Hash::make($req->txtMatKhau1);
            $thanhvien->quyen = 'sv';
            $thanhvien->remember_token= $req->_token;
            $thanhvien->save();
            
            $ch2 = DB::table('chia_nhom')->insert(
                        [
                            'mssv'           => $_POST['txtMaSV'],
                            'manhomhp'       => $_POST['rdNhomHP'],
                            'manhomthuchien' => "",
                            'nhomtruong'     => 0
                        ]
                    );
            
           return redirect('quantri/sinhvien');
           
        }
    }
/*=========================== Sửa thông tin sinh viên ==============================================*/ 
    public function CapNhatSV($mahp,$masv){
        $sv = DB::table('sinh_vien')->where('mssv',$masv)->first();
        //Lấy năm học và học kỳ của sinh viên đang hoc
        $nam = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.mssv',$masv)
                ->value('nk.nam');
        $hk = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.mssv',$masv)
                ->value('nk.hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->join('chia_nhom as chn','hp.manhomhp','=','chn.manhomhp')
                ->where('chn.mssv',$masv)
                ->value('nk.mank');
        $dshp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->get();  
        $sv_hp = DB::table('chia_nhom')->where('mssv',$masv)->value('manhomhp');
        
        return view('quantri.cap-nhat-sinh-vien')->with('sv',$sv)->with('dshp',$dshp)
            ->with('nam',$nam)->with('hk',$hk)->with('mank',$mank)->with('sv_hp',$sv_hp)->with('masv',$masv);
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
//                    'txtMatKhauCu'      => 'required',
//                    'txtMatKhauMoi1'    => 'required|min:6|different:txtMatKhauCu',
//                    'txtMatKhauMoi2'    => 'required|min:6|same:txtMatKhauMoi1'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
//            $mk =isset($_POST['txtMatKhauMoi1']) ? 
            $data = array(
                    'mssv'      => $_POST['txtMaSV'],
                    'hoten'     => $_POST['txtHoTen'],
                    'gioitinh'  => $_POST['rdGioiTinh'],
                    'ngaysinh'  => $_POST['txtNgaySinh'],
                    'email'     => $_POST['txtEmail'],
                    'khoahoc'   => $_POST['txtKhoaHoc'],
                    'matkhau'   => Hash::make($_POST['txtMatKhauMoi1']),
                    'khoa'      => isset($_POST['ckbKhoa']) ? 0 : 1,
                    'ngaytao'   => Carbon::now()
            );
            $ch = DB::table('sinh_vien')->where('mssv',$post['txtMaSV'])->update($data);
//Lưu cập nhật mật khẩu vào bảng Users  
            $idsv = DB::table('users')->where('taikhoan',$req->txtMaSV)->value('id');
            $thanhvien = User::find($idsv);
            $thanhvien->taikhoan = $req->txtMaSV;
            $thanhvien->name = $req->txtHoTen;
            $thanhvien->email = $req->txtEmail;
            $thanhvien->password = Hash::make($req->txtMatKhauMoi1);
    //        $thanhvien->quyen = 'sv';
            $thanhvien->remember_token= $req->_token;
            $thanhvien->save();
            
           if(isset($_POST['rdNhomHP'])){
               $nhomhp = Input::get('rdNhomHP'); 
           }
            $ch2 = DB::table('chia_nhom')->where('mssv',$post['txtMaSV'])->update(
                        [
                            'manhomhp' => $nhomhp,
                        ]
                    );
            return redirect('quantri/sinhvien');
           
        }
    }
/*=========================== Xóa thông tin Giảng viên ==============================================*/ 
    public function XoaSV($masv){
        $delete = DB::table('sinh_vien')->where('mssv',$masv)->delete();
        $tensv = DB::table('sinh_vien')->where('mssv',$masv)->value('hoten');
        \Session::flash('ThongBao','Xóa '.$tensv.' thành công!');
        if($delete){
            //return $delete; $delete = 1 sau khi thuc hiện xóa
            return redirect('quantri/sinhvien');
        }
    }
    
}// END Class QuantriController
