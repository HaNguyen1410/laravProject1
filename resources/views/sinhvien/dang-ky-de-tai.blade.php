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
                var _window = window.open("{{asset('sinhvien/chondetai/1111317')}}", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=90, left=90, width=1200, height=400");
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
            <form name="frmThemTV" action="{{action('DangkydtController@LuuThemThanhVien')}}" method="post">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" id="tblChonTV">
                    <tr>                   
                        <td align="center">                                                  
                                @foreach($dstensv as $sv)
                                <div style="padding: 2px 2px 2px 60px; display: block; float: left;">  
                                     <a href="" data-toggle="tooltip" data-placement="top" title="{{$sv->hoten}}">
                                           {{$sv->mssv}}
                                       </a>
                                       : <input type="checkbox" name="chk[]" value="{{$sv->mssv}}"/>&nbsp&nbsp&nbsp
                                       Nhóm trưởng: <input type="radio" name="rdNhomTruong" value=""/><br>   
                                </div>                                                                
                                @endforeach                                
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align='center'>
                            <div style="display: block;">                                    
                                <p style='color:red;'>{{$errors->first('chk')}}</p>
                                <p style='color:red;'>{{$errors->first('rdNhomTruong')}}</p>
                            </div>
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
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Sáng thứ 2</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="S2"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Sáng thứ 3</label>  &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="S3"/>                            
                            </div> 
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Sáng thứ 4</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="S4"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Sáng thứ 5</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="S5"/>                            
                            </div>
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Sáng thứ 6</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="S6"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Sáng thứ 7</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="S7"/>                            
                            </div>
                         <!-- Chọn buổi chiều -->
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Chiều thứ 2</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="C2"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Chiều thứ 3</label>  &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="C3"/>                            
                            </div> 
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Chiều thứ 4</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="C4"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 43px; display: block; float: left;">  
                                <label>Chiều thứ 5</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="C5"/>                            
                            </div>
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 6</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="C6"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 7</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop" value="C7"/>                            
                            </div>
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
                        <th>Mô tả công nghệ <br> thực hiện (Nếu có):</th>
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
