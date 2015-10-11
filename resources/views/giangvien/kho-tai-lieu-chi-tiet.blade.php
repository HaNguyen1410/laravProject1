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
        <h3 style="color: darkblue; font-weight: bold;">&nbsp;&nbsp;
            <a href="{{asset('giangvien/khotailieu')}}">Kho tài liệu</a>  
                &Gt;
            Chi tiết tài liệu dự án: </h3>
         <label style="font-size: 15pt; font-weight: bold; color: #2ca02c; margin-left: 50px">
             {{$dt->tendt}}
         </label><br><br>         
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                 <tr>
                    <th width="1%">STT</th>
                    <th width="6%">Mã công việc chính</th>
                    <th width="8%">Tên tập tin</th>
                    <th width="15%">Mô tả</th>                    
                    <th width="6%">Ngày đăng</th>
                    <th width="10%">Người nộp</th>
                    <th width="15%">Thực hiện</th>
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
                            <td rowspan="2" align="center" style="vertical-align: middle;">{{$stt+1}}</td>
                            <td align="center">
                                <a style="color: blue;" data-toggle="tooltip" data-placement="bottom" title="{{$tl->congviec}}">                                    
                                    <label>{{$tl->macv}}</label>
                                </a>
                            </td>
                            <td><!--#006400-->
                                <a href="../../../public/tailieu/{{$tl->tentl}}" style="color: #2ca02c; font-weight: bold;" data-toggle="tooltip" data-placement="bottom" title="{{$tl->kichthuoc}} Kb">                                    
                                    {{$tl->tentl}}
                                </a>
                            </td>
                            <td>{{$tl->mota}}</td>
                            <td>
                                <a style="color: blueviolet;" data-toggle="tooltip" data-placement="bottom" title="Tuần: {{$tl->tuan}}">                                    
                                    <label style="color: #2ca02c">{{$tl->ngaycapnhat}}</label>
                                </a> 
                            </td>
                            <td>{{$tl->hoten}}</td> 
                            <td>{{$tl->giaocho}}</td>                            
                            <td align="center">
                               <a href="{{$manth}}/danhgiatailieu/{{$tl->matl}}">
                                   <img src="{{asset('public/images/edit-icon.png')}}"/>
                               </a>
                           </td>
                         </tr>
                         <tr>
                             <td colspan="5">
                                 <label style="color: darkblue;">Nhận xét của giảng viên:</label><br>
                                <p style="color: black;">{{$tl->nd_danhgia}}</p>
                            </td>
                            <td colspan="2" style="color: darkblue;">
                                <label>Ngày nhận xét:</label><br>
                                <label style="color: black;">{{$tl->ngaydanhgia}}</label>                                                               
                            </td>
                         </tr>
                    @endforeach
                 @endif                
            </table> 
        </div>        
    </div>
</div>
@endsection