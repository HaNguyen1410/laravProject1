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
                        <td align="right">Năm học:</td>
                        <td width="14%">
                            <select class="form-control" name='cbNamHoc'>
                                @foreach($namhoc as $nk)
                                <option value="{{$nk->nam}}">{{$nk->nam}}</option>  
                                @endforeach
                            </select>
                        </td>
                        <td align="right">Học kỳ:</td>
                        <td width="10%">
                            <select class="form-control" name='cbHocKy'>
                                @foreach($hocky as $nk)
                                <option value="{{$nk->hocky}}">{{$nk->hocky}}</option>  
                                @endforeach
                            </select>
                        </td>
                        <td align="right">Nhóm học phần:</td>
                        <td>
                            <select class="form-control" name='cbNhomHP'>
                                @foreach($nhomhp as $hp)
                                <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>  
                                @endforeach
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
                        <td width='15%'>
                            {{$dt->tendt}}
                            <a href='$taptin'  align='center'><img src="{{asset('images/Filetype-PDF-icon.png')}}"/></a>
                        </td>
                        <td width='15%'>{{$dt->motadt}}</td>
                        <td width='15%'>{{$dt->congnghe}}</td>
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
                <tr>
                    <td colspan="10" align="center">{!! $dsdt->setPath('danhsachdetai/2134')->render() !!}</td>
                </tr>
            </table>
        </div>
    </div><!-- /row -->
</div> <!-- /container -->

@endsection