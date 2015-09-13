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
            <h4 style="display:block; float: left; color: darkblue; font-weight: bold;">DANH SÁCH GIẢNG VIÊN</h4>
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
                            <a href="danhsachgv/themgv">
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
                <table class="table table-bordered table-striped" >
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
                    @foreach($dsgv as $stt => $rw)                
                        <tr>
                            <td align='center'> 
                                <?php 
                                    if(isset($_GET['page'])){
                                        $p = 5*($_GET['page']-1);
                                        echo $stt+1+$p;
                                    }else
                                        echo $stt+1;
                                ?>
                            </td>
                            <td align='center'>{{$rw->macb}}</td>
                            <td>{{$rw->hoten}}</td>
                            <td>{{$rw->email}}</td>
                            <td>...</td>
                            <td align='center'>{{$rw->ngaytao}}</td>
                            <td align='center'>
                                @if($rw->khoa == 1)
                                    <img src="{{asset('images/Lock.png')}}"/>
                                @elseif($rw->khoa == 0)
                                    <img src="{{asset('images/Unlock.png')}}"/>
                                @endif
                            </td>
                            <td align='center'>
                                <a href='danhsachgv/capnhatgv/{{$rw->macb}}'><img src="{{asset('images/edit-icon.png')}}"/></a>&nbsp &nbsp &nbsp
                                <a onclick="return confirm('Giảng viên **{{$rw->hoten}}** sẽ bị xóa?');" href='danhsachgv/xoagv/{{$rw->macb}}'>
                                    <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="9" align="center">{!! $dsgv->setPath('danhsachgv')->render() !!}</td>
                    </tr>                     
                </table>
            </div>            
            <div class="col-md-12">
                <p style="color:red;"><?php echo Session::get('ThongBaoRut'); ?></p>
                <table class="table table-bordered table-striped" style="width: 700px" align="center">
                    <tr>
                        <th width="3%">STT</th>
                        <th>MACB</th>
                        <th width="15%">Nhóm HP phụ trách</th>
                        <th>Năm học</th>
                        <th>Học kỳ</th>
                        <th width="15%">Chức năng</th>
                    </tr>
                    @foreach($gv_hp as $stt => $gvhp)
                    <tr>
                        <td align="center">{{$stt+1}}</td>
                        <td align="center">{{$gvhp->macb}}</td>
                        <td align="center">{{$gvhp->tennhomhp}}</td>
                        <td align="center">{{$gvhp->nam}}</td>
                        <td align="center">{{$gvhp->hocky}}</td>
                        <td align='center'>
                            <a onclick="return confirm('Rút giảng viên **{{$rw->hoten}}** khỏi nhóm HP **{{$gvhp->tennhomhp}}?');" href='danhsachgv/xoagvkhoihocphan/{{$gvhp->manhomhp}}'>
                                <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>                
        </div>
    </div>
</div>
    
@endsection