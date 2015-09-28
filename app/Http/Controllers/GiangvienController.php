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
    Session,
    Hash;
use Carbon\Carbon;
use App\Giangvien;
use App\User;
use App\Http\Controllers\Auth;

class GiangvienController extends Controller
{
/*=========================== Ví dụ về đưa dữ liệu từ Controller vào Views ==============================================*/
    public function ViDu(){         
        $name = "Nguyễn Thị Thu Hà";
        return view('giangvien.thong-tin')->with('name', $name);
    }   
    public function ThongTin_gv(){
        $giangvien = Giangvien::all();
        return $giangvien; //view('giangvien.thong-tin-giang-vien')->with('gv',$giangvien);        
    }
    
/*=========================== Xem thông tin giảng viên theo mã cán bộ ==============================================*/     
    public function ThongTinGV($macb){
        $giangvien = Giangvien::find($macb);
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa as nk')
                ->join('nhom_hocphan as hp','nk.mank','=','hp.mank')
                ->where('nk.nam',$nam)->where('nk.hocky',$hk)
                ->value('nk.mank');
       //Lấy ds nhóm học phần GV này phụ trách giảng dạy
        $nhomhp = DB::table('nhom_hocphan as hp')->select('hp.manhomhp','hp.tennhomhp')
                ->join('nien_khoa as nk','hp.mank','=','nk.mank')
                ->where('nk.mank',$mank)
                ->where('hp.macb',$macb)
                ->get();  
        
        return view('giangvien.thong-tin-giang-vien')->with('gv',$giangvien)->with('nhomhp',$nhomhp);
    }
/*=========================== Đổi mật khẩu Giảng Viên ==============================================*/   
    public function DoiMatKhauGV($macb){
        $row = DB::table('giang_vien')->where('macb',$macb)->first();
        return view('giangvien.doi-mat-khau-gv')->with('gv', $row);
    } 
    public function LuuDoiMatKhauGV(Request $req){   
        $macb = \Auth::user()->taikhoan;
        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
//                    'txtMaCB'      => 'required',
//                    'txtHoTen'     => 'required',
//                    'txtEmail'     => 'required',
                    'txtMatKhauCu'    => 'required',
                    'txtMatKhauMoi1'  => 'required|min:6|different:txtMatKhauCu',
                    'txtMatKhauMoi2'  => 'required|min:6|same:txtMatKhauMoi1'
                ]
             );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        } 
        else{
            $mk = Hash::make($post['txtMatKhauMoi1']);
            $ch = DB::table('giang_vien')->where('macb',$post['txtMaCB'])
                    ->update(['matkhau' => $mk]);
        //Lưu cập nhật mật khẩu vào bảng Users      
            $idgv = DB::table('users')->where('taikhoan',$req->txtMaCB)->value('id');
            $thanhvien = User::find($idgv);
            $thanhvien->password = $mk;
            $thanhvien->save();            
            
            if($ch > 0){
                return redirect('giangvien/thongtingv/'.$macb);                
            }
        }
    }
/*=============================== (UPLOAD hình) Đổi hình đại diện ===============================*/
    public function DoiHinhDaiDienGV(Request $req){        
        $macb = Input::get('txtMaCB');
        $hoten = DB::table('giang_vien')->where('macb',$macb)->value('hoten');

        $post = $req->all();
        $v = \Validator::make($req->all(),
                [
                    'fHinh' => 'required|image|mimes:jpg,png'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }else{
            $file = Input::file('fHinh');
            // Đặt đường dẫn lưu file upload
            $luuden = public_path(). '/hinhdaidien/';
            // Lấy đuôi mở rộng        
    //           $extension = Input::file('fHinh')->getClientOriginalExtension();
            //Gắn đuôi mở rộng lúc nào cũng là png
            $extension = "png";
            // Đặt lại tên file vừa upload lên
            $tachten = $this->lay_ten($hoten);               
            $fileName = $tachten . str_replace("/", "", str_replace(" ", "", $macb)) . '.' . $extension;

            //Lưu Hình Vào CSDL
            DB::table('giang_vien')->where('macb',$macb)->update(['hinhdaidien' => $fileName]);
            // Chuyển file upload vào thư mục lưu trữ đã đặt trươc đó
            $upload_success = $file->move($luuden, $fileName);

            if ($upload_success) {
                return Redirect('giangvien/doimatkhaugv/2134')->with('message', 'Upload hình đại diện thành công!');
            }
        }
    }
/*=================== Các Hàm ==================================*/
    function bo_dau_cau($str){
        if(!$str) return false;
        $unicode = array( 
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ', 
            'd'=>'đ', 
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 
            'i'=>'í|ì|ỉ|ĩ|ị', 
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ', 
            'D'=>'Đ', 
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ', 
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị', 
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'

         );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }
    function lay_ten($hoten){
        if(isset($hoten)){
            $hten = trim($hoten);
            $mang = explode(" ", $hten);
            $n = count($mang);
            $ten = $mang[$n-1];
            
            return $this->bo_dau_cau($ten);
        }   
    }
 
}// END Class GiangvienController
