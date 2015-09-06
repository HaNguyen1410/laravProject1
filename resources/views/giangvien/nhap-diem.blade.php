@extends('giangvien_home')

@section('content_gv')

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
        <h3 style="color: darkblue; font-weight: bold;">BẢNG GHI ĐIỂM NIÊN LUẬN</h3>        
        <form id="" name="frmNhapDiem" action="" method="post">
            <table class="table table-bordered" style="width:900px" align='center'>
                <tr>
                    <th width='8%'>Năm học:</th>                
                    <td width='15%'>
                        <input style="text-align: center; font-weight: bold;" type='text' name='' value='{{$nam}}' class='form-control' readonly=""/>
                    </td>
                    <th width='8%'>Học kỳ:</th>
                    <td width='10%'>
                        <input style="text-align: center; font-weight: bold;" type='text' name='' value='{{$hk}}' class='form-control' readonly=""/>
                    </td>              
                    <th width='12%'>Tên học phần:</th>
                    <th width="10%">
                        <select name="cbNhomNL" class="form-control" style="width:90%">
                            <option value="">Tất cả</option>
                            @foreach($dshp as $hp)
                            <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>   
             </table>
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="1%">STT</th> 
                    <th rowspan="2" width="4%">Mã nhóm</th>
                    <th rowspan="2" width="8%">MSSV</th>
                    <th rowspan="2" width="15%">Họ và tên</th>
                    <th colspan="{{$n=count($tieuchi)}}" width="30%">Tiêu chí</th>
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
                        <td align="center">
                            @foreach($tendt as $dt)
                                @if($dt->manhomthuchien == $sv->manhomthuchien)
                                    <a href="" style="color: blueviolet; font-weight: bold" data-toggle="tooltip" data-placement="bottom" title="{{$dt->tendt}}">
                                         {{$sv->manhomthuchien}}
                                    </a>
                                @endif
                            @endforeach
                        </td>
                        <td align="center">{{$sv->mssv}}</td>
                        <td>{{$sv->hoten}}</td>
                        @foreach($dsdiem as $diem) 
                            <?php
                                if($diem->mssv == $sv->mssv && isset($diem->diem))
                                    echo "<td align='center'>".
                                              "<input type='text' value='$diem->diem' style='text-align:center;' size='1' />".
                                         "</td>";
                                else if(!isset($diem->diem))
                                    echo "<td align='center'>".
                                              "<input type='text' value='' style='text-align:center;' size='1' />".
                                         "</td>";
                            ?>
                        @endforeach
                        @foreach($tongdiem as $tong) 
                            @if($tong->mssv == $sv->mssv)
                                <td align="center" style="color: #FF0000; font-weight: bold">{{$tong->tongdiem}}</td>
                            @endif                        
                        @endforeach
                    </tr>
                @endforeach                  
            </table>

            <table class="table" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <td align="right">
                        <button type="button" name="" class="btn btn-info" style="width: 50%;">
                            <img src="{{asset('images/excel-icon.png')}}"> Nhập từ Exel...
                        </button> 
                    </td>
                    <td>
                        <a href="2134/inbangdiemgv" target="_blank">
                            <button type="button" name="" class="btn btn-success" style="width: 50%;">
                                <img src="{{asset('images/printer-icon.png')}}"> In bảng điểm
                            </button>
                        </a>
                        
                    </td>
                    <td align="right">
                        <button type="submit" name="btnLuu" class="btn btn-primary" style="width: 55%;">
                            <img src="{{asset('images/save-as-icon.png')}}"> Lưu dữ liệu
                        </button>                            
                    </td>
                    <td>
                        <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 60%;">
                            <img src="{{asset('images/calculator.png')}}"> Cập nhật ĐTB
                        </button>
                    </td>
                </tr>
            </table>
        </form>               
    </div>
    </div> <!-- /row -->
</div> <!-- /container -->

@endsection