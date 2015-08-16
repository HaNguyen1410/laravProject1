@extends('quantri_home')

@section('content_quantri')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
        td:first-child{
            color: darkblue;
        }
    </style>
    
   
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;" align="center">THÔNG TIN GIẢNG VIÊN</h3><br>
        </div>               
        <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <table class="table table-bordered" border="0" width="800px" cellpadding="25px" cellspacing="0px" align='center'>
                        <tr><th colspan="2" style="text-align: center">Thông tin giảng viên</th></tr>
                        <tr>
                            <td width="30%"><label>Mã số cán bộ:</label></td>
                            <td style="color:blue;">{{$gv->macb}}</td>
                        </tr>
                        <tr>
                            <td><label>Họ và tên:</label></td>
                            <td style="color:blue;">{{$gv->hoten}}</td>
                        </tr>
                        <tr>
                            <td><label>Giới tính:</label></td>
                            <td style="color:blue;">{{$gv->gioitinh}}</td>
                        </tr>
                        <tr>
                            <td><label>Ngày sinh:</label></td>
                            <td style="color:blue;">{{$gv->ngaysinh}}</td>
                        </tr>
                        <tr>
                            <td><label>Email:</label></td>
                            <td style="color:blue;">{{$gv->email}}</td>
                        </tr>
                        <tr>
                            <td><label>Điện thoại:</label></td>
                            <td style="color:blue;">{{$gv->sdt}}</td>
                        </tr>
                        <tr>
                            <td><label>Hướng dẫn nhóm học phần:</label></td>
                            <td style="color:blue;"></td>
                        </tr>
                    </table>
                </div> <!-- /class="col-md-9 col-md-pull-3" -->
                <div class="col-md-3 col-md-pull-9">
                    <table class="table table-bordered" border="0" width="800px" cellpadding="25px" cellspacing="0px" align='center'>
                        <tr>
                            <td align="center">
                                @if($gv->hinhdaidien != "")
                                    <img width='200px' src="../../hinhdaidien/{{$gv->hinhdaidien}}">
                                @else
                                    <img src="{{asset('images/User-image.png')}}"/>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><a href="#">Ảnh đại diện</a></td>
                        </tr>
                    </table>                            
                </div> <!-- /class="col-md-3 col-md-pull-9" -->
            </div> <!-- /row --> 
    </div> <!-- /row -->           
</div> <!-- /container -->

@endsection
