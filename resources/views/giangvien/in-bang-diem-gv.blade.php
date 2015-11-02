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
        <style type="text/css">
            body { 
                font-family: DejaVu Sans, sans-serif;
                font-size: 10;
                margin-left: 50px;
                margin-right: 50px;            
            }            
            th{
                background-color: #9acfea;
            }
            .page-break{
                page-break-after: always;
            }
        </style>
    </head>
     <?php 
        /*========================== Quy điểm số ra điểm chữ ====================*/ 
                function diemchu($d){
                    if($d<=0 && $d<4){
                        return F;
                    }
                    else if($d<=4 || $d<=4.4){
                        return 'D';
                    }
                    else if($d<=4.5 || $d<=4.9){
                        return 'D+';
                    }
                    else if($d<=5.0 || $d<=5.9){
                        return 'C';
                    }
                    else if($d<=6 || $d<=6.9){
                        return 'C+';
                    }
                    else if($d<=7 || $d<=7.9){
                        return 'B';
                    }
                    else if($d<=8 || $d<=8.9){
                        return 'B+';
                    }
                    else     
                        return 'A';
                }    
    ?>
    <body>
        @if($mahp == "all")
            <div>
                <table style="width:100%">
                    <tr>
                        <td width="10%" align="right">
                            <img src="http://localhost/laravProject1/public/images/logo-ctu.jpg" width="70px" height="70px"/>
                        </td>
                        <td>
                            <div>
                                <label>Trường Đại Học Cần Thơ</label><br>
                                <label>Khoa công nghệ thông tin & truyền thông</label>
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
                <h2 align="center" style="margin-bottom: 1px;">KẾT QUẢ NIÊN LUẬN</h2>
                <div align="center">
                    (Học kỳ: <lable style="color: #00c;">{{$hk}}</lable> - Năm học: <lable style="color: #00c;">{{$nam}})</lable>
                </div>
                <br>
                <table border="0" style="width:100%" padding="1px 1px" cellspacing="0px 0px">
                    <tr>
                        <td>Họ và tên cán bộ:<label style="color: #00c; font-weight: bold"> {{$tencb->hoten}} ({{$tencb->macb}}) </label></td>
                        <td width="30%">Nhóm HP:
                            <label style="color: #00c; font-weight: bold">
                                @foreach($gv_hp as $gvhp)
                                    {{$gvhp->tennhomhp}} &nbsp;&nbsp; 
                                @endforeach
                            </label>
                        </td>
                    </tr>
                </table><br>
                <h3 align="center">Danh sách điểm</h3>
                <table border="1" style="width:100%; margin-left: -15px;" padding="1px 1px" cellspacing="0px 0px">            
                    <tr>
                        <th rowspan="2" width="1%">STT</th>
                        <th rowspan="2" width="4%">Tên nhóm HP</th>
                        <th rowspan="2" width="6%">Mã nhóm</th>
                        <th rowspan="2" width="7%">MSSV</th>
                        <th rowspan="2" width="15%">Họ và tên</th>
                        <th rowspan="2" width="5%">Nhóm trưởng</th>
                        <th colspan="{{count($tieuchi)}}" width="14%">Tiêu chí - Điểm tối đa</th>
                        <th rowspan="2" width="4%">Tổng điểm</th>
                        <th rowspan="2" width="4%">Điểm chữ</th>   
                        <th rowspan="2" width="20%">Nhận xét</th>                        
                    </tr>
                    <tr>
                       @foreach($tieuchi as $tc)
                            <th width="4%">[{{$tc->matc}}] - {{$tc->heso}}</th>
                       @endforeach
                    </tr>
                    @foreach($dssv as $stt => $sv) 
                        <tr>
                            <td align="center">{{$stt+1}}</td>
                            <td align="center">{{$sv->tennhomhp}}</td>
                            <td align="center">{{$sv->manhomthuchien}}</td>
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
                                        <td align="center" style="color: #FF0000; font-weight: bold">{{diemchu($tong->tongdiem)}}</td>
                                    @endif 
                                @endif                        
                            @endforeach 
                            @foreach($nhanxet as $nx)
                                @if($nx->mssv == $sv->mssv)
                                    <td style="color: #00008b;">{{$nx->nhanxet}}</td>
                                @endif 
                            @endforeach
                        </tr>
                    @endforeach        
                </table><br>
                <table class="table table-bordered" style="width: 600px;">
                    <tr>
                        <th width="2%">STT</th>
                        <th width="10%">Mã tiêu chí</th>
                        <th width="50%">Nội dung đánh giá</th>
                        <th width="10%">Mức điểm tối đa</th>                        
                    </tr>
                    @foreach($tieuchi as $stt => $tc)
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
                                {{$tencb->hoten}} ({{$tencb->macb}}) 
                            </label>
                        </td>                
                    </tr>
                </table>
            </div>                               
        @elseif($mahp != "all")
            <div>
                <table style="width:100%">
                    <tr>
                        <td width="10%" align="right">
                            <img src="http://localhost/laravProject1/public/images/logo-ctu.jpg" width="70px" height="70px"/>
                        </td>
                        <td>
                            <div>
                                <label>Trường Đại Học Cần Thơ</label><br>
                                <label>Khoa công nghệ thông tin & truyền thông</label>
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
                <h2 align="center" style="margin-bottom: 1px;">KẾT QUẢ NIÊN LUẬN</h2>
                <div align="center">
                    (Học kỳ: <lable style="color: #00c;">{{$hk}}</lable> - Năm học: <lable style="color: #00c;">{{$nam}})</lable>
                </div>
                <br>
                <table border="0" style="width:100%" padding="1px 1px" cellspacing="0px 0px">
                    <tr>
                        <td>Họ và tên cán bộ:<label style="color: #00c; font-weight: bold"> {{$tencb->hoten}} ({{$tencb->macb}}) </label></td>
                        <td width="30%">Nhóm HP:
                            <label style="color: #00c; font-weight: bold">
                                {{DB::table('nhom_hocphan')->where('manhomhp',$mahp)->value('tennhomhp')}}
                            </label>
                        </td>
                    </tr>
                </table><br>
                <h3 align="center">Danh sách điểm</h3>
                <table border="1" style="width:100%; margin-left: -15px;" padding="1px 1px" cellspacing="0px 0px">            
                    <tr>
                        <th rowspan="2" width="1%">STT</th>
                        <th rowspan="2" width="6%">Mã nhóm</th>
                        <th rowspan="2" width="7%">MSSV</th>
                        <th rowspan="2" width="15%">Họ và tên</th>
                        <th rowspan="2" width="6%">Nhóm trưởng</th>
                        <th colspan="{{count($tieuchi)}}" width="14%">Tiêu chí - Điểm tối đa</th>
                        <th rowspan="2" width="4%">Tổng điểm</th>
                        <th rowspan="2" width="4%">Điểm chữ</th>   
                        <th rowspan="2" width="20%">Nhận xét</th>                        
                    </tr>
                    <tr>
                       @foreach($tieuchi as $tc)
                            <th width="4%">[{{$tc->matc}}] - {{$tc->heso}}</th>
                       @endforeach
                    </tr>
                    @foreach($dssv as $stt => $sv) 
                        <tr>
                            <td align="center">{{$stt+1}}</td>
                            <td align="center">{{$sv->manhomthuchien}}</td>
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
                                        <td align="center" style="color: #FF0000; font-weight: bold">{{diemchu($tong->tongdiem)}}</td>
                                    @endif 
                                @endif                        
                            @endforeach 
                            @foreach($nhanxet as $nx)
                                @if($nx->mssv == $sv->mssv)
                                    <td style="color: #00008b;">{{$nx->nhanxet}}</td>
                                @endif 
                            @endforeach
                        </tr>
                    @endforeach        
                </table><br>
                <table class="table table-bordered" style="width: 600px;">
                    <tr>
                        <th width="2%">STT</th>
                        <th width="10%">Mã tiêu chí</th>
                        <th width="50%">Nội dung đánh giá</th>
                        <th width="10%">Mức điểm tối đa</th>                        
                    </tr>
                    @foreach($tieuchi as $stt => $tc)
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
                                {{$tencb->hoten}} ({{$tencb->macb}}) 
                            </label>
                        </td>                
                    </tr>
                </table>
            </div>
        @endif            
    </body>
</html>
