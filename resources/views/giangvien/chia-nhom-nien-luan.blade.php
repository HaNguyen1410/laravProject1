@extends('sinhvien_home')

@section('content_sv')

        <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
                vertical-align: middle;
            }

        </style>
        
        <script>
            function dschon_detai() {
                $macb = document.getElementById('txtMaCB').value;
                //prompt($macb);
                //alert($macb);
                var _window = window.open("{{asset('sinhvien/chondetai/1111317')}}", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=90, left=90, width=1200, height=400");
                _window.onbeforeunload = function()
                {
                    location.reload();
                }
            }
        </script>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;" align='center'>CHIA NHÓM LÀM NIÊN LUẬN</h3> 
            <h4 style="color: darkblue; font-weight: bold;">Chia thành viên</h4>
            <form name="frmThemTV" action="{{action('')}}" method="post">
                <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                <table class="table table-bordered" id="tblChonTV">
                    <tr>                   
                        <td align="center">                                                  
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
                        <td colspan="4" align='center'>
                            <div style="display: block;">                                    
                                <p style='color:red;'>{{$errors->first('chk')}}</p>
                                <p style='color:red;'>{{$errors->first('rdNhomTruong')}}</p>
                            </div>
                            <input type="submit" name="btnThem" value="Thêm thành viên" class="btn btn-primary">
                        </td>
                    </tr>                
                </table> 
            </form>
            <h4 style="color: darkblue; font-weight: bold;">Giao đề tài</h4>    
            <form name="frmDangKyNL" action="" method="post">
                <table class="table table-bordered" border="1" width="800px" cellpadding="15px" cellspacing="0px" align='center' id="dangky">                    
                    <tr>
                        <th width='15%' valign='middle'>Chọn đề tài:</th>
                        <td align="center">
                            <select class="form-control" name="cbDeTai">
                                @foreach($dsdetai as $dt)
                                <option value="{{$dt->madt}}">{{$dt->tendt}}</option>
                                @endforeach
                            </select>
                        </td>                        
                    </tr>                    
                    <tr>
                        <td colspan="2" align='center'>
                            <button type="submit" name="btnLưu" class="btn btn-success" style="width: 20%;">
                                Lưu 
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>    

    </div> <!-- /row -->

</div> <!-- /container -->

@endsection
