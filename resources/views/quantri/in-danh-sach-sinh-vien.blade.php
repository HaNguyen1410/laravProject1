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
            @page {size: landscape;}
        </style>
    </head>
    
    <body>       
        <h2 align="center" style="margin-bottom: 1px;">DANH SÁCH SINH VIÊN</h2>
        <div align="center">
            (Học kỳ: <lable style="color: #00c;"></lable> - Năm học: <lable style="color: #00c;">)</lable>
        </div>
        <br><br>
        <table border="0" style="width:100%" cellpadding="1px 1px" cellspacing="0px 0px">
            <tr>
                <th width="25%">Cán bộ phụ trách:</th>
                <td width="40%">
                    <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                        
                    </label>
                </td>
                <th width="20%">Nhóm HP:</th>
                <td>
                    <label style="color: #00c; font-weight: bold; margin-left: 10px;"> 
                        
                    </label>
                </td>
            </tr>
        </table><br>
        <table border="1" style="width:100%; margin-left: -15px;" cellpadding="4px 8px" cellspacing="0px 0px">            
            <tr>
                <th width="1%">STT</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Nhóm niên luận</th>
                <th>Nhóm trưởng</th>
            </tr>           
            <tr>
                <td>1</td>    
                <td></td>
                <td></td>    
                <td></td>
                <td></td>    
                <td></td>
            </tr>
        </table><br>
        <table border="0" style="width:300px;" align="right" padding="1px 1px" cellspacing="0px 0px">
            <tr>
                <td align="center">
                    <label style="font-weight: bold">Người in</label>
                </td>             
            </tr>
        </table>
    </body>
</html>
