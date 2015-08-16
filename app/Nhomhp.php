<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhomhp extends Model
{
    public $timestamps = false;
    public $table = "nhom_hocphan";  
    protected $primaryKey = 'manhomhp';
    protected $fillable = [     
        'manhomhp',
        'tennhomhp',
        'mank',
        'siso'
    ];
}
