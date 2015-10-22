@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            background-color: #dff0d8;
            font-weight: bold;
        }
    </style>

<div class="container">
    <div class="row">
         <form action="{{action('QdtieuchiController@LuuThemTieuChi')}}" method="post" name="frmDoiMatKhau" class="form-horizontal"> 
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <h3 style="color: darkblue; font-weight: bold; margin-left: 50px; text-align: center">
                        Thêm tiêu chí đánh giá
                    </h3>
                    <table class="table table-bordered" align="center" style="width:800px;">
                        <tr>
                            <th>Mã cán bộ:</th>
                            <td>
                                <input type="text" name="txtMaCB" value="2134" style="width: 60%; text-align: center;" class="form-control" readonly=""/>
                            </td>
                            <th>Mã tiêu chí:</th>
                            <td>                                 
                                <input style="width:35%; text-align: center;" type="text" name="txtMaTC" value="{{$ma}}" class="form-control" readonly=""/> 
                            </td>
                        </tr>
                        <tr>
                            <th>Nội dung đánh giá:</th>
                            <td colspan="3">
                                 <textarea class="form-control" rows="3" name="txtNoiDungTC"></textarea>
                                 <p style='color:red;'>{{$errors->first('txtNoiDungTC')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Mức điểm:</th>
                            <td colspan="3">
                                <input type="text" name="txtMucDiem" value="" class="form-control" /> 
                                <p style='color:red;'>{{$errors->first('txtMucDiem')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                                <button type="submit" name="btnThem" class="btn btn-primary" style="width: 20%;">
                                    <img src="{{asset('public/images/save-as-icon.png')}}"> Thêm
                                </button> 
                                <a href="{{asset('giangvien/dstieuchi')}}" class="btn btn-warning" style="width:20%;">
                                    <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                                </a> 
                            </td>                            
                        </tr>
                    </table>       
            </form>
    </div><!-- /row -->

</div> <!-- /container -->
@endsection