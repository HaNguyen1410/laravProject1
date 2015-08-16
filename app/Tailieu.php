<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tailieu extends Model
{
    public $timestamps = false;
    public $table = "tai_lieu";  
    protected $primaryKey = 'matl';
    protected $fillable = [     
        'matl',
        'macv',
        'tentl',
        'kichthuoc',
        'mota',
        'ngaycapnhat',
        'dieuchinh'
    ];
}
