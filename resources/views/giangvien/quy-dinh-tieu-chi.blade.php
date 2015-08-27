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
            </table>
        </div>
        <div class="col-md-12">
            
        </div>
   </div> <!-- /row -->
</div> <!-- /container -->       

@endsection
