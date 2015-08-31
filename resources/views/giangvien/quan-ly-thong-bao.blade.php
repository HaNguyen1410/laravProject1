@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>

<div class="container">  
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">Quản lý các thông báo</h3> 
            <table class="table table-bordered" cellpadding="15px" cellspacing="10px">
                <th>STT</th>
                <th>Nội dung thông báo</th>
                <th>Thời gian bắt đầu</th>
                <th>Thời hạn kết thúc</th>
                <th>Ngày tạo</th>
                <th>Đóng hệ thống</th>
            </table>
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection