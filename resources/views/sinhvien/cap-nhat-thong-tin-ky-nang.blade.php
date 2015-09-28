@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>

<div class="container">  
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">
                Cập nhật thông tin các kỹ năng: 
            </h3>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <form action="{{action('SinhvienController@LuuCapNhatThongTin')}}" method="post">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered" border="0" width="800px" id="bang2">
                        <tr>
                            <th width="20%">Mã số sinh viên:</th>
                            <td>                                
                                <input type="text" name="txtMaSV" value="<?php echo $sv['mssv'];?>" style="width:30%; text-align: center;" class="form-control" readonly=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td>
                                <input type="text" name="txtDienThoai" value="<?php echo $sv['sdt'];?>" class="form-control">
                                <p style='color:red;'>{{$errors->first('txtDienThoai')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Kỹ năng công nghệ:</th>
                            <td>
                                <textarea class="form-control" name="txtCongNghe" rows="3"><?php echo $sv['kynangcongnghe'];?></textarea>                                            
                            </td>
                        </tr>
                        <tr>
                            <th>Kiến thức về ngôn lập trình:</th>
                            <td>
                                <textarea class="form-control" name="txtLapTrinh" rows="3" style="text-align: left;"><?php echo $sv['kienthuclaptrinh'];?></textarea>
                                <p style='color:red;'>{{$errors->first('txtLapTrinh')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Kinh nghiệm:</th>
                            <td>
                                <textarea class="form-control" name="txtKinhNghiem" rows="3"><?php echo $sv['kinhnghiem'];?></textarea>
                                <p style='color:red;'>{{$errors->first('txtKinhNghiem')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">
                                <button type="submit" name="btnLuu" class="btn btn-primary" style="width: 20%;">
                                    <img src="{{asset('public/images/save-as-icon.png')}}"> Lưu 
                                </button>&nbsp;&nbsp;
                                <a href="../thongtinsv" class="btn btn-warning" style="width:20%;">
                                    <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                                </a>                                  
                            </td>                                  
                        </tr>
                    </table>
                </form>   
            </div>            
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection