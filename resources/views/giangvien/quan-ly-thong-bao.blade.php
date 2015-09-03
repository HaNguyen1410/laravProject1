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
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">Quản lý các thông báo</h3>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <form action="" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nội dung thông báo:</th>
                            <td colspan="3">
                                <textarea class="form-control" rows="4"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th title="Bắt đầu mở hệ thống cho sinh viên nộp tài liệu">Thời gian bắt đầu</th>
                            <td>
                                <input type="text" id="txtNgayBatDau" name="txtBatDauNop" value="" class="form-control"/>
                            </td>
                            <th title="Hạn chót mở hệ thống cho sinh viên nộp tài liệu">Thời hạn kết thúc</th>
                            <td>
                                <input type="text" id="txtNgayKetThuc" name="txtKetThucNop" value="" class="form-control"/>
                            </td>
                        </tr>
                        <tr>
                            <th>Đóng hệ thống:</th>
                            <td colspan="2">
                                <input type="checkbox" name="chkDongNop" value=""/>
                            </td>
                            <td>
                                <a href="2134/themdetai">
                                    <button type="button" name="" class="btn btn-primary">
                                        <img src="{{asset('images/add-icon.png')}}">Thêm Thông báo
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </table>
                    
                    
                </form>
            </div>
            <table class="table table-bordered" cellpadding="15px" cellspacing="10px">
                <tr>
                    <th>STT</th>
                    <th>Nội dung thông báo</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời hạn kết thúc</th>
                    <th>Ngày tạo</th>
                    <th>Đóng hệ thống</th>
                    <th>Thao tác</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Nộp tài liệu đặc tả sơ bộ</td>
                    <td>12/02/2014</td>
                    <td>24/02/2014</td>
                    <td>11/02/2014</td>
                    <td align='center'>
                        <img src="{{asset('images/Unlock.png')}}"/>
                    </td>
                    <td align='center'>
                        <a href=""><img src="{{asset('images/edit-icon.png')}}"/></a>&nbsp
                        <a onclick="return confirm('Thông báo **** sẽ bị xóa?');" href="">
                            <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nộp sơ đồ mô tả chức năng</td>
                    <td>20/02/2014</td>
                    <td>30/02/2014</td>
                    <td>11/02/2014</td>
                    <td align='center'>
                        <img src="{{asset('images/Lock.png')}}"/>
                    </td>
                    <td align='center'>
                        <a href=""><img src="{{asset('images/edit-icon.png')}}"/></a>&nbsp
                        <a onclick="return confirm('Thông báo **** sẽ bị xóa?');" href="">
                            <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                        </a>
                    </td>
                </tr>                            
            </table>
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection