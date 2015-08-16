<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tieuchidanhgia extends Model
{
    public $timestamps = false;
    public $table = "tieu_chi_danh_gia";  
    protected $primaryKey = 'matc';
    protected $fillable = [     
        'matc',
        'noidungtc',
        'heso',
        'ngaytao'        
    ];
}
