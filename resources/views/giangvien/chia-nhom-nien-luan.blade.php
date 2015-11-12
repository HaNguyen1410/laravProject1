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
<!--        <script>
            function kt(){
                if(document.getElementById('cbDeTai').value == ''){                    
                    alert('Vui lòng nhập và đầy đủ các thông tin trong khung "Phân chia thành viên"!');
                    return false;
                }
                document.getElementById('frChiaNhom').method = 'post';
                document.getElementById('frChiaNhom').action = "{{action('ChianhomController@LuuChiaNhomNL')}}";
                //In url mang theo mã nhóm hp
                return true;
                
            }
        </script>-->
       
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;" align='center'>CHIA NHÓM LÀM NIÊN LUẬN</h3> 
            <h4 style="color: darkblue; font-weight: bold;">Phân chia thành viên</h4> 
            
            <form action="{{action('ChianhomController@LayNhomHP')}}" method="post" name="frmChonNhomHP">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered">                    
                    <tr>
                        <th align="right" width="8%">Năm học:</th>
                        <th width="12%">
                            <input type="text" name="txtNamHoc" value="{{$namcb}}" style="text-align: center;" class="form-control" readonly=""/>
                        </th>
                        <th align="right" width="7%">Học kỳ:</th>
                        <th width="7%">
                            <input type="text" name="txtHocKy" value="{{$hkcb}}" style="text-align: center;" class="form-control" readonly=""/>
                        </th>
                        <th align="right" width="10%">Mã nhóm:</th>
                        <th width="10%">
                            <input type="text" name="txtHocKy" value="{{$manth}}" style="text-align: center;" class="form-control" readonly=""/>
                        </th>
                        <th align="right" width="12%">Nhóm học phần:</th>
                        <th width="8%">
<!--                            <select onchange="document.frChiaNhom.submit()" class="form-control" name="cbNhomHP">
                                @foreach($dsmahp as $hp)
                                    <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                                @endforeach
                            </select>-->
                            <select class="form-control" name='cbNhomHP'>
                                @if($mahp == null || $mahp == 0)
                                    @foreach($dshp as $hp)
                                        <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option>
                                    @endforeach 
                                @elseif($mahp != null)
                                    @foreach($dsmahp as $hp)
                                        @if($mahp == $hp->manhomhp)
                                            <option value="{{$hp->manhomhp}}" selected="">{{$hp->tennhomhp}}</option>
                                        @else
                                            <option value="{{$hp->manhomhp}}">{{$hp->tennhomhp}}</option> 
                                        @endif
                                    @endforeach   
                                @endif
                            </select>
                        </th>
                        <th style="text-align: center">
                            <button type="submit" name="btnLưu" class="btn btn-success" style="min-width: 130px;">
                                Liệt kê
                            </button>
                        </th>
                        <th width="12%">  
                            <a href="{{asset('giangvien/chianhom/'.$mahp.'/indanhsachdetainhom/'.\Auth::user()->taikhoan)}}" target="_blank">
                                <button type="button" name="" class="btn btn-success">
                                    <img src="{{asset('public/images/printer-icon.png')}}"> In danh sách
                                </button>
                            </a>
                        </th>
                    </tr>
                </table>
            </form>
            <form action="{{action('ChianhomController@LuuChiaNhomNL')}}" method="post" id="frChiaNhom" name="frChiaNhom">
               <input type='hidden' name='_token' value='<?= csrf_token();?>'/>               
                <table class="table table-bordered" id="tblChonTV">
                    <tr>
                        <th width='18%' valign='middle'>Chọn đề tài:</th>
                        <td colspan="5" align="center">
                            <select class="form-control" id="cbDeTai" name="cbDeTai">
                                <option value="">Chọn tên đề tài</option>
                                @foreach($dsdetai as $dt)
                                    <option value="{{$dt->madt}}">{{$dt->tendt}}</option>                         
                                @endforeach
                            </select>
                            <p style='color:red;'>{{$errors->first('cbDeTai')}}</p>
                        </td>                        
                    </tr>  
                    <tr>
                        <th>Ngày bắt đầu (kế hoạch):</th>
                        <td width="20%">
                           <input type="text" id="txtNgayBatDauKH" name="txtNgayBatDauKH" value="" class="form-control"/>
                           <p style='color:red;'>{{$errors->first('txtNgayBatDauKH')}}</p>
                        </td>
                        <th width="18%">Ngày kết thúc (kế hoạch):</th>
                        <td width="20%">
                            <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtNgayKetThucKH')}}</p>
                        </td>
                        <th width="18%">Số tuần theo kế hoạch:</th>
                        <td>
                            <input type='text' name="txtSoTuanKH" value="" class="form-control"/>
                            <p style='color:red;'>{{$errors->first('txtSoTuanKH')}}</p>
                        </td>
                    </tr>
                    <tr>                   
                        <td align="center" colspan="7">                                                  
                            @foreach($dstensv as $sv)
                                <div style="padding: 2px 2px 2px 60px; display: block; float: left;">                                   
                                    <a href="" data-toggle="tooltip" data-placement="top" title="{{$sv->hoten}}">
                                          {{$sv->mssv}}
                                    </a> 
                                    : <input type="checkbox" name="chkThanhVien[]" value="{{$sv->mssv}}"/>&nbsp&nbsp&nbsp
                                    Nhóm trưởng: <input type="radio" name="rdNhomTruong[]" value="{{$sv->mssv}}"/><br> 
                                </div> 
                            @endforeach                                
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" align='center'>
                            <div style="display: block;">                                    
                                <p style='color:red;'>{{$errors->first('chkThanhVien')}}</p>
                                <p style='color:red;'>{{$errors->first('rdNhomTruong')}}</p>
                            </div>
                            <button onclick="return kt();" type="submit" name="btnLưu" class="btn btn-success" style="min-width: 13%;">
                                <img src="{{asset('public/images/save-as-icon.png')}}">&nbsp;
                                Lưu 
                            </button>
                        </td>
                    </tr>                
                </table> 
            </form>            
        </div>   
        <div class="col-md-12">    
            <div>                
                <h4 style="margin-left: 240px;color: darkblue; font-weight: bold; display: block; float: left;">
                    Danh sách đề tài của mỗi nhóm trong các nhóm Học Phần
                </h4> &nbsp;&nbsp;&nbsp;
                <a href="{{asset('giangvien/chianhom/all/indanhsachdetainhom/'.\Auth::user()->taikhoan)}}" target="_blank" style="text-align: center;">
                    <button type="button" name="" class="btn btn-primary" style="min-width: 13%;">
                        <img src="{{asset('public/images/printer-icon.png')}}"> In tất cả
                    </button>
                </a>
            </div>
            <table class="table table-bordered" style="max-width: 900px;" align='center' id="bang2">
                <tr>
                    <th width="4%">STT</th>
                    <th width="8%">Mã nhóm</th>
                    <th width="6%">Tên nhóm HP</th>
                    <th>Tên đề tài</th>
                </tr>
                @foreach($detainhom as $stt => $dt)
                    <tr>
                        <td>{{$stt+1}}</td>
                        <td>{{$dt->manhomthuchien}}</td>
                        <td align='center'>{{$dt->tennhomhp}}</td>
                        <td>{{$dt->tendt}}</td>
                    </tr>                        
                @endforeach
            </table>           
             <h4 style="color: darkblue; font-weight: bold; text-align: center;">
                 Danh sách các nhóm đã chia của nhóm HP: {{$tenhp = DB::table('nhom_hocphan')->where('manhomhp',$mahp)->value('tennhomhp')}}
             </h4>
             <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
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
                                <input type="image" src="{{asset('public/images/uncheck.png')}}" />
                            @else
                                <input type="image" src="{{asset('public/images/check.png')}}"/>
                            @endif
                        </td>
                        <td align="center" >
                            <a href="{{asset('giangvien/chianhom/chuyenthanhvien/'.$svnhom->mssv)}}">
                                    <img src="{{asset('public/images/edit-icon.png')}}"/>
                            </a>&nbsp
                            <a onclick="return confirm('Xóa sinh viên *{{$svnhom->hoten}} ra khỏi nhóm *{{$svnhom->manhomthuchien}}!');" href="{{asset('giangvien/chianhom/xoasvtrongnhom/'.$svnhom->mssv)}}">
                                <img src="{{asset('public/images/Document-Delete-icon.png')}}"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div> <!-- /row -->

</div> <!-- /container -->

@endsection