@extends('giangvien_home')

@section('content_gv')

        <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }
            #bang2 th{
                text-align: center;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }

        </style>
       
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;" align='center'>CHIA NHÓM LÀM NIÊN LUẬN</h3> 
            <h4 style="color: darkblue; font-weight: bold;">Phân chia thành viên</h4>            
            <form name="frmThemTV" action="" method="post">
               <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" id="tblChonTV">
                    <tr>
                        <th align="right">Năm học:</th>
                        <th width="15%">
                            <input type="text" name="txtNamHoc" value="{{$namcb}}" style="text-align: center;" class="form-control" readonly=""/>
                        </th>
                        <th align="right">Học kỳ:</th>
                        <th width="15%">
                            <input type="text" name="txtHocKy" value="{{$hkcb}}" style="text-align: center;" class="form-control" readonly=""/>
                        </th>
                        <th align="right" width="15%">Nhóm học phần:</th>
                        <th>
                            <select class="form-control" name="cbNhomHP">
                                @foreach($dsmahp as $hp)
                                    <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th width='15%' valign='middle'>Chọn đề tài:</th>
                        <td align="center" colspan='5'>
                            <select class="form-control" name="cbDeTai">
                                @foreach($dsdetai as $dt)
                                <option value="{{$dt->madt}}">{{$dt->tendt}}</option>
                                @endforeach
                            </select>
                        </td>                        
                    </tr>  
                    <tr>                   
                        <td align="center" colspan="6">                                                  
                            @foreach($dstensv as $sv)
                                <div style="padding: 2px 2px 2px 60px; display: block; float: left;">  
                                     <a href="" data-toggle="tooltip" data-placement="top" title="{{$sv->hoten}}">
                                           {{$sv->mssv}}
                                       </a>
                                       : <input type="checkbox" name="chk[]" value="{{$sv->mssv}}"/>&nbsp&nbsp&nbsp
                                       Nhóm trưởng: <input type="radio" name="rdNhomTruong" value=""/><br>   
                                </div>                                                                
                             @endforeach                                
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align='center'>
                            <div style="display: block;">                                    
                                <p style='color:red;'>{{$errors->first('chk')}}</p>
                                <p style='color:red;'>{{$errors->first('rdNhomTruong')}}</p>
                            </div>
                            <button type="submit" name="btnLưu" class="btn btn-success" style="width: 20%;">
                                <img src="{{asset('images/save-as-icon.png')}}">&nbsp;
                                Lưu 
                            </button>
                        </td>
                    </tr>                
                </table> 
            </form>            
        </div>   
        <div class="col-md-12">
            <h4 style="color: darkblue; font-weight: bold; text-align: center;">Danh sách đề tài của mỗi nhóm</h4>
            <table class="table table-bordered" style="max-width: 900px;" align='center' id="bang2">
                <tr>
                    <th width="4%">STT</th>
                    <th width="8%">Mã nhóm</th>
                    <th>Tên đề tài</th>
                    <th width="6%">Thao tác</th>
                </tr>
                @foreach($detainhom as $stt => $dt)
                    <tr>
                        <td>{{$stt+1}}</td>
                        <td>{{$dt->manhomthuchien}}</td>
                        <td>{{$dt->tendt}}</td>
                        <td align="center">
                            <a onclick="return confirm('Xóa đề tài **{{$dt->tendt}}** ra khỏi nhóm {{$dt->manhomthuchien}}?');" href="">
                                <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>                        
                @endforeach
            </table>
             <h4 style="color: darkblue; font-weight: bold; text-align: center;">Danh sách các nhóm đã chia</h4>
            <table class="table table-bordered" style="max-width:900px" align='center' id="bang2">
                <tr>
                    <th width="4%">STT</th>
                    <th width="8%">Mã nhóm</th>
                    <th width="10%">MSSV</th>
                    <th>Thành viên</th>
                    <th width="8%">Nhóm trưởng</th>
                    <th width="6%">Thao tác</th>
                </tr>
                @foreach($dsNhom as $stt => $svnhom)                
                    <tr>
                        <td align="center">{{$stt+1}}</td>
                        <td align="center" rowspan="count($svnhom->mssv)">
                            {{$svnhom->manhomthuchien}}
                        </td>
                        <td align="center">{{$svnhom->mssv}}</td>
                        <td width="25%">{{$svnhom->hoten}}</td>
                        <td align="center">
                            @if($svnhom->nhomtruong == 0)                            
                                <a href=""><input type="image" src="{{asset('images/uncheck.png')}}" /></a>
                            @else
                                <a href=""><input type="image" src="{{asset('images/check.png')}}"/></a>
                            @endif
                        </td>
                        <td align="center" >
                            <a onclick="return confirm('Xóa sinh viên **{{$svnhom->hoten}}** ra khỏi nhóm {{$svnhom->manhomthuchien}}?');" href="">
                                <img src="{{asset('images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div> <!-- /row -->

</div> <!-- /container -->

@endsection
