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
            $('#container2').highcharts({
                chart: {
                    type: 'column'
                },

                title: {
                    text: 'Biểu đồ thể hiện tiến độ (%) thực hiện công việc của mỗi sinh viên theo tuần'
                },

                xAxis: {
                    categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
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
                    name: 'Tổng ngày làm kế hoạch',
                    data: [5, 3, 4, 7, 2],
                    stack: 'male'
                }, {
                    name: 'Đã làm kế hoạch',
                    data: [3, 4, 4, 2, 5],
                    stack: 'male'
                }, {
                    name: 'Tổng ngày làm thực tế',
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
        <h3 style="color: darkblue; font-weight: bold;" align="center">DANH SÁCH CÔNG VIỆC TRONG NHÓM</h3><br> 
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">ID</th>
                    <th width="2%">Tuần</th>
                    <th width="2%">Tuần làm lại</th>
                    <th width="15%">Công việc</th>
                    <th width="8%">Trạng thái</th>
                    <th width="10%">Giao cho</th>
<!--                    <th width="8%">Bắt đầu <br> (thực tế)</th>
                    <th width="8%">Kết thúc <br> (thực tế)</th>
                    <th width="6%">Số tuần <br> (thực tế)</th>-->
                    <th width="7%">Tiến độ (%)</th>
                    <th width="20%">Nội dung công việc</th>
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
                            <td align="center">{{$cv->tuan}}</td>
                            <td align="center"></td>
                            <td>
                                <a href="?cn=kehoach" style="color: blueviolet;" data-toggle="tooltip" data-placement="bottom" title="Bắt đầu kế hoạch: {{$cv->ngaybatdau_kehoach}} -> Kết thúc kế hoạch:{{$cv->ngayketthuc_kehoach}}">                                
                                    {{$cv->congviec}}
                                </a>
                            </td>
                            <td align="center">{{$cv->trangthai}}</td>
                            <td>{{$cv->giaocho}}</td>
<!--                            <td align="center">{{$cv->ngaybatdau_thucte}}</td>
                            <td align="center">{{$cv->ngayketthuc_thucte}}</td>
                            <td align="center">{{$cv->sotuan_thucte}}</td>-->
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
                @endif
            </table> 
        </div>  <!-- /class="col-md-12" -->  
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

