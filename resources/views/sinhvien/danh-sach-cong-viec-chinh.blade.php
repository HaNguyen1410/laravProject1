@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>
    <script src="{{asset('public/scripts/Highcharts-4.1.7/js/highcharts.js')}}"></script>
    <script src="{{asset('public/scripts/Highcharts-4.1.7/js/modules/exporting.js')}}"></script>   
    <script type="text/javascript">
        $(function () {
            $('#container1').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Biểu độ thể hiện "số tuần" thực hiện của cả nhóm'
                },
                xAxis: {
                    categories: ['Kế hoạch', 'Thực tế']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Số tuần thực hiện'
                    }
                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },
                series: [{
                    name: 'Chưa hoàn thành',
                    data: [4, 3]
                }, {
                    name: 'Hoàn thành',
                    data: [2, 3]
                }]
            });
        });
    </script>
    <script type="text/javascript">    
      $(function () {
            $('#container2').highcharts({
                chart: {
                    type: 'column'
                },

                title: {
                    text: 'Biểu đồ thể hiện tiến độ các công việc chính theo tuần'
                },

                xAxis: {
                    categories: ['GD1', 'GD2', 'GD3', 'GD4', 'GD5']
                },

                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Số tuần thực hiện'
                    }
                },

                tooltip: {
                    formatter: function () {
                        return '<b>' + this.x + '</b><br/>' +
                            this.series.name + ': ' + this.y + '<br/>' +
                            'Total: ' + this.point.stackTotal;
                    }
                },

                plotOptions: {
                    column: {
                        stacking: 'normal'
                    }
                },

                series: [{
                    name: 'Tổng tuần làm kế hoạch',
                    data: [5, 3, 4, 7, 2],
                    stack: 'male'
                }, {
                    name: 'Đã làm kế hoạch',
                    data: [3, 4, 4, 2, 5],
                    stack: 'male'
                }, {
                    name: 'Tổng tuần làm thực tế',
                    data: [2, 5, 6, 2, 1],
                    stack: 'female'
                }, {
                    name: 'Đã làm thực tế',
                    data: [3, 0, 4, 4, 3],
                    stack: 'female'
                }]
            });
        });
    </script>

<div class="container">         

    <div class="row">
        <h3 style="color: darkblue; font-weight: bold;" align="center">DANH SÁCH CÔNG VIỆC CHÍNH (GIAI ĐOẠN) TRONG NHÓM</h3><br> 
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container1" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
        </div>
    <!-- Sơ đồ tiến độ công việc theo tuần -->    
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">ID</th>
                    <th width="3%">Tuần</th>
                    <th width="15%">Công việc</th>
                    <th width="8%">Trạng thái</th>
                    <th width="12%">Giao cho</th>
                    <th width="8%">Bắt đầu <br> (thực tế)</th>
                    <th width="8%">Kết thúc <br> (thực tế)</th>
                    <th width="7%">Số tuần <br> (thực tế)</th>
                    <th width="7%">Tiến độ (%)</th>
                    <th width="20%">Nội dung công việc</th>
                </tr>
                @foreach($dscv as $stt => $cv)  
                    <tr>
                        <td align="center">{{$cv->macv}}</td>
                        <td align="center">{{$cv->tuan}}</td>
                        <td>
                            <a href="{{asset('sinhvien/danhsachcvchinh/danhsachcv/'.$cv->macv)}}" style="color: blueviolet;" data-toggle="tooltip" data-placement="bottom" title="Bắt đầu kế hoạch: {{$cv->ngaybatdau_kehoach}} -> Kết thúc kế hoạch:{{$cv->ngayketthuc_kehoach}}">                                
                                {{$cv->congviec}}
                            </a>
                        </td>
                        <td align="center">{{$cv->trangthai}}</td>
                        <td>{{$cv->giaocho}}</td>
                        <td align="center">{{$cv->ngaybatdau_thucte}}</td>
                        <td align="center">{{$cv->ngayketthuc_thucte}}</td>
                        <td align="center">{{$cv->sotuan_thucte}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                    <span style='color:brown;'>{{$cv->tiendo}}%</span>
                                </div>
                            </div> 
                        </td>
                        <td>{{$cv->noidungthuchien}}</td>
                     </tr>                
                @endforeach
                <tr>
                    <td colspan="10" align="center">{!! $dscv->setPath('danhsachcvchinh')->render() !!}</td>
                </tr> 
            </table> 
        </div>  <!-- /class="col-md-12" -->  
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection
