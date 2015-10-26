
<!DOCTYPE html>
<html>    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        <meta http-equiv="Content-Type" content="text/html; charset=iso-utf-8" />
        <title>Sinh viên</title>
        <!-- Bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <link rel="stylesheet" href="{{Asset('public/css/style.css')}}">
        <link rel="stylesheet" href="{{Asset('bootstrap/css/bootstrap.min.css')}}">        
        <link rel="stylesheet" href="{{Asset('public/scripts/jquery-ui-1.11.4/style.css')}}">
        <link rel="stylesheet" href="{{Asset('public/scripts/jquery-ui-1.11.4/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{Asset('public/scripts/datetimepicker/jquery.datetimepicker.css')}}"/> 
<!--        <script src="{{Asset('scripts/datetimepicker/jquery.datetimepicker.js')}}"></script>-->
        <script src="{{Asset('bootstrap/js/jquery-1.11.3.min.js')}}"></script>  
        <script src="{{Asset('public/scripts/jquery-ui-1.11.4/jquery-ui.min.js')}}"></script>   
        <script src="{{Asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{Asset('public/scripts/ckeditor/ckeditor.js')}}"></script>         
            
        <script type="text/javascript">
            $(function() {
              $( "#txtNgayBatDauKH" ).datepicker({
                  dateFormat: "yy-mm-dd",
              });
            });
            $(function() {
              $( "#txtNgayKetThucKH" ).datepicker({
                  dateFormat: "yy-mm-dd",
              });
            });
            
            $(function() {
              $( "#txtNgayBatDauThucTe" ).datepicker({
                  dateFormat: "yy-mm-dd",
              });
            });
            $(function() {
              $( "#txtNgayKTThucTe" ).datepicker({
                  dateFormat: "yy-mm-dd",
              });
            });
        </script>
                
        <script type="text/javascript">
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        
        <style type="text/css">

            .custom-date-style {
                background-color: red !important;
            }

        </style>
    </head>
       
    <body id="Haside">                        
        <div class="container body-content" id="Habody">  
            <div class="page-header" id="Haheader">
                <!-- Chỉ chèn hình nền của header -->
            </div> <!-- /page-header -->       
            <!-- Static navbar -->       
            <nav class="navbar navbar-default">
                <div class="container">                
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>               
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">    
                            <?php 
                                $mssv = Auth::user()->taikhoan;
                                $nhomtruong = DB::table('chia_nhom')->where('mssv',$mssv)->value('nhomtruong');
                            ?>
                            @if($nhomtruong == 1)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Quản lý công việc
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{asset('sinhvien/themthongtinnhom')}}" data-toggle="tooltip" data-placement="bottom" title="Thêm các thông tin lịch họp, mô tả thực hiện đề tài">
                                                Thêm thông tin nhóm
                                            </a>
                                        </li>
                                        <li class="divider"></li>                                
                                        <li><a href="{{asset('sinhvien/phancv')}}">Phân công việc</a></li>
                                        <li class="divider"></li>                             
                                        <li><a href="{{asset('sinhvien/danhsachnoptailieu')}}">Nộp tài liệu</a></li>                               
                                    </ul>
                                </li>  
                            @endif                                  
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Thông tin nhóm
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('sinhvien/danhsachcvchinh')}}">Danh sách các công việc</a></li>                                    
                                    <li class="divider"></li>    
                                    <li><a href="{{asset('sinhvien/xemdiem')}}">Xem điểm</a></li>                                                       
                                </ul>
                            </li>                           
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php
                                        $mssv = Auth::user()->taikhoan;
                                        $tenhinh = DB::table('sinh_vien')->where('mssv',$mssv)->value('hinhdaidien');
                                    ?>
                                        @if($tenhinh == "")
                                           <img src="{{asset('public/images/User-image.png')}}" width='20px' height='20px'>                                        
                                        @elseif($tenhinh != "")
                                            <img src="{{asset('public/hinhdaidien/'.$tenhinh)}}" width='20px' height='20px'>
                                        @endif
                                                                        
                                    <lable style="font-weight: bold; color: #00008b;">
                                        {!! Auth::user()->name !!}
                                    </lable>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role='menu'>  
                                    <li><a href="{{asset('sinhvien/thongtinsv')}}">Thông tin cá nhân</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('sinhvien/xemviecduocgiao')}}">Xem công việc</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('sinhvien/doimatkhausv')}}">Đổi mật khẩu</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">                            
                            <li> 
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-lg" style="padding: 0px 0px; margin-top: 5px;">
                                     <img src="{{Asset('public/images/search-icon(4).png')}}">
                                </button>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-lg">       
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel" style="color: darkblue; font-weight: bold;">Thanh tìm kiếm</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{action('TimkiemController@SVTimKiem')}}" method="post" class="form-inline" align="center">                         
                                                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                                                    <input type="text" id="txtTimKiem" name="txtTimKiem" value="" placeholder="Nhập họ và tên sinh viên cần tìm" class="form-control" style="width: 90%">
                                                    <button type="submit" class="btn btn-info" style="padding: 0px 0px;">
                                                        <img src="{{Asset('public/images/Search.png')}}">
                                                    </button>                                         
                                                </form>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            <li style="margin-right: 15px;">                                
                                <a href="{{asset('dangxuat')}}">
                                     Đăng xuất <img src="{{asset('public/images/Action-exit-icon.png')}}"/>
                                </a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>
            <div class="row">                
                @yield('content_sv')
            </div> <!-- /container -->

            <!--<hr>-->
            <footer class="footer" id="Hafooter">
                <p align="center">
                    Khoa Công Nghệ Thông Tin và Truyền Thông <br> 
                    Trường Đại Học Cần Thơ
                </p>
            </footer>
        </div>
    </body>
</html>
