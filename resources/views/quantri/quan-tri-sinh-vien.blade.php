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
            <div>
                <form action="{{action('QuantriController@LayNhomHP')}}" method="post">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <table class="table table-bordered" style="max-width: 1000px" align="center">                    
                        <tr>
                            <th align="right" width="10%">Năm học:</th>
                            <th width="16%">
<!--                                <select class="form-control" name='cbNamHoc'>
                                    @foreach($namhoc as $nk)
                                    <option value="{{$nk->nam}}">{{$nk->nam}}</option>  
                                    @endforeach
                                </select>-->
                                <input type="text" name="txtNamHoc" value="{{$namht}}" style="text-align: center" class="form-control" readonly=""/>
                            </th>
                            <th align="right" width="8%">Học kỳ:</th>
                            <th width="10%">
<!--                                <select class="form-control" name='cbHocKy'>
                                    @foreach($hocky as $nk)
                                        @if($nk->hocky == 3)
                                            <option value="{{$nk->hocky}}">Hè</option>                                         
                                        @else
                                            <option value="{{$nk->hocky}}">{{$nk->hocky}}</option>
                                        @endif  
                                    @endforeach
                                </select>-->
                                <input type="text" name="txtHocKy" value="{{$hkht}}" style="text-align: center" class="form-control" readonly=""/>
                            </th>
                            <th align="right" width="10%">Nhóm học phần:</th>
                            <th width="12%">
                                <select class="form-control" name='cbNhomHP'>
                                    @if($mahp == null || $mahp == 0)
                                        <option value="0" selected="">Tất cả</option>
                                        @foreach($dshp as $hp)
                                            <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                                        @endforeach 
                                    @elseif($mahp != null)
                                        <option value="0">Tất cả</option>
                                        @foreach($dshp as $hp)
                                            @if($mahp == $hp->manhomhp)
                                                <option value="{{$hp->manhomhp}}" selected="">{{$hp->tennhomhp}}</option>
                                            @else
                                                <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option> 
                                            @endif
                                        @endforeach   
                                    @endif
                                </select>
                            </th>
                            <th width="15%">
                                <button type="submit" class="btn btn-success" style="width:100%">
                                    Liệt kê
                                </button>
                            </th>
                            <th width="15%">  
                                @if($mahp == null || $mahp == 0)
                                    <button onclick="return confirm('Vui lòng chọn nhóm HP muốn in!');" type="button" name="" class="btn btn-success">
                                        <img src="{{asset('public/images/printer-icon.png')}}"> In danh sách
                                    </button>
                                @elseif($mahp != null)
                                    <a href="{{asset('quantri/sinhvien/'.$mahp.'/indanhsachsinhvien/'.\Auth::user()->taikhoan)}}" target="_blank">
                                        <button type="button" name="" class="btn btn-success">
                                            <img src="{{asset('public/images/printer-icon.png')}}"> In danh sách
                                        </button>
                                    </a>
                                @endif
                            </th>
                        </tr>
                    </table> 
                </form> 
            </div>
            <h4 style="color: darkblue; font-weight: bold; display:block; float: left;">
                DANH SÁCH SINH VIÊN
            </h4>  
            <div align="right">
                <a href="{{asset('quantri/sinhvien/0/themsv')}}">
                    <button type="submit" class="btn btn-primary" style="width:12%;">
                        <img src="{{asset('public/images/add-icon.png')}}"> Thêm
                   </button>
                </a>
            </div> 
                  
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-bordered table-striped" max-width="800px" cellpadding="0px" cellspacing="0px" align='center'>
                <tr>
                    <th width="3%">STT</th>
                    <th width="6%">MSSV</th>
                    <th width="18%">Họ và tên</th>
                    <th width="15%">Email</th>
                    <th width="4%">Nhóm HP</th>
                    <th width="8%">Mã nhóm thực hiện đề tài</th>
                    <!--<th>Người tạo</th>--> 
                    <th>Ngày tạo</th>
                    <th>Nhóm trưởng</th>
                    <th>Khóa</th>
                    <th width=6%>Chức năng</th>
                </tr>
                    @if(count($dssv) == 0)
                        <tr>
                            <td colspan="10" align="center">
                                <label style="color: #e74c3c;"> Chưa có sinh viên nào!</label> 
                            </td>
                        </tr>
                    @elseif (count($dssv) > 0)
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
                                <!--<td align='center'>...</td>-->
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
                                    @if($mahp == null)
                                        <a href="sinhvien/0/capnhatsv/{{$rw->mssv}}"><img src="{{asset('public/images/edit-icon.png')}}" /></a>&nbsp;&nbsp;&nbsp;
                                    @elseif($mahp != null)
                                        <a href="../sinhvien/{{$mahp}}/capnhatsv/{{$rw->mssv}}"><img src="{{asset('public/images/edit-icon.png')}}" /></a>&nbsp;&nbsp;&nbsp;
                                    @endif
                                    <a onclick="return confirm('Sinh viên **{{$rw->hoten}}** sẽ bị xóa?');" href='danhsachsv/xoasv/{{$rw->mssv}}'>
                                        <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                                    </a>
                                </td>
                            </tr>   
                        @endforeach
                    @endif
                <tr>
                    @if($mahp == null)
                        <td colspan="11" align="center">{!! $dssv->setPath('sinhvien')->render() !!}</td>                       
                    @elseif($mahp != null)
                        <td colspan="11" align="center">{!! $dssv->setPath('../sinhvien/'.$mahp)->render() !!}</td> 
                    @endif
                </tr>      
           </table>

        </div>
    </div>
</div>
        
@endsection
