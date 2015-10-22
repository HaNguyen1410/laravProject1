@extends('sinhvien_home')

@section('content_sv')

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
<!-- Cập nhật chi tiết công sức làm dự án của mỗi thành viên -->
            <h4 style="color: darkblue; font-weight: bold;">CHI TIẾT PHÂN CÔNG CHO MỖI THÀNH VIÊN</h4><br>
            <div class="col-md-12" style="background-color:#dff0d8; margin-bottom: 20px; padding: 8px;">
                <label style="color: darkblue; font-size: 13pt;">Thuộc công việc:</label>
                <label style="color: #F65D20;">
                    <a href="{{asset('sinhvien/phancv')}}">
                        <?= $cvchinh->macv ?> - <?= $cvchinh->congviec ?>
                    </a>
                </label>
                 <a href="{{$cvchinh->macv}}/themcvphu" style="margin-left: 40%;">
                    <button type="button" name="btnThem" class="btn btn-primary" style="width:15%;">
                    <img src="{{asset('public/images/add-icon.png')}}">Thêm công việc
                    </button>
                 </a>
            </div>
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-hover table-striped" width="800px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="1%">STT</th>
                    <th rowspan="2" width="4%">Tuần</th>
                    <th rowspan="2" width="15%%">Tên công việc</th>
                    <th rowspan="2" width="15%">Giao cho</th>
                    <th colspan="2" width="15%">Kế hoach</th>
                    <th rowspan="2" width="20%">Chi tiết công việc</th>
                    <th rowspan="2" width="8%">Tiến độ</th>
                    <th rowspan="2" width="6%">Thao tác</th>
                </tr>
                <tr>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <!--<th>Số tuần</th>-->
                </tr>
                @if(count($dscvphu) == 0)
                    <tr>
                        <td colspan="11" align="center">
                            <label style="color: #e74c3c;"> Chưa có công việc nào được phân công!</label> 
                        </td>
                    </tr>
                @elseif(count($dscvphu) > 0)
                    @foreach($dscvphu as $stt => $cvphu)
                        <tr>
                            <td align="center">{{$stt+1}}</td>
                            <td align="center">
                                @if($cvphu->tuan != " ")
                                    {{$cvphu->tuan}}
                                @elseif($cvphu->tuan_lamlai != "")
                                    {{$cvphu->tuan_lamlai}}
                                @endif
                            </td>
                            <td>
                                <a href="" data-toggle="tooltip" data-placement="bottom" title="Mã công việc phụ: {{$cvphu->macv}}">
                                    {{$cvphu->congviec}}
                                </a>                            
                            </td>
                            <td>{{$cvphu->giaocho}}</td>
                            <td align="center">{{$cvphu->ngaybatdau_kehoach}}</td>
                            <td align="center">{{$cvphu->ngayketthuc_kehoach}}</td>
                            <!--<td align="center">{{$cvphu->sotuan_kehoach}}</td>-->
                            <td>{{$cvphu->noidungthuchien}}</td>  
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cvphu->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cvphu->tiendo; ?>%">
                                        <span style='color:brown;'>{{$cvphu->tiendo}}%</span>
                                    </div>
                                </div> 
                            </td>
                            <td align='center'>
                                <a href="{{$cvchinh->macv}}/capnhatcvphu/{{$cvphu->macv}}">
                                    <img src="{{asset('public/images/edit-icon.png')}}"/>
                                </a>&nbsp
                                <a onclick="return confirm('Công việc **{{$cvphu->macv}}** sẽ bị xóa?');" href="{{$cvchinh->macv}}/xoacvphu/{{$cvphu->macv}}">
                                    <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>     
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->

@endsection