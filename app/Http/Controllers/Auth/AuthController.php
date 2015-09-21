<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests\DangnhapRequest;
use App\Giangvien;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            $dangnhap = array(
                'macb'    => $request->txtTenDangNhap,
                'matkhau' => $request->txtMatKhau,
            );   
            if(\Auth::attempt($dangnhap)){
                echo "Thành công";
//                echo \Auth::user()->hoten;
//                return redirect()->route('quantri/danhsachgv');
            }else{
                echo "Thất bại: ".$request->txtMatKhau;
//                return redirect()->back();
            }              
    }
    
}
