<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth;
use App\Chianhom;
use App\Chitietdiem;

class ImportExcelController extends Controller
{
    public function LuuImportExcel(Request $req){
        $v = \Validator::make($req->all(),
                [
                    'fDiemExcel' => 'required|mimes:xls,xlsx'
                ]
            );
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $luuden = storage_path() . '/ImportExcel/';
            $taptin = Input::file('fDiemExcel');
            //$extension = Input::file('fTaiLieu')->getClientOriginalExtension();
            //Lấy tên và cả đuôi của tập tin
            $tenbandau = Input::file('fDiemExcel')->getClientOriginalName();            
            $upload_success = $taptin->move($luuden, $tenbandau);
        //Import vào CSDL  
             $sheet = Excel::load($luuden.'/'.$tenbandau, function($reader){})->get();
           // Khi upload thành công thì thông báo
            if ($upload_success) {
                return $sheet;
                //return Redirect::to('giangvien/nhapdiem')->with('BaoUpload', 'Import thành công!');
            }
            else
                return $upload_success;
        }

    }
    
}
