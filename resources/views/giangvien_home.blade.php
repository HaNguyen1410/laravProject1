
<!DOCTYPE html>
<html>         
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Giảng viên</title>
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
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        
        <script type="text/javascript">
            $(function() {
              $( "#txtNgaySinh" ).datepicker();
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
    </head>
    
    <body>
        <div class="container body-content">
            <div class="page-header">
                <h2 style="color: darkblue;">
                    HỆ THỐNG QUẢN LÝ NHÓM LÀM NIÊN LUẬN</h2>
            </div> 
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
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Quản lý nhóm niên luận
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('giangvien/theodoikehoach/2134')}}" data-toggle="tooltip" data-placement="bottom" title="Theo dõi thực hiện dự án">
                                            Theo dõi kế hoạch</a>
                                    </li>
                                    <li class="divider"></li>                           
                                    <li><a href="{{asset('giangvien/quanlythongbao/2134')}}" data-toggle="tooltip" data-placement="bottom" title="Thông báo thời hạn nộp tài liệu, ngày báo cáo tiến độ với giảng viên hướng dẫn">
                                            Quản lý thông báo</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Quản lý đề tài
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('giangvien/danhsachdetai/2134')}}" >
                                            Đề tài</a>
                                    </li>
                                    <li class="divider"></li>                           
                                    <li>
                                        <!--   -->
                                        <a href="{{asset('giangvien/chianhom/2134')}}" data-toggle="tooltip" data-placement="bottom" title="Chia đề tài vào mỗi nhóm sinh viên">
                                            Chia nhóm thực hiện
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{asset('giangvien/khotailieu/2134')}}">Kho tài liệu</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Chấm điểm
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('giangvien/dstieuchi/2134')}}">Tiêu chí</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('giangvien/nhapdiem/2134')}}">Nhập điểm</a></li>

                                </ul>
                            </li>                                 
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Họ tên (macb)
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('giangvien/thongtingv/2134')}}">Thông tin giảng viên</a></li>
                                    <li class="divider"></li>                           
                                    <li><a href="{{asset('giangvien/doimatkhaugv/2134')}}">Đổi mật khẩu</a></li>
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
                </div><!--/container -->
            </nav>

            <div class="row">                                
                @yield('content_gv')
            </div> <!-- /row -->
            <hr>
            <footer class="footer">
                <p>&copy; Company 2015</p>
            </footer>                     
        </div>                   
    </body>
</html>
