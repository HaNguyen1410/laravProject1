<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sinhvien extends Model
{
    public $timestamps = false;
    public $table = "sinh_vien";
    //$table->primary(array('id','mssv'))
    protected $primaryKey = 'mssv';
    protected $fillable = [
       
        'mssv',
        'hoten',
        'gioitinh',
        'ngaysinh',
        'khoahoc',
        'email',
        'sdt',
        'hinhdaidien',
        'kynangcongnghe',
        'kienthuclaptrinh',
        'kinhnghiem',
        'matkhau',
        'ngaytao',
        'khoa',
        'nguoitao'
    ];
}
