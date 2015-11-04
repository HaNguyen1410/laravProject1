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

<div class="container">         

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: #006400; font-weight: bold;" align="center">THÔNG BÁO MỚI</h3><br>
            <table class="table table-condensed" style="max-width:900px;" align="center">
                @if(count($dsthongbao) == 0)
                    <tr>
                        <td colspan="9" align="center">
                            <label style="color: #e74c3c;"> Chưa có thông báo nào!</label> 
                        </td>
                    </tr>
                @endif
                @foreach($dsthongbao as $stt => $tb)                
                    <tr>
                        <td>
                            @if($tb->dinhkemtb == "")
                                <label style="color: #e74c3c; padding-left: 20px;">
                                    {{$stt + 1}}. {{$tb->noidungtb}} (Từ {{$tb->batdautb}} đến {{$tb->ketthuctb}})
                                </label> 
                            @elseif($tb->dinhkemtb != "")
                                <a href="../public/thongbao/{{$tb->dinhkemtb}}" target="_blank" style="color: #e74c3c; padding-left: 20px;">
                                    {{$stt + 1}}. {{$tb->noidungtb}} (Từ {{$tb->batdautb}} đến {{$tb->ketthuctb}})
                                </a>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>  
        <div class="col-md-12" style="margin-bottom: 15px;">
            <h3 style="color: darkblue; font-weight: bold;" align="center">THÔNG TIN SINH VIÊN</h3>
            <div align="center">
                (Học kỳ: <lable style="color: #00c; font-weight: bold;">{{$hk}}</lable> - Năm học: <lable style="color: #00c; font-weight: bold;">{{$nam}})</lable>
            </div>       
        </div>          
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <table class="table table-bordered" border="0" style="max-width: 700px;" cellpadding="25px" cellspacing="0px" align='center' id="bang1">
                        <tr><th colspan="4" style="text-align: center">Thông tin sinh viên</th></tr>
                        <tr>
                            <td><label>Mã số sinh viên:</label></td>
                            <td style="color:blue;">{{$sv->mssv}}</td>                             
                            <td><label>Họ và tên:</label></td>
                            <td style="color:blue;" colspan="3">{{$sv->hoten}}</td>
                        </tr>
                        <tr>
                            <td><label>Ngày sinh:</label></td>
                            <td style="color:blue;">{{$sv->ngaysinh}}</td>                            
                            <td><label>Điện thoại sinh viên:</label></td>
                            <td style="color:blue;">{{$sv->sdt}}</td>
                        </tr>
                        <tr>
                            <td><label>Khóa:</label></td>
                            <td style="color:blue;">{{$sv->khoahoc}}</td>
                            <td width="20%"><label>Nhóm học phần:</label></td>
                            <td style="color:blue;">{{$hp->tennhomhp}}</td>
                        </tr>
                        <tr>
                            <td><label>Mã giảng viên:</label></td>
                            <td style="color:blue;">{{$ttgv->macb}}</td>
                            <td><label>Họ và tên giảng viên:</label></td>
                            <td style="color:blue;">{{$ttgv->hoten}}</td>
                        </tr>
                        <tr>
                            <td><label>Số điện thoại giảng viên:</label></td>
                            <td style="color:blue;">{{$ttgv->sdt}}</td>
                            <td><label>Email giảng viên:</label></td>
                            <td style="color:blue;">{{$ttgv->email}}</td>
                        </tr>
                        <tr>
                            <td><label>Tên đề tài:</label></td>
                            <td style="color:blue;" colspan="3">
                                @if($detainhom->taptindinhkem != "")
                                    <a href="../public/mota_detai/{{$detainhom->taptindinhkem}}" target="_blank" style="color:darkblue;">
                                        <img src="{{asset('public/images/doc-pdf-icon.png')}}"/>&nbsp;&nbsp;
                                        {{$detainhom->tendt}}
                                    </a>
                                @elseif($detainhom->taptindinhkem == "")
                                    <a href="thongtinsv/inchitietdetaisv/{{$detainhom->madt}}" target="_blank" style="color:darkblue;">
                                        <img src="{{asset('public/images/doc-pdf-icon.png')}}"/>&nbsp;&nbsp;
                                        {{$detainhom->tendt}}
                                    </a>
                                @endif
                            </td>
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
                                                        <th width="10%">Email</th>
                                                        <th width="10%">Điện thoại</th>
                                                        <th width="5%">Trưởng nhóm</th>
                                                    </tr>
                                                    @foreach($dstv as $stt => $tv)
                                                        <tr>
                                                            <td align='center'>{{$stt+1}}</td>
                                                            <td align='center'>{{$tv->mssv}}</td>
                                                            <td>{{$tv->hoten}}</td>
                                                            <td>{{$tv->email}}</td>
                                                            <td align='center'>{{$tv->sdt}}9876543212</td>
                                                            <td align='center'>
                                                                @if($tv->nhomtruong == 1)
                                                                    <img src="{{asset('public/images/check.png')}}"/>
                                                                @elseif($tv->nhomtruong == 0)
                                                                    <img src="{{asset('public/images/uncheck.png')}}"/>
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
                                    //Chuyển chuổi thành các phần tử trong 1 mảng 
                                     $ngay = explode(', ', $nhomth->lichhop);
                                     //var_dump($ngay); //Xem kết quả của mảng vừa tách được từ chuỗi ban đầu 
                                     for($i = 0; $i < count($ngay); $i++){                                    
                                         //Cắt số trong chuỗi ngày
                                         $ngay_so = substr($ngay[$i],1); 
                                         $kytu = substr($ngay[$i], 0, 1);
                                         //So sánh ký tự đầu tiên
                                         $bs = strcasecmp($kytu, 'S');
                                         $bc = strcasecmp($kytu, 'C');
                                         if($bs == 0){
                                             echo "<div style='padding: 2px 2px 2px 40px; display: block; float: left;'>".  
                                                 "<label style='color:green;'>Sáng thứ ".$ngay_so."</label> &nbsp;&nbsp;&nbsp;".                           
                                              "</div>";
                                         }
                                         else if($bc == 0){
                                             echo "<div style='padding: 2px 2px 2px 40px; display: block; float: left;'>".  
                                                     "<label style='color:green;'>Chiều thứ ".$ngay_so."</label> &nbsp;&nbsp;&nbsp;".                           
                                                  "</div>";                                        
                                         }
                                     }                                    
                                 ?>      
                            </td>
                        </tr>
                        <tr>
                            <td><label>Kỹ năng công nghệ:</label></td>
                            <td style="color:blue;" colspan="2">{{$sv->kynangcongnghe}}</td>  
                            <td rowspan="3" align="center">
                                <a href="thongtinsv/capnhatkynang">
                                    <button type="button" class="btn btn-default">
                                        Cập nhật <img src="{{asset('public/images/user-edit-icon.png')}}"/>
                                    </button> 
                                </a> 
                            </td>
                        </tr>                       
                            <td><label>Kiến thức lập trình:</label></td>
                            <td style="color:blue;" colspan="2">{{$sv->kienthuclaptrinh}}</td>
                        </tr>
                        <tr>                          
                            <td><label>Kinh nghiệm lập trình:</label></td>
                            <td style="color:blue;" colspan="2">{{$sv->kinhnghiem}}</td>                            
                        </tr>
                    </table>                                             
                </div> <!-- /class="col-md-9 col-md-pull-3" -->
                <div class="col-md-3 col-md-pull-9">
                    <br><br><br>
                    <table class="table table-bordered" border="0" max-width="800px" cellpadding="25px" cellspacing="0px" align='center'>
                        <tr>
                            <td align="center">
                                 @if($sv->hinhdaidien != "")
                                        <img width='200px' src='../public/hinhdaidien/{{$sv->hinhdaidien}}'>
                                 @else
                                        <img src="{{asset('public/images/User-image.png')}}">
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

