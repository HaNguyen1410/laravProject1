@extends('quantri_home')

@section('content_quantri')
          
     <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 style="display:block; float: left; color: darkblue; font-weight: bold;">DANH SÁCH SINH VIÊN</h4>
            <a href="danhsachsv/themsv" style="margin-left: 71%;">
                <button type="button" name="" class="btn btn-primary" style="width: 10%;">
                    <img src="{{asset('images/add-icon.png')}}"> Thêm
                </button>
            </a><br>
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-bordered" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Họ và tên</th>
                    <th width="15%">Email</th>
                    <th>Người tạo</th> 
                    <th>Ngày tạo</th>
                    <th>Khóa</th>
                    <th width=8%>Chức năng</th>
                </tr>
                @foreach($dssv as $stt => $rw)
                    <tr>
                        <td align='center'>
                            {{$stt = $stt + 1}}
                        </td>
                        <td align='center'>{{$rw->mssv}}</td>
                        <td>{{$rw->hoten}}</td>
                        <td>{{$rw->email}}</td>
                        <td align='center'>...</td>
                        <td align='center'>{{$rw->ngaytao}}</td>
                        <td align='center'>
                            @if($rw->khoa == 1)
                                <img src="{{asset('images/Lock.png')}}"/>
                            @elseif($rw->khoa == 0)
                                <img src="{{asset('images/Unlock.png')}}"/>
                            @endif
                        </td>
                        <td align='center'>
                            <a href="danhsachsv/capnhatsv/{{$rw->mssv}}"><img src="{{asset('images/edit-icon.png')}}" /></a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Sinh viên **{{$rw->hoten}}** sẽ bị xóa?');" href='danhsachsv/xoasv/{{$rw->mssv}}'>
                                <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>   
                @endforeach
                <tr>
                    <td colspan="8" align="center">{!! $dssv->setPath('danhsachsv')->render() !!}</td>
                </tr>      
           </table>

        </div>
    </div>
</div>
        
@endsection
