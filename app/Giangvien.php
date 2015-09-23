<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Giangvien extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    
    public $timestamps = false;
    public $table = "giang_vien";
    protected $primaryKey = 'macb';
    protected $fillable = [
        'macb',
        'hoten',
        'gioitinh',
        'ngaysinh',
        'email',
        'sdt',
        'hinhdaidien',
        'matkhau',
        'ngaytao',
        'khoa',
        'quantri'
    ];
}
