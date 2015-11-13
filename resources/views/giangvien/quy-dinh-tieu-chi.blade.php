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
        <h4 style="color:blue; font-weight: bold; margin-left: 20px;">
            BẢNG TIÊU CHÍ ĐÁNH GIÁ KẾT QUẢ NIÊN LUẬN
        </h4>  
        <div class="col-md-12" style="display:block; float:left;">
            <table class="table table-bordered" style="max-width: 750px" align="center">
                <tr>
                    <th align="right">Năm học:</th>
                    <th width="20%">
<!--                        <select class="form-control" name='cbNamHoc'>
                            @foreach($namhoc as $nk)
                            <option value="{{$nk->nam}}">{{$nk->nam}}</option>  
                            @endforeach
                        </select>-->
                        <input type="text" value="{{$namht}}" style="width: 100%; text-align: center;" class="form-control" readonly=""/>
                    </th>
                    <th align="right">Học kỳ:</th>
                    <th width="20%">
<!--                        <select class="form-control" name='cbHocKy'>
                            @foreach($hocky as $nk)
                            <option value="{{$nk->hocky}}">{{$nk->hocky}}</option>  
                            @endforeach
                        </select>-->
                        <input type="text" value="{{$hkht}}" style="width: 60%; text-align: center;" class="form-control" readonly=""/>
                    </th>
                    <th>
                        <a href="dstieuchi/themtieuchi">
                            <button type="button" class="btn btn-primary">
                                <img src="{{asset('public/images/add-icon.png')}}"> Thêm
                           </button>
                        </a>
                    </th>
                </tr>
            </table>            
        </div>   
        <div class="col-md-12">                
            @if(Session::has('BaoLoi'))
                <div class="alert-info" align='center' style="color:red; font-weight: bold; max-width: 500px;">
                    {{Session::get('BaoLoi')}}
                </div><br>
            @elseif(Session::has('BaoLoiCapNhat'))
                <div class="alert-info" align='center' style="color:red; font-weight: bold; max-width: 500px;">
                    {{Session::get('BaoLoiCapNhat')}}
                </div><br>
            @endif
            <div class="alert-info" style="color:red; font-weight: bold; max-width: 500px; text-align: center;">
                    <?php echo Session::get('ThongBaoXoa'); ?>
            </div><br>
            <table class="table table-bordered" style="max-width: 900px" align='center'>
                <tr>
                    <th width="5%">STT</th>
                    <th width="8%">Mã tiêu chí</th>
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
                    @foreach($dstc as $stt => $tc)
                        <tr>
                            <td align='center'>{{$stt+1}}</td>
                            <td align='center'>
                                <label style="color: brown;">[{{$tc->matc}}]</label>
                            </td>
                            <td>{{$tc->noidungtc}}</td>
                            <td align='center'>
                                <label style="color: red;">{{$tc->heso}}</label>                                
                            </td>
                            <td align='center'>{{$tc->ngaytao}}</td>
                            <td align='center'>
                                <a href="dstieuchi/capnhattieuchi/{{$tc->matc}}"><img src="{{asset('public/images/edit-icon.png')}}"></a>&nbsp
                                <a onclick="return confirm('Tiêu chí {{$tc->matc}} sẽ bị xóa?');" href="dstieuchi/xoatieuchi/{{$tc->matc}}">
                                    <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                                </a>
                            </td>    
                        </tr>                    
                    @endforeach    
                @endif  
                <tr>
                    
                </tr>
            </table>
            <div class="col-md-offset-4">
                <label>Tổng mức điểm của các tiêu chí:</label>
                <label style="color: red; font-weight: bold;">{{$tongdiemtc}}</label>
            </div><br>
        </div>
        <div class="col-md-12">
            
        </div>
   </div> <!-- /row -->
</div> <!-- /container -->       

@endsection
