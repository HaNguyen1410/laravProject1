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
        <h3 style="color: darkblue; font-weight: bold;" align="center">DANH SÁCH CÔNG VIỆC TRONG NHÓM</h3><br>
        <div class="col-md-12">
            <table class="table table-bordered" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">ID</th>
                    <th width="15%">Công việc <br>
                        <input type="text" value="" class="form-control">
                    </th>
                    <th width="14%">Trạng thái <br>
                        <select name="" class="form-control">
                            <option value="1">Tất cả</option>
                            <option value="2">Hoàn thành</option>
                            <option value="3">Sắp làm</option>
                            <option value="4">Đang làm</option>
                        </select>
                    </th>
                    <th width="10%">Giao cho</th>
                    <th width="8%">Bắt đầu <br> (kế hoạch)</th>
                    <th width="8%">Kết thúc <br> (kế hoạch)</th>
                    <th width="8%">Bắt đầu <br> (thực tế)</th>
                    <th width="8%">Kết thúc <br> (thực tế)</th>
                    <th width="7%">Số giờ <br> (thực tế)</th>
                    <th>%</th>
                    <th width="20%">Nội dung công việc</th>
                </tr>
                @foreach($dscv as $stt => $cv)
                    <tr>
                        <td>{{$cv->macv}}</td>
                        <td>{{$cv->congviec}}</td>
                        <td>{{$cv->trangthai}}</td>
                        <td>{{$cv->giaocho}}</td>
                        <td>{{$cv->ngaybatdau_kehoach}}</td>
                        <td>{{$cv->ngayketthuc_kehoach}}</td>
                        <td>{{$cv->ngaybatdau_thucte}}</td>
                        <td>{{$cv->ngayketthuc_thucte}}</td>
                        <td>{{$cv->sogio_thucte}}</td>
                        <td>{{$cv->tiendo}}</td>
                        <td>{{$cv->noidungthuchien}}</td>
                    </tr>
                @endforeach

            </table> 
        </div>  <!-- /class="col-md-12" -->                     
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

