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
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">Quản lý các thông báo</h3>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <form action="{{action('QlthongbaoController@LuuThemThongBao')}}" method="post">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nội dung thông báo:</th>
                            <td colspan="4">
                                <textarea class="form-control" name="txtNoiDungTB" rows="4"></textarea>
                                <p style='color:red;'>{{$errors->first('txtNoiDungTB')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th title="Bắt đầu mở hệ thống cho sinh viên nộp tài liệu">Thời gian bắt đầu</th>
                            <td>
                                <input type="text" id="txtNgayBatDau" name="txtBatDauNop" value="" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtBatDauNop')}}</p>
                            </td>
                            <th title="Hạn chót mở hệ thống cho sinh viên nộp tài liệu">Thời hạn kết thúc</th>
                            <td>
                                <input type="text" id="txtNgayKetThuc" name="txtKetThucNop" value="" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtKetThucNop')}}</p>
                            </td>
                        </tr>
                        <tr>                        
                            <th>Mã cán bộ và Mã Thông báo:</th>
                            <td align="center">
                                <input type="text" name="txtMaTB" value="{{$ma}}" style=" width: 90px; text-align: center; color: #006400; font-weight: bold; display: block; float: left;"  class="form-control" readonly=""/>
                                <input type="text" name="txtMaCB" value="{{$macb}}" size="5" style="width:40%; text-align: center;" class="form-control" readonly=""/>
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
                            <th>Đóng hệ thống:</th>
                            <td>
                                <input type="checkbox" name="chkDongNop" value="" style="margin-left: 10px; margin-right: 10px"/>                               
                            </td>
                            <td colspan="2" align="center">
                                <button type="submit" name="" class="btn btn-primary">
                                    <img src="{{asset('images/add-icon.png')}}">Thêm Thông báo
                                </button>
                            </td>
                        </tr>
                    </table>                                      
                </form>
            </div>
   
            <table class="table table-bordered table-hover" cellpadding="15px" cellspacing="10px">
                <tr>
                    <th width="1%">STT</th>
                    <th width="25%">Nội dung thông báo</th>
                    <th width="10%">Thực hiện</th>
                    <th width="8%">Thời gian bắt đầu</th>
                    <th width="8%">Thời hạn kết thúc</th>
                    <th width="8%">Ngày tạo</th>
                    <th width="8%">Ngày sửa</th>
                    <th width="8%">Đóng hệ thống</th>
                    <th width="8%">Thao tác</th>
                </tr>                                  
                    @if(count($dsthongbao) == 0)
                        <tr>
                            <td colspan="9" align="center">
                                <label style="color: #e74c3c;"> Chưa có thông báo nào!</label> 
                            </td>
                        </tr>
                    @elseif (count($dsthongbao) > 0)
                        @foreach($dsthongbao as $stt => $tb)
                            <tr>
                                <td align="center">{{$stt+1}}</td>
                                <td>{{$tb->noidungtb}}</td>
                                <td align="center">{{$tb->manhomthuchien}}</td>
                                <td align="center">{{$tb->batdautb}}</td>
                                <td align="center">{{$tb->ketthuctb}}</td>
                                <td align="center">{{$tb->ngaytao}}</td>
                                <td align="center">{{$tb->ngaysua}}</td>
                                <td align='center'>
                                    @if($tb->donghethong == 1)
                                        <img src="{{asset('images/lock.png')}}"/>
                                    @elseif ($tb->donghethong == 0)   
                                        <img src="{{asset('images/Unlock.png')}}"/>
                                    @endif
                                </td>
                                <td align='center'>
                                    <a href="2134/capnhatthongbao/{{$tb->matb}}">
                                        <img src="{{asset('images/edit-icon.png')}}"/>
                                    </a>&nbsp
                                    <a onclick="return confirm('Thông báo **{{$tb->matb}}** sẽ bị xóa?');" href="2134/xoathongbao/{{$tb->matb}}">
                                        <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                                    </a>
                                </td>
                            </tr>
                        @endforeach                    
                    @endif
           </table>
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection