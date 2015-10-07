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
                    name: 'Tổng tuần làm kế hoạch {{$manth}}',
                    data: [5, 3, 4, 7, 2],
                    stack: 'male'
                }, {
                    name: 'Đã làm kế hoạch',
                    data: [3, 4, 4, 2, 5],
                    stack: 'male'
                }, {
                    name: 'Tổng tuần làm thực tế',
                    data: [6, 5, 6, 2, 1],
                    stack: 'female'
                }, {
                    name: 'Đã làm thực tế',
                    data: [7, 0, 4, 4, 3],
                    stack: 'female'
                }]
            });
        });
    </script>

<div class="container">         

    <div class="row">
        <h4 style="color: darkblue; font-weight: bold;" align="center">
            Danh sách công việc chính (giai đoạn) (Mã nhóm: {{$manth}})
        </h4><br>         
    <!-- Sơ đồ tiến độ công việc theo tuần -->    
        <div class="col-md-12" style="border:1px solid tomato; margin-bottom: 20px;">
            <div id="container2" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
        </div>
    <!---->
        <div class="col-md-12"> 
            <h4 style="color: darkblue; font-weight: bold;">
                Thanh tiến trình thể hiện tiến độ thời gian và công việc của cả nhóm
            </h4>
            <!-- thanh tiến độ thời gian thực hiện -->
            <lable style="display: block; float: left; width: 27%;">Thời gian quy định (20/02/2014 - 30/06/2014): &nbsp;</lable>
            <div class="progress" style="width:70%">
                <?php 
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
                ?>
                <div class="progress-bar progress-bar-success" style="width: {{$antoan}}%">                  
                    {{$antoan}}% Complete (success) {{$tuanhientai}}
                </div>
                <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{$canhbao}}%">
                  {{$canhbao}}% (warning)
                </div>
                <div class="progress-bar progress-bar-danger" style="width: {{$nguyhiem}}%">
                  {{$nguyhiem}}% (danger)
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
        <div class="col-md-12">
            <table class="table table-bordered table-striped" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">ID</th>
                    <th width="3%">Tuần</th>
                    <th width="3%">Tuần làm lại</th>
                    <th width="15%">Công việc</th>
                    <th width="8%">Trạng thái</th>
                    <th width="12%">Giao cho</th>
<!--                    <th width="8%">Bắt đầu <br> (thực tế)</th>
                    <th width="8%">Kết thúc <br> (thực tế)</th>-->
                    <!--<th width="7%">Số tuần <br> (thực tế)</th>-->
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
                                <a href="{{asset('sinhvien/danhsachcvchinh/danhsachcv/'.$cv->macv)}}" style="color: blueviolet;" data-toggle="tooltip" data-placement="bottom" title="Bắt đầu kế hoạch: {{$cv->ngaybatdau_kehoach}} -> Kết thúc kế hoạch:{{$cv->ngayketthuc_kehoach}}">                                
                                    {{$cv->congviec}}
                                </a>
                            </td>
                            <td align="center">{{$cv->trangthai}}</td>
                            <td>{{$cv->giaocho}}</td>
<!--                            <td align="center">{{$cv->ngaybatdau_thucte}}</td>
                            <td align="center">{{$cv->ngayketthuc_thucte}}</td>-->
                            <!--<td align="center">{{$cv->sotuan_thucte}}</td>-->
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
                <tr>
                    <td colspan="10" align="center">{!! $dscv->setPath('danhsachcvchinh')->render() !!}</td>
                </tr> 
            </table> 
        </div>  <!-- /class="col-md-12" -->  
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

