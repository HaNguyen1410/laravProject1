
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
                    <a href="../../cvchinh/{{$tencvchinh->manhomthuchien}}">
                        {{$tencvchinh->macv}} - {{$tencvchinh->congviec}}
                    </a>                     
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
                @foreach($dscvphu as $stt => $cvphu)
                    <tr>
                        <td>{{$stt+1}}</td>
                        <td>{{$cvphu->macv}}</td>
                        <td>
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="Bắt đầu kế hoạch: {{$cvphu->ngaybatdau_kehoach}} -> Kết thúc kế hoạch: {{$cvphu->ngayketthuc_kehoach}}">                                
                                {{$cvphu->congviec}}
                            </a>
                        </td>
                        <td>{{$cvphu->giaocho}}</td>
                        <td>{{$cvphu->ngaybatdau_thucte}}</td>
                        <td>{{$cvphu->ngayketthuc_thucte}}</td>
                        <td>{{$cvphu->sogio_thucte}}</td>
                        <td>{{$cvphu->noidungthuchien}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cvphu->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cvphu->tiendo; ?>%">
                                    <span style="color:brown;">{{$cvphu->tiendo}}%</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>     
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
@endsection