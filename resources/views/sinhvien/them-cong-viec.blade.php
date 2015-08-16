@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
            }
    </style>
       
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;">Thêm công việc</h3> 
            <form action="" method="post">
                <table class="table table-bordered" width="800px" cellpadding="15px" cellspacing="0px">
                    <tr>
                        <th width="10%">Mã công việc:</th>
                        <td>
                            <input style="width:40%;text-align: center;" type="text" name="txtMaCV" value="" class="form-control" />
                        </td>
                        <th width="10%">Tên công việc:</th>
                        <td>
                            <input type="text" name="txtTenCV" value="" class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Ngày thực hiện:</th>
                        <td width="30%">
                           <input type="text" id="txtNgayBatDauKH" name="txtNgayBatDauKH" value="" class="form-control"/>
                        </td>
                        <th width="10%">Ngày kết thúc:</th>
                        <td width="30%">
                            <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="" class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Giao cho:</th>
                        <td colspan="3">
                            <select name='cbGiaoCho' class="form-control">
                                @foreach($dstv as $tv)
                                <option value="{{$tv->mssv}}">{{$tv->hoten}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Nội dung công việc:</th>
                        <td colspan="3">
                            <textarea name="txtNoiDungViec" rows="2" cols="2" class="ckeditor"></textarea>
                            <script language="javascript">
                                CKEDITOR.replace( 'txtNoiDungViec',
                                {
                                    skin : 'kama',
                                    extraPlugins : 'uicolor',
                                    uiColor: '#eeeeee',
                                    toolbar : [['Font'],
                                        ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'], 
                                        ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                        ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                        ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                        ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                    ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th>Số giờ thực tế</th>
                        <td><input type="text" id="txtGioThucTe" name="txtGioThucTe" value="" class="form-control"/></td>
                        <th>Tiến độ (%):</th>
                        <td><input type="text" id="txtTienDo" name="txtTienDo" value="" class="form-control"/></td>
                    </tr>
                    <tr>                            
                        <th>Trạng thái</th>
                        <td>
                            <select class="form-control" size="1" name="cbTrangThai">
                                <option value="Đang làm">Đang làm</option>
                                <option value="Sắp làm">Sắp làm</option>
                                <option value="Hoàn thành">Hoàn thành</option>
                            </select>
                        </td>
                         <th width="13%">Độ ưu tiên:</th>
                        <td>
                            <select class="form-control" size="1" name="cbUuTien">
                                <option value="Cao">Cao</option>
                                <option value="Trung bình">Trung bình</option>
                                <option value="Thấp">Thấp</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" align="center">
                            <button type="submit" name="btnThem" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Thêm công việc
                            </button>&nbsp;&nbsp;
                            <a href="../../phancv/1111317" class="btn btn-warning" style="width:20%;">
                                <img src="{{asset('images/delete-icon.png')}}"> Hủy bỏ
                            </a>                            
                        </td>
                    </tr>
                </table>
            </form>                    
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->
@endsection
