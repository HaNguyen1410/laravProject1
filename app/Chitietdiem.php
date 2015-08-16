<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietdiem extends Model
{
    public $timestamps = false;
    public $table = "chitiet_diem";  
    protected $primaryKey = array('matc', 'mssv');
    protected $fillable = [     
        'matc',
        'mssv',
        'diem'
    ];
}
