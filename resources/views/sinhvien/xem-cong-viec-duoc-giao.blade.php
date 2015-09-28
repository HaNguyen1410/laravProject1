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
                CÔNG VIỆC ĐƯỢC GIAO (Nhóm: {{$manth}})
            </h3>   
            <label style="font-size:14pt;">Tên đề tài: &nbsp;</label>
            <label style="font-size:14pt; color: #178fe5;">{{$tendt->tendt}}</label><br><br>
        </div>         
        <div class="col-md-12">
                    <table class="table table-bordered" border="0" width="1000px" cellpadding="0px" cellspacing="0px" align='center' id="bang1">
                        <tr>
                            <th width="1%">STT</th>
                            <th width="1%">Tuần</th>
                            <th width="15%">Công việc</th>
                            <th width="10%">Giao cho</th>
                            <th width="6%">Ngày bắt đầu</th>
                            <th width="6%">Hạn hoàn tất</th>
                            <th width="4%">Số tuần</th>
                            <th width="4%">Phụ thuộc</th>
                            <th width="5%">Độ ưu tiên</th>
                            <th width="5%">Trạng thái</th>
                            <th width="8%">Tiến độ</th>
                        </tr>                            
                            @foreach($dscv as $stt => $cv)
                                @if($cv->phuthuoc_cv == "0")
                                    <tr style="background-color: #FFEFD5;">
                                        <td align="center">{{$stt + 1}}</td>
                                        <td align="center">{{$cv->tuan}}</td>
                                        <td>
                                            <a style="color: #006400; font-weight: bold;" data-toggle="tooltip" data-placement="bottom" title="Mã công việc: {{$cv->macv}}">
                                                {{$cv->congviec}}
                                            </a>                                            
                                        </td>
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
                                @elseif($cv->phuthuoc_cv != "0")
                                    <tr style="background-color: #FFFFE0;">
                                        <td align="center">{{$stt + 1}}</td>  
                                        <td align="center">{{$cv->tuan}}</td>
                                        <td>
                                            <a style="color: #006400; font-weight: bold;" data-toggle="tooltip" data-placement="bottom" title="Mã công việc: {{$cv->macv}}">
                                                {{$cv->congviec}}
                                            </a>
                                        </td>
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
                                @endif
                            @endforeach
                    </table>
        </div>  <!-- /class="col-md-12" -->                     
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

