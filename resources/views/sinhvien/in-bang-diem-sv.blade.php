<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="Shortcut Icon" href="{{asset('public/images/logo.ico')}}" type="image/x-icon" />  
        <title>In Bảng Điểm Nhóm Niên Luận</title>
        <style>
            body { 
                writing-mode: tb-rl;
                font-family: DejaVu Sans, sans-serif;
                font-size: 10;
                margin-left: 30px;
                margin-right: 30px;               
            }
            @page { 
                size: portrait;
            }
            th{
                background-color: #9acfea;
            }
        </style>
    </head>
     <?php 
        /*========================== Quy điểm số ra điểm chữ ====================*/ 
                function DiemChu($d){
                    if($d >= 9 && $d <= 10)    
                        return 'A';
                    else if($d >= 8 && $d <= 8.9){
                        return 'B+';
                    }
                    else if($d >= 7 && $d <= 7.9){
                        return 'B';
                    }
                    else if($d >= 6 && $d <= 6.9){
                        return 'C+';
                    }
                    else if($d >= 5.0 && $d <= 5.9){
                        return 'C';
                    }
                    else if($d >= 4.5 && $d <= 4.9){
                        return 'D+';
                    }
                    else if($d >= 4 && $d <= 4.4){
                        return 'D';
                    }
                    else if($d >= 0 && $d < 4){
                        return 'F';
                    }
                }    
    ?>
    <body>
        <table style="width:100%">
            <tr>
                <td width="10%" align="right">
                    <img src="http://localhost/laravProject1/public/images/logo-ctu.jpg" width="70px" height="70px"/>
                </td>
                <td>
                    <div>
                        <label>Bộ môn Công Nghệ Phần Mềm</label><br>
                        <label>Khoa Công Nghệ Thông Tin và Truyền Thông</label><br>
                        <label>Trường Đại Học Cần Thơ</label>
                    </div>
                </td>
                <td align="right" width="30%">                    
                    <div style="text-align: left;">
                        <label>Mẫu in M01</label><br>
                        <label>Ngày in: {{$date}}</label>
                    </div>
                </td>
            </tr>
        </table>
        
        <h2 align="center" style="margin-bottom: 1px;">KẾT QUẢ THỰC HIỆN ĐỀ TÀI NIÊN LUẬN</h2>
        <div align="center">
            (Học kỳ: <lable style="color: #00c;">{{$hk}}</lable> - Năm học: <lable style="color: #00c;">{{$nam}})</lable>
        </div>
        <br>
        <table border="0" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">
            <tr>
                <td width="20%">Họ tên cán bộ:</td>
                <td colspan="3">
                    <label style="color: #00c; font-weight: bold">
                        {{$gv->hoten}} ({{$gv->macb}}) 
                    </label>
                </td>             
            </tr>
            <tr>
                <td>Tên đề tài:</td>
                <td colspan="3">
                    <label style="color: #00c;">
                        {{$tendt}}
                    </label>
                </td>
            </tr>
            <tr>
                <td>Mã nhóm:</td>
                <td><label style="color: #00c; font-weight: bold">{{$manhom}}</label></td>
                <td>Nhóm HP: </td>
                <td><label style="color: #00c; font-weight: bold">{{$gv->tennhomhp}}</label></td>
            </tr>
        </table><br>
        <h3 align="center">Danh sách điểm</h3>
        <table class="table table-bordered" border="1" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">            
            <tr>
                <th rowspan="2" width="8%">MSSV</th>
                <th rowspan="2" width="15%">Họ và tên</th>
                <th rowspan="2" width="2%">Nhóm trưởng</th>
                <th colspan="{{count($dstieuchi)}}" width="15%">Tiêu chí - Điểm tối đa</th>
                <th rowspan="2" width="4%">Tổng điểm</th>
                <th rowspan="2" width="4%">Điểm chữ</th>   
                <th rowspan="2" width="20%">Nhận xét</th>                 
            </tr>
            <tr>
               @foreach($dstieuchi as $tc)
                    <th width="2%">[{{$tc->matc}}] - {{$tc->heso}}</th>
               @endforeach
            </tr>
            @foreach($dssv as $sv)               
                @if($sv->manhomthuchien == $manhom)  
                    <tr>
                        <td align="center">{{$sv->mssv}}</td>
                        <td>{{$sv->hoten}}</td>
                        <td align="center">
                            @if($sv->nhomtruong == 1)
                                <img src="http://localhost/laravProject1/public/images/tick-icon-small.png"/>
                            @endif
                        </td>
                        @foreach($dsdiem as $diem)
                            @if($diem->mssv == $sv->mssv)
                                <td align="center">{{$diem->diem}}</td>
                            @endif
                        @endforeach
                        @foreach($tongdiem as $tong) 
                            @if($tong->mssv == $sv->mssv)
                            <td align="center" style="color: #FF0000; font-weight: bold"><?php echo round($tong->tongdiem,2);?></td>
                                @if($tong->tongdiem == null)
                                    <td></td>
                                @elseif($tong->tongdiem != null)
                                    <td align="center" style="color: #FF0000; font-weight: bold">{{DiemChu($tong->tongdiem)}}</td>
                                @endif 
                            @endif                        
                        @endforeach 
                        @foreach($nhanxet as $nx)
                            @if($nx->mssv == $sv->mssv)
                                <td style="color: #00008b;">{{$nx->nhanxet}}</td>
                            @endif 
                        @endforeach
                    </tr>
                 @endif
            @endforeach         
        </table><br>
        <table class="table table-bordered" style="width: 600px;">
            <tr>
                <td style="text-align: center; font-weight: bold;" width="2%">STT</td>
                <td style="text-align: center; font-weight: bold;" width="20%">Mã tiêu chí</td>
                <td style="text-align: center; font-weight: bold;" width="50%">Nội dung đánh giá</td>
                <td style="text-align: center; font-weight: bold;" width="15%">Mức điểm tối đa</td>                        
            </tr>
            @foreach($dstieuchi as $stt => $tc)
                <tr>
                    <td align='center'>{{$stt+1}}</td>
                    <td align='center' style="color: brown; font-weight: bold;">[{{$tc->matc}}]</td>
                    <td>{{$tc->noidungtc}}</td>
                    <td align='center'>{{$tc->heso}}</td>
                </tr>
            @endforeach                              
        </table><br><br>
        <table border="0" style="width:500px;" align="right" padding="1px 1px" cellspacing="0px 0px">
            <tr>
                <td align="center">
                    <label style="font-weight: bold">Người in</label>
                </td>             
            </tr>
            <tr>
                <td align="center">
                    <label style="color: #00c; font-weight: bold">
                        {{$tensv->hoten}} ({{$tensv->mssv}}) 
                    </label>
                </td>                
            </tr>
        </table>
    </body>
</html>
