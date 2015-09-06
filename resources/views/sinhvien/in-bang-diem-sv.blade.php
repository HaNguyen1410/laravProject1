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
                margin-left: 50px;
                margin-right: 50px;               
            }
            @page { 
                size: landscape;
            }
            th{
                background-color: #9acfea;
            }
        </style>
    </head>
    <body>
        <table style="width:100%">
            <tr>
                <td>
                    <div>
                        <label>Bộ Giáo Dục Và Đào Tạo</label><br>
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
        <table border="1" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">
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
        <table border="1" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">            
            <tr>
                <th rowspan="2" width="8%">MSSV</th>
                <th rowspan="2" width="15%">Họ và tên</th>
                <th colspan="{{count($tieuchi)}}" width="15%">Hệ số</th>
                <th rowspan="2" width="4%">Tổng điểm</th>
                <th rowspan="2" width="4%">Điểm chữ</th>                         
            </tr>
            <tr>
               @foreach($tieuchi as $tc)
                    <th width='2%'>{{$tc->heso}}</th>
               @endforeach
            </tr>
            @foreach($dssv as $sv)               
                @if($sv->manhomthuchien == $manhom)  
                    <tr>
                        <td align="center">{{$sv->mssv}}</td>
                        <td>{{$sv->hoten}}</td>
                        @foreach($dsdiem as $diem)
                            @if($diem->mssv == $sv->mssv)
                                <td align="center">{{$diem->diem}}</td>
                            @endif
                       @endforeach
                        @foreach($tongdiem as $tong) 
                            @if($tong->mssv == $sv->mssv)
                                <td align="center" style="color: #FF0000; font-weight: bold">{{$tong->tongdiem}}</td>
                            @endif                        
                        @endforeach 
                    </tr>
                 @endif
            @endforeach         
        </table>
    </body>
</html>
