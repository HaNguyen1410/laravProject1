@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
            }
    </style>
<!--    
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
-->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;">
                <a href="{{asset('sinhvien/phancv')}}">Phân công việc</a>  
                    &Gt;
                Cập nhật công việc
            </h3> 
            <form action="{{action('PhancvController@LuuCapNhatcvChinh')}}" method="post" >
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" width="800px" cellpadding="15px" cellspacing="0px" id="bang1">
                    <tr>
                        <th width="10%">Mã công việc:</th>
                        <td width="20%">
                            <input style="width:30%;" type="text" name="txtMaCV" value="{{$ndcv->macv}}" class="form-control" readonly="">
                        </td>
                        <th width="10%">Tên công việc:</th>
                        <td colspan="2" width="20%">
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
                        <td colspan="2" width="30%">
                            <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="{{$ndcv->ngayketthuc_kehoach}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKetThucKH')}}</p>
                        </td>
                    </tr>
<!--                    <tr>
                        <th width="10%">Ngày bắt đầu (thực tế):</th>
                        <td width="30%">
                            <input type="text" id="txtNgayBatDauThucTe" name="txtNgayBatDauThucTe" value="{{$ndcv->ngaybatdau_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayBatDauThucTe')}}</p>
                        </td>
                        <th width="18%">Ngày kết thúc (thực tế):</th>
                        <td colspan="2" width="30%">
                            <input type="text" id="txtNgayKTThucTe" name="txtNgayKTThucTe" value="{{$ndcv->ngaybatdau_thucte}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKTThucTe')}}</p>
                        </td>
                    </tr>-->
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
                                </div><br>
                            <p style='color:red;'>{{$errors->first('chkGiaoCho')}}</p>
                        </td>
                        <th>Tuần làm lại:</th>
                        <td>
                            <input type="text" id="txtGioThucTe" name="txtTuanLamLai" value="{{$ndcv->tuan_lamlai}}" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTuanLamLai')}}</p>
                        </td>                        
                    </tr>
                    <tr>
                        <th>Được giao cho:</th>
                        <td colspan="4">
                            <label style="color: #006400; font-weight: bold;">{{$ndcv->giaocho}}</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            <select class="form-control" size="1" name="cbTrangThai">
                                <option value="{{$ndcv->trangthai}}" selected="">{{$ndcv->trangthai}}</option>
                                <option value="Đang làm">Đang làm</option>
                                <option value="Sắp làm">Sắp làm</option>
                                <option value="Hoàn thành">Hoàn thành</option>
                            </select>
<!--                            <p style='color:red;'>{{$errors->first('cbTrangThai')}}</p>                        -->
                        </td>
                        <th width="13%">Độ ưu tiên:</th>
                        <td colspan="2" >
                            <select class="form-control" size="1" name="cbUuTien">
                                <option value="{{$ndcv->uutien}}" selected="">{{$ndcv->uutien}}</option>
                                <option value="Cao">Cao</option>
                                <option value="Trung bình">Trung bình</option>
                                <option value="Thấp">Thấp</option>
                            </select>
                            <p style='color:red;'>{{$errors->first('cbUuTien')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Trong tuần:</th>
                        <td>
                            <input type="text" name="txtTuan" value="{{$ndcv->tuan}}" placeholder="Theo dạng: 1-3 từ tuần 1 đến 3 hoặc 4" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtTuan')}}</p>
                        </td>
                        <th>Tiến độ (%):</th>
                        <td colspan="2">
                            <input type="text" name="txtTienDo" value="{{$ndcv->tiendo}}" class="form-control">
                            <p style='color:red;'>{{$errors->first('txtTienDo')}}</p>
                        </td>
                    </tr> 
                    <tr>
                        <th width="20%">Nội dung công việc:</th>
                        <td colspan="4">
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
                        <td colspan="5" align="center">
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
