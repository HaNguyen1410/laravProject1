<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Chọn đề tài</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
        <script src="../../../bootstrap/js/jquery-1.11.3.min.js"></script>
        <script src="../../../bootstrap/js/bootstrap.min.js"></script> 
        
        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }

        </style>
    </head>
    
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: darkblue; font-weight: bold;" align='center'>
                        Danh sách đề tài niên luận 
                    </h3> 
                    <form action="" method="post">
                        <table class="table table-bordered table-hover" style="margin-top: 5%;">
                            <tr>
                                <th>STT</th>
                                <th width="15%">Tên đề tài</th>
                                <th>Số người tối đa</th>
                                <th width="25%">Môt tả</th>
                                <th>Công nghệ sử dụng</th>
                                <th>Trạng thái</th>
                            </tr>
                            @foreach($dsdtHocPhan as $stt => $dt)
                                 <tr>
                                    <td align="center">{{$stt+1}}</td>
                                    <td>
                                        {{$dt->tendt}}<br>
                                        <input type="text" size="5" name="txtMaDeTai" value="{{$dt->madt}}"/>
                                    </td>
                                    <td align="center">{{$dt->songuoitoida}}</td>
                                    <td>{{$dt->motadt}}</td>
                                    <td>{{$dt->congnghe}}</td>
                                    <td align="center">
                                        <input type="submit" id="btnDangKy" name="btnDangKy" value="Đăng ký" class="btn btn-success"/>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </form>
                </div>
            </div>
        </div>        
    </body>
</html>
