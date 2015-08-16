<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhomthuchien extends Model
{
    public $timestamps = false;
    public $table = "nhom_thuc_hien";  
    protected $primaryKey = 'manhomthuchien';
    protected $fillable = [     
        'manhomthuchien',
        'lichhop',
        'tochucnhom',
        'ngaybatdau_kehoach',
        'ngaykethuc_kehoach',
        'ngaybatdau_thucte',
        'ngaybatdau_thucte',
        'sogio_thucte',
        'tiendo',
        'hoanthanh',
        'phamvi_detai',
        'ghichu',
        'nhanxet',
        'chapnhan'
    ];
}
