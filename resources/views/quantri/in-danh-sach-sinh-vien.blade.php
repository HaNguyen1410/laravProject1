<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="Shortcut Icon" href="{{asset('public/images/logo.ico')}}" type="image/x-icon" />  
        <title>In Danh Sách Sinh Viên</title>
        <style type="text/css">
            body { 
                font-family: DejaVu Sans, sans-serif;
                font-size: 10;
                margin-left: 50px;
                margin-right: 50px;            
            }            
            th{
                background-color: #9acfea;
                text-align: center;
            }
            .page-break{
                page-break-after: always;
            }
        </style>
    </head>
    
    <body>   
        @if($mahp == "all")  
            @foreach($gv_hp as $gvhp)
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
                    <h2 align="center" style="margin-bottom: 1px;">DANH SÁCH SINH VIÊN</h2>
                    <div align="center">
                        (Học kỳ: <lable style="color: #00c; font-weight: bold;">{{$hkht}}</lable> - 
                         Năm học: <lable style="color: #00c; font-weight: bold;">{{$namht}}</lable>)
                    </div>
                    <br><br>
                    <table border="0" style="width:100%" cellpadding="1px 1px" cellspacing="0px 0px">
                        <tr>
                            <td width="20%">Nhóm HP:</td>
                            <td>
                                <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                                    {{$gvhp->tennhomhp}}
                                </label>
                            </td>
                            <td width="25%">Cán bộ phụ trách:</td>
                            <td width="40%">
                                <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                                    {{$gvhp->hoten}} ({{$gvhp->macb}})
                                </label>
                            </td>
                        </tr>
                    </table><br>                    
                    <table border="1" style="width:100%; margin-left: -15px;" cellpadding="4px 8px" cellspacing="0px 0px">            
                        <tr>
                            <th width="1%">STT</th>
                            <th width="4%">MSSV</th>
                            <th width="12%">Họ tên</th>
                            <th width="15%">Email</th>
                            <th width="5%">Nhóm niên luận</th>
                            <th width="4%">Nhóm trưởng</th>
                        </tr> 
                        @foreach($dssv as $stt => $sv)
                            @if($sv->manhomhp == $gvhp->manhomhp)
                                <tr>
                                    <td align='center'>{{$stt+1}}</td>    
                                    <td align='center'>{{$sv->mssv}}</td>
                                    <td>{{$sv->hoten}}</td>
                                    <td>{{$sv->email}}</td>    
                                    <td align='center'>{{$sv->manhomthuchien}}</td>
                                    <td align='center'>
                                        @if($sv->nhomtruong == 1)
                                            <label style="font-weight: bold;">X</label>
                <!--                            <img src="public/images/tick-icon-small .png"/>                        -->
                                        @endif
                                    </td>    
                                </tr>
                            @endif
                        @endforeach
                    </table><br>
                    <table border="0" style="width:300px;" align="right" padding="1px 1px" cellspacing="0px 0px">
                        <tr>
                            <td align="center">
                                <label style="font-weight: bold">Người in</label>         
                            </td>
                        </tr>
                        <tr>                
                            <td align="center">
                                <lable style="font-weight: bold; color: blue;">{{$nguoiin}} ({{$macbqt}})</lable>                
                            </td>
                        </tr>
                    </table>
                </div>             
            
                <div class="page-break"></div><!-- /Break Page -->  
            @endforeach                      
        @elseif($mahp != null || $mahp != 0)
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
                <h2 align="center" style="margin-bottom: 1px;">DANH SÁCH SINH VIÊN</h2>
                <div align="center">
                    (Học kỳ: <lable style="color: #00c; font-weight: bold;">{{$hkht}}</lable> - 
                     Năm học: <lable style="color: #00c; font-weight: bold;">{{$namht}}</lable>)
                </div>
                <br><br>
                <table border="0" style="width:100%" cellpadding="1px 1px" cellspacing="0px 0px">
                    <tr>
                        <td width="20%">Nhóm HP:</td>
                        <td>
                            <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                                {{$gv_hp->tennhomhp}}
                            </label>
                        </td>
                        <td width="25%">Cán bộ phụ trách:</td>
                        <td width="40%">
                            <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                                {{$gv_hp->hoten}} ({{$gv_hp->macb}})
                            </label>
                        </td>
                    </tr>
                </table><br>
                <table border="1" style="width:100%; margin-left: -15px;" cellpadding="4px 8px" cellspacing="0px 0px">            
                    <tr>
                        <th width="1%">STT</th>
                        <th width="4%">MSSV</th>
                        <th width="12%">Họ tên</th>
                        <th width="15%">Email</th>
                        <th width="5%">Nhóm niên luận</th>
                        <th width="4%">Nhóm trưởng</th>
                    </tr> 
                    @foreach($dssv as $stt => $sv)
                        <tr>
                            <td align='center'>{{$stt+1}}</td>    
                            <td align='center'>{{$sv->mssv}}</td>
                            <td>{{$sv->hoten}}</td>
                            <td>{{$sv->email}}</td>    
                            <td align='center'>{{$sv->manhomthuchien}}</td>
                            <td align='center'>
                                @if($sv->nhomtruong == 1)
                                    <label style="font-weight: bold;">X</label>
        <!--                            <img src="public/images/tick-icon-small .png"/>                        -->
                                @endif
                            </td>    
                        </tr>
                    @endforeach
                </table><br>
                <table border="0" style="width:300px;" align="right" padding="1px 1px" cellspacing="0px 0px">
                    <tr>
                        <td align="center">
                            <label style="font-weight: bold">Người in</label>         
                        </td>
                    </tr>
                    <tr>                
                        <td align="center">
                            <lable style="font-weight: bold; color: blue;">{{$nguoiin}} ({{$macbqt}})</lable>                
                        </td>
                    </tr>
                </table>
            </div>
        @endif          
    </body>
</html>
