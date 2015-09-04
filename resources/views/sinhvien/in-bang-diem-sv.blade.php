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
                        <label>Ngày in</label>
                    </div>
                </td>
            </tr>
        </table>
        
        <h2 align="center" style="margin-bottom: 1px;">KẾT QUẢ THỰC HIỆN ĐỀ TÀI NIÊN LUẬN</h2>
        <div align="center"><lable>(Học kỳ: - Năm học: )</lable></div>
        
        <table border="1" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">
            <tr>
                <td colspan="2"><label>Tên đề tài: </label></td>
            </tr>
            <tr>
                <td>Mã nhóm thực hiện: </td>
                <td>Nhóm HP: </td>
            </tr>
        </table><br>
        <h3 align="center">Danh sách điểm</h3>
        <table border="1" style="width:100%"  padding="1px 1px" cellspacing="0px 0px">            
            <tr>
                <th rowspan="2" width="1%">STT</th>
                <th rowspan="2" width="8%">MSSV</th>
                <th rowspan="2" width="15%">Họ và tên</th>
                <th colspan="4" width="30%">Hệ số</th>
                <th rowspan="2" width="4%">Tổng điểm</th>
                <th rowspan="2" width="4%">Điểm chữ</th>                         
            </tr>
            <tr>
                <th width="2%">hs1</th>   
                <th width="2%">hs2</th>
                <th width="2%">hs3</th>
                <th width="2%">hs4</th>
            </tr>
            <tr>
                <td align="center">1</td>
                <td align="center">12345</td>
                <td>Mười Giờ</td>
                <td>1</td>     
                <td>2</td>
                <td>3</td> 
                <td>4</td> 
                <td></td> 
                <td></td> 
            </tr>        
        </table>
    </body>
</html>
