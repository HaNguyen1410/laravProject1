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
                Cập nhật thông báo: 
                <lable style="border: 0px; color: #006400">{{$tb->matb}}</lable>
            </h3>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <form action="{{action('QlthongbaoController@LuuCapNhatThongBao')}}" method="post">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nội dung thông báo:</th>
                            <td colspan="4">
                                <textarea class="form-control" name="txtNoiDungTB" rows="4">{{$tb->noidungtb}}</textarea>
                                <p style='color:red;'>{{$errors->first('txtNoiDungTB')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th title="Bắt đầu mở hệ thống cho sinh viên nộp tài liệu">Thời gian bắt đầu</th>
                            <td>
                                <input type="text" id="txtNgayBatDau" name="txtBatDauNop" value="{{$tb->batdautb}}" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtBatDauNop')}}</p>
                            </td>
                            <th title="Hạn chót mở hệ thống cho sinh viên nộp tài liệu">Thời hạn kết thúc</th>
                            <td>
                                <input type="text" id="txtNgayKetThuc" name="txtKetThucNop" value="{{$tb->ketthuctb}}" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtKetThucNop')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Nhóm thực hiện:</th>
                            <td>
                                <select class="form-control" name="cbNhomNL">
                                    <option value="Tất cả">Tất cả</option>
                                    @foreach($dsnhomth as $nhom)
                                        <option value="{{$nhom->manhomthuchien}}">{{$nhom->manhomthuchien}}</option>                                        
                                    @endforeach
                                </select>
                            </td>     
                            <th>Mã Thông báo:</th>
                            <td align="center">
                                <input type="text" name="txtMaTB" value="{{$tb->matb}}" style=" width: 90px; text-align: center; color: #006400; font-weight: bold; display: block; float: left;"  class="form-control"/>                               
                            </td>                           
                        </tr>
                        <tr>
                            <th>Đóng hệ thống:</th>
                            <td align="center">
                                @if($tb->donghethong == 1)
                                    <input type="checkbox" name="chkDongNop" value="1" checked="true" style="margin-left: 10px; margin-right: 10px"/>
                                @elseif($tb->donghethong == 0)
                                    <input type="checkbox" name="chkDongNop" value="0" style="margin-left: 10px; margin-right: 10px"/>
                                @endif
                            </td>
                            <td colspan="2" align="center">
                                <button type="submit" name="" class="btn btn-primary" style="width:25%">
                                    <img src="{{asset('images/add-icon.png')}}">Cập Nhật
                                </button>
                                <a href="{{asset('giangvien/quanlythongbao/2134')}}" class="btn btn-warning" style="margin-left: 10px; width:25%">
                                    <img src="{{asset('images/delete-icon.png')}}">Hủy Bỏ
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