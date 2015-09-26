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
        <div class="col-md-4">  <!-- Upload file danh sách sv  -->                      
            <h3 style="color: darkblue; font-weight: bold;">CẬP NHẬT DANH SÁCH</h3><br>                    
            <div align="center"><input type="file"  />Chọn hình</div><br>
            <div align="center">
                <button  type="submit" name="" class="btn btn-info">
                    <img src="{{asset('public/images/excel-icon.png')}}"> Cập nhật
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <h3 style="color: darkblue; font-weight: bold;">CẬP NHẬT SINH VIÊN</h3>
            <form action="{{action('QuantriController@LuuCapNhatSV')}}" method="post" class="form-horizontal">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table" cellpadding="0px" cellspacing="0px" align='center'>
                    <tr>
                        <td>Năm học:</td>
                        <td>
<!--                            <input type="text" name="txtNamHoc" value="{{$mank}}" class="form-control" readonly=""/>-->
                            <input type="text" name="txtNamHoc" value="{{$nam}}" class="form-control" readonly="" style="text-align: center;"/>
                        </td>
                        <td width="10%" align="right" style="color:darkblue;">Học kỳ:</td>
                        <td>
                            <input type="text" name="txtNamHoc" value="{{$hk}}" class="form-control" readonly="" style="text-align: center;"/>
                        </td>
                    </tr> 
                    <tr>
                        <td width="30%">Mã số sinh viên:</td>
                        <td>
                            <input type="text" name="txtMaSV" value="<?= $sv->mssv ?>" class="form-control" readonly="true"/>
                            <p style='color:red;'>{{$errors->first('txtMaSV')}}</p>
                        </td>
                        <td width='20%' align='right' style="color:darkblue;">
                            <label>Mở tài khoản:</label>
                        </td>
                        <td>
                            <?php
                                if($sv->khoa == 0){
                                    echo "<input type='checkbox' name='ckbKhoa' value='0' checked='true'/>";
                                }
                                elseif ($sv->khoa == 1) {
                                    echo "<input type='checkbox' name='ckbKhoa' value='1' />";
                                }
                            ?> 
                        </td>  
                    </tr>
                    <tr>
                        <td>Họ và tên:</td>
                        <td colspan="3">
                            <input type="text" name="txtHoTen" value="<?= $sv->hoten ?>" class="form-control"/> 
                            <p style='color:red;'>{{$errors->first('txtHoTen')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Ngày sinh:</td>
                        <td colspan="3">
                            <input type="text" id="txtNgaySinh" name="txtNgaySinh" value="<?= $sv->ngaysinh ?>" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtNgaySinh')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Giới tính:</td>
                        <td>
                             <?php
                                $gtNam = strcasecmp($sv->gioitinh, 'Nam');
                                $gtNu = strcasecmp($sv->gioitinh, 'Nữ');
                                if($gtNam == 0 && $gtNu != 0){
                                    echo "Nam: <input type='radio' name='rdGioiTinh' id='rdGioiTinh' value='Nam' checked='true'/> &nbsp&nbsp";
                                    echo "Nữ: <input type='radio' name='rdGioiTinh' id='rdGioiTinh' value='Nữ'/> &nbsp&nbsp";
                                }
                                elseif ($gtNam != 0 && $gtNu == 0) {
                                    echo "Nam: <input type='radio' name='rdGioiTinh' id='rdGioiTinh' value='Nam'/> &nbsp&nbsp";
                                    echo "Nữ: <input type='radio' name='rdGioiTinh' id='rdGioiTinh' value='Nữ' checked='true'/>";
                                }
                            ?>  
                        </td>
                        <td width="8%" align="right" style="color:darkblue;">Khóa học:</td>
                        <td width="30%">
                            <input type="text" name="txtKhoaHoc" value="<?= $sv->khoahoc ?>" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtKhoaHoc')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Nhóm học phần:</td>
                        <td colspan="3">
                            @foreach($dshp as $hp)
                                @if($sv_hp == $hp->manhomhp)
                                    {{$hp->tennhomhp}}: <input type="radio" name="rdNhomHP" value="{{$hp->manhomhp}}" checked=""/> &nbsp;&nbsp;&nbsp;
                                @else
                                    {{$hp->tennhomhp}}: <input type="radio" name="rdNhomHP" value="{{$hp->manhomhp}}" /> &nbsp;&nbsp;&nbsp;
                                @endif                                
                            @endforeach
                             <p style='color:red;'>{{$errors->first('rdNhomHP')}}</p>
                        </td>  
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td colspan="3">
                            <input type="text" name="txtEmail" value="<?= $sv->email ?>" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtEmail')}}</p>
                        </td>
                    </tr> 
<!--                    <tr>
                        <td>Mật khẩu hiện tại:</td>
                        <td colspan="3">
                            <input type="password" id="txtMatKhauCu" name="txtMatKhauCu" value="" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhauCu')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Mật khẩu mới:</td>
                        <td colspan="3">
                            <input type="password" id="txtMatKhauMoi1" name="txtMatKhauMoi1" value="" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhauMoi1')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Nhập lại mật khẩu mới:</td>
                        <td colspan="3">
                            <input type="password" id="txtMatKhauMoi2" name="txtMatKhauMoi2" value="" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtMatKhauMoi2')}}</p>
                        </td>
                    </tr>-->
                    <tr>
                        <td></td>
                        <td colspan="3">
                            <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width:30%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;
                            <a href="{{Asset('quantri/danhsachsv')}}" class="btn btn-warning" style="width:30%;">
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
