@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        th{
            vertical-align: middle;
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>
    
    <?php 
        /*========================== Quy điểm số ra điểm chữ ====================*/ 
                function DiemChu($d){
                    if($d >= 9 && $d <= 10)    
                        return 'A';
                    else if($d >= 8 && $d <= 8.9){
                        return 'B+';
                    }
                    else if($d >= 7 && $d <= 7.9){
                        return 'B';
                    }
                    else if($d >= 6 && $d <= 6.9){
                        return 'C+';
                    }
                    else if($d >= 5.0 && $d <= 5.9){
                        return 'C';
                    }
                    else if($d >= 4.5 && $d <= 4.9){
                        return 'D+';
                    }
                    else if($d >= 4 && $d <= 4.4){
                        return 'D';
                    }
                    else if($d >= 0 && $d < 4){
                        return 'F';
                    }
                }    
    ?>
<div class="container">
    <div class="row">       
    <div class="col-md-12">
        <h3 style="color: darkblue; font-weight: bold; text-align: center;">XEM ĐIỂM NIÊN LUẬN</h3>
        <table class="table" style="max-width: 100%" cellpadding="15px" cellspacing="0px" align='center'>
            <tr>
                <th width='8%'>Năm học:</th>                
                <td width='15%'>
                    <input style="text-align: center; font-weight: bold;" type='text' name='' value='{{$hk_nk->nam}}' class='form-control' readonly=""/>
                </td>
                <th width='8%'>Học kỳ:</th>
                <td width='10%'>
                    <input style="text-align: center; font-weight: bold;" type='text' name='' value='{{$hk_nk->hocky}}' class='form-control' readonly=""/>
                </td>              
                <th>Mã nhóm niên luận:</th>
                <td>
                    <input style="width:30%; text-align: center; font-weight: bold;" type='text' name='' value='{{$dsdt->manhomthuchien}}' class='form-control' readonly=""/>
                </td>
            </tr>
            <tr>
                <th colspan='2'>Cán bộ hướng dẫn:</th>
                <td colspan='4'>
                    <label style="color: #00c; font-weight: bold">{{$tengv->hoten}}</label>
                </td>
            </tr>
            <tr>  
                <th colspan='2'>Đề tài:</th>
                <td colspan='4'><input type='text' name='' value='{{$dsdt->tendt}}' class='form-control' readonly=""/></td>
            </tr>
         </table>

        <table style="max-width: 100%" class="table table-bordered" cellpadding="0px" cellspacing="0px">            
            <tr>
                <th rowspan="2" width="1%">STT</th>
                <th rowspan="2" width="8%">MSSV</th>
                <th rowspan="2" width="15%">Họ và tên</th>
                <th rowspan="2" width="1%">Nhóm trưởng</th>
                <th colspan="{{$n=count($tieuchi)}}" width="30%">Tiêu chí - Điểm tối đa</th>
                <th rowspan="2" width="4%">Tổng điểm</th>
                <th rowspan="2" width="4%">Điểm chữ</th>    
                <th rowspan="2" width="20%">Nhận xét</th> 
            </tr>
            <tr>
                @if(count($tieuchi) == 0)
                    <th></th>
                @elseif(count($tieuchi) > 0)
                    @foreach($tieuchi as $tc)
                        <th width="4%">
                            [{{$tc->matc}}] - {{$tc->heso}}
                        </th>
                    @endforeach 
                @endif                                                  
            </tr>
            @foreach($dssv as $stt => $sv)
                <tr>
                    <td align="center">{{$stt+1}}</td>
                    <td align="center">{{$sv->mssv}}</td>
                    <td>{{$sv->hoten}}</td>
                    <td align="center">
                        @if($sv->nhomtruong == 1)
                            <img src="{{asset('public/images/check.png')}}"/>
                        @endif
                    </td>
                    @if(count($tieuchi) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                    @elseif(count($tieuchi) > 0)
                        @foreach($dsdiem as $diem) 
                            @if($diem->mssv == $sv->mssv)
                                <td align="center">{{$diem->diem}}</td>
                            @endif
                        @endforeach 
                        @foreach($tongdiem as $tong) 
                            @if($tong->mssv == $sv->mssv)
                                <td align="center" style="color: #FF0000; font-weight: bold"><?php echo round($tong->tongdiem,2);?></td>                                
                                <td align="center" style="color: #FF0000; font-weight: bold">{{DiemChu($tong->tongdiem)}}</td>                                                                 
                            @endif                        
                        @endforeach
                    @endif   
                    @foreach($nhanxet as $nx)
                        @if($nx->mssv == $sv->mssv)
                            <td style="color: #00008b;">{{$nx->nhanxet}}</td>
                        @endif 
                    @endforeach                    
                </tr>
            @endforeach         
        </table>
        <div class="col-md-12" style="text-align: right;">
            <a href="xemdiem/inbangdiemsv" target="_blank">
                <button type="button" name="" class="btn btn-success">
                    <img src="{{asset('public/images/printer-icon.png')}}"> In bảng điểm
                </button>
            </a><hr>
        </div>
        <table class="table table-bordered" style="max-width: 600px;">
            <tr>
                <th width="2%">STT</th>
                <th width="10%">Mã tiêu chí</th>
                <th width="50%">Nội dung đánh giá</th>
                <th width="10%">Mức điểm tối đa</th>                        
            </tr>
            @foreach($tieuchi as $stt => $tc)
                <tr>
                    <td align='center'>{{$stt+1}}</td>
                    <td align='center' style="color: brown; font-weight: bold;">[{{$tc->matc}}]</td>
                    <td>{{$tc->noidungtc}}</td>
                    <td align='center'>{{$tc->heso}}</td>
                </tr>
            @endforeach                              
        </table>
    </div>
    </div> <!-- /row -->
</div> <!-- /container -->

@endsection
