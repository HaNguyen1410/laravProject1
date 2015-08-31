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
        <div class="col-md-4">  <!-- Upload hình đại diện --> 
            <h3 style="color: darkblue; font-weight: bold;">THÊM DANH SÁCH SINH VIÊN</h3><br>
            <form enctype="multipart/form-data" action="" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                <div align="center"><input type="file" name="fDanhSach" id="fDanhSach" /></div><br>
                <div align="center">
                    <button  type="submit" class="btn btn-info">
                        <img src="{{asset('images/excel-icon.png')}}"> Thêm
                    </button>
                </div>
            </form>                                    
        </div>
        <div class="col-md-8">
            <h3 style="color: darkblue; font-weight: bold;">THÊM SINH VIÊN</h3>
            <form action="{{action('QuantriController@LuuThemSV')}}" method="post" name="frmThemSV" class="form-horizontal">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table" cellpadding="0px" cellspacing="0px" align='center'>
                    <tr>
                        <td width="30%">Mã số sinh viên:</td>
                        <td colspan="3">
                            <input type="text" size="2" value="{{$ma}}" name="txtMaSV" class="form-control" readonly=""/>
                            <p style='color:red;'>{{$errors->first('txtMaSV')}}</p>
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
                        <td colspan="3">
                            Nam: <input type="radio" size="2" value="Nam" name="rdGioiTinh"/> ;&nbsp;&nbsp;&nbsp
                            Nữ: <input type="radio" size="2" value="Nữ" name="rdGioiTinh"/> 
                            <p style='color:red;'>{{$errors->first('rdGioiTinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Ngày sinh:</td>
                        <td colspan="3">
                            <input type="text" size="2" value="" id="txtNgaySinh" name="txtNgaySinh" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtNgaySinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td colspan="3">
                            <input type="text" value="" name="txtEmail" class="form-control"> 
                        </td>
                    </tr>
                    <tr>
                        <td>Khóa học:</td>
                        <td width="30%">
                            <input type="text" value="" name="txtKhoaHoc" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtKhoaHoc')}}</p>
                        </td>
                        <td width="18%" align="right" style="color:darkblue;">Nhóm học phần:</td>
                        <td colspan="3">
                             <select class="form-control" name="cbNhomHP">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Năm học:</td>
                        <td>
                            <select class="form-control" name="cbNamHoc">
                                <option value="">2013-2014</option>
                            </select>
                        </td>
                        <td width="10%" align="right" style="color:darkblue;">Học kỳ:</td>
                        <td>
                            <select class="form-control" name="cbHocKy">
                                <option value=""></option>
                            </select>
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
                        <td colspan="3">
                            <button  type="submit" name="btnThem" class="btn btn-primary" style="width:30%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Thêm
                            </button>&nbsp;&nbsp;
                            <a href="{{Asset('quantri/danhsachsv')}}" class="btn btn-warning" style="width:30%;">
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
