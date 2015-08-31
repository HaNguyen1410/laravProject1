<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QlthongbaoController extends Controller
{
    public function QuanLyThongBao($macb){
        return view('giangvien.quan-ly-thong-bao');
    }
            
}
