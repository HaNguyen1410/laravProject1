@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
            }
    </style>
    
    <script src="{{Asset('public/scripts/datetimepicker/jquery.datetimepicker.js')}}"></script>
    <script type="text/javascript">
        /*window.onerror = function(errorMsg) {
            $('#console').html($('#console').html()+'<br>'+errorMsg)
            }*/
        $('#txtNgayBatDauThucTe').datetimepicker({
            dayOfWeekStart: 1,
            format: "y-m-d H:i:s",
            step: 10
        });

        $('#txtNgayKTThucTe').datetimepicker({
            dayOfWeekStart: 1,
            format: "y-m-d H:i:s",
            step: 10
        });
        /*$('#datetimepicker').datetimepicker({step: 10});*/
    </script>   
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;">Cập nhật công việc</h3> 
            <form action="{{action('PhancvController@LuuCapNhatcvChinh')}}" method="post" >
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" width="800px" cellpadding="15px" cellspacing="0px" id="bang1">
                    <tr>
                        <th width="10%">Mã công việc:</th>
                        <td>
                            <input style="width:30%;" type="text" name="txtMaCV" value="{{$ndcv->macv}}" class="form-control" readonly="">
                        </td>
                        <th width="10%">Tên công việc:</th>
                        <td colspan="3">
                            <input type="text" name="txtTenCV" value="{{$ndcv->congviec}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTenCV')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Ngày bắt đầu (kế hoạch):</th>
                        <td width="30%">
                           <input type="text" id="txtNgayBatDauKH" name="txtNgayBatDauKH" value="{{$ndcv->ngaybatdau_kehoach}}" class="form-control"/>
                           <p style='color:red;'>{{$errors->first('txtNgayBatDauKH')}}</p>
                        </td>
                        <th width="18%">Ngày kết thúc (kế hoạch):</th>
                        <td width="30%">
                            <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="{{$ndcv->ngayketthuc_kehoach}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKetThucKH')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Ngày bắt đầu (thực tế):</th>
                        <td width="30%">
                            <input type="text" id="txtNgayBatDauThucTe" name="txtNgayBatDauThucTe" value="{{$ndcv->ngaybatdau_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayBatDauThucTe')}}</p>
                        </td>
                        <th width="18%">Ngày kết thúc (thực tế):</th>
                        <td width="30%">
                            <input type="text" id="txtNgayKTThucTe" name="txtNgayKTThucTe" value="{{$ndcv->ngaybatdau_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKTThucTe')}}</p>
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
                            <p style='color:red;'>{{$errors->first('cbGiaoCho')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Nội dung công việc:</th>
                        <td colspan="3">
                            <textarea name="txtNoiDungViec" rows="2" cols="2" class="ckeditor">{{$ndcv->noidungthuchien}}</textarea>
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
                                        ['NumberedList','BulletedList','-','Outdent','Indent'],
                                        ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                    ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                });
                            </script>
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
                        <td>
                            <select class="form-control" size="1" name="cbUuTien">
                                <option value="Cao">Cao</option>
                                <option value="Trung bình">Trung bình</option>
                                <option value="Thấp">Thấp</option>
                            </select>
                            <p style='color:red;'>{{$errors->first('cbUuTien')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Số giờ thực tế</th>
                        <td>
                            <input type="text" id="txtGioThucTe" name="txtGioThucTe" value="{{$ndcv->sogio_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtGioThucTe')}}</p>
                        </td>
                        <th>Tiến độ (%):</th>
                        <td>
                            <input type="text" name="txtTienDo" value="{{$ndcv->tiendo}}" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtTienDo')}}</p>
                        </td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td colspan="3" align="center">
                            <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width:20%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}"> Cập nhật
                            </button>&nbsp;&nbsp;
                            <a href="../../phancv" class="btn btn-warning" style="width:20%;">
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
