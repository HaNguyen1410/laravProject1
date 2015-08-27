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

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold;" align='center'>Đăng ký thành viên</h3> 
            <form name="frmThemTV" action="{{action('DangkydtController@LuuThemThanhVien')}}" method="post">
                
                <table class="table table-bordered" id="tblChonTV">
                    <tr>                   
                        <td align="center">                                                  
                                @foreach($dstensv as $sv)
                                <div style="padding: 2px 2px 2px 60px; display: block; float: left;">  
                                     <a href="" data-toggle="tooltip" data-placement="top" title="{{$sv->hoten}}">
                                           {{$sv->mssv}}
                                       </a>
                                       : <input type="checkbox" name="chk[]" value="{{$sv->mssv}}"/>&nbsp&nbsp&nbsp
                                       Nhóm trưởng: <input type="radio" name="rdNhomTruong" value=''/><br>   
                                </div>                                                                
                                @endforeach                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align='center'>
                            <input type="submit" name="btnThem" value="Thêm thành viên" class="btn btn-primary">
                        </td>
                    </tr>                
                </table> 
            </form>            
        </div>    

    </div> <!-- /row -->

</div> <!-- /container -->

@endsection
