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
                    <a href="{{asset('sinhvien/phancv/phancongchitiet/'.$macvchinh)}}">Phân công việc phụ</a>  
                    &Gt;
                    Cập nhật công việc phụ thuộc việc: <label>{{$macvchinh}}</label> 
                </h3>
                <form action="{{action('PhancvController@LuuCapNhatcvPhu')}}" method="post" >
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered" width="800px" cellpadding="15px" cellspacing="0px" id="bang1">
                        <tr>
                            <th width="10%">Mã công việc:</th>
                            <td>
                                <!-- Lấy macvchinh đưa vào Input -->
                                <input type="hidden" name="txtMacvChinh" value="{{$macvchinh}}" class="form-control"/>
                                <input type="text" name="txtMaCV" value="{{$cv->macv}}" class="form-control" readonly=""/>
                            </td>
                            <th width="10%">Tên công việc:</th>
                            <td colspan="3">
                                <input type="text" name="txtTenCV" value="{{$cv->congviec}}" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtTenCV')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th width="10%">Ngày bắt đầu (kế hoạch):</th>
                            <td width="30%">
                               <input type="text" id="txtNgayBatDauKH" name="txtNgayBatDauKH" value="{{$cv->ngaybatdau_kehoach}}" class="form-control"/>
                               <p style='color:red;'>{{$errors->first('txtNgayBatDauKH')}}</p>
                            </td>
                            <th width="18%">Ngày kết thúc (kế hoạch):</th>
                            <td width="30%">
                                <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="{{$cv->ngayketthuc_kehoach}}" class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtNgayKetThucKH')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Giao cho:</th>
                            <td>
                                <select name='cbGiaoCho' class="form-control">                                    
                                    @foreach($dstv as $tv)
                                        @if($cv->giaocho == $tv->hoten)
                                            <option value="{{$cv->giaocho}}" selected="">{{$cv->giaocho}}</option>                                       
                                        @elseif($cv->giaocho != $tv->hoten)
                                            <option value="{{$tv->hoten}}">{{$tv->hoten}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <p style='color:red;'>{{$errors->first('cbGiaoCho')}}</p>
                            </td>
                            <th>Trong tuần:</th>
                            <td>
                                <input type="text" name="txtTuan" value="{{$cv->tuan}}" placeholder="Theo dạng: 1-3 từ tuần 1 đến 3 hoặc 4"  class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtTuan')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Tuần làm lại:</th>
                            <td>
                                <input type="text" name="txtTuanLamLai" value="{{$cv->tuan_lamlai}}" placeholder="Theo dạng: 1-3 từ tuần 1 đến 3 hoặc 4"  class="form-control"/>
                                <p style='color:red;'>{{$errors->first('txtTuanLamLai')}}</p>
                            </td>
                            <th>Tiến độ (%):</th>
                            <td>
                                <input type="text" name="txtTienDo" value="{{$cv->tiendo}}" class="form-control">
                                <p style='color:red;'>{{$errors->first('txtTienDo')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                <select class="form-control" size="1" name="cbTrangThai">
                                    <option value="{{$cv->trangthai}}" selected="">{{$cv->trangthai}}</option>                                        
                                    <option value="Đang làm">Đang làm</option>
                                    <option value="Sắp làm">Sắp làm</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                </select>
                                <p style='color:red;'>{{$errors->first('cbTrangThai')}}</p>
                            </td>  
                            <th width="13%">Độ ưu tiên:</th>
                            <td>
                                <select class="form-control" size="1" name="cbUuTien">
                                    <option value="{{$cv->uutien}}" selected="">{{$cv->uutien}}</option>
                                    <option value="Cao">Cao</option>
                                    <option value="Trung bình">Trung bình</option>
                                    <option value="Thấp">Thấp</option>
                                </select>
                                <p style='color:red;'>{{$errors->first('cbUuTien')}}</p>
                            </td>
                        </tr> 
                        <tr>
                            <th width="20%">Nội dung công việc:</th>
                            <td colspan="3">
                                <textarea name="txtNoiDungViec" rows="2" cols="2" class="ckeditor">{{$cv->noidungthuchien}}</textarea>
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
                            <td></td>
                            <td colspan="3" align="center">
                                <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width:20%;">
                                    <img src="{{asset('public/images/save-as-icon.png')}}"> Cập nhật
                                </button>&nbsp;&nbsp;
                                <a href="../../{{$macvchinh}}" class="btn btn-warning" style="width:20%;">
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