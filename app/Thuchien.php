<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thuchien extends Model
{
    public $timestamps = false;
    public $table = "thuc_hien";  
    protected $primaryKey = array('manhomthuchien','macv');
    protected $fillable = [     
        'manhomthuchien',
        'macv'
    ];
}
