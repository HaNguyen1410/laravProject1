@extends('sinhvien_home')

@section('content_sv')

<!--    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-utf-8" />
    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>
    <!--<link rel="stylesheet" href="{{Asset('public/scripts/Highcharts-4.1.7/api/css/font-awesome.css')}}">-->
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
                        @foreach($dscvchinh as $cv)
                            {
                                name: "<?php echo $cv->congviec;?>",
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
                        @foreach($dscvchinh as $cv)
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
        <h3 style="color: darkblue; font-weight: bold;" align="center">
            DANH SÁCH CÔNG VIỆC CHÍNH (GIAI ĐOẠN) (Mã nhóm: {{$manth}})
        </h3><br>         
    <!-- Sơ đồ tiến độ công việc chính-->    
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container1" style="min-width: 200px; max-width: 900px; height: 350px; margin: 0 auto"></div>
        </div>
    <!-- Thanh tiến trình thời gian và tiến độ công việc cả nhóm -->
        <div class="col-md-12"> 
            <h4 style="color: darkblue; font-weight: bold;">
                Thanh tiến trình thể hiện tiến độ thời gian và công việc của cả nhóm
            </h4>
            <!-- thanh tiến độ thời gian thực hiện -->
            <lable style="display: block; float: left; width: 27%;">Thời gian quy định ({{$tiendonhom->ngaybatdau_kehoach}} - {{$tiendonhom->ngayketthuc_kehoach}}): &nbsp;</lable>
            <div class="progress" style="width:70%">
                <?php 
                    if(count($tuancv) == 0){
                        $antoan = 0;
                        $canhbao = 0;
                        $nguyhiem = 0;
                    }
                    else{
                        $tuancvchinh = $tuancv->tuan;
                        $tachtuan = explode('-', $tuancvchinh);
                        $n = count($tachtuan);
                        $tuanhientai = $tachtuan[$n-1];
                        $tuankh = ($tuanhientai*100)/$tiendonhom->sotuan_kehoach; 
                        $t = round($tuankh,1);      
                        if($t >= 0 && $t <= 70){
                            $antoan = $t;
                            $canhbao = 0;
                            $nguyhiem = 0;
                        }
                        else if($t > 70 && $t <= 90){
                            $antoan = 70;
                            $canhbao = $t-70;
                            $nguyhiem = 0;
                        }
                        else if($t > 90 && $t <= 100){
                            $antoan = 70;
                            $canhbao = 20;
                            $nguyhiem = $t-90;
                        }
                    }                    
                ?>
                <div class="progress-bar progress-bar-success" style="width: {{$antoan}}%">                  
                    {{$antoan}}%
                </div>
                <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{$canhbao}}%">
                  {{$canhbao}}%
                </div>
                <div class="progress-bar progress-bar-danger" style="width: {{$nguyhiem}}%">
                  {{$nguyhiem}}%
                </div>
            </div>
            <!-- thanh tiến độ côg việc -->
            <lable style="display: block; float: left; width: 27%;">Công việc hoàn thành: &nbsp;</lable>
            <div class="progress" style="width:70%">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$tiendonhom->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width: <?= $tiendonhom->tiendo?>%;">
                  {{$tiendonhom->tiendo}}% Complete (success)
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 10px;">
            <label style="display: block; float: left; width: 27%;">In danh sách kế hoạch thực hiện:</label>
            <a href="" target="_blank">
                <button type="button" name="" class="btn btn-success">
                    <img src="{{asset('public/images/printer-icon.png')}}"> In kế hoạch
                </button>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">ID</th>
                    <th width="3%">Tuần</th>
                    <th width="15%">Công việc</th>
                    <th width="8%">Trạng thái</th>
                    <th width="12%">Giao cho</th>
                    <th width="8%">Bắt đầu <br> (Kế hoạch)</th>
                    <th width="8%">Kết thúc <br> (Kế hoạch)</th>
                    <th width="7%">Tiến độ (%)</th>
                    <th width="10%">Nội dung công việc</th>
                </tr>
                @if(count($dscv) == 0)
                    <tr>
                        <td colspan="10" align="center">
                            <label style="color: #e74c3c;"> Chưa có công việc nào được phân công!</label> 
                        </td>
                    </tr>
                @elseif(count($dscv) > 0)
                    @foreach($dscv as $stt => $cv)  
                        <tr>
                            <td align="center">{{$cv->macv}}</td>
                            <td align="center">
                                @if($cv->tuan_lamlai == "")
                                    {{$cv->tuan}}
                                @else
                                    {{$cv->tuan}}, {{$cv->tuan_lamlai}}                                    
                                @endif
                            </td>
                            <td>
                                {{$cv->congviec}}
                            </td>
                            <td align="center">{{$cv->trangthai}}</td>
                            <td>{{$cv->giaocho}}</td>
                            <td align="center">{{$cv->ngaybatdau_kehoach}}</td>
                            <td align="center">{{$cv->ngayketthuc_kehoach}}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                        <span style='color:brown;'>{{$cv->tiendo}}%</span>
                                    </div>
                                </div> 
                            </td>
                            <td align="center">
                                <a href="{{asset('sinhvien/danhsachcvchinh/danhsachcv/'.$cv->macv)}}" style="color: blueviolet; font-weight: bold;">                                
                                    Chi tiết
                                </a>
                                <!--{{$cv->noidungthuchien}}-->
                            </td>
                         </tr>                
                    @endforeach
                @endif
                <tr>
                    <td colspan="10" align="center">{!! $dscv->setPath('danhsachcvchinh')->render() !!}</td>
                </tr> 
            </table> 
        </div>  <!-- /class="col-md-12" -->  
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

