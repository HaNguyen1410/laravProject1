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
            <h3 style="color: darkblue; font-weight: bold;">
                <a href="{{asset('sinhvien/phancv')}}">Phân công việc</a>  
                    &Gt;
                Thêm công việc
            </h3> 
            <form action="{{action('PhancvController@LuuThemcvChinh')}}" method="post">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" width="800px" cellpadding="15px" cellspacing="0px">
                    <tr>
                        <th width="10%">Mã công việc:</th>
                        <td width="20%">
                            <!-- Lấy mã nhóm thực hiện -->
                            <input type='hidden' name='txtMaNhomNL' value="{{$manth}}"/>
                            <input style="width:40%;text-align: center;" type="text" name="txtMaCV" value="{{$ma}}" class="form-control" readonly=""/>
                        </td>
                        <th width="10%">Tên công việc:</th>
                        <td colspan="2" width="20%">
                            <input type="text" name="txtTenCV" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTenCV')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Ngày thực hiện:</th>
                        <td width="30%">
                           <input type="text" id="txtNgayBatDauKH" name="txtNgayBatDauKH" value="" class="form-control"/>
                           <p style='color:red;'>{{$errors->first('txtNgayBatDauKH')}}</p>
                        </td>
                        <th width="10%">Ngày kết thúc:</th>
                        <td colspan="2" width="30%">
                            <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKetThucKH')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Giao cho:</th>
                        <td colspan="2">
                            @foreach($dstv as $tv)
                                <div style="padding: 2px 2px 2px 20px; display: block; float: left;">  
                                     <a href="" data-toggle="tooltip" data-placement="top" title="{{$tv->hoten}}">
                                           {{$tv->mssv}}
                                     </a>
                                       : <input type="checkbox" name="chkGiaoCho[]" value="{{$tv->hoten}}"/> 
                                </div>   
                            @endforeach
                                <div style="padding: 2px 2px 2px 20px; display: block; float: left;">  
                                    <a>Cả nhóm</a>
                                       : <input type="checkbox" name="chkGiaoCho[]" value="Cả nhóm"/> 
                                </div>
                            <p style='color:red;'>{{$errors->first('chkGiaoCho')}}</p>
                        </td>
                        <th>Số tuần thực tế</th>
                        <td>
                            <input type="text" id="txtTuanThucTe" name="txtTuanThucTe" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTuanThucTe')}}</p>
                        </td>
                    </tr>
                    <tr>                        
                        <th>Trong tuần:</th>
                        <td>
                            <input type="text" name="txtTuan" value=""  placeholder="Theo dạng: 1-3 từ tuần 1 đến 3 hoặc 4" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTuan')}}</p>
                        </td>
                        <th>Tiến độ (%):</th>
                        <td colspan="2">
                            <input type="text" id="txtTienDo" name="txtTienDo" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTienDo')}}</p>
                        </td>
                    </tr>
                    <tr>                            
                        <th>Trạng thái</th>
                        <td>
                            <select class="form-control" size="1" name="cbTrangThai">
                                <option value="Đang làm">Đang làm</option>
                                <option value="Sắp làm">Sắp làm</option>
                                <option value="Hoàn thành">Hoàn thành</option>
                            </select>
                            <p style='color:red;'>{{$errors->first('cbTrangThai')}}</p>
                        </td>
                         <th width="13%">Độ ưu tiên:</th>
                         <td colspan="2">
                            <select class="form-control" size="1" name="cbUuTien">
                                <option value="Cao">Cao</option>
                                <option value="Trung bình">Trung bình</option>
                                <option value="Thấp">Thấp</option>
                            </select>
                            <p style='color:red;'>{{$errors->first('cbUuTien')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Nội dung công việc:</th>
                        <td colspan="4">
                            <textarea name="txtNoiDungViec" rows="2" cols="2" class="ckeditor"></textarea>
                            <p style='color:red;'>{{$errors->first('txtNoiDungViec')}}</p>
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
                        <td></td>
                        <td colspan="4" align="center">
                            <button type="submit" name="btnThem" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Thêm công việc
                            </button>&nbsp;&nbsp;
                            <a href="../phancv" class="btn btn-warning" style="width:20%;">
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
