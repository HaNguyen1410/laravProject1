<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radetai extends Model
{
    public $timestamps = false;
    public $table = "ra_de_tai";  
    protected $primaryKey = array('madt','manhomhp');
    protected $fillable = [     
        'madt',
        'manhomhp',
        'manhomthuchien'
    ];
}
