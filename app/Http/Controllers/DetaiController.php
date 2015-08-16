<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session;

class DetaiController extends Controller
{
    public function DsDeTai($macb){
        
        return view('giangvien.danh-sach-de-tai');
    }
}
