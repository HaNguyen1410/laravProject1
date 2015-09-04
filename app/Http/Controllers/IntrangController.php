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
use Carbon\Carbon;

class IntrangController extends Controller
{
    public function InBangDiemSV($mssv){
        $manhom = DB::table('chia_nhom')->where('mssv',$mssv)->value('manhomthuchien');
        $pdf = \PDF::loadView('sinhvien.in-bang-diem-sv',array('manhom',$manhom));
//        // embed the font
//        $fontname = $pdf->addTTFfont(K_PATH_FONTS . 'helvetica55roman.ttf', 'TrueTypeUnicode', '', 32);
//        // use the font
//        $pdf->SetFont($fontname, '', 10);
        
        //return $pdf->download('Nhom_'.$manhom.'.pdf'); //this code is used for the name pdf
        return $pdf->stream("Nhom_".$manhom.".pdf");
    }
}
