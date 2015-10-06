@extends('sinhvien_home')

@section('content_sv')
 
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
            <h3 style="color: darkblue; font-weight: bold;" align="center">
                Kết quả tìm kiếm ({{$hoten}}: {{$manth}})
            </h3>   
            
            <p style="color:red;"><?php echo Session::get('BaoLoi'); ?></p>
        </div>         
        <div class="col-md-12">
                    <table class="table table-bordered" border="0" width="1000px" cellpadding="0px" cellspacing="0px" align='center' id="bang1">
                        <tr>
                            <th width="1%">STT</th>
                            <th width="1%">Tuần</th>
                            <th width="15%">Công việc</th>
                            <th width="6%">Ngày bắt đầu</th>
                            <th width="6%">Hạn hoàn tất</th>
                            <th width="4%">Số tuần</th>
                            <th width="4%">Phụ thuộc</th>
                            <th width="5%">Độ ưu tiên</th>
                            <th width="5%">Trạng thái</th>
                            <th width="8%">Tiến độ</th>
                        </tr>                            
                            
                    </table>
        </div>  <!-- /class="col-md-12" -->                     
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

