@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>
    <script type="text/javascript">
        $(function() {
          $( "#txtNgayBatDau" ).datepicker({
              dateFormat: "yy-mm-dd"
          });
        });
        $(function() {
          $( "#txtNgayKetThuc" ).datepicker({
              dateFormat: "yy-mm-dd"
          });
        });
    </script>

<div class="container">  
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">
                Thêm thông báo: 
            </h3>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <form action="{{action('QlthongbaoController@LuuThemThongBao')}}" method="post" enctype="multipart/form-data">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered">
                        <tr>                        
                            <th>Mã Thông báo:</th>
                            <td align="center">
                                <input type="text" name="txtMaTB" value="{{$ma}}" style=" width: 90px; text-align: center; color: #006400; font-weight: bold; display: block; float: left;"  class="form-control" readonly=""/>
<!--                                <input type="text" name="txtMaCB" value="{{$macb}}" size="5" style="width:40%; text-align: center;" class="form-control" readonly=""/>-->
                            </td>
                            <th>Nhóm thực hiện:</th>
                            <td>
                                <select class="form-control" name="cbNhomNL">
                                    <option value="Tất cả">Tất cả</option>
                                    @foreach($dsnhomth as $nhom)
                                        <option value="{{$nhom->manhomthuchien}}">{{$nhom->manhomthuchien}}</option>                                        
                                    @endforeach
                                </select>
                            </td>    
                        </tr>
                        <tr>
                            <th>Nội dung thông báo:</th>
                            <td colspan="4">
                                <textarea class="form-control" name="txtNoiDungTB" rows="4"></textarea>
                                <p style='color:red;'>{{$errors->first('txtNoiDungTB')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th title="Bắt đầu mở hệ thống cho sinh viên nộp tài liệu">Thời gian bắt đầu</th>
                            <td width="25%">
                                <input type="text" id="txtNgayBatDau" name="txtBatDauNop" value="" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtBatDauNop')}}</p>
                            </td>
                            <th title="Hạn chót mở hệ thống cho sinh viên nộp tài liệu">Thời hạn kết thúc</th>
                            <td width="25%">
                                <input type="text" id="txtNgayKetThuc" name="txtKetThucNop" value="" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtKetThucNop')}}</p>
                            </td>
                        </tr>
                        <tr>   
                            <th>Đính kèm:</th>
                            <td colspan="3">
                                <input type="file" name="fDinhKemTB"/>
                                <p style='color:red;'>{{$errors->first('fDinhKemTB')}}</p>
                            </td>
<!--                            <th>Đóng hệ thống:</th>
                            <td>
                                <input type="checkbox" name="chkDongNop" value="" style="margin-left: 10px; margin-right: 10px"/>                               
                            </td>                            -->
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                                <button type="submit" name="" class="btn btn-primary">
                                    <img src="{{asset('public/images/add-icon.png')}}">Thêm thông báo
                                </button>
                                <a href="{{asset('giangvien/quanlythongbao')}}" class="btn btn-warning" style="margin-left: 10px; min-width:15%">
                                    <img src="{{asset('public/images/delete-icon.png')}}">Hủy Bỏ
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