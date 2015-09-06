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
        <!-- Bảng các tài liệu đã được chỉnh sửa -->
        <h3 style="color: darkblue; font-weight: bold;">&nbsp;&nbsp;Chi tiết tài liệu dự án: </h3>
         <label style="font-size: 15pt; font-weight: bold; color: #2ca02c; margin-left: 50px">
             {{$dt->tendt}}
         </label><br><br>
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="1%">STT</th>
                    <th width="5%">Mã tài liệu</th>
                    <th width="16%">Tên tài liệu</th>
                    <th width="8%">Ngày đăng</th>
                    <th width="18%">Tác giả</th>
                    <th width="20%">Mô tả nội dung</th>
                    <th width="20%">Giảng viên nhận xét</th>
                    <th width="8%">Ngày đánh giá</th>
                </tr>
                @foreach($dstailieu as $stt => $tl)
                     <tr>
                        <td>{{$stt+1}}</td>
                        <td>{{$tl->matl}}</td>
                        <td>
                            <a href="" style="color: black" data-toggle="tooltip" data-placement="bottom" title="Kích thước tập tin: {{$tl->kichthuoc}}">
                                {{$tl->tentl}}
                            </a>                            
                        </td>
                        <td>{{$tl->ngaycapnhat}}</td>
                        <td>{{$tl->giaocho}}</td>
                        <td>{{$tl->mota}}</td>
                        <td>{{$tl->nd_danhgia}}</td>
                        <td>{{$tl->ngaydanhgia}}</td>
                    </tr>
                @endforeach
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
                <label>Mã tài liệu:</label>
                <select class="form-control" name="cbMaTL" style="width:10%">
                    @foreach($dstailieu as $tl)
                        <option value="{{$tl->matl}}">{{$tl->matl}}</option>
                    @endforeach
                </select><br>
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