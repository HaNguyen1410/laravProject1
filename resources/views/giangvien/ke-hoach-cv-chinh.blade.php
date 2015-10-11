@extends('giangvien_home')

@section('content_gv')

        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
            }
        </style>

        <script src="{{asset('public/scripts/Highcharts-4.1.7/js/highcharts.js')}}"></script>
        <script src="{{asset('public/scripts/Highcharts-4.1.7/js/modules/data.js')}}"></script>
        <script src="{{asset('public/scripts/Highcharts-4.1.7/js/modules/drilldown.js')}}"></script> 
        <script type="text/javascript" charset="UTF-8">
        $(function (transactiosn) {
            // Create the chart
            $('#container1').highcharts({
                chart: {
                    type: 'column',
                    style: {
                        fontFamily: 'Verdana, Arial, Helvetica, sans-serif',
                        color: "red"
                    }
                },
                title: {
                    text: 'Tiến độ các công việc chính của nhóm "{{$manth}}"'
                },
                subtitle: {
                    text: 'Nhấp chuột vào cột để xem tiến độ của các công việc phụ thuộc'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Tiến độ thực hiện công việc chính (%)'
                    }

                },
                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false //Bỏ đường link highchart.com dưới sơ đồ
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%',
                            color: 'green',
                            style: {
                                fontFamily: 'Verdana, Arial, Helvetica, sans-serif'
                            }                            
                        }
                    }
                },                

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                },

                series: [{
                    name: "Công việc chính",
                    colorByPoint: true,
                    data: [
                        @foreach($dscv as $cv)
                            {
                                name: "<?php echo $cv->congviec; ?>",
                                y: {{$cv->tiendo}},
                                drilldown: "<?php echo $cv->congviec; ?>"                        
                            },
                        @endforeach
                    ]                 
                }],
                drilldown: {
                    activeAxisLabelStyle: {
                        textDecoration: 'none',
                        fontFamily: 'Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
                    },
                    activeDataLabelStyle: {
                        textDecoration: 'none',
                        fontStyle: 'italic',
                        color: 'black',
                        fontFamily: 'Verdana, Arial, Helvetica, sans-serif'
                    },
                    series: [
                        @foreach($dscv as $cv)
                            {
                                name: "<?php echo $cv->congviec; ?>",
                                id: "<?php echo $cv->congviec; ?>",
                                data: [
                                    @foreach($dscvphu as $cvphu)
                                        @if($cvphu->phuthuoc_cv == $cv->macv)
                                            ["<?php echo $cv->congviec; ?>", {{$cvphu->tiendo}}],
                                        @endif
                                    @endforeach
                                ] 
                            },
                        @endforeach                
                    ],
                }
            });
        });     
    </script>        

<div class="container">
    <div class="row">
        <h3 style="color: darkblue;font-weight: bold; margin-left: 2%">
            <a href="{{asset('giangvien/theodoikehoach')}}">THEO DÕI KẾ HOẠCH THỰC HIỆN</a>  
                &Gt;
            KẾ HOẠCH CHI TIẾT
        </h3><br>
        <h4 style='color: #398439; margin-left: 10%'>
            Mã nhóm niên luận: <label>{{$manth}}</label>
        </h4>  
        <h4 style='color: #398439; margin-left: 10%'>
            Đề tài thực hiện: <label>{{$tendt->tendt}}</label>
        </h4>            
        <div class="col-md-6">
            <table class="table table-hover" width="500px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">STT</th>
                    <th width="10%">MSSV</th>
                    <th width="20%">Các thành viên</th>
                    <!--<th width="10%">Số giờ thực hiện dự án</th>-->
                    <th width="5%">Trưởng nhóm</th>
                </tr>         
                @foreach($dstv as $stt => $tv)
                <tr>
                    <td style="vertical-align: middle; text-align: center;" rowspan="2">{{$stt+1}}</td>
                    <td align='center'>{{$tv->mssv}}</td>
                    <td align='center'>{{$tv->hoten}}</td>
                    <!--<td align='center'></td>-->
                    <td align='center'>
                        @if($tv->nhomtruong == 1)
                            <img src="{{asset('public/images/check.png')}}"/>
                        @elseif($tv->nhomtruong == 0)
                            <img src="{{asset('public/images/uncheck.png')}}"/>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <lable style="font-weight: bold;">Kỹ năng công nghệ:</lable> {{$tv->kynangcongnghe}} <br>
                        <lable style="font-weight: bold;">Kiến thức lập trình:</lable> {{$tv->kienthuclaptrinh}} <br>
                        <lable style="font-weight: bold;">Kinh nghiệm:</lable> {{$tv->kinhnghiem}} <br>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-6" style="background-color: #dff0d8;">
            <div id="container1" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto; "></div>                        
        </div>

  <!-- Danh sách chi tiết các công việc -->      
        <div class="col-md-12">            
             @foreach($dstuan as $tuan)
                <div class="col-md-12">
                    <h4 style="color: #c7254e;">
                        <img src="{{asset('public/images/box-icon1.png')}}"/>&nbsp; Tuần &nbsp;
                        {{$tuan->tuan}}                        
                    </h4>   
                    <table class="table table-hover" width='800px' align='center'>
                        <tr>
                            <th rowspan='2' width='2%'>ID</th>
                            <th rowspan='2' width='15%'>Công việc</th>
                            <th rowspan='2' width='15%'>Giao cho</th>  
                            <th rowspan='2' width='4%'>Tuần làm lại</th>
                            <th rowspan='2' width='15%'>Ngày tạo</th>
                            <th rowspan='2' width='8%'>Trạng thái</th>
                            <th rowspan='2' width='8%'>Tiến độ</th>
                            <th colspan='2' width='15%'>Kế hoạch</th>
                        </tr>
                        <tr>
                           <th>Bắt đầu</th>
                           <th>Kết thúc</th>
                        </tr>
                        @foreach($dscv as $cv)
                            @if($cv->tuan == $tuan->tuan)  
                                <tr>
                                    <td rowspan="2" align='center' style="vertical-align: middle; font-weight: bold;">
                                        {{$cv->macv}}
                                    </td>
                                    <td rowspan="2"  style="vertical-align: middle; font-weight: bold;">
                                        <a href="{{$manth}}/cvphuthuoc/{{$cv->macv}}">{{$cv->congviec}}</a>                                        
                                    </td>
                                    <td>{{$cv->giaocho}}</td>
                                    <td align='center'>{{$cv->tuan_lamlai}}</td>
                                    <td align='center'>{{$cv->ngaytao}}</td>
                                    <td align='center'>{{$cv->trangthai}}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                                <span style="color:brown;">{{$cv->tiendo}}%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td align='center'>{{$cv->ngaybatdau_kehoach}}</td>
                                    <td align='center'>{{$cv->ngayketthuc_kehoach}}</td>   
                                 </tr>
                                 <tr>                                         
                                     <td colspan='8'>
                                       <h5 style='color: darkblue; font-weight:bold;'>Chi tiết công việc:</h5>
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$cv->noidungthuchien}}
                                     </td> 
                                 </tr>
                            @endif
                        @endforeach 
                     </table>
                </div>             
             @endforeach             
        </div>
    </div>
</div>

@endsection