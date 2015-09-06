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

<div class="container">
    <div class="row">
       
    <div class="col-md-12">
        <h3 style="color: darkblue; font-weight: bold; text-align: center;">XEM ĐIỂM NIÊN LUẬN</h3>
        <table class="table" cellpadding="15px" cellspacing="0px" align='center'>
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
                <th>Đề tài:</th>
                <td colspan='5'><input type='text' name='' value='{{$dsdt->tendt}}' class='form-control' readonly=""/></td>
            </tr>
         </table>

        <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>            
            <tr>
                <th rowspan="2" width="1%">STT</th>
                <th rowspan="2" width="8%">MSSV</th>
                <th rowspan="2" width="15%">Họ và tên</th>
                <th colspan="{{$n=count($tieuchi)}}" width="30%">Hệ số</th>
                <th rowspan="2" width="4%">Tổng điểm</th>
                <th rowspan="2" width="4%">Điểm chữ</th>                         
            </tr>
            <tr>
                @foreach($tieuchi as $tc)
                    <th width="2%">{{$tc->heso}}</th>
                @endforeach                                   
            </tr>
            @foreach($dssv as $stt => $sv)
                <tr>
                    <td align="center">{{$stt+1}}</td>
                    <td align="center">{{$sv->mssv}}</td>
                    <td>{{$sv->hoten}}</td>
                    @foreach($dsdiem as $diem) 
                        @if($diem->mssv == $sv->mssv)
                            <td>{{$diem->diem}}</td>
                        @endif
                    @endforeach 
                    @foreach($tongdiem as $tong) 
                        @if($tong->mssv == $sv->mssv)
                            <td align="center" style="color: #FF0000; font-weight: bold">{{$tong->tongdiem}}</td>
                        @endif                        
                    @endforeach
                </tr>
            @endforeach         
        </table>
        <div class="col-md-12" style="text-align: right;">
            <a href="1111317/inbangdiemsv" target="_blank">
                <button type="button" name="" class="btn btn-success" style="width: 15%;">
                    <img src="{{asset('images/printer-icon.png')}}"> In bảng điểm
                </button>
            </a><hr>
        </div>
        <table class="table table-bordered" style="width: 600px;">
            <tr>
                <th width="2%">STT</th>
                <th width="50%">Nội dung đánh giá</th>
                <th width="10%">Mức điểm tối đa</th>                        
            </tr>
            @foreach($tieuchi as $stt => $tc)
                <tr>
                    <td align='center'>{{$stt+1}}</td>
                    <td>{{$tc->noidungtc}}</td>
                    <td align='center'>{{$tc->heso}}</td>
                </tr>
            @endforeach                              
        </table>
    </div>
    </div> <!-- /row -->
</div> <!-- /container -->

@endsection
