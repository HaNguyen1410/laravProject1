@extends('giangvien_home')

@section('content_gv')

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
            <h3 style="color: darkblue; font-weight: bold;">Theo dõi kế hoạch thực hiện đề tài</h3> 
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th align="right">Năm học:</th>
                    <th width="20%">
                        <select class="form-control" name='cbNamHoc'>
                            @foreach($namhoc as $nk)
                            <option value="{{$nk->nam}}">{{$nk->nam}}</option>  
                            @endforeach
                        </select>
                    </th>
                    <th align="right">Học kỳ:</th>
                    <th width="10%">
                        <select class="form-control" name='cbHocKy'>
                            @foreach($hocky as $nk)
                            <option value="{{$nk->hocky}}">{{$nk->hocky}}</option>  
                            @endforeach
                        </select>
                    </th>
                    <th align="right">Nhóm học phần:</th>
                    <th>
                        <select class="form-control" name='cbNhomHP'>
                            @foreach($nhomhp as $hp)
                            <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>  
                            @endforeach
                        </select>
                    </th>
                </tr>
            </table>
            <table class="table table-bordered table-hover" width="800px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th width="1%">STT</th>
                    <th width="5%">Mã nhóm</th>
                    <th width="20%">Tên đề tài</th>
                    <th width="10%">Trưởng nhóm</th>
                    <th width="15%">Tổ chức nhóm</th>
                    <th width="4%">Lịch họp</th>
                    <th width="6%">Thời gian làm dự án</th>
                    <th width="10%">Trạng thái(%)</th>
                </tr>
                
                @foreach($dsdtnhom as $stt => $dtn)                
                    <tr>
                        <td align='center'>{{$stt+1}}</td>
                        <td align='center'>{{$dtn->manhomthuchien}}</td>
                        <td><a href="cvchinh/{{$dtn->manhomthuchien}}">{{$dtn->tendt}}</a></td>
                        <td>{{$dtn->hoten}}</td>
                        <td>{{$dtn->tochucnhom}}</td>
                        <td align='center'>                            
                           <?php
                                $b = "";
                                $buoi = substr($dtn->lichhop, 0,1);
                                $bs = strcasecmp($buoi, 'S');
                                $bc = strcasecmp($buoi, 'C');

                                if($bs == 0){
                                    echo $b="Sáng thứ "; 
                                }
                                else if($bc == 0){
                                    echo $b="Chiều thứ "; 
                                }
                                echo " ". $so = substr($dtn->lichhop,1,1);
                            ?>
                        </td>
                        <td align='center'>{{$dtn->sogio_thucte}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$dtn->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $dtn->tiendo; ?>%">
                                    <span style='color:brown;'>{{$dtn->tiendo}}%</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>                    
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
@endsection