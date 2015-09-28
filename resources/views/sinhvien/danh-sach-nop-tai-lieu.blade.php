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
        <h3 style="color: darkblue; font-weight: bold;" align="center">DANH SÁCH NỘP TÀI LIỆU</h3><br>
        <div class="col-md-12" style="margin-bottom: 20px; width: 80%; display: block; float: left;">
            <label style="margin-left: 15px; color: #00008b">Tên đề tài: </label><br>                    
            <lable style="margin-left: 30px; color: #00008b; font-size: 13pt;">{{$tendt}}</lable>
        </div>  
        <div align="right">
            <a href="danhsachnoptailieu/noptailieu">
                <button type="button" class="btn btn-primary" style="width:12%; margin-right: 20px; ">
                    <img src="{{asset('public/images/add-icon.png')}}"> Nộp tài liệu
               </button>
            </a>
        </div> 
        <div class="col-md-12">     
             <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                 <tr>
                    <th width="1%">STT</th>
                    <th width="4%">Giai Đoạn</th>
                    <th width="8%">Tên tập tin</th>
                    <th width="15%">Mô tả</th>                    
                    <th width="6%">Ngày đăng</th>
                    <th width="10%">Tác giả</th>
                    <th width="15%">Nhận xét</th>
                    <th width="6%">Ngày nhận xét</th>
                    <th width="4%">Thao tác</th>
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
                            <td align="center">{{$stt+1}}</td>
                            <td>
                                <a style="color: #006400;" data-toggle="tooltip" data-placement="bottom" title="">                                    
                                    
                                </a>
                            </td>
                            <td>
                                <a style="color: #006400;" data-toggle="tooltip" data-placement="bottom" title="{{$tl->kichthuoc}} Kb">                                    
                                    {{$tl->tentl}}
                                </a>
                            </td>
                            <td>{{$tl->mota}}</td>
                            <td>{{$tl->ngaycapnhat}}</td>
                            <td>{{$tl->hoten}}</td>
                            <td><p style="color: #000080;">{{$tl->nd_danhgia}}</p></td>
                            <td>{{$tl->ngaydanhgia}}</td>
                            <td align="center">
                                <a href="">
                                    <img src="{{asset('public/images/edit-icon.png')}}"/>
                                </a>&nbsp
                                <a onclick="return confirm('Tài liệu --{{$tl->tentl}}-- sẽ bị xóa?')" href="{{$mssv}}/xoatailieu/{{$tl->matl}}">
                                    <img src="{{asset('public/images/Document-Delete-icon.png')}}">
                                </a>
                            </td>
                         </tr>
                    @endforeach
                 @endif                 
             </table><hr>
         </div>                                            
    </div><!-- /row -->

</div>   <!-- /container -->
@endsection
