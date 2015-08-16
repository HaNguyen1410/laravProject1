<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detai extends Model
{
    public $timestamps = false;
    public $table = "de_tai";  
    protected $primaryKey = 'madt';
    protected $fillable = [     
        'madt',
        'macb',
        'tendt',
        'motadt',
        'congnghe',
        'taptindinhkem',
        'songuoitoida',
        'phanloai',
        'trangthai',
        'duyet',
        'ngaytao',
        'ghichudt'
    ];
}
