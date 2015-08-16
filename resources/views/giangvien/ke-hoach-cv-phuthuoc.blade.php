
@extends('giangvien_home')

@section('content_gv')

        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
            }
            #bang1 th{
                text-align: left;                
                color: darkblue;
                background-color: #dff0d8;
            }
        </style>
    

<div class="container">
    <div class="row">
        <div class="col-md-12">                    
            <h4 style="color: darkblue; font-weight: bold;">KẾ HOẠCH CÔNG VIỆC PHỤ THUỘC</h4><br>
            <div class="col-md-12">
                <label style="color: darkblue;">Thuộc công việc:</label>
                <label style="color: #F65D20;">
                    <?php echo "<a href='?cn=kehoachcvchinh&id_nth=$manth'>".$macv; ?> -  <?php echo $khchinh['congviec']."</a>"; ?> 
                </label>
            </div>
            <table class="table table-hover" width="800px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="2%">STT</th>
                    <th rowspan="2" width="3%">ID</th>
                    <th rowspan="2" width="15%%">Tên công việc</th>
                    <th rowspan="2" width="15%">Giao cho</th>
                    <th colspan="3" width="20%">Thực tế</th>
                    <th rowspan="2" width="20%">Chi tiết công việc</th>
                    <th rowspan="2" width="8%">Tiến độ</th>
                </tr>
                <tr>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Số giờ</th>
                </tr>
                
            </table>     
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
@endsection