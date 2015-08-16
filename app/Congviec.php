<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Congviec extends Model
{
    public $timestamps = false;
    public $table = "cong_viec";
    protected $primaryKey = 'macv';
    protected $fillable = [
        'macv',
        'congviec',
        'giaocho',
        'ngaybatdau_kehoach',
        'ngaykethuc_kehoach',
        'ngaybatdau_thucte',
        'ngaybatdau_thucte',
        'sogio_thucte',
        'phuthuoc_cv',
        'uutien',
        'trangthai',
        'tiendo',
        'noidungthuchien',
        'ghichu',
        'ngaytao'
    ];
}
