@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>
    <script type="text/javascript">
        $(function() {
          $( "#txtNgayBatDau" ).datepicker({
              dateFormat: "yy-mm-dd"
          });
        });
        $(function() {
          $( "#txtNgayKetThuc" ).datepicker({
              dateFormat: "yy-mm-dd"
          });
        });
    </script>

<div class="container">  
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">Quản lý các thông báo</h3> 
            <div style="margin-bottom: 15px;" align="right">
                <a href="quanlythongbao/themthongbao">
                    <button type="button" name="" class="btn btn-primary">
                        <img src="{{asset('public/images/add-icon.png')}}">Thêm thông báo
                    </button>
                </a>
            </div>
            <table class="table table-bordered table-hover" cellpadding="15px" cellspacing="10px">
                <tr>
                    <th width="1%">STT</th>
                    <th width="25%">Nội dung thông báo</th>
                    <th width="4%">Đính Kèm</th>
                    <th width="10%">Thực hiện</th>
                    <th width="8%">Thời gian bắt đầu</th>
                    <th width="8%">Thời hạn kết thúc</th>
                    <th width="8%">Ngày tạo</th>
                    <th width="8%">Ngày sửa</th>
                    <th width="8%">Đóng hệ thống</th>
                    <th width="8%">Thao tác</th>
                </tr>                                  
                    @if(count($dsthongbao) == 0)
                        <tr>
                            <td colspan="10" align="center">
                                <label style="color: #e74c3c;"> Chưa có thông báo nào!</label> 
                            </td>
                        </tr>
                    @elseif (count($dsthongbao) > 0)
                        @foreach($dsthongbao as $stt => $tb)
                            <tr>
                                <td align="center">{{$stt+1}}</td>
                                <td>{{$tb->noidungtb}}</td>
                                @if($tb->dinhkemtb != "")
                                    <td>
                                        <a href="../public/thongbao/{{$tb->dinhkemtb}}" align='center' target="_blank">
                                            <img src="{{asset('public/images/file-pdf-icon.png')}}"/>
                                        </a>                            
                                    </td>
                                @elseif($tb->dinhkemtb == "")
                                    <td></td>
                                @endif  
                                <td align="center">{{$tb->manhomthuchien}}</td>
                                <td align="center">{{$tb->batdautb}}</td>
                                <td align="center">{{$tb->ketthuctb}}</td>
                                <td align="center">{{$tb->ngaytao}}</td>
                                <td align="center">{{$tb->ngaysua}}</td>
                                <td align='center'>
                                    @if($tb->donghethong == 1)
                                        <img src="{{asset('public/images/lock.png')}}"/>
                                    @elseif ($tb->donghethong == 0)   
                                        <img src="{{asset('public/images/Unlock.png')}}"/>
                                    @endif
                                </td>
                                <td align='center'>
                                    <a href="quanlythongbao/capnhatthongbao/{{$tb->matb}}">
                                        <img src="{{asset('public/images/edit-icon.png')}}"/>
                                    </a>&nbsp
                                    <a onclick="return confirm('Thông báo **{{$tb->matb}}** sẽ bị xóa?');" href="quanlythongbao/xoathongbao/{{$tb->matb}}">
                                        <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                                    </a>
                                </td>
                            </tr>
                        @endforeach                    
                    @endif
           </table>
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection