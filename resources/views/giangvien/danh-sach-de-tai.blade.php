@extends('giangvien_home')

@section('content_gv')

        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }
        </style>   

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">Danh sách các đề tài</h3> 
            <div class="bg-success">
                <table class="table table-bordered" cellpadding="15px" cellspacing="10px">
                    <tr> 
                        <td align="right">Mã cán bộ:</td>
                        <td style="color: darkblue; font-weight: bold;">
                            
                        </td>
                        <td align="right">Giảng viên:</td>
                        <td colspan="5" style="color: darkblue; font-weight: bold;"></td>
                    </tr>
                    <tr>                             
                        <td align="right">Nhóm học phần:</td>
                        <td>
                            <select class="form-control">
                                <option value="">01</option>
                                <option value="">03</option>
                                <option value="">03</option>  
                            </select>
                        </td>
                        <td align="right">Trạng thái:</td>
                        <td>
                            <select class="form-control">
                                <option value="-1">Tất cả</option>
                                <option value="Chưa thực hiện">Chưa thực hiện</option>
                                <option value="Đang thực hiện">Đang thực hiện</option>
                                <option value="Hoàn thành">Hoàn thành</option>
                            </select>
                        </td>
                        <td>
                            <a href="?cn=themdt">
                                <button type="button" name="" class="btn btn-primary">
                                <img src="images/add-icon.png">Thêm đề tài
                            </button></a>
                        </td>
                    </tr>
                </table> 
            </div> <!-- /bg-success -->

            <table class="table table-bordered table-hover" width="800px" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th width="2%">STT</th>
                    <th width="20%">Tên đề tài</th>
                    <th width="15%">Mô tả đề tài</th>
                    <th width="15%">Công nghệ</th>
                    <th width="5%">Tối đa</th>
                    <th width="15%">Lưu ý</th>
                    <th width="8%">Phân loại</th>
                    <th width="4%">Duyệt</th>
                    <th width="8%">Thao tác</th>
                </tr>
              
            </table>
        </div>
    </div><!-- /row -->
</div> <!-- /container -->

@endsection