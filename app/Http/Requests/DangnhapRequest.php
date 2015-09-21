<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DangnhapRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtTenDangNhap'   => 'required',//|unique:sinh_vien
            'txtMatKhau'       => 'required'
        ];
    }
    public function thongbao(){
        return [
            'txtTenDangNhap.required' => 'Chưa nhập tên đăng nhập',
            'txtMatKhau.required'     => 'Chưa nhập mật khẩu'
        ];
    }
}
