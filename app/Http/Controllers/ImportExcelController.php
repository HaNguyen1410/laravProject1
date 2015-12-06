<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Classes\PHPExcel;
//use Maatwebsite\Excel\Facades\Excel;
use DB,
    Excel;
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
            //$extension = Input::file('fDiemExcel')->getClientOriginalExtension();
            //Lấy tên và cả đuôi của tập tin
            $tenbandau = Input::file('fDiemExcel')->getClientOriginalName();            
            $upload_success = $taptin->move($luuden, $tenbandau);
            
           // Khi upload thành công thì thông báo
            if ($upload_success){
                //Import vào CSDL  
                //$sheet = Excel::load($luuden.'/'.$tenbandau, function($reader){})->get();
                \Excel::load($luuden.'/'.$tenbandau, function($reader) {
                    //return $reader->dump(); trả về một đối tượng (Object)
                   $results = $reader->toArray(); //Trả về mảng                 
                   //return var_dump($results);
                   $row = count($results);
                   $n = count($results,1); // Đếm từng phần tử trong mảng đa chiều
                   $col = ($n-$row)/($row);
//                   echo $col." :Số cột<br>".$row.": Số dòng<br>";
//                   echo $n." Số Phần tử của mảng 2 chiều (Gồm số phần tử của hàng và số phần tử của cột)";
                   for($i = 1; $i < $row; $i++){
                       for($j = 1; $j < $col; $j++){
                            echo dump($results[$i]);                           
                       }
                   }
                   
                   
                });
                //return Redirect::to('giangvien/nhapdiem')->with('BaoUpload', 'Import thành công!');
            }
            else
                return $upload_success;
        }
    }
    
}
