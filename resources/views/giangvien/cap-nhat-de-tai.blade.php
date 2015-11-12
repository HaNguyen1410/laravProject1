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
    
    <script type="text/javascript">
        function DoiGD(){
            if(document.getElementById('rdCapNhatTapTin').checked == true){
                return window.location.href = 'http://localhost/laravProject1/giangvien/danhsachdetai/capnhatdetai/1?gd=tt';                    
            }
            else if(document.getElementById('rdCapNhatMoTa').checked == true){
               return window.location.href = 'http://localhost/laravProject1/giangvien/danhsachdetai/capnhatdetai/1?gd=mt';                    
            }
        }
    </script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;">
                <a href="{{asset('giangvien/danhsachdetai')}}">Danh sách đề tài</a>  
                &Gt;
                Sửa đề tài
            </h3>  
            <div class="col-md-12" align="center">
                <form action="" method="get">
                    <label style="font-size: 13pt; color: darkblue; font-weight: bold;">Cập nhật tập tin mô tả đính kèm</label> 
                        &nbsp;<input type="radio" onclick="DoiGD()" id="rdCapNhatTapTin" name="rdCapNhat" 
                                    <?php
                                        if(!isset($_GET['gd']) || $_GET['gd'] == "tt")
                                            echo 'checked';
                                        else if($_GET['gd'] == "mt")
                                            echo '';
                                    ?>     
                             /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label style="font-size: 13pt; color: darkblue; font-weight: bold;">Cập nhật mô tả đề tài</label>
                        &nbsp;<input type="radio" onclick="DoiGD()" id="rdCapNhatMoTa" name="rdCapNhat"
                                    <?php
                                        if(!isset($_GET['gd']) || $_GET['gd'] == "tt")
                                            echo '';
                                        else if($_GET['gd'] == "mt")
                                            echo 'checked';
                                    ?>                                        
                              />  
                </form>                                
            </div><br><br>
            @if(!isset($_GET['gd']) || $_GET['gd'] == "tt" )
                <form action="{{action('DetaiController@UploadMoTaDeTai')}}" method="post" enctype="multipart/form-data">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <p style="color: #e74c3c; font-weight: bold;" align="center">{!! Session::get('success') !!}</p>
                    <table class="table table-bordered"> 
                         <tr>
                            <th width="15%">Tên đề tài:</th>
                            <td colspan="6">
                                <input type="text" id="txtTenDeTai" name="txtTenDeTai" value="{{$dt->tendt}}" class="form-control" /> 
                                <p style='color:red;'>{{$errors->first('txtTenDeTai')}}</p>
                            </td>
                        </tr>
                        <tr> 
                            <th>Mã cán bộ:</th>
                            <td width="10%">
                                <input type="text" name="txtMaCB" value="{{$macb}}" style="text-align: center;" readonly="true" class="form-control"/>
                            </td>
                            <th>Mã đề tài:</th>
                            <td width="10%">
                                <input type="text" name="txtMaDT" value="{{$dt->madt}}" style="text-align: center;" readonly="true" class="form-control"/>
                            </td>
                            <th>Tập tin đính kèm:</th>
                            <td><input type="file" id="fTapTinKem" name="fTapTinKem"/></td>
                            <p style='color:red;'>{{$errors->first('txtTapTinKem')}}</p>
                            <td align='center'>
                                 <button type="submit" class="btn btn-warning">
                                        <img src="{{asset('public/images/save-upload-icon.png')}}"/>
                                        Cập nhật đề tài
                                 </button>
                            </td>
                        </tr>
                    </table>
                </form>
            @elseif($_GET['gd'] == "mt")            
                <form action="{{action('DetaiController@LuuCapNhatDeTai')}}" method="post" id="formSuaDeTai" name="formSuaDeTai" > 
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered" id="bang1">
                       <tr>
                           <th align="right">Năm học:</th>
                           <td>
                               <input type="text" value="{{$nam}}" style="width:90%; text-align: center" readonly="" class="form-control"/>
                           </td>
                           <th align="right" width="10%">Học kỳ:</th>
                           <td>
                               <input type="text" value="{{$hk}}" style="width:80%;text-align: center" readonly="" class="form-control"/>
                           </td> 
                           <th width="10%">Mã cán bộ:</th>
                           <td align="center">                            
                               <input type='text' name='txtMaCB' value='{{$macb}}' style="width:70%;" class="form-control" readonly=""/>
                           </td>
                           <th width="10%">Mã đề tài:</th>
                           <td align="center">
                               <input type="text" id="txtMaDeTai" name="txtMaDeTai" value="{{$dt->madt}}" style="width:60%; text-align: center;" class="form-control" readonly=""/>                        
                           </td>
                       </tr>                  
                       <tr>
                           <th>Tên đề tài:</th>
                           <td colspan="7">
                               <input type="text" name="txtTenDeTai" value="{{$dt->tendt}}" class="form-control"> 
                               <p style='color:red;'>{{$errors->first('txtTenDeTai')}}</p>
                           </td>
                       </tr>
                       <tr>
                           <th>Số sinh viên tối đa</th>
                           <td width="10%" colspan="2">
                               <input type="text" name="txtSoNguoi" value="{{$dt->songuoitoida}}" class="form-control">
                               <p style='color:red;'>{{$errors->first('txtSoNguoi')}}</p>
                           </td> 
                           <th width="8%">Trạng thái</th>
                           <td colspan="4">
                               <?php
                                   if($dt->trangthai != null){
                                       $chuath = strcasecmp($dt->trangthai, 'Chưa làm');
                                       $dangth = strcasecmp($dt->trangthai, 'Đang làm');
                                       $ht = strcasecmp($dt->trangthai, 'Hoàn thành');
                                       if ($chuath == 0 && $dangth != 0 && $ht != 0) {
                                           echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa làm' checked='true'/> &nbsp&nbsp&nbsp&nbsp";
                                           echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang làm'/>&nbsp&nbsp&nbsp&nbsp";
                                           echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành'/>";
                                       } elseif ($chuath != 0 && $dangth == 0 && $ht != 0) {
                                           echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa làm'/> &nbsp&nbsp&nbsp&nbsp";
                                           echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang làm' checked='true'/>&nbsp&nbsp&nbsp&nbsp";
                                           echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành'/>";
                                       }elseif ($chuath != 0 && $dangth != 0 && $ht == 0) {
                                           echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa làm'/> &nbsp&nbsp&nbsp&nbsp";
                                           echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang làm'/>&nbsp&nbsp&nbsp&nbsp";
                                           echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành' checked='true'/>";
                                       }
                                   }else if($dt->trangthai == "" || $dt->trangthai == null){
                                       echo "Chưa thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Chưa làm'/> &nbsp&nbsp&nbsp&nbsp";
                                       echo "Đang thực hiện: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Đang làm' checked='true'/>&nbsp&nbsp&nbsp&nbsp";
                                       echo "Hoàn thành: <input type='radio' name='rdTrangThai' id='rdTrangThai' value='Hoàn thành'/>";
                                   }

                               ?>
                           </td>
                       </tr>                                           
                       <tr>
                           <th>Mô tả:</th>
                           <td colspan="7">
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
                                           ['NumberedList','BulletedList','-','Outdent','Indent'],
                                           ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                       ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                   });
                               </script>
                           </td>
                       </tr>
                       <tr>
                           <th>Công nghệ thực hiện:</th>
                           <td colspan="7">
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
                                           ['NumberedList','BulletedList','-','Outdent','Indent'],
                                           ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                       ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                   });
                               </script>
                           </td>
                       </tr>
                       <tr>
                           <th>Những yếu tố cần lưu ý trong đề tài:</th>
                           <td colspan="7">
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
                                           ['NumberedList','BulletedList','-','Outdent','Indent'],
                                           ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                       ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                   });
                               </script>
                           </td>
                       </tr>
                       <tr>
                           <td align="center" colspan="8">
                               <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width:20%;">
                                   <img src="{{asset('public/images/save-as-icon.png')}}"> Cập nhật
                               </button>&nbsp;&nbsp;  
                               <a href="{{asset('giangvien/danhsachdetai')}}" class="btn btn-warning" style="width:20%;">
                                   <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                               </a>                         
                           </td>
                       </tr>
                   </table>
                </form>             
            @endif
        </div>
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection