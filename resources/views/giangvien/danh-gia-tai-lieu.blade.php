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
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;"> Ghi nhận xét - đánh giá tài liệu</h3>            
            <label style="font-size: 15pt; font-weight: bold; color: #2ca02c; margin-left: 50px">
                Tên đề tài: {{$dt->tendt}}
            </label><br><br> 
            <form action="{{action('QltailieuController@LuuDanhGia')}}" method="post">
                <input type="hidden" name="_token" value="<?= csrf_token();?>"/>
                <table class="table table-bordered" style="width: 900px;" align="center">
                    <tr>
                        <th>Giai đoạn:</th>
                        <td colspan="3"><label style="color: #006400;">{{$tailieu->congviec}}</label></td>
                    </tr>
                    <tr>
                        <th>Mã cán bộ:</th>
                        <td>
                            <input type="text" name="txtMaCB" value="{{$macb}}" style="width: 50%; text-align:center;" class="form-control" readonly=""/>
                        </td>
                        <th>Mã tài liệu:</th>
                        <td>
                            <input type="text" name="txtMaTL" value="{{$matl}}" style="width: 50%; text-align:center;" class="form-control" readonly=""/>
                            <p style='color:red;'>{{$errors->first('txtMaTL')}}</p>
                       </td>
                    </tr>
                    <tr>
                        <th>Nhận xét - Đánh giá</th>
                        <td colspan="3">
                            <textarea class="form-control" name="txtDanhGia" rows="6">{{$tailieu->nd_danhgia}}</textarea><br>
                            <p style='color:red;'>{{$errors->first('txtDanhGia')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <button type="submit" class="btn btn-primary" style="width: 15%">
                                <img src="{{asset('public/images/save-as-icon.png')}}">Lưu
                            </button>&nbsp;&nbsp;
                            <a href="../../{{$manth}}" class="btn btn-warning" style="width:15%;">
                                <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection