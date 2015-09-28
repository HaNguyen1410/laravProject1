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
                    <th width="4%">Mã nhóm</th>
                    <th width="15%">Tên đề tài</th>
                    <th width="10%">Trưởng nhóm</th>
                    <th width="18%">Tổ chức nhóm</th>
                    <th width="8%">Lịch họp</th>
                    <th width="6%">Số giờ làm dự án</th>
                    <th width="8%">Trạng thái(%)</th>
                </tr>
                @if(count($dsdtnhom) == 0)
                    <tr>
                        <td colspan="9" align="center">
                            <label style="color: #e74c3c;"> Chưa có thông tin!</label> 
                        </td>
                    </tr>
                @elseif (count($dsdtnhom) > 0)
                    @foreach($dsdtnhom as $stt => $dtn)                
                        <tr>
                            <td align='center'>{{$stt+1}}</td>
                            <td align='center'>{{$dtn->manhomthuchien}}</td>
                            <td>
                               <a href='cvchinh/{{$dtn->manhomthuchien}}'>
                                    {{$dtn->tendt}}
                                </a>  
                            </td>
                            <td>{{$dtn->hoten}}</td>
                            <td>{{$dtn->tochucnhom}}</td>
                            <td align='center'>                            
                                <?php
                                  //Chuyển chuổi thành các phần tử trong 1 mảng 
                                   $ngay = explode(', ', $dtn->lichhop);
                                   //var_dump($ngay); //Xem kết quả của mảng vừa tách được từ chuỗi ban đầu 
                                   for($i = 0; $i < count($ngay); $i++){                                    
                                       //Cắt số trong chuỗi ngày
                                       $ngay_so = substr($ngay[$i],1); 
                                       $kytu = substr($ngay[$i], 0, 1);
                                       //So sánh ký tự đầu tiên
                                       $bs = strcasecmp($kytu, 'S');
                                       $bc = strcasecmp($kytu, 'C');
                                       if($bs == 0){
                                           echo "<div style='padding: 0px 0px; display: block; float: left;'>".  
                                               "<label style='color:green;'>Sáng thứ ".$ngay_so."</label> &nbsp;&nbsp;".                           
                                            "</div>";
                                       }
                                       else if($bc == 0){
                                           echo "<div style='padding: 0px 0px; display: block; float: left;'>".  
                                                   "<label style='color:green;'>Chiều thứ ".$ngay_so."</label> &nbsp;&nbsp;".                           
                                                "</div>";                                        
                                       }
                                   }                                    
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
                @endif
            </table>                    
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
@endsection