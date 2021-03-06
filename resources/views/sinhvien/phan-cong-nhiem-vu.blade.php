@extends('sinhvien_home')

@section('content_sv')
        
        <style type="text/css">
                th{
                    text-align: center;
                    color: darkblue;
                    background-color: #dff0d8;
                }
                #bang1 th{
                    text-align: left;                
                    color: darkblue;
                    background-color: #dff0d8;
                }
        </style>

        
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; text-align: center;">
                PHÂN CÔNG THỰC HIỆN ĐỀ TÀI (Mã nhóm: {{$manth}})
            </h3> <br>
            <div class="col-md-12"> 
                <!-- thanh tiến độ thời gian thực hiện -->
                <lable style="display: block; float: left; width: 27%;">
                    Thời gian quy định ({{$tendt->ngaybatdau_kehoach}} - {{$tendt->ngayketthuc_kehoach}}): &nbsp;
                </lable>
                <div class="progress" style="width:70%">
                    <?php 
                        $ngayht = date('Y-m-d');
                        $ngaybd = $tiendonhom->ngaybatdau_kehoach;
                        $ngayhientai = date_create($ngayht);
                        $ngaybatdau_duan = date_create($ngaybd);
                        $tuanht = date_diff($ngayhientai,$ngaybatdau_duan);
                        //Tính số tuần thực hiện dự án mà giảng viên quy định
                        $ngaykt = $tiendonhom->ngayketthuc_kehoach;
                        $ngayketthuc_duan = date_create($ngaykt);
                        $sotuan_duan = date_diff($ngaybatdau_duan,$ngayketthuc_duan);
                        if($tuanht <= $sotuan_duan){
                            $songay_duan = (int)$sotuan_duan->format("%a");
                            $sotuan_duan = (int)($songay_duan/7);
                            $ngaylam = (int)$tuanht->format("%a");
                            $tuan = (int)($ngaylam/7);
                            $phandu = $ngaylam%7;
                            if($phandu > 0){
                                $tuanhientai = $tuan + 1;
                                $t = round(($tuanhientai*100)/$sotuan_duan,2);
                            } 
                            else if($phandu = 0){
                                $tuanhientai = $tuan;
                                $t = round(($tuanhientai*100)/$sotuan_duan,2);
                            }
                            //Tính phần trăm ngày làm
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
                        }else if($tuanht > $sotuan_duan){
                            $antoan = 70;
                            $canhbao = 20;
                            $nguyhiem = 10;
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
                      {{$tiendonhom->tiendo}}%
                    </div>
                </div>
            </div><br><br><br><br>
            <h4 style="color:red; font-weight: bold; border: 2px solid #dff0d8; background-color: #dff0d8; width: 60%">
                <?php echo Session::get('ThongBao'); ?>
            </h4>
            <table class="table" width="800px" cellpadding="0px" cellspacing="0px" id="bang1">
                <tr>
                    <th width="8%">Tên đề tài:</th>
                    <th width="70%">
                        <input type="text" name="txtTenDT" value="{{$tendt->tendt}}" readonly="" class="form-control">
                    </th>
                    <th width="10%" style="text-align: right;">
                        <a href="{{asset('sinhvien/phancv/themcvchinh')}}">
                            <button type="button" name="btnThem" class="btn btn-primary">
                            <img src="{{asset('public/images/add-icon.png')}}">Thêm công việc
                            </button>
                        </a>
                    </th>
                </tr>
            </table>
            <table class="table table-hover" width="800px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="2%">STT</th>
                    <th rowspan="2" width="4%">Tuần</th>
                    <th rowspan="2" width="15%">Tên công việc</th>
                    <th rowspan="2" width="8%">Nội dung thực hiện</th>
                    <th rowspan="2" width="15%">Giao cho</th>
                    <th colspan="2" width="18%">Kế hoạch</th>
                    <th rowspan="2" width="8%">Trạng thái</th>
                    <th rowspan="2" width="6%">Tiến độ<br>(%)</th>
                    <th rowspan="2" width="6%">Thao tác</th>
                </tr>
                <tr>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <!--<th>Số tuần</th>-->
                </tr>
                @if(count($dscvchinh) == 0)
                    <tr>
                        <td colspan="13" align="center">
                            <label style="color: #e74c3c;"> Chưa có công việc nào được phân công!</label> 
                        </td>
                    </tr>
                @elseif(count($dscvchinh) > 0)
                    @foreach($dscvchinh as $stt => $cv)
                        <tr>
                            <td style="vertical-align: middle;"  align="center">
                                <?php 
                                    if(isset($_GET['page'])){
                                        $p = 5*($_GET['page']-1);
                                        echo $stt+1+$p;
                                    }else
                                        echo $stt+1;
                                ?>
                            </td>
                            <td align="center">                                
                                    @if($cv->tuan_lamlai == "")
                                        {{$cv->tuan}}
                                        @foreach($tuanlamlai_cvphu as $lamlai_cvphu) 
                                            @if(($cv->macv == $lamlai_cvphu->phuthuoc_cv) && ($lamlai_cvphu->tuan_lamlai != "") && ($lamlai_cvphu->tuan_lamlai != $cv->tuan_lamlai))
                                               , {{$lamlai_cvphu->tuan_lamlai}}                                                
                                            @endif                                            
                                        @endforeach 
                                    @elseif($cv->tuan_lamlai != "")
                                        {{$cv->tuan}} , {{$cv->tuan_lamlai}}  
                                        @foreach($tuanlamlai_cvphu as $lamlai_cvphu) 
                                            @if(($cv->macv == $lamlai_cvphu->phuthuoc_cv) && ($lamlai_cvphu->tuan_lamlai != "") && ($lamlai_cvphu->tuan_lamlai != $cv->tuan_lamlai))
                                                , {{$lamlai_cvphu->tuan_lamlai}}                                                
                                            @endif                                            
                                        @endforeach 
                                    @endif
                            </td>
                            <td>
                                <label>{{$cv->congviec}}</label>
                            </td>
                            <td align="center">
                                <a href="phancv/phancongchitiet/{{$cv->macv}}" style="color: blueviolet; font-weight: bold;">
                                     Chi tiết
                                </a>
                            </td>
                            <td>{{$cv->giaocho}}</td>
                            <td align="center">{{$cv->ngaybatdau_kehoach}}</td>
                            <td align="center">{{$cv->ngayketthuc_kehoach}}</td>
                            <!--<td align="center">{{$cv->sotuan_kehoach}}</td>-->
                            <td align="center">{{$cv->trangthai}}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                        <span style='color:brown;'>{{$cv->tiendo}}%</span>
                                    </div>
                                </div> 
                            </td>
                            <td style="vertical-align: middle;" align='center'>
                                <a href="phancv/capnhatcvchinh/{{$cv->macv}}">
                                    <img src="{{asset('public/images/edit-icon.png')}}"/>
                                </a>&nbsp &nbsp &nbsp
                                <a onclick="return confirm('Công việc **{{$cv->macv}}** sẽ bị xóa?');" href="phancv/xoacvchinh/{{$cv->macv}}">
                                    <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="12" align="center">{!! $dscvchinh->setPath('phancv')->render() !!}</td>
                    </tr> 
                @endif
            </table>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
        
@endsection