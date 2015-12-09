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
    <div class="row" style="margin-bottom: 5px;">
        <div class="col-md-6">
            <strong style="font-size: 18pt; color: blue;">Kho tài liệu</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center">
                <tr>
                    <th width="1%">STT</th>
                    <th width="5%">Mã đề tài</th>
                    <th width="30%">Tên dự án</th>
                    <th width="8%">Mã nhóm</th>
                    <th width="18%">Nhóm trưởng</th>
                    <th width="10%">Ngày đăng mới nhất</th>
                    <th width="50%">Mô tả tài liệu</th>
                </tr>
                 @if(count($dsdt) == 0)
                    <tr>
                        <td colspan="9" align="center">
                            <label style="color: #e74c3c;"> Chưa có tài liệu nào!</label> 
                        </td>
                    </tr>
                @elseif (count($dsdt) > 0)
                    @foreach($dsdt as $stt => $dt)
                        <tr>
                            <td align="center">{{$stt+1}}</td>
                            <td align="center">
                                {{$dt->madt}}
                            </td>
                            <td><img src="{{asset('public/images/folder-page-icon.png')}}"/>
                                <a href="khotailieu/khotailieuchitiet/{{$dt->manhomthuchien}}">
                                    {{$dt->tendt}}
                                </a> 
                            </td>
                            <td align="center">{{$dt->manhomthuchien}}</td>
                            <td>{{$dt->hoten}}</td> 
                            @foreach($tailieu as $tl)                                
                                @if(count($tailieu) == 0 && $dt->manhomthuchien == $tl->manhomthuchien)
                                    <td colspan="2">Chưa có tài liệu nào!</td>
                                @elseif($dt->manhomthuchien == $tl->manhomthuchien)
                                    <td>{{$tl->ngaycapnhat}}</td>
                                    <td>{{$tl->mota}}</td>
                                @endif
                            @endforeach 
                        </tr>
                    @endforeach
                @endif
            </table>              
        </div>   
    </div>
</div>
@endsection