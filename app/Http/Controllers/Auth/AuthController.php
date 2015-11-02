<?php

namespace App\Http\Controllers\Auth;


use App\Http\Middleware;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests\DangnhapRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use App\Giangvien;
use App\User;
use Validator,
    Session,
    DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;
    
    protected $redirectAfterLogout = 'dangnhap';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
/*=============== Hiển thị giao diện đăng nhập =====================*/    
    public function DangNhap(){
        return view('giaodienchung.dang-nhap');
    }
/*=====================  =======================*/    
    public function GoiDangNhap(DangnhapRequest $request){   
//        echo $request->txtTenDangNhap;
//        $mk = md5($request->txtMatKhau);
//            $mk = Hash::make($request->txtMatKhau);
//          Hash::check('matkhau', $request->txtMatKhau);
        
            $dangnhap = array(
                'email'    => $request->txtTenDangNhap,
                'password' => $request->txtMatKhau,
            );   
    // tim giao vien va chuyen ve giao dien giao vien neu can            
            if($this->auth->attempt($dangnhap)){
//                echo "Thành công";
//                return redirect()->intended();                
                if($this->auth->user()->quyen == 'qt'){
                    $khoa = DB::table('giang_vien')->where('macb',$this->auth->user()->taikhoan)->value('khoa');
                    if($khoa == 1){
                        return redirect()->back()->withErrors('Tài khoản đã bị khóa!');
                    }
                    return redirect('quantri/thongtinqt');
                }
                else if($this->auth->user()->quyen == 'gv'){
                    $khoa = DB::table('giang_vien')->where('macb',$this->auth->user()->taikhoan)->value('khoa');
                    if($khoa == 1){
                        return redirect()->back()->withErrors('Tài khoản đã bị khóa!');
                    }
                    return redirect('giangvien/thongtingv');
                }
                else if($this->auth->user()->quyen == 'sv'){
                    $khoa = DB::table('sinh_vien')->where('mssv',$this->auth->user()->taikhoan)->value('khoa');
                    if($khoa == 1){
                        return redirect()->back()->withErrors('Tài khoản đã bị khóa!');
                    }
                    return redirect('sinhvien/thongtinsv');
                }
            }else{
//                echo "Thất bại: ".$this->auth->user();
                return redirect()->back()->withErrors('Email hoặc mật khẩu không đúng!');
            }              
    }
/*=============== Hiển thị giao diện đăng nhập =====================*/    
    public function DangXuat(Request $request){
//        Session::flush();
//        $request->session()->flush();
//        return redirect()->guest('dangnhap');
        
        \Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : Middleware::handle());
    }    
}
