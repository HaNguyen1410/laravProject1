@extends('sinhvien_home')

@section('content_sv')

        <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }

        </style>
        
        <script>
            function dschon_detai() {
                $macb = document.getElementById('txtMaCB').value;
                //prompt($macb);
                //alert($macb);
                var _window = window.open("http://localhost/laravProject1/resources/views/sinhvien/chon-de-tai.php/1111317", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=800, height=400");
                _window.onbeforeunload = function()
                {
                    location.reload();
                }
            }
        </script>

<div class="container">

    <div class="row">
        <div class="col-md-12">
        <h3 style="color: darkblue; font-weight: bold;" align='center'>ĐĂNG KÝ NHÓM LÀM NIÊN LUẬN</h3> 
        <h4 style="color: darkblue; font-weight: bold;">Đăng ký thành viên</h4>
        <form name="frmThemTV" action="" method="post">
            <table class="table table-bordered" id="tblChonTV">
                <tr> 
                    <?php echo $n = count($dstensv); ?>                    
                    <td>
                        <div style="border: 1px solid black; padding: 2px 2px; width: 220px;display: block; float: left;">
                            <?php $stt=1; ?>
                            @foreach($dstensv as $sv)
                                 <a href="" data-toggle="tooltip" data-placement="top" title="">
                                       {{$sv->mssv}}
                                   </a>
                                   : <input type="checkbox" name="chk[]" value=""/>&nbsp&nbsp&nbsp&nbsp
                                   Nhóm trưởng: <input type="radio" name="rdNhomTruong" value=''/><br>                                     

                                 <?php $stt++; ?>                                      
                                  @if($stt == 6)
                                      <?php break; continue; ?>
                                  @endif  
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align='center'>
                        <input type="submit" name="btnThem" value="Thêm thành viên" class="btn btn-primary">
                    </td>
                </tr>                
            </table> 
        </form>
        <h4 style="color: darkblue; font-weight: bold;">Đăng ký đề tài</h4>    
        <form name="frmDangKyNL" action="" method="post">
            <table class="table table-bordered" border="1" width="800px" cellpadding="15px" cellspacing="0px" align='center' id="dangky">
                <tr>
                    <th>Mã cán bộ:</th>
                    <td width="15%">
                        <input type="text" id="txtMaCB" name="txtMaCB" value="" class="form-control" readonly="true"/>
                    </td>
                    <th width="20%">Họ và tên cán bộ hướng dẫn:</th>
                    <td>
                        <input type="text" name="txtTen" value="" class="form-control" readonly="true"/>
                    </td>
                </tr>
                <tr>
                    <th width='15%' valign='middle'>Chọn đề tài:</th>
                    <td align="center">
                            <input onclick="dschon_detai()" type="radio" id="rdMaDT" name="rdMaDT" value="" title="Nhấp chuột vào để chọn đề tài"/>
                    </td>
                    <td align='center' colspan="3">
                        <input type="text" name="" value="Tên đề tài được chọn" class="form-control" readonly=""/>
                    </td>

                </tr>
                <tr>
                    <th>Ngày họp nhóm:</th>
                    <td colspan="3">
                        <table class="table table-bordered" border="0" cellpadding="0px" cellspacing="0px" align="center">
                            <tr>
                                <th>Chọn buổi họp nhóm:</th>
                                <td>
                                    <select class="form-control" name="cbBuoi">
                                        <option value="S">Buổi sáng</option>
                                        <option value="C">Buổi chiều</option>
                                    </select>                                        
                                </td>
                                <th>Chọn ngày trong tuần:</th>
                                <td>
                                    <select class="form-control" name="cbThu">
                                        <option value="2">Thứ 2</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="5">Thứ 5</option>
                                        <option value="6">Thứ 6</option>
                                        <option value="7">Thứ 7</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Tổ chức nhóm:</th>
                    <td align='center' colspan="3">
                        <textarea name="txtToChucNhom" rows="2" cols="2" class="ckeditor"></textarea>
                            <script language="javascript">
                                CKEDITOR.replace( 'txtToChucNhom',
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
                                        ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                        ['Style','FontFormat','FontName','FontSize']]
                                });
                            </script>
                    </td>
                </tr>
                <tr>
                    <th>Phạm vi đề tài:</th>
                    <td align='center' colspan="3">
                        <textarea name="txtPhamVi" rows="2" cols="2" class="ckeditor"></textarea>
                            <script language="javascript">
                                CKEDITOR.replace( 'txtPhamVi',
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
                                        ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                        ['Style','FontFormat','FontName','FontSize']]
                                });
                            </script>
                    </td></tr>
                <tr>
                    <th>Mô tả đề tài (Nếu có):</th>
                    <td align='center' colspan="3">
                        <textarea name="txtMoTa" rows="2" cols="2" class="ckeditor"></textarea>
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
                                        ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                        ['Style','FontFormat','FontName','FontSize']]
                                });
                            </script>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align='center'>
                        <button type="submit" name="btnDangKy" class="btn btn-success" style="width: 20%;">
                            Đăng ký 
                        </button>
                    </td>
                </tr>
            </table>
        </form>
        </div>    

    </div> <!-- /row -->

</div> <!-- /container -->

@endsection
