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
         <div class="col-md-12" align="center">
            <h3>Ghi nhận xét - đánh giá tài liệu</h3>
            <form action="{{action('QltailieuController@LuuDanhGia')}}" method="post">
                <input type="hidden" name="_token" value="<?= csrf_token();?>"/>
                <table class="table table-bordered" style="width: 800px;">
                    <tr>
                        <th>Mã cán bộ:</th>
                        <td>
                            <input type="text" name="txtMaCB" value="{{$macb}}" style="width: 50%;" class="form-control" readonly=""/>
                        </td>
                        <th>Mã tài liệu:</th>
                        <td>
                            <select class="form-control" name="cbMaTL">
                                <option value="">--Chọn mã tài liệu--</option>
                                @foreach($dstailieu as $tl)
                                    <option value="{{$tl->matl}}">{{$tl->matl}}</option>
                                @endforeach
                            </select>  
                            <p style='color:red;'>{{$errors->first('cbMaTL')}}</p>
                       </td>
                    </tr>
                    <tr>
                        <th>Nhận xét - Đánh giá</th>
                        <td colspan="3">
                            <textarea class="form-control" name="txtDanhGia" rows="6"></textarea><br>
                            <p style='color:red;'>{{$errors->first('txtDanhGia')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <button type="submit" class="btn btn-primary" style="width: 10%">
                                <img src="{{asset('public/images/save-as-icon.png')}}">Lưu
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="1%">STT</th>
                    <th width="5%">Mã tài liệu</th>
                    <th width="16%">Tên tài liệu</th>
                    <th width="8%">Ngày đăng</th>
                    <th width="15%">Tác giả</th>
                    <th width="15%">Mô tả nội dung</th>
                    <th width="20%">Giảng viên nhận xét</th>
                    <th width="8%">Ngày đánh giá</th>
                </tr>
                @foreach($dstailieu as $stt => $tl)
                     <tr>
                        <td>{{$stt+1}}</td>
                        <td>{{$tl->matl}}</td>
                        <td>
                            <a href="../../../../tailieu/{{$tl->tentl}}" style="color: #2ca02c" data-toggle="tooltip" data-placement="bottom" title="Kích thước tập tin: {{$tl->kichthuoc}}">
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
        </div>        
    </div>
</div>
@endsection