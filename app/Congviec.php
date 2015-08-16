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
        'ngayketthuc_kehoach',
        'ngaybatdau_thucte',
        'ngayketthuc_thucte',
        'sogio_thucte',
        'phuthuoc_cv',
        'uutien',
        'trangthai',
        'tiendo',
        'noidungthuchien',
        'ngaytao'
    ];
}
