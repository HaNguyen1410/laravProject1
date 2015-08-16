

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
            <h4 style="display:block; float: left; color: darkblue; font-weight: bold;">DANH SÁCH GIẢNG VIÊN</h4>
            <a href="themgv" style="margin-left: 70%;">
                <button type="button" name="" class="btn btn-primary" style="width: 10%;">
                    <img src="images/add-icon.png"> Thêm
                </button>
            </a><br>      
            <table class="table table-bordered" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th>STT</th>
                    <th>Mã cán bộ</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Người tạo</th> 
                    <th>Ngày tạo</th>
                    <th>Khóa</th>
                    <th width=8%>Chức năng</th>
                </tr>
                @foreach($dsgv as $rw)
                    <tr>
                        <td align='center'>{{$rw->id}}</td>
                        <td align='center'>{{$rw->macb}}</td>
                        <td>{{$rw->hoten}}</td>
                        <td align='center'>{{$rw->email}}</td>
                        <td>...</td>
                        <td align='center'>{{$rw->ngaytao}}</td>
                        <td align='center'>
                            @if($rw->khoa == 1)
                                <img src="images/Lock.png"/>
                            @elseif($rw->khoa == 0)
                                <img src="images/Unlock.png"/>
                            @endif
                        </td>
                        <td>
                            <a href='capnhatgv/{{$rw->id}}'><img src='images/edit-icon.png'/></a>&nbsp;&nbsp;&nbsp;
                            <a href=''><img src='images/Document-Delete-icon.png'/></a>
                        </td>
                    </tr>   
                @endforeach
                <tr>
                    <td colspan="8" align="center">{!! $dsgv->setPath('danhsachgv')->render() !!}</td>
                </tr>                     
            </table>
        </div>
    </div>
</div>
    
@endsection