@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            font-weight: bold;
        }
    </style>     
    
<div class="container">
    <div class="row">
        <form action="" enctype="multipart/form-data" method="post" name="frmDoiMatKhau" class="form-horizontal">
            <div class="col-md-4">  <!-- Upload hình đại diện -->                      
                <div align="center">
                    <br><br><br/>
                    <?php
                        if($gv->hinhdaidien != ""){
                            echo "<img width='200px' src='hinhdaidien/$gv->hinhdaidien'>";
                        }
                        else{
                            echo "<img src=\"{{asset('images/User-image.png')}}\">";                                    
                        }
                    ?>
                </div><br>
                <div align="center">
                    <input type="file" name="fHinh" id="fHinh" /> 
                </div>
            </div>
            <div class="col-md-8">
                <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">ĐỔI MẬT KHẨU</h3>
                <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center" style="width:800px;">
                    <tr>
                        <th width="20%">Mã cán bộ:</th>
                        <td width="50%">
                            <input type="text" name="txtMaCB" value="{{$gv->macb}}" class="form-control" readonly="" /> 
                        </td>
                    </tr>
                    <tr>
                        <th>Họ và tên:</th>
                        <td>
                            <input type="text" name="txtTen" value="{{$gv->hoten}}" class="form-control" readonly="" /> 
                        </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>
                            <input type="text" name="txtEmail" value="{{$gv->email}}" class="form-control" readonly="" /> 
                        </td>
                    </tr>
                    <tr></tr>   
                    <tr>
                        <th>Mật khẩu hiện tại:</th>
                        <td>
                            <input type=password id="txtMatKhauCu" name="txtMatKhauCu" value="" class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Mật khẩu mới:</th>
                        <td>
                            <input type="text" id="txtMatKhauMoi1" name="txtMatKhauMoi1" value="" class="form-control"/>                                    
                        </td>
                    </tr>
                    <tr>
                        <th>Nhập lại mật khẩu mới:</th>
                        <td>
                            <input type="text" id="txtMatKhauMoi2" name="txtMatKhauMoi2" value="" class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button onclick="return ktMatKhau();" type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 20%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;
                            <a href="?cn=ttgv" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('images/delete-icon.png')}}"> Hủy bỏ
                            </a>                              
                        </td>
                    </tr>
                </table>                   
            </div> 
        </form>
    </div><!-- /row -->

</div> <!-- /container -->
@endsection
