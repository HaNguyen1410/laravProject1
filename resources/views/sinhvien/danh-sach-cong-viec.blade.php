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
    <script src="{{asset('scripts/Highcharts-4.1.7/js/modules/data.js')}}"></script>
    <script src="{{asset('scripts/Highcharts-4.1.7/js/modules/drilldown.js')}}"></script> 
    <script type="text/javascript">
        $(function () {
            // Create the chart
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Browser market shares. January, 2015 to May, 2015'
                },
                subtitle: {
                    text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total percent market share'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                },

                series: [{
                    name: "Brands",
                    colorByPoint: true,
                    data: [{
                        name: "Microsoft Internet Explorer",
                        y: 56.33,
                        drilldown: "Microsoft Internet Explorer"
                    }, {
                        name: "Chrome",
                        y: 24.03,
                        drilldown: "Chrome"
                    }, {
                        name: "Firefox",
                        y: 10.38,
                        drilldown: "Firefox"
                    }, {
                        name: "Safari",
                        y: 4.77,
                        drilldown: "Safari"
                    }, {
                        name: "Opera",
                        y: 0.91,
                        drilldown: "Opera"
                    }, {
                        name: "Proprietary or Undetectable",
                        y: 0.2,
                        drilldown: null
                    }]
                }],
                drilldown: {
                    series: [{
                        name: "Microsoft Internet Explorer",
                        id: "Microsoft Internet Explorer",
                        data: [
                            [
                                "v11.0",
                                24.13
                            ],
                            [
                                "v8.0",
                                17.2
                            ],
                            [
                                "v9.0",
                                8.11
                            ],
                            [
                                "v10.0",
                                5.33
                            ],
                            [
                                "v6.0",
                                1.06
                            ],
                            [
                                "v7.0",
                                0.5
                            ]
                        ]
                    }, {
                        name: "Chrome",
                        id: "Chrome",
                        data: [
                            [
                                "v40.0",
                                5
                            ],
                            [
                                "v41.0",
                                4.32
                            ],
                            [
                                "v42.0",
                                3.68
                            ],
                            [
                                "v39.0",
                                2.96
                            ],
                            [
                                "v36.0",
                                2.53
                            ],
                            [
                                "v43.0",
                                1.45
                            ],
                            [
                                "v31.0",
                                1.24
                            ],
                            [
                                "v35.0",
                                0.85
                            ],
                            [
                                "v38.0",
                                0.6
                            ],
                            [
                                "v32.0",
                                0.55
                            ],
                            [
                                "v37.0",
                                0.38
                            ],
                            [
                                "v33.0",
                                0.19
                            ],
                            [
                                "v34.0",
                                0.14
                            ],
                            [
                                "v30.0",
                                0.14
                            ]
                        ]
                    }, {
                        name: "Firefox",
                        id: "Firefox",
                        data: [
                            [
                                "v35",
                                2.76
                            ],
                            [
                                "v36",
                                2.32
                            ],
                            [
                                "v37",
                                2.31
                            ],
                            [
                                "v34",
                                1.27
                            ],
                            [
                                "v38",
                                1.02
                            ],
                            [
                                "v31",
                                0.33
                            ],
                            [
                                "v33",
                                0.22
                            ],
                            [
                                "v32",
                                0.15
                            ]
                        ]
                    }, {
                        name: "Safari",
                        id: "Safari",
                        data: [
                            [
                                "v8.0",
                                2.56
                            ],
                            [
                                "v7.1",
                                0.77
                            ],
                            [
                                "v5.1",
                                0.42
                            ],
                            [
                                "v5.0",
                                0.3
                            ],
                            [
                                "v6.1",
                                0.29
                            ],
                            [
                                "v7.0",
                                0.26
                            ],
                            [
                                "v6.2",
                                0.17
                            ]
                        ]
                    }, {
                        name: "Opera",
                        id: "Opera",
                        data: [
                            [
                                "v12.x",
                                0.34
                            ],
                            [
                                "v28",
                                0.24
                            ],
                            [
                                "v27",
                                0.17
                            ],
                            [
                                "v29",
                                0.16
                            ]
                        ]
                    }]
                }
            });
        });
    </script>

<div class="container">         

    <div class="row">
        <h3 style="color: darkblue; font-weight: bold;" align="center">DANH SÁCH CÔNG VIỆC TRONG NHÓM</h3><br> 
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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

