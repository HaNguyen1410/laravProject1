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
        <div class="col-md-6"><strong style="font-size: 18pt; color: blue;">root</strong></div>
        <div class="col-md-6" style="display: inline-flex;">
            <a href=""><img src="{{asset('images/chart-icon.png')}}">Thống kê</a> &nbsp; | &nbsp;
            <form action="" id="" method="get">
                Bản điều chỉnh: &nbsp; <input type="text" name="" id="" value="">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="20%">Tên dự án</th>
                    <th width="5%">Cỡ</th>
                    <th width="12%">Bản điều chỉnh</th>
                    <th width="10%">Thời gian</th>
                    <th width="20%">Tác giả</th>
                    <th width="50%">Ghi chú</th>
                </tr>
                <tr>
                    <td><img src="{{asset('images/folder-page-icon.png')}}"/>  Website bán đồ nội thất</td>
                    <td></td>
                    <td>2</td>
                    <td>2 ngày trước</td>
                    <td>Trấn Thành</td>
                    <td>Cập nhật thêm chức năng mới trong tài liệu đặc tả</td>
                </tr>
                <tr>
                    <td><img src="{{asset('images/folder-page-icon.png')}}"/>  Phần mềm quản lý nghiên cứu khoa học</td>
                    <td>3M</td>
                    <td>10</td>
                    <td>4 ngày trước</td>
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
        <h3 style="color: darkblue; font-weight: bold;">&nbsp;&nbsp;Bản điều chỉnh sau cùng</h3>
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="3%">#</th>
                    <th width="10%">Tên bản điều chỉnh</th>
                    <th width="12%">Ngày</th>
                    <th width="10%">Tác giả</th>
                    <th width="30%">Nội dung điều chỉnh</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td>02/01/2014</td>
                    <td>Hoàng Trung Long</td>
                    <td>Tài liệu phân tích yêu cầu phần mềm</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td>23/02/2014</td>
                    <td>Phan Ngọc Yến</td>
                    <td>Tài liệu đặc tả sơ bộ</td>
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
    </div>
</div>
@endsection