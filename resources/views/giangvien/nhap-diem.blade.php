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
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
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
                        <select name="cbNhomNL" class="form-control">
                            <option value="">Tất cả</option>
                            @foreach($dsdt as $dt)
                            <option value="{{$dt->manhomthuchien}}">{{$dt->manhomthuchien}}</option>
                            @endforeach
                        </select>
                    </td>
                    <th>Đề tài:</th>
                    <td>
                        <select name="cbDeTai" class="form-control">
                            @foreach($dsdt as $dt)
                            <option value="{{$dt->madt}}">{{$dt->tendt}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>   
             </table>
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="1%">STT</th>           
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center">
                        <input style="text-align:center;" type="text" size='1' value=""/>
                    </td>
                    <td align="center">
                        <input style="text-align:center;" type="text" size='1' value=""/>
                    </td>
                    <td align="center">
                        <input style="text-align:center;" type="text" size='1' value=""/>
                    </td>
                    <td align="center">
                        <input style="text-align:center;" type="text" size='1' value=""/>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <table class="table" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <td align="right">
                        <button type="button" name="" class="btn btn-info" style="width: 50%;">
                            <img src="{{asset('images/excel-icon.png')}}"> Nhập từ Exel...
                        </button> 
                    </td>
                    <td>
                        <button type="button" name="" class="btn btn-success" style="width: 50%;">
                            <img src="{{asset('images/printer-icon.png')}}"> In bảng điểm
                        </button>
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