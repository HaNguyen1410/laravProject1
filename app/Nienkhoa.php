<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nienkhoa extends Model
{
    public $timestamps = false;
    public $table = "nien_khoa";  
    protected $primaryKey = 'mank';
    protected $fillable = [     
        'mank',
        'nam',
        'hocky'
    ];
}
