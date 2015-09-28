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
            <h4 style="color: darkblue; font-weight: bold;">DANH SÁCH SINH VIÊN</h4>
            <div style="display:block; float: left;">
                <form action="" method="post">
                    <table class="table table-bordered" style="width: 900px" align="left">                    
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
                            <th align="right">Nhóm học phần:</th>
                            <th>
                                <select class="form-control" name='cbNhomHP'>
                                        <option value="0">Tất cả</option>
                                    @foreach($dshp as $hp)
                                        <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>  
                                    @endforeach
                                </select>
                            </th>
                            <th>                            
                                <a href="sinhvien/indanhsachsinhvien/2134" target="_blank">
                                    <button type="button" name="" class="btn btn-success">
                                        <img src="{{asset('public/images/printer-icon.png')}}"> In bảng điểm
                                    </button>
                                </a>
                            </th>
                        </tr>
                    </table> 
                </form> 
            </div>    
            <div align="right" style="margin-top: 20px;">
                <a href="sinhvien/themsv">
                    <button type="button" class="btn btn-primary" style="width:12%;">
                        <img src="{{asset('public/images/add-icon.png')}}"> Thêm
                   </button>
                </a>
            </div>        
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-bordered table-striped" width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="3%">STT</th>
                    <th width="6%">MSSV</th>
                    <th width="18%">Họ và tên</th>
                    <th width="15%">Email</th>
                    <th width="4%">Nhóm HP</th>
                    <th width="8%">Mã nhóm thực hiện đề tài</th>
                    <th>Người tạo</th> 
                    <th>Ngày tạo</th>
                    <th>Nhóm trưởng</th>
                    <th>Khóa</th>
                    <th width=6%>Chức năng</th>
                </tr>
                @foreach($dssv as $stt => $rw)
                    <tr>
                        <td align='center'>
                            <?php 
                                if(isset($_GET['page'])){
                                    $p = 10*($_GET['page']-1);
                                    echo $stt+1+$p;
                                }else
                                    echo $stt+1;
                            ?>
                        </td>
                        <td align='center'>
                            <a href="" style="color: seagreen; font-weight: bold;" data-toggle="tooltip" data-placement="top" title="Ngày sinh: {{$rw->ngaysinh}}">
                                {{$rw->mssv}}                            
                            </a>                            
                        </td>
                        <td>
                            <a href="" data-toggle="tooltip" data-placement="top" title="Khóa Học: K{{$rw->khoahoc}}">
                                {{$rw->hoten}}                                
                            </a>
                        </td>
                        <td>{{$rw->email}}</td>
                        <td align='center'>{{$rw->tennhomhp}}</td>
                        <td align='center'>{{$rw->manhomthuchien}}</td>
                        <td align='center'>...</td>
                        <td align='center' width="8%">{{$rw->ngaytao}}</td>
                        <td width="5%" align='center'>
                            @if($rw->nhomtruong == 1)
                                <img src="{{asset('public/images/check.png')}}"/>
                            @else
                                <img src="{{asset('public/images/uncheck.png')}}"/>
                            @endif
                        </td>
                        <td align='center' width="5%">
                            @if($rw->khoa == 1)
                                <img src="{{asset('public/images/Lock.png')}}"/>
                            @elseif($rw->khoa == 0)
                                <img src="{{asset('public/images/Unlock.png')}}"/>
                            @endif
                        </td>
                        <td align='center'>
                            <a href="sinhvien/capnhatsv/{{$rw->mssv}}"><img src="{{asset('public/images/edit-icon.png')}}" /></a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Sinh viên **{{$rw->hoten}}** sẽ bị xóa?');" href='danhsachsv/xoasv/{{$rw->mssv}}'>
                                <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>   
                @endforeach
                <tr>
                    <td colspan="11" align="center">{!! $dssv->setPath('sinhvien')->render() !!}</td>
                </tr>      
           </table>

        </div>
    </div>
</div>
        
@endsection
