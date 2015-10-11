
<!DOCTYPE html>
<html>         
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Giảng viên</title>
        <!-- Bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{Asset('bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{Asset('public/scripts/jquery-ui-1.11.4/style.css')}}">
        <link rel="stylesheet" href="{{Asset('public/scripts/jquery-ui-1.11.4/jquery-ui.min.css')}}"> 
        <link rel="stylesheet" href="{{Asset('public/scripts/datetimepicker/jquery.datetimepicker.css')}}"/>     
        <script src="{{Asset('bootstrap/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{Asset('public/scripts/jquery-ui-1.11.4/jquery-ui.min.js')}}"></script>
        <script src="{{Asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{Asset('public/scripts/datetimepicker/jquery.datetimepicker.js')}}"></script>
        <script src="{{Asset('public/scripts/ckeditor/ckeditor.js')}}"></script>
                
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
                                    <li><a href="{{asset('giangvien/theodoikehoach')}}" data-toggle="tooltip" data-placement="bottom" title="Theo dõi thực hiện dự án">
                                            Theo dõi kế hoạch</a>
                                    </li>
                                    <li class="divider"></li> 
                                    <li><a href="{{asset('giangvien/khotailieu')}}">Kho tài liệu</a></li>
                                    <li class="divider"></li>                           
                                    <li><a href="{{asset('giangvien/quanlythongbao')}}" data-toggle="tooltip" data-placement="bottom" title="Thông báo thời hạn nộp tài liệu, ngày báo cáo tiến độ với giảng viên hướng dẫn">
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
                                    <li>
                                        <a href="{{asset('giangvien/danhsachdetai')}}" >
                                            Đề tài
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <!--   -->
                                        <a href="{{asset('giangvien/chianhom')}}" data-toggle="tooltip" data-placement="bottom" title="Chia đề tài vào mỗi nhóm sinh viên">
                                            Chia nhóm thực hiện
                                        </a>
                                    </li>
                                </ul>
                            </li>                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Chấm điểm
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('giangvien/dstieuchi')}}">Tiêu chí</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('giangvien/nhapdiem')}}">Nhập điểm</a></li>

                                </ul>
                            </li>                                 
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php
                                        $macb = Auth::user()->taikhoan;
                                        $tenhinh = DB::table('giang_vien')->where('macb',$macb)->value('hinhdaidien');
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
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{url('giangvien/thongtingv')}}">Thông tin cá nhân</a></li>
                                    <li class="divider"></li>                           
                                    <li><a href="{{asset('giangvien/doimatkhaugv')}}">Đổi mật khẩu</a></li>
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
                                                <form action="{{action('TimkiemController@GVTimKiem')}}" method="post" class="form-inline" align="center">                         
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
                                    (Đăng xuất)
                                </a>
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
