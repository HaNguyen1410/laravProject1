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
                            @foreach($dscv as $cv)
                                <tr>
                                    <td></td>
                                    <td>{{$cv->congviec}}</td>
                                    <td>{{$cv->giaocho}}</td>
                                    <td>{{$cv->ngaybatdau_kehoach}}</td>
                                    <td>{{$cv->ngayketthuc_kehoach}}</td>
                                    <td>{{$cv->sogio_thucte}}</td>
                                    <td>{{$cv->phuthuoc_cv}}</td>
                                    <td>{{$cv->uutien}}</td>
                                    <td>{{$cv->trangthai}}</td>
                                    <td>{{$cv->tiendo}}</td>
                                </tr>
                            @endforeach
                        <tr>
                            <td colspan="10">{!! $dscv->setPath('xemviecduocgiao')->render() !!}</td>
                        </tr>
                    </table>
        </div>  <!-- /class="col-md-12" -->                     
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

