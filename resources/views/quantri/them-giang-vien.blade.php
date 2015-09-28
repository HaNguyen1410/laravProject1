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
                    <img src="{{asset('public/images/excel-icon.png')}}"> Thêm
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <h3 style="color: darkblue; font-weight: bold;">THÊM NGƯỜI DÙNG</h3>      
            <form action="{{action('QuantriController@LuuThemGV')}}" method="post" name="frmThemGV" class="form-horizontal">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table" cellpadding="0px" cellspacing="0px" align='center'>
                    <tr>
                        <td>Năm học:</td>
                        <td>
<!--                            <input type="text" name="txtNamHoc" value="{{$mank}}" class="form-control" readonly=""/>-->
                            <input type="text" name="txtNamHoc" value="{{$nam}}" class="form-control" readonly="" style="text-align: center;"/>
                        </td>
                        <td width="15%" align="right" style="color:darkblue;">Học kỳ:</td>
                        <td>
                            <input type="text" name="txtNamHoc" value="{{$hk}}" class="form-control" readonly="" style="text-align: center;"/>
                        </td>
                    </tr> 
                    <tr>
                        <td width="30%">Mã cán bộ:</td>
                        <td colspan="3">
                            <input type="text" size="2" value="{{$ma}}" name="txtMaCB" class="form-control" readonly=""/>
                            <p style='color:red;'>{{$errors->first('txtMaCB')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Họ và tên:</td>
                        <td colspan="3">
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
                        <td align="right" style="color:darkblue;">Ngày sinh:</td>
                        <td colspan="3">
                            <input type="text" size="2" value="" id="txtNgaySinh" name="txtNgaySinh" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtNgaySinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td colspan="3">
                            <input type="text" value="" name="txtEmail" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtEmail')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td colspan="3">
                            <input type="text" value="" name="txtSDT" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtSDT')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Nhóm học phần:</td>
                        <td colspan="3">
                            @foreach($dshp as $hp)
                                {{$hp->tennhomhp}}: <input type="checkbox" name="chkNhomHP[]" value="{{$hp->manhomhp}}" /> &nbsp;&nbsp;&nbsp;
                            @endforeach
                             <p style='color:red;'>{{$errors->first('chkNhomHP')}}</p>
                        </td>
                    </tr>                     
                    <tr>
                        <td>Mật khẩu:</td>
                        <td colspan="3">
                            <input type="password" value="" name="txtMatKhau1" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhau1')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Nhập lại mật khẩu:</td>
                        <td colspan="3">
                            <input type="password" value="" name="txtMatKhau2" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhau2')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">
                            <button  type="submit" name="btnThem" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Thêm
                            </button> &nbsp;&nbsp;
                            <a href="{{Asset('quantri/giangvien')}}" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                            </a>                                
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div><!-- /row -->

</div> <!-- /container -->

@endsection