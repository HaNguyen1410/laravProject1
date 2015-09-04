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
            <h3 style="color: darkblue; font-weight: bold;">SỬA ĐỀ TÀI</h3>  
             <form action="{{action('DetaiController@LuuCapNhatDeTai')}}" method="post" id="formSuaDeTai" name="formSuaDeTai" > 
                 <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                 <table class="table table-bordered" id="bang1">
                    <tr>
                        <td align="right" width='10%'>Năm học:</td>
                        <td align="center"><input type="text" value="{{$namcb}}" style="width:80%;text-align: center" readonly="" class="form-control"/></td>
                        <th align="right">Học kỳ:</th>
                        <td align="center"><input type="text" value="{{$hkcb}}" style="width:30%;text-align: center" readonly="" class="form-control"/></td>                        
                    </tr>
                    <tr>
                        <td>Mã đề tài:</td>
                        <td>
                            <input style="width:30%; text-align: center;" type="text" id="txtMaDeTai" name="txtMaDeTai" value="{{$dt->madt}}" class="form-control" readonly=""/> 
                            <input type='text' name='txtMaCB' value='{{$macb}}'/>
                        </td>
                        <th align="right" width="10%">Nhóm học phần:</th>
                        <td width="20%">
                            <select class="form-control" name="cbNhomHP" style="width:30%">
                                <option value="">01</option>
                                <option value="">03</option>
                                <option value="">03</option> 
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tên đề tài:</td>
                        <td colspan="3">
                            <input type="text" name="txtTenDeTai" value="{{$dt->tendt}}" class="form-control"> 
                            <p style='color:red;'>{{$errors->first('txtTenDeTai')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Số sinh viên tối đa</td>
                        <td width="10%">
                            <input type="text" name="txtSoNguoi" value="{{$dt->songuoitoida}}" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtSoNguoi')}}</p>
                        </td> 
                        <th width="8%">Trạng thái</th>
                        <td>
                            <?php
                                $chuath = strcasecmp($dt->trangthai, 'Chưa làm');
                                $dangth = strcasecmp($dt->trangthai, 'Đang làm');
                                $ht = strcasecmp($dt->trangthai, 'Hoàn thành');
                                if ($chuath == 0 && $dangth != 0 && $ht != 0) {
                                    echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa thực hiện' checked='true'/> &nbsp&nbsp&nbsp&nbsp";
                                    echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang thực hiện'/>&nbsp&nbsp&nbsp&nbsp";
                                    echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành'/>";
                                } elseif ($chuath != 0 && $dangth == 0 && $ht != 0) {
                                    echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa thực hiện'/> &nbsp&nbsp&nbsp&nbsp";
                                    echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang thực hiện' checked='true'/>&nbsp&nbsp&nbsp&nbsp";
                                    echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành'/>";
                                }elseif ($chuath != 0 && $dangth != 0 && $ht == 0) {
                                    echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa thực hiện'/> &nbsp&nbsp&nbsp&nbsp";
                                    echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang thực hiện'/>&nbsp&nbsp&nbsp&nbsp";
                                    echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành' checked='true'/>";
                                }
                            ?>
                        </td>
                    </tr>                                           
                    <tr>
                        <td>Mô tả:</td>
                        <td colspan="3">
                            <textarea name="txtMoTa" rows="2" cols="2" class="ckeditor">{{$dt->motadt}}</textarea>
                            <script language="javascript">
                                CKEDITOR.replace( 'txtMoTa',
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
                        <td>Công nghệ thực hiện:</td>
                        <td colspan="3">
                            <textarea name="txtCongNghe" rows="2" cols="2" class="ckeditor">{{$dt->congnghe}}</textarea>
                            <script language="javascript">
                                CKEDITOR.replace( 'txtCongNghe',
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
                        <td>Những yếu tố cần lưu ý trong đề tài:</td>
                        <td colspan="3">
                            <textarea name="txtGhiChu" rows="2" cols="2" class="ckeditor">{{$dt->ghichudt}}</textarea>
                            <script language="javascript">
                                CKEDITOR.replace( 'txtGhiChu',
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
                        <td>Tập tin đính kèm:</td>
                        <td colspan="3"><input type="file" name="txtTapTinKem"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center" colspan="3">
                            <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;  
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