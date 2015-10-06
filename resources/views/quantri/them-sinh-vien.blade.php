@extends('quantri_home')

@section('content_quantri')
      
    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>

<div class="container">
    <div class="row">
<!--        
        <div class="col-md-4">   Upload hình đại diện  
            <h3 style="color: darkblue; font-weight: bold;">THÊM DANH SÁCH SINH VIÊN</h3><br>
            <form enctype="multipart/form-data" action="" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                <div align="center"><input type="file" name="fDanhSach" id="fDanhSach" /></div><br>
                <div align="center">
                    <button  type="submit" class="btn btn-info">
                        <img src="{{asset('public/images/excel-icon.png')}}"> Thêm
                    </button>
                </div>
            </form>                                    
        </div>
        <div class="col-md-8"></div>-->
        
        <div class="col-md-12" align="center">
            <h3 style="color: darkblue; font-weight: bold;">THÊM SINH VIÊN</h3>
            <form action="{{action('QuantriController@LuuThemSV')}}" method="post" name="frmThemSV" class="form-horizontal">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table" cellpadding="0px" cellspacing="0px" align='center' style="width:700px">
                    <tr>
                        <th>Năm học:</th>
                        <td>
<!--                            <input type="text" name="txtNamHoc" value="{{$mank}}" class="form-control" readonly=""/>-->
                            <input type="text" name="txtNamHoc" value="{{$nam}}" class="form-control" readonly="" style="text-align: center;"/>
                        </td>
                        <th width="10%" align="right" style="color:darkblue;">Học kỳ:</th>
                        <td>
                            <input type="text" name="txtNamHoc" value="{{$hk}}" class="form-control" readonly="" style="text-align: center;"/>
                        </td>
                    </tr> 
                    <tr>
                        <th>Mã số sinh viên:</th>
                        <td>
                            <input type="text" size="2" value="{{$ma}}" name="txtMaSV" class="form-control" readonly=""/>
                            <p style='color:red;'>{{$errors->first('txtMaSV')}}</p>
                        </td>                        
                        <th width="12%" align="right" style="color:darkblue;">Khóa học:</th>
                        <td width="30%">
                            <input type="text" value="" name="txtKhoaHoc" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtKhoaHoc')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Họ và tên:</th>
                        <td colspan="3">
                            <input type="text" size="2" value="" name="txtHoTen" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtHoTen')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Giới tính:</th>
                        <td>
                            Nam: <input type="radio" size="2" value="Nam" name="rdGioiTinh"/> ;&nbsp;&nbsp;&nbsp
                            Nữ: <input type="radio" size="2" value="Nữ" name="rdGioiTinh"/> 
                            <p style='color:red;'>{{$errors->first('rdGioiTinh')}}</p>
                        </td>
                        <th width="8%" align="right" style="color:darkblue;">Ngày sinh:</th>
                        <td>
                            <input type="text" size="2" value="" id="txtNgaySinh" name="txtNgaySinh" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtNgaySinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td colspan="3">
                            <input type="text" value="" name="txtEmail" class="form-control"> 
                        </td>
                    </tr>
                    <tr>
                        <th>Nhóm học phần:</th>
                        <td colspan="3">
                            @foreach($dshp as $hp)
                            {{$hp->tennhomhp}}: <input type="radio" name="rdNhomHP" value="{{$hp->manhomhp}}" /> &nbsp;&nbsp;&nbsp;
                            @endforeach
                             <p style='color:red;'>{{$errors->first('rdNhomHP')}}</p>
                        </td>  
                    </tr>
                    <tr>
                        <th>Mật khẩu:</th>
                        <td colspan="3">
                            <input type="password" value="" name="txtMatKhau1" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhau1')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Nhập lại mật khẩu:</th>
                        <td colspan="3">
                            <input type="password" value="" name="txtMatKhau2" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhau2')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <button  type="submit" name="btnThem" class="btn btn-primary" style="width:30%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Thêm
                            </button>&nbsp;&nbsp;
                            <a href="{{Asset('quantri/sinhvien')}}" class="btn btn-warning" style="width:30%;">
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
