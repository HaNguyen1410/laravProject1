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

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;" align='center'>THÊM THÔNG TIN NHÓM ĐỀ TÀI NIÊN LUẬN</h3>   
            <form name="frmDangKyNL" action="{{action('SVthongtinnhomController@LuuThemThongTinNhom')}}" method="post">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" border="1" style="max-with: 800px;" cellpadding="15px" cellspacing="0px" align='center' id="dangky">
                    <tr>
                        <th  width='15%'>Mã cán bộ:</th>
                        <td width="15%">
                            <input type="text" id="txtMaCB" name="txtMaCB" value="{{$thongtindt->macb}}" style="text-align: center;" class="form-control" readonly="true"/>
                        </td>
                        <th width="15%">Họ và tên cán bộ hướng dẫn:</th>
                        <td width="15%">
                            <input type="text" name="txtTen" value="{{$thongtindt->hoten}}" class="form-control" readonly="true"/>
                        </td>                        
                        <th width='15%' valign='middle'>Mã nhóm thực hiện:</th>
                        <td width='15%' align='center'>
                            <input type="text" name="txtMaNhomNL" value="{{$manth}}" style="text-align: center;" class="form-control" readonly=""/>
                        </td>
                    </tr>
                    <tr>
                        <th valign='middle'>Đề tài được giao:</th>
                        <td align='center' colspan="5">
                            <input type="text" name="" value="{{$thongtindt->tendt}}" class="form-control" readonly=""/>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày họp nhóm:</th>
                        <td colspan="5">                          
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Sáng thứ 2</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="S2"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Sáng thứ 3</label>  &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="S3"/>                            
                            </div> 
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Sáng thứ 4</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="S4"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Sáng thứ 5</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="S5"/>                            
                            </div>
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Sáng thứ 6</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="S6"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Sáng thứ 7</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="S7"/>                            
                            </div>
                         <!-- Chọn buổi chiều -->
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 2</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="C2"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 3</label>  &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="C3"/>                            
                            </div> 
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 4</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="C4"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 5</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="C5"/>                            
                            </div>
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 6</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="C6"/>                            
                            </div>   
                            <div style="padding: 2px 2px 2px 40px; display: block; float: left;">  
                                <label>Chiều thứ 7</label> &nbsp;&nbsp;&nbsp; <input type="checkbox" name="chkBuoiHop[]" value="C7"/>                            
                            </div>
                            <p style='color:red;'>{{$errors->first('chkBuoiHop')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Các buổi đã chọn</th>
                        <td colspan='5'>                            
                            <?php
                               //Chuyển chuổi thành các phần tử trong 1 mảng 
                                $ngay = explode(', ', $nhom->lichhop);
                                //var_dump($ngay); //Xem kết quả của mảng vừa tách được từ chuỗi ban đầu 
                                for($i = 0; $i < count($ngay); $i++){                                    
                                    //Cắt số trong chuỗi ngày
                                    $ngay_so = substr($ngay[$i],1); 
                                    $kytu = substr($ngay[$i], 0, 1);
                                    //So sánh ký tự đầu tiên
                                    $bs = strcasecmp($kytu, 'S');
                                    $bc = strcasecmp($kytu, 'C');
                                    if($bs == 0){
                                        echo "<div style='padding: 2px 2px 2px 40px; display: block; float: left;'>".  
                                            "<label style='color:green;'>Sáng thứ ".$ngay_so."</label> &nbsp;&nbsp;&nbsp;".                           
                                         "</div>";
                                    }
                                    else if($bc == 0){
                                        echo "<div style='padding: 2px 2px 2px 40px; display: block; float: left;'>".  
                                                "<label style='color:green;'>Chiều thứ ".$ngay_so."</label> &nbsp;&nbsp;&nbsp;".                           
                                             "</div>";                                        
                                    }
                                }                                    
                            ?>                        
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày bắt đầu (Kế hoạch):</th>
                        <td>
                            <input type="text" name="txtNgayBatDauThucTe" value="{{$nhom->ngaybatdau_kehoach}}" class="form-control" readonly=""/>                            
                        </td>
                        <th width="18%">Ngày kết thúc (Kế hoạch):</th>
                        <td>
                            <input type="text" name="txtNgayKTThucTe" value="{{$nhom->ngayketthuc_kehoach}}" class="form-control" readonly=""/>                           
                        </td>
                        <th>Số tuần kế hoach:</th>
                        <td width="15%">
                            <input type="text" id="txtGioThucTe" name="txtTuanThucTe" value="{{$nhom->sotuan_kehoach}}" class="form-control" readonly=""/>                            
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày bắt đầu (thực tế):</th>
                        <td>
                            <input type="text" id="txtNgayBatDauThucTe" name="txtNgayBatDauThucTe" value="{{$nhom->ngaybatdau_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayBatDauThucTe')}}</p>
                        </td>                        
                        <th width="18%">Ngày kết thúc (thực tế):</th>
                        <td>
                            <input type="text" id="txtNgayKTThucTe" name="txtNgayKTThucTe" value="{{$nhom->ngayketthuc_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKTThucTe')}}</p>
                        </td>
                        <th>Tiến độ (%):</th>
                        <td>
                            <input type="text" name="txtTienDo" value="{{$nhom->tiendo}}" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtTienDo')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Tổ chức nhóm:</th>
                        <td align='center' colspan="5">
                            <textarea name="txtToChucNhom" rows="2" cols="2" class="ckeditor">
                                {{$nhom->tochucnhom}}
                            </textarea>
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
                            <p style='color:red;'>{{$errors->first('txtToChucNhom')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Phạm vi đề tài:</th>
                        <td align='center' colspan="5">
                            <textarea name="txtPhamVi" rows="2" cols="2" class="ckeditor">{{$nhom->phamvi_detai}}</textarea>
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
                        <td align='center' colspan="5">
                            <textarea name="txtCongNgheThucHien" rows="2" cols="2" class="ckeditor">{{$nhom->congnghethuchien}}</textarea>
                                <script language="javascript">
                                    CKEDITOR.replace( 'txtCongNgheThucHien',
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
                        <td colspan="6" align='center'>
                            <button type="submit" name="btnLuu" class="btn btn-success">
                                <img src="{{asset('public/images/save-as-icon.png')}}">&nbsp;
                                Lưu thông tin
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>    

    </div> <!-- /row -->

</div> <!-- /container -->

@endsection
