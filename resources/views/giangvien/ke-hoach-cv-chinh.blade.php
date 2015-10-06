@extends('giangvien_home')

@section('content_gv')

        <script src="{{asset('public/scripts/Highcharts-4.1.7/js/highcharts.js')}}"></script>
        <script src="{{asset('public/scripts/Highcharts-4.1.7/js/modules/data.js')}}"></script>
        <script src="{{asset('public/scripts/Highcharts-4.1.7/js/modules/drilldown.js')}}"></script> 
        <script type="text/javascript">
            $(function () {
                // Create the chart
                $('#container').highcharts({
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Browser market shares. January, 2015 to May, 2015'
                    },
                    subtitle: {
                        text: 'Click the slices to view versions. Source: netmarketshare.com.'
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}: {point.y:.1f}%'
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
                            y: 24.030000000000005,
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
                            y: 0.9100000000000001,
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
                                ["v11.0", 24.13],
                                ["v8.0", 17.2],
                                ["v9.0", 8.11],
                                ["v10.0", 5.33],
                                ["v6.0", 1.06],
                                ["v7.0", 0.5]
                            ]
                        }, {
                            name: "Chrome",
                            id: "Chrome",
                            data: [
                                ["v40.0", 5],
                                ["v41.0", 4.32],
                                ["v42.0", 3.68],
                                ["v39.0", 2.96],
                                ["v36.0", 2.53],
                                ["v43.0", 1.45],
                                ["v31.0", 1.24],
                                ["v35.0", 0.85],
                                ["v38.0", 0.6],
                                ["v32.0", 0.55],
                                ["v37.0", 0.38],
                                ["v33.0", 0.19],
                                ["v34.0", 0.14],
                                ["v30.0", 0.14]
                            ]
                        }, {
                            name: "Firefox",
                            id: "Firefox",
                            data: [
                                ["v35", 2.76],
                                ["v36", 2.32],
                                ["v37", 2.31],
                                ["v34", 1.27],
                                ["v38", 1.02],
                                ["v31", 0.33],
                                ["v33", 0.22],
                                ["v32", 0.15]
                            ]
                        }, {
                            name: "Safari",
                            id: "Safari",
                            data: [
                                ["v8.0", 2.56],
                                ["v7.1", 0.77],
                                ["v5.1", 0.42],
                                ["v5.0", 0.3],
                                ["v6.1", 0.29],
                                ["v7.0", 0.26],
                                ["v6.2", 0.17]
                            ]
                        }, {
                            name: "Opera",
                            id: "Opera",
                            data: [
                                ["v12.x", 0.34],
                                ["v28", 0.24],
                                ["v27", 0.17],
                                ["v29", 0.16]
                            ]
                        }]
                    }
                });
            });
        </script>
        
        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
            }
        </style>

<div class="container">
    <div class="row">
        <h3 style="color: darkblue;font-weight: bold; margin-left: 2%">KẾ HOẠCH CHI TIẾT</h3>
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
                    <th width="10%">Số giờ thực hiện dự án</th>
                    <th width="5%">Trưởng nhóm</th>
                </tr>         
                @foreach($dstv as $stt => $tv)
                <tr>
                    <td style="vertical-align: middle; text-align: center;" rowspan="2">{{$stt+1}}</td>
                    <td align='center'>{{$tv->mssv}}</td>
                    <td align='center'>{{$tv->hoten}}</td>
                    <td align='center'></td>
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
            <div id="container" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto; "></div>                        
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
                            <th rowspan='2' width='15%'>Ngày tạo</th>
                            <th rowspan='2' width='8%'>Trạng thái</th>
                            <th colspan='2' width='15%'>Kế hoạch</th>
                            <th colspan='3' width='25%'>Thực tế</th>
                        </tr>
                        <tr>
                           <th>Bắt đầu</th>
                           <th>Kết thúc</th>
                           <th>Bắt đầu</th>
                           <th>Kết thúc</th>
                           <th>Số tuần</th>
                        </tr>
                        @foreach($dscv as $cv)
                            @if($cv->tuan == $tuan->tuan)  
                                @if($cv->phuthuoc_cv == "0")
                                      <tr style="background-color: #FFFFE0;">
                                         <td rowspan="2" align='center' style="vertical-align: middle; font-weight: bold;">
                                             {{$cv->macv}}
                                         </td>
                                         <td rowspan="2"  style="vertical-align: middle; font-weight: bold;">
                                             {{$cv->congviec}}
                                         </td>
                                         <td>{{$cv->giaocho}}</td>
                                         <td align='center'>{{$cv->ngaytao}}</td>
                                         <td align='center'>{{$cv->trangthai}}</td>
                                         <td align='center'>{{$cv->ngaybatdau_kehoach}}</td>
                                         <td align='center'>{{$cv->ngayketthuc_kehoach}}</td> 
                                         <td align='center'>{{$cv->ngaybatdau_thucte}}</td>
                                         <td align='center'>{{$cv->ngayketthuc_thucte}}</td>                            
                                         <td align='center'>{{$cv->sotuan_thucte}}</td>
                                      </tr>
                                      <tr style="background-color: #FFFFE0;">                                         
                                          <td colspan='78'>
                                            <h5 style='color: darkblue; font-weight:bold;'>Chi tiết công việc:</h5>
                                            {{$cv->noidungthuchien}}
                                          </td> 
                                      </tr>
                                @elseif($cv->phuthuoc_cv != "0")
                                    <tr>
                                         <td rowspan="2" align='center' style="vertical-align: middle; font-weight: bold;">
                                             {{$cv->macv}}
                                         </td>
                                         <td rowspan="2"  style="vertical-align: middle; font-weight: bold;">
                                             {{$cv->congviec}}
                                         </td>
                                         <td>{{$cv->giaocho}}</td>
                                         <td align='center'>{{$cv->ngaytao}}</td>
                                         <td align='center'>{{$cv->trangthai}}</td>
                                         <td align='center'>{{$cv->ngaybatdau_kehoach}}</td>
                                         <td align='center'>{{$cv->ngayketthuc_kehoach}}</td> 
                                         <td align='center'>{{$cv->ngaybatdau_thucte}}</td>
                                         <td align='center'>{{$cv->ngayketthuc_thucte}}</td>                            
                                         <td align='center'>{{$cv->sotuan_thucte}}</td>
                                      </tr>
                                      <tr>                                         
                                          <td colspan='78'>
                                            <h5 style='color: darkblue; font-weight:bold;'>Chi tiết công việc:</h5>
                                            {{$cv->noidungthuchien}}
                                          </td> 
                                      </tr>
                                @endif
                            @endif
                        @endforeach 
                     </table>
                </div>             
             @endforeach
             <div class="col-md-12" align="center">
                 {!! $dstuan->setPath($manth)->render() !!}
             </div>
        </div>
    </div>
</div>

@endsection