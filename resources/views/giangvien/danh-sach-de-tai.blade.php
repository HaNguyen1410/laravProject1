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
                        <td align="right">Năm học:</td>
                        <td width="14%"></td>
                        <td align="right">Học kỳ:</td>
                        <td width="10%"></td>
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
                            <a href="2134/themdetai">
                                <button type="button" name="" class="btn btn-primary">
                                <img src="{{asset('images/add-icon.png')}}">Thêm đề tài
                            </button></a>
                        </td>
                    </tr>
                </table> 
            </div> <!-- /bg-success -->
            
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-bordered table-hover" width="800px">
                <tr>
                    <th width="2%">STT</th>
                    <th width="20%">Tên đề tài</th>
                    <th width="15%">Mô tả đề tài</th>
                    <th width="15%">Công nghệ</th>
                    <th width="4%">Tối đa</th>
                    <th width="15%">Lưu ý</th>
                    <th width="8%">Phân loại</th>
                    <th width="10%">Trạng thái</th>
                    <th width="4%">Duyệt</th>
                    <th width="8%">Thao tác</th>
                </tr>
                @foreach($dsdt as $stt => $dt)
                    <tr>
                        <td align='center'>{{$stt+1}}</td>
                        <td width='20%'>{{$dt->tendt}}</td>
                        <td>{{$dt->motadt}}</td>
                        <td>{{$dt->congnghe}}</td>
                        <td align='center'>{{$dt->songuoitoida}}</td>
                        <td>{{$dt->ghichudt}}</td>
                        <td align='center'>{{$dt->phanloai}}</td>
                        <td align='center'>{{$dt->trangthai}}</td>
                        <td align='center'>  
<!--                            <a href=''><img src="{{asset('images/uncheck.png')}}"/></a>
                            <a href=''><img src="{{asset('images/check.png')}}"/></a>-->
                            {{$dt->duyet}}
                        </td>
                        <td align='center'>
                            <a href="2134/capnhatdetai/{{$dt->madt}}"><img src="{{asset('images/edit-icon.png')}}"/></a>&nbsp
                            <a onclick="return confirm('Đề tài **{{$dt->tendt}}** sẽ bị xóa?');" href="xoadt/{{$dt->madt}}">
                                <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div><!-- /row -->
</div> <!-- /container -->

@endsection