<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Giangvien extends Model
{
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
