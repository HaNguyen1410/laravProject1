@extends('giangvien_home')

@section('content_gv')

        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }
            #bang1 td:first-child{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
                font-weight: bold;
            }
            
        </style>

 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;">THÊM ĐỀ TÀI MỚI</h3>                
            <form action="{{action('DetaiController@LuuThemDeTai')}}" method="post"  name="formThemDeTai" >  
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" id="bang1">
                    <tr>
                        <td align="right">Năm học:</td>
                        <td></td>
                        <th align="right">Học kỳ:</th>
                        <td></td>                        
                    </tr>
                    <tr>
                        <td width="25%">Mã đề tài:</td>
                        <td>
                            <input style="width:30%; text-align: center;" type="text" id="txtMaDeTai" name="txtMaDeTai" value="{{$ma}}" class="form-control" readonly=""/> 
                            <input type='text' name='txtMaCB' value='{{$macb}}'/>
                        </td>
                        <th align="right" width="10%">Nhóm học phần:</th>
                        <td width="10%">
                            <select class="form-control" name="cbNhomHP">
                                @foreach($nhomhp as $hp)
                                    <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Tên đề tài:</td>
                        <td colspan="3">
                            <input type="text" id="txtTenDeTai" name="txtTenDeTai" value="" class="form-control" /> 
                            <p style='color:red;'>{{$errors->first('txtTenDeTai')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Số sinh viên tối đa</td>
                        <td>
                            <input type="text" id="txtSoNguoi" name="txtSoNguoi" value="" class="form-control" /> 
                            <p style='color:red;'>{{$errors->first('txtSoNguoi')}}</p>
                        </td>
                        <th>Phân loại:</th>
                        <td>
                            <select class="form-control" name="cbmPhanLoai">
                                <option value="Gợi ý">Đề tài gợi ý</option>
                                <option value="Đề xuất">Được đề xuất</option>                                       
                            </select> 
                        </td>
                    </tr>                                            
                    <tr>
                        <td>Mô tả:</td>
                        <td colspan="3">
                            <textarea name="txtMoTa" rows="2" cols="2" class="ckeditor"></textarea>
                            <script language="javascript">
                                CKEDITOR.replace('txtMoTa',
                                        {
                                            skin: 'kama',
                                            extraPlugins: 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar: [['Font'],
                                                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
                                                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
                                                ['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
                                                ['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                                                ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                                ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                        });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Công nghệ thực hiện:</td>
                        <td colspan="3">
                            <textarea name="txtCongNghe" rows="2" cols="2" class="ckeditor"></textarea>
                            <script language="javascript">
                                CKEDITOR.replace('txtCongNghe',
                                        {
                                            skin: 'kama',
                                            extraPlugins: 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar: [['Font'],
                                                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
                                                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
                                                ['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
                                                ['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                                                ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                                ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                        });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Những yếu tố cần lưu ý trong đề tài:</td>
                        <td colspan="3">
                            <textarea name="txtGhiChu" rows="2" cols="2" class="ckeditor"></textarea>
                            <script language="javascript">
                                CKEDITOR.replace('txtGhiChu',
                                        {
                                            skin: 'kama',
                                            extraPlugins: 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar: [['Font'],
                                                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
                                                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
                                                ['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
                                                ['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                                                ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                                ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                        });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td>
                            <select class="form-control" name="cbmTrangThai">
                                <option value="Chưa làm">Chưa làm</option>
                                <option value="Đang làm">Đang làm</option>
                                <option value="Đã hoàn thành">Đã hoàn thành</option>                                        
                            </select> 
                        </td>
                        <th width="15%">Tập tin đính kèm:</th>
                        <td><input type="file" name="fTapTinKem"/></td>
                    </tr>                    
                    <tr>
                        <td></td>
                        <td align="center" colspan="3">
                            <button type="submit" name="btnThem" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Thêm
                            </button>
                            <a href="{{asset('giangvien/danhsachdetai/2134')}}" class="btn btn-warning" style="width:20%;">
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
