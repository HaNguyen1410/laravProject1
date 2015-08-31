@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>


<div class="container">            
    <div class="row">
        <h3 style="color: darkblue; font-weight: bold;" align="center">NỘP TÀI LIỆU</h3><br>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label style="margin-left: 15px;">Tên đề tài: </label><br>
                    <label style="margin-left: 15px;color: darkblue; font-weight: bold;">                         
                        <textarea class="form-control" cols='80' rows='3' style="padding-left: 1px" readonly="">
                            {{$tendt}}
                        </textarea>
                    </label>
                </div>
                <div class="col-md-6">
                    <label style="display: block; float: left;">Công việc: </label>
                    <select class="form-control">
                        @foreach($dscvchinh as $cv)
                        <option value="{{$cv->macv}}">{{$cv->congviec}}</option>  
                        @endforeach
                    </select>
                </div>                                          
             </div><br>
             <div class="col-md-12">     
                <table class="table table-bordered" cellpadding="15px" cellspacing="0px" align='center'>
                    <tr>
                        <th width="1%">STT</th>
                        <th width="8%">Tên tập tin</th>
                        <th width="4%">Cỡ</th>
                        <th width="6%">Ngày đăng</th>
                        <th width="10%">Tác giả</th>
                        <th width="20%">Nhận xét GV</th>
                        <th width="6%">Ngày nhận xét</th>
                        <th width="5%">Thao tác</th>
                    </tr> 
                    <tr>
                        <td>1</td>
                        <td><label>Đặc tả sơ bộ</label></td>
                        <td>3Mb</td>
                        <td>02/03/2014</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="center">
                            <a href="?cn=noptl"><img src="{{asset('images/Document-Delete-icon.png')}}"></a>
                        </td>
                    </tr>
                </table><hr>
             </div>
        </form>

        <div class="col-md-12">
             <div id="progress" class="progress" style="width:50%;">
                <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <span id="percent" style="color: black;">0%</span><!--class="sr-only"-->
                </div>                                 
             </div>
             <div id="result"></div>

             <form id="form_upload_ajax" action="" method="post" enctype="multipart/form-data">
                <input type="file" id="fTaiLieu" name="fTaiLieu" style="width:60%;"/><br>
                <label>Mô tả:</label>
                <textarea name="txtMoTa" class="form-control" rows="3" style="width:60%;"></textarea><br>
                <input type="submit" name="uploadclick" value="Gửi tập tin" class="btn btn-success" style="margin-left: 50px;"/><br>
            </form>
        </div>                                               
    </div><!-- /row -->

</div>   <!-- /container -->
@endsection
