<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quydinh extends Model
{
    public $timestamps = false;
    public $table = "quy_dinh";  
    protected $primaryKey = array('macb','matc');
    protected $fillable = [     
        'macb',
        'matc',
        'mank'
    ];
}
