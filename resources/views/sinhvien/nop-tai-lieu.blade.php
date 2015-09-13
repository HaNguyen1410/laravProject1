@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        #bang1 th{
            text-align: right;
            color: darkblue;
            background-color: #dff0d8;
        }
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>


<div class="container">            
    <div class="row">
        <h3 style="color: darkblue; font-weight: bold;" align="center">NỘP TÀI LIỆU</h3><br>
        <div class="col-md-12" style="margin-bottom: 20px; width: 80%;">
            <label style="margin-left: 15px; color: #00008b">Tên đề tài: </label><br>                    
            <lable style="margin-left: 30px; color: #00008b; font-size: 13pt;">{{$tendt}}</lable>
        </div>        
        <div class="col-md-12">
             <form action="{{action('QltailieuController@LuuNopTaiLieu')}}" method="post" enctype="multipart/form-data">
                 <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                 <table class="table table-bordered" id="bang1">
                    <tr>
                        <th width='20%'>Mã tài liệu:</th>
                        <td width='15%'>
                            <input type="text" name="txtMaTL" value="{{$matl}}" style="text-align: center;" class="form-control" readonly=""/>
                        </td>
                        <th width='15%'>Tên công việc:</th>
                        <td>
                             <select class="form-control" name="cbTenCV">
                                    <option value="">-- Chọn tên công việc --</option>  
                                @foreach($dscvchinh as $cv)
                                    <option value="{{$cv->macv}}">{{$cv->congviec}}</option>  
                                @endforeach
                            </select>
                            <p style='color:red;'>{{$errors->first('cbTenCV')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Tài liệu:</th>
                        <td colspan="4">
                             <input type="file" id="fTaiLieu" name="fTaiLieu" style="width:60%;"/> 
                             <p style='color:red;'>{{$errors->first('fTaiLieu')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Mô tả tài liệu:</th>
                        <td colspan="4">
                            <textarea name="txtMoTa" class="form-control" rows="3"></textarea><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='5' align='center'>
                             <button type="submit" class="btn btn-warning">
                                    <img src="{{asset('images/save-upload-icon.png')}}"/>
                                    Gửi tập tin
                             </button>
                        </td>
                    </tr>
                </table>
            </form>
         </div> 
         <div class="col-md-12">     
             <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                 <tr>
                    <th width="1%">STT</th>
                    <th width="4%">Công việc</th>
                    <th width="8%">Tên tập tin</th>
                    <th width="4%">Cỡ</th>
                    <th width="6%">Ngày đăng</th>
                    <th width="10%">Tác giả</th>
                    <th width="20%">Nhận xét GV</th>
                    <th width="6%">Ngày nhận xét</th>
                    <th width="5%">Thao tác</th>
                 </tr> 
                 @if(count($dstailieu) == 0)
                    <tr>
                        <td colspan="9" align="center">
                            <label style="color: #e74c3c;"> Chưa có tài liệu nào!</label> 
                        </td>
                    </tr>
                 @elseif(count($dstailieu) > 0)
                    @foreach($dstailieu as $stt => $tl)
                        <tr>
                            <td>{{$stt+1}}</td>
                            <td>
                                <a style="color: #006400;" data-toggle="tooltip" data-placement="bottom" title="{{$tl->congviec}}">                                    
                                    {{$tl->macv}}
                                </a>
                            </td>
                            <td><label>{{$tl->tentl}}</label></td>
                            <td>{{$tl->kichthuoc}}</td>
                            <td>{{$tl->ngaycapnhat}}</td>
                            <td>{{$tl->hoten}}</td>
                            <td>{{$tl->nd_danhgia}}</td>
                            <td>{{$tl->ngaydanhgia}}</td>
                            <td align="center">
                                <a href=""><img src="{{asset('images/Document-Delete-icon.png')}}"></a>
                            </td>
                         </tr>
                    @endforeach
                 @endif                 
             </table><hr>
         </div>                                            
    </div><!-- /row -->

</div>   <!-- /container -->
@endsection
