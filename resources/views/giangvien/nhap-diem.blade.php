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
    <script type="text/javascript">
        function DoiGD(){
            if(document.getElementById('rdTuNhap').checked == true){
                return window.location.href = 'http://localhost/laravProject1/giangvien/nhapdiem?gd=nhap';                    
            }
            else if(document.getElementById('rdExcel').checked == true){
               return window.location.href = 'http://localhost/laravProject1/giangvien/nhapdiem?gd=excel';                    
            }
        }
    </script>
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
    <div class="col-md-12">  <br> 
        <div class="col-md-12" align="center">
            <form action="" method="get">
                <label style="font-size: 13pt; color: darkblue; font-weight: bold;">Nhập điểm</label> 
                    &nbsp;<input type="radio" onclick="DoiGD()" id="rdTuNhap" name="rdKieuNhapDiem" 
                                <?php
                                    if(!isset($_GET['gd']) || $_GET['gd'] == "nhap")
                                        echo 'checked';
                                    else if($_GET['gd'] == "excel")
                                        echo '';
                                ?>     
                         /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="font-size: 13pt; color: darkblue; font-weight: bold;">Nhập từ excel</label>
                    &nbsp;<input type="radio" onclick="DoiGD()" id="rdExcel" name="rdKieuNhapDiem"
                                <?php
                                    if(!isset($_GET['gd']) || $_GET['gd'] == "nhap")
                                        echo '';
                                    else if($_GET['gd'] == "excel")
                                        echo 'checked';
                                ?>                                        
                          />  
            </form>                                
        </div><br><br>
        @if(!isset($_GET['gd']) || $_GET['gd'] == "nhap") 
            <h3 style="color: darkblue; font-weight: bold; display: block; float: left;">
                BẢNG GHI ĐIỂM NIÊN LUẬN 
                (Nhóm HP: <?php 
                                if($mahp == 0 || $mahp == NULL)
                                    echo "Tất cả";
                                else if($mahp != 0 || $mahp != NULL)
                                    echo DB::table('nhom_hocphan')->where('manhomhp',$mahp)->value('tennhomhp');
                          ?>)
            </h3>
            <form action="{{action('DiemController@LayMaNhomHP')}}" method="post">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" style="max-width:900px" align='center'>
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
                        <td width="10%">
                            <select class="form-control" name='cbNhomHP'>
                                @if($mahp == null || $mahp == 0)
                                    <option value="0" selected="">Tất cả</option>
                                    @foreach($dshp as $hp)
                                        <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                                    @endforeach 
                                @elseif($mahp != null)
                                    <option value="0">Tất cả</option>
                                    @foreach($dshp as $hp)
                                        @if($mahp == $hp->manhomhp)
                                            <option value="{{$hp->manhomhp}}" selected="">{{$hp->tennhomhp}}</option>
                                        @else
                                            <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option> 
                                        @endif
                                    @endforeach   
                                @endif
                            </select>
                        </td>
                        <th width="15%">
                            <button type="submit" class="btn btn-success" style="width:100%">
                                Liệt kê
                            </button>
                        </th>
                    </tr>   
                 </table>
            </form> 
            <div style="background-color: #B0E0E6;">                
                <p style="color:#006400; font-weight: bold; text-align: center;">
                    <?php echo Session::get('BaoUpload'); ?>
                </p>
            </div>
            <form name="frmNhapDiem" action="{{action('DiemController@LuuNhapDiem')}}" method="post"> 
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                    <tr>
                        <th rowspan="2" width="1%">STT</th> 
                        <th rowspan="2" width="3%">Mã nhóm</th>
                        <th rowspan="2" width="1%">Mã số sinh viên</th>
                        <th rowspan="2" width="12%">Họ và tên</th>
                        <th rowspan="2" width="2%">Nhóm trưởng</th>
                        <th colspan="{{count($tieuchi)}}" width="30%">Mã tiêu chí - [Điểm tối đa]</th> 
                        <th rowspan="2" width="20%">Nhận xét</th>
                        <th rowspan="2" width="3%">Tổng điểm</th>
                        <th rowspan="2" width="3%">Điểm chữ</th>   
                    </tr>
                    <tr>
                        @if(count($tieuchi) == 0)
                                <th colspan="{{count($tieuchi)}}" align="center">
                                    <label style="color: #e74c3c;"> Chưa có tiêu chí đánh giá nào!</label> 
                                </th>
                        @elseif (count($tieuchi) > 0)
                            @foreach($tieuchi as $tc)
                                <th width="2%">
                                    <input type="text" name="txtMaTC[]" value="{{$tc->matc}}" size="1" style="text-align: center; border: 0px; background-color: #F5F5F5; height: 25px;" class="form-control" readonly=""/>
                                    [{{$tc->heso}}]
                                </th>
                            @endforeach  
                        @endif
                    </tr>
                    @if(count($dssv) == 0)
                        <tr>
                            <td colspan="11" align="center">
                                <label style="color: #e74c3c;"> Chưa có sinh viên nào!</label> 
                            </td>
                        </tr>
                    @elseif (count($dssv) > 0)
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
                                <td align="center">
                                    @if($sv->nhomtruong == 1)
                                        <img src="http://localhost/laravProject1/public/images/tick-icon-small.png"/>
                                    @endif
                                </td>
                                @foreach($dsdiem as $diem)                                    
                                    @if($diem->mssv == $sv->mssv && $diem->diem != null)                                
                                        <td align="center">                                        
                                            <!--Báo lỗi khi nhập lớn hơn điểm tiêu chí-->
                                            @if(Session::has('Loi'.$sv->mssv.'_'.$diem->matc))
                                                <input type="text" name="{{$sv->mssv}}_{{$diem->matc}}" value="" style="text-align:center; vertical-align: middle; border-color: red;" size="1" />                                        
                                                <div style="color: red;">{{Session::get('Loi'.$sv->mssv.'_'.$diem->matc)}}</div>
                                            @else
                                                <input type="text" name="{{$sv->mssv}}_{{$diem->matc}}" value="{{$diem->diem}}" style="text-align:center; vertical-align: middle;" size="1" />
                                            @endif
                                        </td> 
                                    @elseif($diem->mssv == $sv->mssv && $diem->diem == null)
                                        <td align="center">
                                            <input type="text" name="{{$sv->mssv}}_{{$diem->matc}}" value="" style="text-align:center; vertical-align: middle;" size="1" />
                                        </td>
                                    @endif 
                                @endforeach     
                                @foreach($nhanxet as $nx)
                                     @if($nx->mssv == $sv->mssv)  
                                        <td><textarea class="form-control" name="{{$sv->mssv}}">{{$nx->nhanxet}}</textarea></td>  
                                     @endif  
                                @endforeach
                                @foreach($tongdiem as $tong)                             
                                    @if($tong->mssv == $sv->mssv)                             
                                    <td align="center" style="color: #FF0000; font-weight: bold"><?php echo round($tong->tongdiem,2);?></td>
                                        @if($tong->tongdiem == null)
                                            <td></td>
                                        @elseif($tong->tongdiem != null)
                                            <td align="center" style="color: #FF0000; font-weight: bold">{{DiemChu($tong->tongdiem)}}</td>
                                        @endif 
                                    @endif                      
                                @endforeach 
                            </tr>
                        @endforeach  
                    @endif
                </table> 
                <table class="table" cellpadding="15px" cellspacing="0px" align='center'>
                    <tr>
    <!--                    <td align="right">
                            <button onclick="return kt_diem();" type="submit" class="btn btn-info" style="width: 50%;">
                                <img src="{{asset('public/images/excel-icon.png')}}"> Nhập từ Exel...
                            </button> 
                        </td>          -->
                        <td></td>
                        <td>
                            @if($mahp == null || $mahp == 0)                            
                                <a href="{{asset('giangvien/nhapdiem/'.$macb.'/inbangdiemgv/all')}}" target="_blank">
                                    <button type="button" name="" class="btn btn-success" style="width: 50%;">
                                        <img src="{{asset('public/images/printer-icon.png')}}"> In bảng điểm
                                    </button>
                                </a>                           
                            @elseif($mahp != null || $mahp != 0)
                                <a href="{{asset('giangvien/nhapdiem/'.$macb.'/inbangdiemgv/'.$mahp)}}" target="_blank">
                                    <button type="button" name="" class="btn btn-success" style="width: 50%;">
                                        <img src="{{asset('public/images/printer-icon.png')}}"> In bảng điểm
                                    </button>
                                </a>
                            @endif
                        </td>
                        <td>
                            <button type="submit" name="btnLuu" class="btn btn-primary" style="width: 55%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Lưu dữ liệu
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
        @elseif($_GET['gd'] == "excel" )
            <div class="col-md-8 col-md-offset-2" align="center">
                <p style="color:red;"><?php echo Session::get('BaoUpload'); ?></p>
                <form action="{{action('ImportExcelController@LuuImportExcel')}}" method="post" enctype="multipart/form-data">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <label style="display: block; float: left; color: darkblue; margin-top: 25px;">
                        Chọn tập bảng điểm excel:
                    </label>&nbsp;
                    <input type="file" name="fDiemExcel" id="fileDiemExcel" class="form-control" style="max-width: 400px; margin-left: -90px;">
                    <p style='color:red;'>{{$errors->first('fDiemExcel')}}</p>
                    <button type="submit" class="btn btn-primary">
                        <img src="{{asset('public/images/excel-icon.png')}}"/>Tập tin Excel
                    </button>
                </form>
                <br> 
            </div>   
        @endif                       
    </div>
    </div> <!-- /row -->
</div> <!-- /container -->

@endsection