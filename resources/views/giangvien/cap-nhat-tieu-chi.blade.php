@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            font-weight: bold;
        }
    </style>

<div class="container">
    <div class="row">
        <form action="{{action('QdtieuchiController@LuuCapNhatTieuChi')}}" method="post" name="frmDoiMatKhau" class="form-horizontal">
            <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
            <div class="col-md-8">
                <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">Thêm tiêu chí đánh giá</h3>
                <table class="table table-bordered" align="center" style="width:600px;">
                    <tr>
                        <th width="20%">Mã tiêu chí:</th>
                        <td width="50%">
                            <input style="width:35%; text-align: center;" type="text" name="txtMaTC" value="{{$tc->matc}}" class="form-control" readonly="true" /> 
                        </td>
                    </tr>
                    <tr>
                        <th>Nội dung đánh giá:</th>
                        <td>
                            <input type="text" name="txtNoiDungTC" value="{{$tc->noidungtc}}" class="form-control" />
                            <p style='color:red;'>{{$errors->first('txtNoiDungTC')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Mức điểm:</th>
                        <td>
                            <input type="text" name="txtMucDiem" value="{{$tc->heso}}" class="form-control" /> 
                            <p style='color:red;'>{{$errors->first('txtMucDiem')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 20%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;
                            <a href="{{asset('giangvien/dstieuchi/2134')}}" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('images/delete-icon.png')}}"> Hủy bỏ
                            </a>                              
                        </td>
                    </tr>
                </table>                   
            </div> 
        </form>
    </div><!-- /row -->

</div> <!-- /container -->
@endsection