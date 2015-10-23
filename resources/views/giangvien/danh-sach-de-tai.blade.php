@extends('giangvien_home')

@section('content_gv')

        <style type="text/css">
            th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }
        </style>   

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">Danh sách các đề tài</h3>            
            <table class="table table-bordered" style="width:700px;" align="center">
                <tr>  
                    <th align="right">Năm học:</th>
                    <td width="20%">
<!--                        <select class="form-control" name='cbNamHoc'>
                            @foreach($namhoc as $nk)
                            <option value="{{$nk->nam}}">{{$nk->nam}}</option>  
                            @endforeach
                        </select>-->
                        <input type="text" name="txtNam" value="{{$namcb}}" style="text-align:center;" class="form-control" readonly=""/>
                    </td>
                    <th align="right">Học kỳ:</th>
                    <td width="15%">
<!--                        <select class="form-control" name='cbHocKy'>
                            @foreach($hocky as $nk)
                            <option value="{{$nk->hocky}}">{{$nk->hocky}}</option>  
                            @endforeach
                        </select>-->
                        <input type="text" name="txtHocKy" value="{{$hkcb}}" style="text-align:center;" class="form-control" readonly=""/>
                    </td>
                    <td align="center">
                        <a href="danhsachdetai/themdetai">
                            <button type="button" name="" class="btn btn-primary">
                                <img src="{{asset('public/images/add-icon.png')}}">Thêm đề tài
                            </button>
                        </a>
                    </td>
                </tr>
            </table> 
                        
            <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
            <table class="table table-bordered table-hover" width="800px">
                <tr>
                    <th width="2%">STT</th>
                    <th width="20%">Tên đề tài</th>
                    <th width="5%">Chi tiết</th>
                    <th width="15%">Mô tả đề tài</th>
                    <th width="15%">Công nghệ</th>
                    <th width="4%">Tối đa</th>
                    <th width="15%">Lưu ý</th>
                    <!--<th width="8%">Nhóm thực hiện</th>-->
                    <th width="10%">Trạng thái</th>
                    <th width="8%">Thao tác</th>
                </tr>
                @if(count($dsdt) == 0)
                    <tr>
                        <td colspan="9" align="center">
                            <label style="color: #e74c3c;"> Chưa có đề tài nào!</label> 
                        </td>
                    </tr>
                @elseif (count($dsdt) > 0)
                    @foreach($dsdt as $stt => $dt)
                        <tr>
                            <td align='center' style="vertical-align: middle;">
                                <?php
                                    if(isset($_GET['page'])){
                                        $p = 5*($_GET['page']-1);
                                        //Vì $stt là chỉ số của 1 mảng nên luôn luôn bắt đầu bằng 0
                                        echo $stt+1+$p;
                                    }
                                    else{
                                        echo $stt+1;
                                    }
                                ?>
                            </td>
                            <td width='15%'>
                                <a data-toggle="tooltip" data-placement="bottom" title="Ngày tạo: {{$dt->ngaytao}} - Ngày sửa: {{$dt->ngaysua}}">
                                    <label>{{$dt->tendt}}</label>                                
                                </a>
                            </td>
                            @if($dt->taptindinhkem != "")
                                <td>
                                    <a href="../public/mota_detai/{{$dt->taptindinhkem}}" align='center' target="_blank">
                                        <img src="{{asset('public/images/Filetype-PDF-icon.png')}}"/>
                                    </a>                            
                                </td>
                            @elseif($dt->taptindinhkem == "")
                                <td style="vertical-align: middle;">
                                    <a href="danhsachdetai/{{$dt->macb}}/inchitietdetai/{{$dt->madt}}" target="_blank" style="color: #008000; font-weight: bold;">
                                        Chi tiết
                                    </a>
                                </td>
                            @endif               
                            <td width='15%'>
                                <?php 
                                    echo substr($dt->motadt,0,100). "<br><label>....</label>";
                                ?>
                            </td> 
                            <td width='15%'>
                                <?php                                     
                                    echo substr($dt->congnghe,0,200). "<br><label>....</label>";
                                ?>
                            </td>
                            <td align="center" style="vertical-align: middle;">
                                {{$dt->songuoitoida}}
                            </td>
                            <td>
                                {{$dt->ghichudt}}
                            </td>
    <!--                        @foreach($nhomth as $nhom)      
                                @if($nhom->tendt == $dt->tendt)
                                    <td align='center'>
                                        {{$nhom->manhomthuchien}}
                                    </td>
                                @endif
                            @endforeach -->
                            <td align='center' style="vertical-align: middle;">{{$dt->trangthai}}</td>
                            <td align='center'>
                                <a href="danhsachdetai/capnhatdetai/{{$dt->madt}}">
                                    <img src="{{asset('public/images/edit-icon.png')}}"/>
                                </a>&nbsp
                                <a onclick="return confirm('Đề tài **{{$dt->tendt}}** sẽ bị xóa?');" href="danhsachdetai/xoadt/{{$dt->madt}}">
                                    <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="10" align="center">{!! $dsdt->setPath('danhsachdetai')->render() !!}</td>
                </tr> 
            </table>
        </div>
    </div><!-- /row -->
</div> <!-- /container -->

@endsection