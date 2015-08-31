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
    <div class="row" style="margin-bottom: 5px;">
        <div class="col-md-6">
            <strong style="font-size: 18pt; color: blue;">Kho tài liệu</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="5%">Mã đề tài</th>
                    <th width="20%">Tên dự án</th>
                    <th width="10%">Mã nhóm</th>
                    <th width="20%">Nhóm trưởng</th>
                    <th width="50%">Ghi chú</th>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="{{asset('images/folder-page-icon.png')}}"/>
                        <a href="">Website bán đồ nội thất</a> 
                    </td>
                    <td></td>
                    <td>Trấn Thành</td>
                    <td>Cập nhật thêm chức năng mới trong tài liệu đặc tả</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="{{asset('images/folder-page-icon.png')}}"/>
                       <a href="">Phần mềm quản lý nghiên cứu khoa học</a> 
                    </td>
                    <td></td>
                    <td>Trung Long</td>
                    <td>Hoàn chỉnh tài liệu thiết kế</td>
                </tr>
            </table>
            <!-- Phân trang -->
            <table class="table" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th>
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">8</a></li>
                            <li>
                                <a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                            </li>
                        </ul>
                    </th>
                </tr>
            </table> <!-- /Phân trang -->
        </div>   
        <!-- Bảng các tài liệu đã được chỉnh sửa -->
        <h3 style="color: darkblue; font-weight: bold;">&nbsp;&nbsp;Chi tiết tài liệu dự án</h3>        
         &nbsp;&nbsp; &nbsp;&nbsp;
         <label style="font-size: 13pt; font-weight: bold; color: #2ca02c;">
             Tên đề tài
         </label>
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="3%">STT</th>
                    <th width="10%">Tên tài liệu</th>
                    <th width="5%">Cỡ</th>
                    <th width="12%">Ngày đăng</th>
                    <th width="10%">Tác giả</th>
                    <th width="20%">Mô tả nội dung</th>
                    <th width="20%">Giảng viên nhận xét</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td>02/01/2014</td>
                    <td>Hoàng Trung Long</td>
                    <td>Tài liệu phân tích yêu cầu phần mềm</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                    <td>23/02/2014</td>
                    <td>Phan Ngọc Yến</td>
                    <td>Tài liệu đặc tả sơ bộ</td>
                    <td>
                        
                    </td>
                </tr>
            </table> 
            <!-- Phân trang -->
            <table class="table" border="0" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th>
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">8</a></li>
                            <li>
                                <a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                            </li>
                        </ul>
                    </th>
                </tr>
            </table> <!-- /Phân trang -->
        </div>
        <div class="col-md-12">
            <form action="" method="post">
                <label>Mã tài liệu</label>
                <select class="form-control" name="cbMaTL" style="width:10%">
                    <option value=""></option>
                </select>
                 <label>Nhận xét của giảng viên:</label>
                <textarea class="form-control" name="" style="width:50%" rows="10"></textarea><br>
                <button type="button" name="" class="btn btn-primary">
                    <img src="{{asset('images/save-as-icon.png')}}">Lưu
                </button>
            </form>
        </div>
    </div>
</div>
@endsection