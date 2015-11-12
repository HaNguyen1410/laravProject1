@extends('giangvien_home')

@section('content_gv')

    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            background-color: #dff0d8;
            font-weight: bold;
        }
    </style>
    
    <script type="text/javascript">
        function DoiGDThemTC(){
            if(document.getElementById('rdThemMoi').checked == true){
                return window.location.href = 'http://localhost/laravProject1/giangvien/dstieuchi/themtieuchi?gd=moi';                    
            }
            else if(document.getElementById('rdThemDaCo').checked == true){
               return window.location.href = 'http://localhost/laravProject1/giangvien/dstieuchi/themtieuchi?gd=daco';                    
            }
        }
    </script>

    <div class="container">
        <div class="row">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">
                <a href="{{asset('giangvien/dstieuchi')}}">Danh sách tiêu chí đánh giá</a>  
                   &Gt;
                Thêm tiêu chí đánh giá
            </h3><br> 
            <div class="col-md-12" align="center">
                <form action="" method="get">
                    <label style="font-size: 13pt; color: darkblue; font-weight: bold;">Thêm mới</label> 
                        &nbsp;<input type="radio" onclick="DoiGDThemTC()" id="rdThemMoi" name="rdThemMoi"
                                    <?php
                                        if(!isset($_GET['gd']) || $_GET['gd'] == "moi")
                                            echo 'checked';
                                        else if($_GET['gd'] == "daco")
                                            echo '';
                                    ?>
                                /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label style="font-size: 13pt; color: darkblue; font-weight: bold;">Thêm tiêu chí đã có</label>
                        &nbsp;<input type="radio" onclick="DoiGDThemTC()" id="rdThemDaCo" name="rdThemDaCo"
                                    <?php
                                        if(!isset($_GET['gd']) || $_GET['gd'] == "moi")
                                            echo '';
                                        else if($_GET['gd'] == "daco")
                                            echo 'checked';
                                    ?> 
                                />  
                </form>                                
            </div><br><br>
            @if(!isset($_GET['gd']) || $_GET['gd'] == "moi")
                <form action="{{action('QdtieuchiController@LuuThemTieuChi')}}" method="post" class="form-horizontal"> 
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>                                      
                        <table class="table table-bordered" align="center" style="max-width:800px;">
                            <tr>
                                <th>Mã cán bộ:</th>
                                <td>
                                    <input type="text" name="txtMaCB" value="2134" style="width: 60%; text-align: center;" class="form-control" readonly=""/>
                                </td>
                                <th>Mã tiêu chí:</th>
                                <td>                                 
                                    <input style="width:35%; text-align: center;" type="text" name="txtMaTC" value="{{$ma}}" class="form-control" readonly=""/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Nội dung đánh giá:</th>
                                <td colspan="3">
                                     <textarea class="form-control" rows="3" name="txtNoiDungTC"></textarea>
                                     <p style='color:red;'>{{$errors->first('txtNoiDungTC')}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>Mức điểm:</th>
                                <td colspan="3">
                                    <input type="text" name="txtMucDiem" value="" class="form-control" /> 
                                    <p style='color:red;'>{{$errors->first('txtMucDiem')}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <button type="submit" name="btnThem" class="btn btn-primary" style="width: 20%;">
                                        <img src="{{asset('public/images/save-as-icon.png')}}"> Thêm
                                    </button> 
                                    <a href="{{asset('giangvien/dstieuchi')}}" class="btn btn-warning" style="width:20%;">
                                        <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                                    </a> 
                                </td>                            
                            </tr>
                        </table>       
                </form>        
            @elseif($_GET['gd'] == "daco") 
                <form action="" method="post" class="form-horizontal"> 
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>                                      
                        <table class="table table-bordered" align="center" style="max-width:800px;">
                            <tr>
                                <th>Mã cán bộ:</th>
                                <td>
                                    <input type="text" name="txtMaCB" value="2134" style="width: 60%; text-align: center;" class="form-control" readonly=""/>
                                </td>
                                <th>Mã tiêu chí:</th>
                                <td>                                 
                                    <input style="width:35%; text-align: center;" type="text" name="txtMaTC" value="{{$ma}}" class="form-control" readonly=""/> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <button type="submit" name="btnThem" class="btn btn-primary" style="width: 20%;">
                                        <img src="{{asset('public/images/save-as-icon.png')}}"> Thêm
                                    </button> 
                                    <a href="{{asset('giangvien/dstieuchi')}}" class="btn btn-warning" style="width:20%;">
                                        <img src="{{asset('public/images/delete-icon.png')}}"> Hủy bỏ
                                    </a> 
                                </td>                            
                            </tr>
                        </table>    
                </form>    
            @endif
        </div><!-- /row -->

    </div> <!-- /container -->
@endsection