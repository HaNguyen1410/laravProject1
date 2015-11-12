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
        <form action="{{action('ChianhomController@LuuChuyenThanhVien')}}" method="post" name="frmDoiMatKhau" class="form-horizontal">
            <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
            <div class="col-md-12">
                <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">
                    <a href="{{asset('giangvien/chianhom')}}">Chia nhóm</a>  
                       &Gt;
                    Chuyển nhóm
                </h3>    
                <!-- Thông báo lỗi nhiều nhóm trưởng ở 1 nhóm -->
                <p style="color: red; font-weight: bold; text-align: center">{{ Session::get('NhieuNhomTruong') }}</p>
                
                <table class="table table-bordered" align="center" style="max-width:800px;">
                    <tr>
                        <th>Học kỳ: </th>
                        <td width="20%">
                            <input type="text" name="txtMaSV" value="{{$hkht}}" style="text-align: center;" class="form-control" readonly=""/>
                        </td>
                        <th>Năm học:</th>
                        <td>                                 
                            <input type="text" name="txtHoTen" value="{{$namht}}" class="form-control" style="width: 60%; text-align: center;" readonly=""/> 
                        </td>
                    </tr>
                    <tr>
                        <th>Mã sinh viên:</th>
                        <td width="20%">
                            <input type="text" name="txtMaSV" value="{{$sv_chuyen->mssv}}" style="text-align: center;" class="form-control" readonly=""/>
                        </td>
                        <th>Họ tên:</th>
                        <td>                                 
                            <input type="text" name="txtHoTen" value="{{$sv_chuyen->hoten}}" class="form-control" readonly=""/> 
                        </td>
                    </tr>
                    <tr>
                        <th>Chuyển sang nhóm:</th>
                        <td>
                            <select class="form-control" name='cbNhomThucHien'>  
                                @foreach($manhom as $manth)
                                    @if($sv_chuyen->manhomthuchien == $manth->manhomthuchien)
                                        <option value="{{$manth->manhomthuchien}}" selected="true">{{$sv_chuyen->manhomthuchien}}</option>
                                    @elseif($sv_chuyen->manhomthuchien != $manth->manhomthuchien)
                                        <option value="{{$manth->manhomthuchien}}">{{$manth->manhomthuchien}}</option>
                                    @endif
                                @endforeach  
                            </select>                            
                        </td>
                        <th>Nhóm trưởng:</th>
                        <td>  
                            @if($sv_chuyen->nhomtruong == 1)
                            <input type="checkbox" name="chkNhomTruong" checked=""/> 
                            @else
                                <input type="checkbox" name="chkNhomTruong"/> 
                            @endif                                
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 20%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;
                            <a href="{{asset('giangvien/chianhom')}}" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                            </a>                              
                        </td>
                    </tr>
                </table>                   
            </div> 
        </form>
    </div><!-- /row -->

</div> <!-- /container -->
@endsection