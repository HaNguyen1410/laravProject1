@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>

<div class="container">   
    <div class="row">  
        <!-- Bảng các tài liệu đã được chỉnh sửa -->
        <h3 style="color: darkblue; font-weight: bold;">&nbsp;&nbsp;Chi tiết tài liệu dự án: </h3>
         <label style="font-size: 15pt; font-weight: bold; color: #2ca02c; margin-left: 50px">
             {{$dt->tendt}}
         </label><br><br>         
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="1%">STT</th>
                    <th width="10%">Giai đoạn</th>
                    <th width="16%">Tên tài liệu</th>
                    <th width="8%">Ngày đăng</th>
                    <th width="12%">Tác giả</th>
                    <th width="15%">Mô tả nội dung</th>
                    <th width="20%">Giảng viên nhận xét</th>
                    <th width="8%">Ngày đánh giá</th>
                    <th width="5%">Chức năng</th>
                </tr>
                @foreach($dstailieu as $stt => $tl)
                     <tr>
                        <td align="center">{{$stt+1}}</td>
                        <td></td>
                        <td>
                            <a href="../../../public/tailieu/{{$tl->tentl}}" style="color: #2ca02c" data-toggle="tooltip" data-placement="bottom" title="Kích thước tập tin: {{$tl->kichthuoc}}">
                                {{$tl->tentl}}
                            </a>                            
                        </td>
                        <td>{{$tl->ngaycapnhat}}</td>
                        <td>{{$tl->giaocho}}</td>
                        <td>{{$tl->mota}}</td>
                        <td>{{$tl->nd_danhgia}}</td>
                        <td>{{$tl->ngaydanhgia}}</td>
                        <td align="center">
                            <a href="{{$manth}}/danhgiatailieu/{{$tl->matl}}">
                                <img src="{{asset('public/images/edit-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table> 
        </div>        
    </div>
</div>
@endsection