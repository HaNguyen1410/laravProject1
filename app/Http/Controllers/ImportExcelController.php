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
/*====================== Import điểm từ tập tin Excel ==========================*/
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
                       for($j = 2; $j < $col-2; $j++){
                            //echo $j.">";                           
                            //echo $results[$i][$j] . "  "; 
                           if($j >= 4 && $j < $col-2){
                                //echo $results[$i][2]."-".$results[$i][$j]."<br>";
                                //Lưu điểm
                              DB::table('chitiet_diem')->where('mssv',$results[$i][2])->update(
                                       ['diem' => $results[$i][$j]]
                                   );     
                               
                           }   
                       }                      
                       echo "<br>";
                   }
                   //Lưu nhận xét
                   for($i = 1; $i < $row; $i++){
                        DB::table('chia_nhom')->where('mssv',$results[$i][2])->update(
                                       ['nhanxet' => $results[$i][$col-2]]
                                   );   
                       echo $results[$i][2]." => ".$results[$i][$col-2]."<br>";
                   }
                   
                });
                return Redirect::to('giangvien/nhapdiem')->with('BaoUpload', 'Import điểm từ tập tin Excel thành công!');
            }
            else
                return $upload_success;
        }
    }

/*====================== Export danh sách nhập điểm sang tập tin Excel ==========================*/
/*    
    public function XuatExcel($macb){
        //Lấy năm học và học kỳ hiện tại      
        $nam = DB::table('nien_khoa')->distinct()->orderBy('nam','desc')->value('nam');
        $hk = DB::table('nien_khoa')->distinct()->orderBy('hocky','desc')
                ->where('nam',$nam)
                ->value('hocky');
        $mank = DB::table('nien_khoa')->where('nam',$nam)->where('hocky',$hk)->value('mank');
        $hoten = DB::table('sinh_vien as sv')
                ->select('chn.manhomthuchien','sv.mssv','chn.nhomtruong','sv.hoten')
                ->join('chia_nhom chn','sv.mssv','=','chn.mssv')
                ->lists('chn.manhomthuchien','sv.mssv','chn.nhomtruong','sv.hoten');
        $tieuchi = DB::table('tieu_chi_danh_gia as tc')->select('tc.heso')
                ->join('quy_dinh as qd','tc.matc','=','qd.matc')
                ->where('qd.macb',$macb)->where('qd.mank',$mank)
                ->lists('tc.heso');
        Excel::create('ds_nhapdiem', function($excel) use($data){
            $excel->sheet('1', function($sheet) use($data){
              $sheet->loadView('giangvien/xuat-excel', array('data' => $data));

              //I would "dream" to to something like this:
              //$row=$sheet->getLastRow();
              //$sheet->cell('C'.($row+1),'=sum(C4:C'.$row.')');

           });
        })->export('xls');
    }
 */
        
}
