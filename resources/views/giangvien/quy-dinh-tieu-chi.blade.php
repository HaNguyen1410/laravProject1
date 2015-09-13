@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: center;
            background-color: #dff0d8;
        }
    </style>


<div class="container">
    <div class="row">
        <h4 style="display:block; float:left; color:blue; font-weight: bold;">BẢNG TIÊU CHÍ ĐÁNH GIÁ KẾT QUẢ NIÊN LUẬN</h4>         
        <div class="col-md-12" style="display:block; float:left;">
            <table class="table table-bordered" style="width: 800px" align="center">
                <tr>
                    <th align="right">Năm học:</th>
                    <th>
                        <select class="form-control" name='cbNamHoc'>
                            @foreach($namhoc as $nk)
                            <option value="{{$nk->nam}}">{{$nk->nam}}</option>  
                            @endforeach
                        </select>
                    </th>
                    <th align="right">Học kỳ:</th>
                    <th>
                        <select class="form-control" name='cbHocKy'>
                            @foreach($hocky as $nk)
                            <option value="{{$nk->hocky}}">{{$nk->hocky}}</option>  
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <a href="2134/themtieuchi">
                            <button type="button" class="btn btn-primary" style="width:60%">
                                <img src="{{asset('images/add-icon.png')}}"> Thêm
                           </button>
                        </a>
                    </th>
                </tr>
            </table>            
        </div>   
        <div class="col-md-12" style="margin-bottom: 20px; display:block; float:left;" align="center">
            <form action="{{action('QdtieuchiController@LuuThemTieuChi')}}" method="post" name="frmDoiMatKhau" class="form-horizontal"> 
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">Thêm tiêu chí đánh giá</h3>
                    <table class="table table-bordered" align="center" style="width:600px;">
                        <tr>
                            <th width="20%">Mã tiêu chí:</th>
                            <td width="50%">
                                <input type="text" name="txtMaCB" value="2134"/> 
                                <input style="width:35%; text-align: center;" type="text" name="txtMaTC" value="{{$ma}}" class="form-control" readonly=""/> 
                            </td>
                        </tr>
                        <tr>
                            <th>Nội dung đánh giá:</th>
                            <td>
                                 <textarea class="form-control" rows="4" name="txtNoiDungTC"></textarea>
                                 <p style='color:red;'>{{$errors->first('txtNoiDungTC')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Mức điểm:</th>
                            <td>
                                <input type="text" name="txtMucDiem" value="" class="form-control" /> 
                                <p style='color:red;'>{{$errors->first('txtMucDiem')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button type="submit" name="btnThem" class="btn btn-primary" style="width: 20%;">
                                    <img src="{{asset('images/save-as-icon.png')}}"> Thêm
                                </button>                                                              
                            </td>
                        </tr>
                    </table>       
            </form>
        </div>
        <div class="col-md-12">            
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                <tr>
                    <th width="5%">STT</th>
                    <th>Nội dung đánh giá</th>
                    <th width="10%">Mức điểm</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
                @if(count($dstc) == 0)
                        <tr>
                            <td colspan="7" align="center">
                                <label style="color: #e74c3c;"> Chưa có tiêu chí đánh giá nào!</label> 
                            </td>
                        </tr>
                @elseif (count($dstc) > 0)
                    @foreach($dstc as $tc)
                        <tr>
                            <td align='center'>{{$tc->matc}}</td>
                            <td>{{$tc->noidungtc}}</td>
                            <td align='center'>{{$tc->heso}}</td>
                            <td align='center'>{{$tc->ngaytao}}</td>
                            <td align='center'>
                                <a href="2134/capnhattieuchi/{{$tc->matc}}"><img src="{{asset('images/edit-icon.png')}}"></a>&nbsp
                                <a onclick="return confirm('Tiêu chí {{$tc->matc}} sẽ bị xóa?');" href="2134/xoatieuchi/{{$tc->matc}}">
                                    <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                                </a>
                            </td>    
                        </tr>                    
                    @endforeach    
                @endif
            </table>
        </div>
        <div class="col-md-12">
            
        </div>
   </div> <!-- /row -->
</div> <!-- /container -->       

@endsection
