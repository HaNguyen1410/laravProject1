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
    <script>
        function kt_diem(){
            $diem = document.getElementsByName('txtDiem');
            for($i = 0; $i < count($tieuchi); $i++){
                if($tieuchi[$i] < $diem){
                    alert('Điểm nhập vào không được lớn hơn hệ số!');
                    return true;
                }else
                    return false;
            }         
        }
    </script>
    <?php 
        /*========================== Quy điểm số ra điểm chữ ====================*/ 
                function diemchu($d){
                    if($d<=0 && $d<4){
                        return F;
                    }
                    else if($d<=4 || $d<=4.4){
                        return 'D';
                    }
                    else if($d<=4.5 || $d<=4.9){
                        return 'D+';
                    }
                    else if($d<=5.0 || $d<=5.9){
                        return 'C';
                    }
                    else if($d<=6 || $d<=6.9){
                        return 'C+';
                    }
                    else if($d<=7 || $d<=7.9){
                        return 'B';
                    }
                    else if($d<=8 || $d<=8.9){
                        return 'B+';
                    }
                    else     
                        return 'A';
                }    
    ?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h3 style="color: darkblue; font-weight: bold;">BẢNG GHI ĐIỂM NIÊN LUẬN</h3>  
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
        <form name="frmNhapDiem" action="{{action('DiemController@LuuNhapDiem')}}" method="post"> 
            <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th rowspan="2" width="1%">STT</th> 
                    <th rowspan="2" width="3%">Mã nhóm</th>
                    <th rowspan="2" width="1%">Mã số sinh viên</th>
                    <th rowspan="2" width="12%">Họ và tên</th>
                    <th colspan="{{count($tieuchi)}}" width="30%">Tiêu chí</th> 
                    <th rowspan="2" width="20%">Nhận xét</th>
                    <th rowspan="2" width="4%">Tổng điểm</th>
                    <th rowspan="2" width="4%">Điểm chữ</th>   
                </tr>
                <tr>
                    @foreach($tieuchi as $tc)
                        <th width="2%">
                            <input type="text" name="txtMaTC[]" value="{{$tc->matc}}" size="1" style="text-align: center;" class="form-control" readonly=""/>
                            {{$tc->heso}}
                        </th>
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
                        <td align="center">
                            <input type="text" name="txtMaSV[]" size="6" style="border: 0px; background-color: #dff0d8; text-align: center;" value="{{$sv->mssv}}" readonly=""/>
                        </td>
                        <td>{{$sv->hoten}}</td>                        
                        @foreach($dsdiem as $diem) 
                            @if($diem->mssv == $sv->mssv && $diem->diem != null)
                                <td align="center">
                                    <input type="text" name="txtDiem[]" value="{{$diem->diem}}" style="text-align:center; vertical-align: middle;" size="1" />
                                </td> 
                            @elseif($diem->mssv == $sv->mssv && $diem->diem == null)
                                <td align="center">
                                    <input type="text" name="txtDiem[]" value="" style="text-align:center; vertical-align: middle;" size="1" />
                                </td>
                            @endif                                             
                        @endforeach     
                        @foreach($nhanxet as $nx)
                             @if($nx->mssv == $sv->mssv)  
                                <td><textarea class="form-control" name="txtNhanXet[]">{{$nx->nhanxet}}</textarea></td>  
                             @endif  
                        @endforeach
                        @foreach($tongdiem as $tong)                             
                            @if($tong->mssv == $sv->mssv)                             
                                <td align="center" style="color: #FF0000; font-weight: bold">{{$tong->tongdiem}}</td>
                                @if($tong->tongdiem == null)
                                    <td></td>
                                @elseif($tong->tongdiem != null)
                                    <td align="center" style="color: #FF0000; font-weight: bold">{{diemchu($tong->tongdiem)}}</td>
                                @endif 
                            @endif                      
                        @endforeach 
                    </tr>
                @endforeach   
            </table> 
            <table class="table" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <td align="right">
                        <button onclick="return kt_diem();" type="submit" class="btn btn-info" style="width: 50%;">
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
    <!--                    <td>
                        <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 60%;">
                            <img src="{{asset('images/calculator.png')}}"> Cập nhật ĐTB
                        </button>
                    </td>-->
                </tr> 
            </table>
        </form>  
                     
    </div>
    </div> <!-- /row -->
</div> <!-- /container -->

@endsection