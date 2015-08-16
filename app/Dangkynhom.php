<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dangkynhom extends Model
{
    public $timestamps = false;
    public $table = "dangky_nhom";  
    //$table->primary(array('mssv', 'manhomhp'));
    protected $primaryKey = array('mssv', 'manhomhp');
    protected $fillable = [       
        'mssv',
        'manhomhp',
        'manhomthuchien',
        'nhomtruong',
    ];
}
