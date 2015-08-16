
<!DOCTYPE html>
<html>    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sinh viên</title>
        <!-- Bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{Asset('../bootstrap/css/bootstrap.min.css')}}">        
        <link rel="stylesheet" href="{{Asset('scripts/jquery-ui-1.11.4/style.css')}}">
        <link rel="stylesheet" href="{{Asset('scripts/jquery-ui-1.11.4/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{Asset('scripts/datetimepicker/jquery.datetimepicker.css')}}"/> 
        <script src="{{Asset('../bootstrap/js/jquery-1.11.3.min.js')}}"></script>  
        <script src="{{Asset('scripts/jquery-ui-1.11.4/jquery-ui.min.js')}}"></script>   
        <script src="{{Asset('../bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{Asset('scripts/datetimepicker/jquery.datetimepicker.js')}}"></script>
        <script src="{{Asset('scripts/ckeditor/ckeditor.js')}}"></script>
         
        <script type="text/javascript">
            $('#txtNgayBatDauThucTe').datetimepicker({
                format: "y-m-d H:i:s",
                step: 10
            });
            
            $('#txtNgayKTThucTe').datetimepicker({
                format: "y-m-d H:i:s",
                step: 10
            });

        </script>       
        <script type="text/javascript">
            $(function() {
              $( "#txtNgayBatDauKH" ).datepicker({
                  dateFormat: "yy-mm-dd"
              });
            });
            $(function() {
              $( "#txtNgayKetThucKH" ).datepicker({
                  dateFormat: "yy-mm-dd"
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
       
    <body>                        
        <div class="container body-content">  
            <div class="page-header">
                <h2 style="color: darkblue;">HỆ THỐNG QUẢN LÝ NHÓM LÀM NIÊN LUẬN</h2>
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
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Đăng ký niên luận
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('sinhvien/dangkydt/1111317')}}">Đăng ký</a></li>
                                    <li class="divider"></li>                                
                                    <li><a href="">Kết quả đăng ký</a></li>                              
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Quản lý công việc
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('sinhvien/danhsachcv/1111317')}}">Danh sách các nhiệm vụ</a></li>
                                    <li class="divider"></li>                                
                                    <li><a href="{{asset('sinhvien/phancv/1111317')}}">Phân công việc</a></li>
                                    <li class="divider"></li>                             
                                    <li><a href="{{asset('sinhvien/noptailieu')}}">Nộp tài liệu</a></li>                               
                                </ul>
                            </li>                        
                            <li><a href="{{asset('sinhvien/xemdiem/1111317')}}">Xem điểm</a></li>
                            <li><a href="">Thảo luận</a></li>                          
                            <li class="dropdown active">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Họ và tên sinh viên (mssv)
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role='menu'>
                                    <li><a href="{{asset('sinhvien/thongtinsv/1111317')}}">Thông tin sinh viên</a></li>
                                    <li class="divider"></li>                                    
                                    <li><a href="{{asset('sinhvien/xemviecduocgiao/1111317/Phạm Thúy Ngọc/NTH02')}}">Xem công việc</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('sinhvien/doimatkhausv/1111317')}}">Đổi mật khẩu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('/dangnhap')}}">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li> 
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-lg" style="padding: 0px 0px; margin-top: 5px; margin-right: 40px;">
                                     <img src="{{Asset('images/search-icon(4).png')}}">
                                </button>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-lg">       
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel" style="color: darkblue; font-weight: bold;">Thanh tìm kiếm</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" id="" method="post" class="form-inline" align="center">                         
                                                     <input type="text" name="" id="" value="" class="form-control" style="width: 90%">
                                                     <button type="button" class="btn btn-info" style="padding: 0px 0px;">
                                                         <img src="{{Asset('images/Search.png')}}">
                                                     </button>                                         
                                                </form>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>                        
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>
            <div class="row">                
                @yield('content_sv')
            </div> <!-- /container -->

            <hr>
            <footer class="footer">
                <p style="margin-left: 20px;">&copy; Company 2015</p>
            </footer>
        </div>
    </body>
</html>
