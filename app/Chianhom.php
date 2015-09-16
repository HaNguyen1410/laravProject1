<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Chianhom extends Model
{
    public $timestamps = false;
    public $table = "chia_nhom";  
    //$table->primary(array('mssv', 'manhomhp'));
    protected $primaryKey = array('mssv', 'manhomhp');
    protected $fillable = [       
        'mssv',
        'manhomhp',
        'manhomthuchien',
        'nhomtruong',
        'nhanxet'
    ];
}
