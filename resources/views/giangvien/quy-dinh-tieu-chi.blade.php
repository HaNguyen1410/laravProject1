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
        <div class="col-md-12">
            <h4 style="display:block; float:left; color:blue; font-weight: bold;">BẢNG TIÊU CHÍ ĐÁNH GIÁ KẾT QUẢ NIÊN LUẬN</h4>
            <a href="2134/themtieuchi" style="margin-left: 50%;">
                <button type="button" class="btn btn-primary" style="width: 10%;">
                    <img src="{{asset('images/add-icon.png')}}"> Thêm
               </button>
            </a><br>
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
   </div> <!-- /row -->
</div> <!-- /container -->       

@endsection
