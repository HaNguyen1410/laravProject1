@extends('quantri_home')

@section('content_quantri')
      
    <style type="text/css">
        td:first-child{
            text-align: right;
            color: darkblue;
        }
    </style>


<div class="container">
    <div class="row">
        <div class="col-md-4">  <!-- Upload file danh sách gv  -->                      
            <h3 style="color: darkblue; font-weight: bold;">THÊM DANH SÁCH</h3><br>                    
            <div align="center"><input type="file"  />Chọn hình</div><br>
            <div align="center">
                <button  type="submit" name="" class="btn btn-info">
                    <img src="{{asset('images/excel-icon.png')}}"> Thêm
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <h3 style="color: darkblue; font-weight: bold;">THÊM NGƯỜI DÙNG</h3>      
            <form action="{{action('QuantriController@LuuThemGV')}}" method="post" name="frmThemGV" class="form-horizontal">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table" cellpadding="0px" cellspacing="0px" align='center'>
                    <tr>
                        <td>Mã cán bộ:</td>
                        <td>
                            <input type="text" size="2" value="" name="txtMaCB" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMaCB')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Họ và tên:</td>
                        <td>
                            <input type="text" size="2" value="" name="txtHoTen" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtHoTen')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Giới tính:</td>
                        <td>
                            Nam: <input type="radio" size="2" value="Nam" name="rdGioiTinh"/> &nbsp &nbsp &nbsp
                            Nữ: <input type="radio" size="2" value="Nữ" name="rdGioiTinh"/> 
                            <p style='color:red;'>{{$errors->first('rdGioiTinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Ngày sinh:</td>
                        <td>
                            <input type="text" size="2" value="" id="txtNgaySinh" name="txtNgaySinh" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtNgaySinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="text" value="" name="txtEmail" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtEmail')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td>
                            <input type="text" value="" name="txtSDT" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtSDT')}}</p>
                        </td>
                    </tr>
                    <tr></tr> 
                    <tr>
                        <td>Mật khẩu:</td>
                        <td>
                            <input type="password" value="" name="txtMatKhau1" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhau1')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Nhập lại mật khẩu:</td>
                        <td>
                            <input type="password" value="" name="txtMatKhau2" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhau2')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button  type="submit" name="btnThem" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Thêm
                            </button> &nbsp;&nbsp;
                            <a href="{{Asset('quantri/danhsachgv')}}" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('images/delete-icon.png')}}"> Hủy bỏ
                            </a>                                
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div><!-- /row -->

</div> <!-- /container -->

@endsection