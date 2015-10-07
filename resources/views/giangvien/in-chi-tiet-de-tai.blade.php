<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="Shortcut Icon" href="{{asset('public/images/logo.ico')}}" type="image/x-icon" />  
        <title>In Chi Tiết Đề Tài</title>
        <style type="text/css">
            body { 
                font-family: DejaVu Sans, sans-serif;
                font-size: 10;
                margin-left: 50px;
                margin-right: 50px;            
            }            
            th{
                background-color: #9acfea;
                text-align: right;
            }
            @page {size: landscape;}
        </style>
    </head>
    
    <body>       
        <h2 align="center" style="margin-bottom: 1px;">CHI TIẾT ĐỀ TÀI</h2>
        <div align="center">
            (Học kỳ: <lable style="color: #00c;">{{$nk->hocky}}</lable> - Năm học: <lable style="color: #00c;">{{$nk->nam}})</lable>
        </div>
        <br>
        <table border="0" style="width:100%" cellpadding="1px 1px" cellspacing="0px 0px">
            <tr>
                <th width="20%">Họ và tên cán bộ:</th>
                <td>
                    <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                        {{$tencb->hoten}} ({{$tencb->macb}})
                    </label>
                </td>
            </tr>
            <tr>
                <th>Tên đề tài:</th>
                <td>
                    <label style="color: #00c; margin-left: 10px;"> 
                        {{$detai->tendt}}
                    </label>
                </td>
            </tr>
            <tr>
                <th>Số sinh viên thực hiện (tối đa):</th>
                <td>
                    <label style="color: #00c; margin-left: 10px; font-weight: bold;"> 
                        {{$detai->songuoitoida}} Người.
                    </label>
                </td>
            </tr>
        </table><br>
        <h3 style="text-align: center; font-weight: bold;">Thông tin chi tiết</h3>
        <table border="1" style="width:100%; margin-left: -15px;" cellpadding="4px 8px" cellspacing="0px 0px">            
            <tr>
                <th width="20%">Mô tả đề tài:</th>
                <td>{{$detai->motadt}}</td>                                       
            </tr>
            <tr>
                <th width="10%">Công nghệ thực hiện:</th>
                <td>{{$detai->congnghe}}</td>                                       
            </tr>   
            <tr>
                <th width="10%">Lưu ý:</th>
                <td>{{$detai->ghichudt}}</td>                                       
            </tr> 
        </table>
    </body>
</html>
