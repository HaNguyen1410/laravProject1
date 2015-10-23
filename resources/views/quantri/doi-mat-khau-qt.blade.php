@extends('quantri_home')

@section('content_quantri')

    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            font-weight: bold;
        }
    </style>     
    
<div class="container">
    <div class="row">
        <div class="col-md-4">  <!-- Upload hình đại diện -->                      
            <div align="center">
                <p style="color: blue; font-weight: bold;">{{ Session::get('message') }}</p>
                <br><br><br/>
                 @if($gv->hinhdaidien != "")
                    <img width='100px' src='../public/hinhdaidien/{{$gv->hinhdaidien}}'>
                @else
                    <img src="{{asset('public/images/User-image.png')}}">
                @endif
            </div><br>
            <form action="{{action('QuantriController@DoiHinhDaiDienQT')}}" enctype="multipart/form-data" method="post" class="form-horizontal">
                <input type='hidden' name='_token' value="<?= csrf_token();?>"/>
                <div align="center">
                    <input type="file" name="fHinh" id="fHinh" /><br> 
                    <p style='color:red;'>{{$errors->first('fHinh')}}</p>
                    <button type="submit" class="btn btn-success" style="width:30%;">
                        <img src="{{asset('public/images/save-as-icon.png')}}"> Lưu hình
                    </button>
                </div>
            </form>
        </div>
        <form action="{{action('QuantriController@LuuDoiMatKhauQT')}}" method="post" name="frmDoiMatKhau" class="form-horizontal">
            <input type='hidden' name='_token' value="<?= csrf_token();?>"/>            
            <div class="col-md-8">
                <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">ĐỔI MẬT KHẨU</h3>
                <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center" style="max-width:800px;">
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
                            <p style='color:red;'>{{$errors->first('txtMatKhauCu')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Mật khẩu mới:</th>
                        <td>
                            <input type="password" id="txtMatKhauMoi1" name="txtMatKhauMoi1" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtMatKhauMoi1')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Nhập lại mật khẩu mới:</th>
                        <td>
                            <input type="password" id="txtMatKhauMoi2" name="txtMatKhauMoi2" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtMatKhauMoi2')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 20%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;
                            <a href="{{asset('quantri/thongtinqt')}}" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                            </a>                              
                        </td>
                    </tr>
                </table>                   
            </div> 
        </form>
    </div><!-- /row -->

</div> <!-- /container -->
@endsection
