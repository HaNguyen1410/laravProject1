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
            <h3 style="color: darkblue; font-weight: bold;" align="center">CÔNG VIỆC ĐƯỢC GIAO</h3><br>            
        </div>          
        <div class="col-md-12">
                    <table class="table table-bordered" border="0" width="1000px" cellpadding="0px" cellspacing="0px" align='center' id="bang1">
                        <tr>
                            <th width="1%">STT</th>
                            <th width="15%">Công việc</th>
                            <th width="8%">Giao cho</th>
                            <th width="6%">Ngày bắt đầu</th>
                            <th width="6%">Hạn hoàn tất</th>
                            <th width="4%">Thời gian</th>
                            <th width="4%">Phụ thuộc</th>
                            <th width="5%">Độ ưu tiên</th>
                            <th width="5%">Trạng thái</th>
                            <th width="8%">Tiến độ</th>
                        </tr>                            
                            @foreach($dscv as $stt => $cv)
                                <tr>
                                    <td align="center">{{$stt + 1}}</td>
                                    <td>{{$cv->congviec}}</td>
                                    <td>{{$cv->giaocho}}</td>
                                    <td align="center">{{$cv->ngaybatdau_kehoach}}</td>
                                    <td align="center">{{$cv->ngayketthuc_kehoach}}</td>
                                    <td align="center">{{$cv->sotuan_thucte}}</td>
                                    <td align="center">{{$cv->phuthuoc_cv}}</td>
                                    <td align="center">{{$cv->uutien}}</td>
                                    <td align="center">{{$cv->trangthai}}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                                <span style='color:brown;'>{{$cv->tiendo}}%</span>
                                            </div>
                                        </div>                                          
                                    </td>
                                </tr>
                            @endforeach
                    </table>
        </div>  <!-- /class="col-md-12" -->                     
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

