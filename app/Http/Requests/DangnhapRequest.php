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
// tên hàm 'messages' bắt buộc vì laravel có hỗ trợ
    public function messages(){
        return [
            'txtTenDangNhap.required' => 'Vui lòng nhập tên đăng nhập',
            'txtMatKhau.required'     => 'Vui lòng nhập mật khẩu'
        ];
    }
}
