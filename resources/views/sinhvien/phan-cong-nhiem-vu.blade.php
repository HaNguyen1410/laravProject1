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
            <h3 style="color: darkblue; font-weight: bold;">Phân công thực hiện đề tài</h3> 
            <div class="col-md-12"> 
                <!-- thanh tiến độ thời gian thực hiện -->
                <lable style="display: block; float: left; width: 27%;">Thời gian quy định (20/02/2014 - 30/06/2014): &nbsp;</lable>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" style="width: 35%">
                      35% Complete (success)
                    </div>
                    <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%">
                      20% Complete (warning)
                    </div>
                    <div class="progress-bar progress-bar-danger" style="width: 10%">
                      <span class="sr-only">10% Complete (danger)</span>
                    </div>
                </div>
                <!-- thanh tiến độ côg việc -->
                <lable style="display: block; float: left; width: 27%;">Công việc hoàn thành: &nbsp;</lable>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$tiendonhom->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width: <?= $tiendonhom->tiendo?>%;">
                      {{$tiendonhom->tiendo}}%
                    </div>
                </div>
            </div>
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table" width="800px" cellpadding="0px" cellspacing="0px" id="bang1">
                <tr>
                    <th width="8%">Tên đề tài:</th>
                    <th width="70%">
                        <input type="text" name="txtTenDT" value="{{$tendt->tendt}}" readonly="" class="form-control">
                    </th>
                    <th width="10%" style="text-align: right;">
                        <a href="{{asset('sinhvien/phancv/1111317/themcvchinh')}}">
                            <button type="button" name="btnThem" class="btn btn-primary">
                            <img src="{{asset('images/add-icon.png')}}">Thêm công việc
                            </button>
                        </a>
                    </th>
                </tr>
            </table>
            <table class="table table-hover" width="800px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="2%">STT</th>
                    <th rowspan="2" width="3%">ID</th>
                    <th rowspan="2" width="15%">Tên công việc</th>
                    <th rowspan="2" width="10%">Giao cho</th>
                    <th rowspan="2" width="10%">Trạng thái</th>
                    <th colspan="3" width="15%">Thực tế</th>
                    <th rowspan="2" width="3%">Phụ thuộc</th>
                    <th rowspan="2" width="6%">Tiến độ<br>(%)</th>
                    <th rowspan="2" width="6%">Thao tác</th>
                </tr>
                <tr>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Số giờ</th>
                </tr>
                @foreach($dscvchinh as $stt => $cv)
                    <tr>
                        <td>{{$stt+1}}</td>
                        <td>
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="Bắt đầu kế hoạch: {{$cv->ngaybatdau_kehoach}} -> Kết thúc kế hoạch: {{$cv->ngaybatdau_kehoach}}">
                                {{$cv->macv}}
                            </a>
                            
                        </td>
                        <td>
                            <a href="../phancongchitiet/1111317/{{$cv->macv}}" data-toggle="tooltip" data-placement="bottom" title="Nội dung thực hiện: {{$cv->noidungthuchien}}">
                                {{$cv->congviec}}
                            </a>
                        </td>
                        <td>{{$cv->giaocho}}</td>
                        <td>{{$cv->trangthai}}</td>
                        <td>{{$cv->ngaybatdau_thucte}}</td>
                        <td>{{$cv->ngayketthuc_thucte}}</td>
                        <td>{{$cv->sogio_thucte}}</td>
                        <td>{{$cv->phuthuoc_cv}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                    <span style='color:brown;'>{{$cv->tiendo}}%</span>
                                </div>
                            </div> 
                        </td>
                        <td align='center'>
                            <a href="1111317/capnhatcvchinh/{{$cv->macv}}">
                                <img src="{{asset('images/edit-icon.png')}}"/>
                            </a>&nbsp &nbsp &nbsp
                            <a href="">
                                <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
        
@endsection