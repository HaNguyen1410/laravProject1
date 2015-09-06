@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>
    <script src="{{asset('scripts/Highcharts-4.1.7/js/highcharts.js')}}"></script>
    <script src="{{asset('scripts/Highcharts-4.1.7/js/modules/exporting.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#container1').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Stacked bar chart'
                },
                xAxis: {
                    categories: ['Apples', 'Oranges']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total fruit consumption'
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
                    name: 'John',
                    data: [4, 3]
                }, {
                    name: 'Jane',
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
                    text: 'Total fruit consumtion, grouped by gender'
                },

                xAxis: {
                    categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
                },

                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Number of fruits'
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
                    name: 'John',
                    data: [5, 3, 4, 7, 2],
                    stack: 'male'
                }, {
                    name: 'Joe',
                    data: [3, 4, 4, 2, 5],
                    stack: 'male'
                }, {
                    name: 'Jane',
                    data: [2, 5, 6, 2, 1],
                    stack: 'female'
                }, {
                    name: 'Janet',
                    data: [3, 0, 4, 4, 3],
                    stack: 'female'
                }]
            });
        });
    </script>

<div class="container">         

    <div class="row">
        <h3 style="color: darkblue; font-weight: bold;" align="center">DANH SÁCH CÔNG VIỆC TRONG NHÓM</h3><br> 
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container1" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
        </div>
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
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
                    <th width="8%">Bắt đầu <br> (thực tế)</th>
                    <th width="8%">Kết thúc <br> (thực tế)</th>
                    <th width="7%">Số giờ <br> (thực tế)</th>
                    <th>%</th>
                    <th width="20%">Nội dung công việc</th>
                </tr>
                @foreach($dscv as $stt => $cv)
                    <tr>
                        <td>{{$cv->macv}}</td>
                        <td>
                            <a href="?cn=kehoach" data-toggle="tooltip" data-placement="bottom" title="Bắt đầu kế hoạch: {{$cv->ngaybatdau_kehoach}} -> Kết thúc kế hoạch:{{$cv->ngayketthuc_kehoach}}">                                
                                {{$cv->congviec}}
                            </a>
                        </td>
                        <td>{{$cv->trangthai}}</td>
                        <td>{{$cv->giaocho}}</td>
                        <td>{{$cv->ngaybatdau_thucte}}</td>
                        <td>{{$cv->ngayketthuc_thucte}}</td>
                        <td>{{$cv->sogio_thucte}}</td>
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
                    <td colspan="9" align="center">{!! $dscv->setPath('danhsachcv/1111317')->render() !!}</td>
                </tr> 
            </table> 
        </div>  <!-- /class="col-md-12" -->  
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

