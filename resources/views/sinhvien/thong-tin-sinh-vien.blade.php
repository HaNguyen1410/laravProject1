@extends('sinhvien_home')

@section('content_sv')
    
    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
        #bang1 td:first-child{
            width: 30%; 
            vertical-align: middle;
        }
        #bang1 td{
           vertical-align: middle;             
        }        
        td:first-child{
            color: black;
        }
        #bang2 td:first-child{
            text-align: center;
            color: black;
            font-weight: bold;
            text-align: left;
            vertical-align: middle;
            width: 30%;
        }
    </style> 

    
    <body>
        <div class="container">         
            
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: darkblue; font-weight: bold;" align="center">THÔNG TIN SINH VIÊN</h3><br>
                </div>          
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9 col-md-push-3">
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                                    Giảng viên hướng dẫn
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">
                                            <table class="table table-bordered" border="0" width="800px" cellpadding="25px" cellspacing="0px" align='center'>
                                                <tr>
                                                    <th width="40%">MSCB:</th>
                                                    <td>{{$ttgv->macb}}</td>                                    
                                                </tr>
                                                <tr>
                                                    <th>Họ và tên:</th>
                                                    <td>{{$ttgv->hoten}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email:</th>
                                                    <td>{{$ttgv->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Điện thoại:</th>
                                                    <td>{{$ttgv->sdt}}</td>
                                                </tr>
                                            </table>
                                        </a>
                                    </li>
                                </ul>
                            </div> <!-- /dropdown -->
                            
                            <br>
                            <table class="table table-bordered" border="0" width="700px" cellpadding="25px" cellspacing="0px" align='center' id="bang1">
                                <tr><th colspan="4" style="text-align: center">Thông tin sinh viên</th></tr>
                                <tr>
                                    <td><label>Mã số sinh viên:</label></td>
                                    <td style="color:blue;" colspan="3">{{$sv->mssv}}</td>                                    
                                </tr>
                                <tr>
                                    <td><label>Họ và tên:</label></td>
                                    <td style="color:blue;" colspan="3">{{$sv->hoten}}</td>
                                </tr>
                                <tr>
                                    <td><label>Ngày sinh:</label></td>
                                    <td style="color:blue;" colspan="3">{{$sv->ngaysinh}}</td>
                                </tr>
                                <tr>
                                    <td><label>Khóa:</label></td>
                                    <td style="color:blue;">{{$sv->khoahoc}}</td>
                                    <td width="10%"><label>Nhóm học phần:</label></td>
                                    <td style="color:blue;">{{$hp->tennhomhp}}</td>
                                </tr>
                                <tr>
                                    <td><label>Tên đề tài:</label></td>
                                    <td style="color:blue;" colspan="3">{{$detainhom->tendt}}</td>
                                </tr>
                                <tr>
                                    <td><label>Mã nhóm niên luận: </label></td>
                                    <td style="color:blue;">{{$ttgv->manhomthuchien}}</td>
                                    <td colspan="2" align="center">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                                Thành viên nhóm làm niên luận
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">
                                                        <table class="table table-hover" width="500px" cellpadding="15px" cellspacing="0px">
                                                            <tr>
                                                                <th width="2%">STT</th>
                                                                <th width="4%">MSSV</th>
                                                                <th width="20%">Họ và tên</th>
                                                                <th width="5%">Trưởng nhóm</th>
                                                            </tr>
                                                            @foreach($dstv as $stt => $tv)
                                                                <tr>
                                                                    <td align='center'>{{$stt+1}}</td>
                                                                    <td align='center'>{{$tv->mssv}}</td>
                                                                    <td>{{$tv->hoten}}</td>
                                                                    <td align='center'>
                                                                        @if($tv->nhomtruong == 1)
                                                                            <img src="{{asset('images/check.png')}}"/>
                                                                        @elseif($tv->nhomtruong == 0)
                                                                            <img src="{{asset('images/uncheck.png')}}"/>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach              
                                                        </table>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> <!-- /dropdown -->
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Tổ chức nhóm:</label></td>                                   
                                    <td colspan='3' style="color:blue;">{{$nhomth->tochucnhom}}</td>
                                </tr>
                                <tr>
                                    <td><label>Lịch họp nhóm:</label></td>
                                    <td colspan='3' style="color:blue;">
                                        <?php
                                            $b = "";
                                            $buoi = substr($nhomth->lichhop, 0,1);
                                            $bs = strcasecmp($buoi, 'S');
                                            $bc = strcasecmp($buoi, 'C');

                                            if($bs == 0){
                                                echo $b="Sáng thứ "; 
                                            }
                                            else if($bc == 0){
                                                echo $b="Chiều thứ "; 
                                            }
                                            echo " ". $so = substr($nhomth->lichhop,1,1);
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <form action="{{action('SinhvienController@LuuCapNhatThongTin')}}" method="post">
                                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                                <table class="table table-bordered" border="0" width="800px" id="bang2">
                                    <tr><th colspan="2" style="text-align: center">Xác nhận thông tin</th></tr>
                                    <tr>
                                        <td>Số điện thoại:</td>
                                        <td>
                                            <input type="hidden" name="txtMaSV" value="<?php echo $sv['mssv'];?>" />
                                            <input type="text" name="txtDienThoai" value="<?php echo $sv['sdt'];?>" class="form-control">
                                            <p style='color:red;'>{{$errors->first('txtDienThoai')}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kỹ năng công nghệ:</td>
                                        <td>
                                            <textarea class="form-control" name="txtCongNghe" rows="3">
                                                <?php echo $sv['kynangcongnghe'];?>
                                            </textarea>                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kiến thức về ngôn lập trình:</td>
                                        <td>
                                            <textarea class="form-control" name="txtLapTrinh" rows="3" style="text-align: left;">
                                                <?php echo $sv['kienthuclaptrinh'];?>
                                            </textarea>
                                            <p style='color:red;'>{{$errors->first('txtLapTrinh')}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kinh nghiệm:</td>
                                        <td>
                                            <textarea class="form-control" name="txtKinhNghiem" rows="3">
                                                <?php echo $sv['kinhnghiem'];?>
                                            </textarea>
                                            <p style='color:red;'>{{$errors->first('txtKinhNghiem')}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td align="center">
                                            <button type="submit" name="btnLuu" class="btn btn-primary" style="width: 20%;">
                                                <img src="{{asset('images/save-as-icon.png')}}"> Lưu 
                                            </button>
                                        </td>                                  
                                    </tr>
                                </table>
                            </form>                            
                        </div> <!-- /class="col-md-9 col-md-pull-3" -->
                        <div class="col-md-3 col-md-pull-9">
                            <br><br><br>
                            <table class="table table-bordered" border="0" width="800px" cellpadding="25px" cellspacing="0px" align='center'>
                                <tr>
                                    <td align="center">
                                         @if($sv->hinhdaidien != "")
                                                <img width='200px' src='../../hinhdaidien/{{$sv->hinhdaidien}}'>
                                         @else
                                                <img src="{{asset('images/User-image.png')}}">
                                         @endif                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center"><a href="#">Ảnh đại diện</a></td>
                                </tr>
                            </table >  <!-- /table anh dai dien -->
                        </div> <!-- /class="col-md-3 col-md-pull-9" -->
                    </div> <!-- /row -->
                   
                </div>  <!-- /class="col-md-12" -->                     
            </div> <!-- /row -->
            
        </div> <!-- /container -->
@endsection

