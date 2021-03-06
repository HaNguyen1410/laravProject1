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
         <div class="col-md-12">            
            <h3 style="color: darkblue; font-weight: bold;" align="center">
                Kết quả tìm kiếm
            </h3>           
        </div> 
        @if(Session::has('ThongBao') && count($sv) == 0)             
            <div class="alert alert-info" style="color: red; font-weight: bold;">
                {{ Session::get('ThongBao') }} <br>
                <label style="color: black;">{{$hoten}}({{$mssv}}) - Của nhóm HP: {{$hp_sv}}</label>
            </div>
        @elseif(count($sv) != 0)
            <div class="col-md-12">    
                <label style="color: blue">{{$hoten}} ({{$mssv}})</label> - 
                <label>Nhóm HP: </label>&nbsp;<label style="color: blue">{{$hp_sv}}</label> - 
                <label>Mã nhóm thực hiện đề tài: </label>&nbsp;<label style="color: blue">{{$manth}}</label><br>
                <label>Đề tài nhóm:</label>&nbsp;<label style="color: blue">{{$tendt}}</label>        
            </div>    
            <div class="col-md-12"><br>
                        <table class="table table-bordered" border="0" width="1000px" cellpadding="0px" cellspacing="0px" align='center' id="bang1">
                            <tr>
                                <th width="1%">STT</th>
                                <th width="1%">Tuần</th>
                                <th width="15%">Công việc</th>
                                <th width="6%">Ngày bắt đầu</th>
                                <th width="6%">Hạn hoàn tất</th>
                                <th width="7%">Phụ thuộc</th>
                                <th width="5%">Độ ưu tiên</th>
                                <th width="5%">Trạng thái</th>
                                <th width="8%">Tiến độ</th>
                            </tr>
                            @if(count($sv_cv) == 0)
                                <tr>
                                    <td colspan="10" align="center">
                                        <label style="color: #e74c3c;"> Chưa có công việc nào!</label> 
                                    </td>
                                </tr>
                            @elseif(count($sv_cv) != 0)
                                @foreach($sv_cv as $stt => $cv)
                                    <tr>
                                        <td align='center'>{{$stt+1}}</td>
                                        <td align='center'>
                                            @if($cv->tuan != " ")
                                                {{$cv->tuan}}
                                            @elseif($cv->tuan_lamlai != "")
                                                {{$cv->tuan_lamlai}}
                                            @endif                                       
                                        </td>
                                        <td>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Mã công việc: {{$cv->macv}}">
                                                 <label>{{$cv->congviec}}</label>
                                            </a>
                                        </td>
                                        <td align='center'>{{$cv->ngaybatdau_kehoach}}</td>
                                        <td align='center'>{{$cv->ngayketthuc_kehoach}}</td>
                                        <td align='center'>
                                            <?php
                                                $tencvchinh = DB::table('cong_viec')->where('macv',$cv->phuthuoc_cv)->value('congviec');
                                            ?>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Mã công việc: {{$cv->phuthuoc_cv}}">
                                                 {{$tencvchinh}}
                                            </a>                                            
                                        </td>
                                        <td align='center'>{{$cv->uutien}}</td>
                                        <td align='center'>{{$cv->trangthai}}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$cv->tiendo}}" aria-valuemin="0" aria-valuemax="100" style="width:<?= $cv->tiendo; ?>%">
                                                    <span style='color:brown;'>{{$cv->tiendo}}%</span>
                                                </div>
                                            </div>
                                        </td>                                        
                                    </tr>                                
                                @endforeach
                            @endif

                        </table>
            </div>   <!-- /class="col-md-12" --> 
        @endif
                            
    </div> <!-- /row -->

</div> <!-- /container -->

@endsection

