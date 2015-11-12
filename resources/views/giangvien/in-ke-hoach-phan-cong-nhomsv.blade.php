<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="Shortcut Icon" href="{{asset('public/images/logo.ico')}}" type="image/x-icon" />  
        <title>Giảng Viên In Kế Hoạch Phân Công Trong Một Nhóm Niên Luận</title>
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
        
        <h2 align="center" style="margin-bottom: 1px;">KẾ HOẠCH THỰC HIỆN ĐỀ TÀI NIÊN LUẬN</h2>
        <div align="center">
            (Học kỳ: <lable style="color: #00c;">{{$hkht}}</lable> - Năm học: <lable style="color: #00c;">{{$namht}})</lable>
        </div>
        <br>
        <table border="0" style="width:100%"  padding="1px 1px" cellspacing="0px 0px"> 
            <tr>
                <td width="17%">Giảng viên hướng dẫn:</td>
                <td>
                    <label style="color: #00c;">
                        {{$gv->hoten}} ({{$gv->macb}})
                    </label>
                </td>
                <td>Email:</td>
                <td>
                    <label style="color: #00c;">
                        {{$thongtin->email}}
                    </label>
                </td>
            </tr>
            <tr>
                <td>Nhóm trưởng:</td>
                <td>
                    <label style="color: #00c;">
                        {{$thongtin->hoten}} ({{$thongtin->mssv}})
                    </label>
                </td>
                <td>Email:</td>
                <td>
                    <label style="color: #00c;">
                        {{$thongtin->email}}
                    </label>
                </td>
            </tr>
            <tr>
                <td>Tên đề tài:</td>
                <td colspan="3">
                    <label style="color: #00c;">
                        {{$thongtin->tendt}}
                    </label>
                </td>
            </tr>
            <tr>
                <td>Mã nhóm:</td>
                <td><label style="color: #00c; font-weight: bold">{{$manth}}</label></td>
                <td width="10%">Nhóm HP: </td>
                <td><label style="color: #00c; font-weight: bold">{{$thongtin->tennhomhp}}</label></td>
            </tr>
        </table><br>
        <h3 align="center">Danh sách công việc</h3>
        <table class="table table-bordered" border="1" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">            
            <tr>
                <th rowspan="2" width="4%">Tuần</th>  
                <th rowspan="2" width="4%">Mã công việc</th> 
                <th rowspan="2" width="15%">Tên công việc</th>
                <th rowspan="2" width="15%">Giao cho</th>
                <th colspan="2" width="15%">Kế hoạch</th>
                <th rowspan="2" width="20%">Nội dung</th>  
                <th rowspan="2" width="4%">Phụ thuộc công việc</th>                
            </tr>
            <tr>               
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>              
            </tr>
            @foreach($dscv as $cv)
            @if($cv->phuthuoc_cv == 0)
                <tr style="background-color: #EDF2F7">
                    <td align='center'>
                        @if($cv->tuan_lamlai == "")
                            {{$cv->tuan}}
                        @else
                            {{$cv->tuan}}, {{$cv->tuan_lamlai}}                                    
                        @endif                    
                    </td>
                    <td align='center'>{{$cv->macv}}</td>
                    <td>{{$cv->congviec}}</td>
                    <td align='center'>{{$cv->giaocho}}</td>
                    <td align='center'>{{$cv->ngaybatdau_kehoach}}</td>
                    <td align='center'>{{$cv->ngayketthuc_kehoach}}</td>
                    <td>{{$cv->noidungthuchien}}</td>
                    <td align='center'>{{$cv->phuthuoc_cv}}</td>
                </tr>
            @else
                <tr>
                    <td align='center'>
                        @if($cv->tuan_lamlai == "")
                            {{$cv->tuan}}
                        @else
                            {{$cv->tuan}}, {{$cv->tuan_lamlai}}                                    
                        @endif                    
                    </td>
                    <td align='center'>{{$cv->macv}}</td>
                    <td>{{$cv->congviec}}</td>
                    <td align='center'>{{$cv->giaocho}}</td>
                    <td align='center'>{{$cv->ngaybatdau_kehoach}}</td>
                    <td align='center'>{{$cv->ngayketthuc_kehoach}}</td>
                    <td>{{$cv->noidungthuchien}}</td>
                    <td align='center'>{{$cv->phuthuoc_cv}}</td>
                </tr>
            
            @endif            
            @endforeach       
        </table><br>        
        <table border="0" style="width:500px;" align="right" padding="1px 1px" cellspacing="0px 0px">
            <tr>
                <td align="center">
                    <label style="font-weight: bold">Người in</label>
                </td>             
            </tr>
            <tr>
                <td align="center">
                    <label style="color: #00c; font-weight: bold">
                         {{Auth::user()->name}} ({{Auth::user()->taikhoan}})
                    </label>
                </td>                
            </tr>
        </table>
    </body>
</html>
