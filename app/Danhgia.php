<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhgia extends Model
{
    public $timestamps = false;
    public $table = "danh_gia";  
    protected $primaryKey = array('matl', 'macb');
    protected $fillable = [     
        'matl',
        'macb',
        'nd_danhgia',
        'ngay_danhgia'
    ];
}
