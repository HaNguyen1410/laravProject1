<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Quản trị</title>
        <!-- Bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{Asset('/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{Asset('public/scripts/jquery-ui-1.11.4/style.css')}}">
        <link rel="stylesheet" href="{{Asset('public/scripts/jquery-ui-1.11.4/jquery-ui.min.css')}}">
        <script src="{{Asset('/bootstrap/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{Asset('public/scripts/jquery-ui-1.11.4/jquery-ui.min.js')}}"></script>
        <script src="{{Asset('/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{Asset('public/scripts/ckeditor/ckeditor.js')}}"></script>  
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        
        <script>
            $(function() {
              $( "#txtNgaySinh" ).datepicker({
                  dateFormat: "yy-mm-dd"
              });
            });
        </script>
                    
    </head>
    
    <body>
        <div class="container body-content">
            <div class="page-header">
                <h2 style="color: darkblue;">HỆ THỐNG QUẢN TRỊ WEBSITE</h2>               
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
                                <a href="?cn=ttgv" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Quản trị
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('quantri/giangvien')}}">Giảng viên</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('quantri/sinhvien')}}">Sinh viên</a></li>
                                </ul>
                            </li> 
                            <li class="dropdown">
                                <a href="?cn=ttgv" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Quản lý CSDL
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{asset('quantri/saoluu')}}">Sao lưu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{asset('quantri/phuchoi')}}">Phục hồi</a></li>
                                </ul>
                            </li> 
                            <li class="dropdown">
                                <a href="?cn=ttgv" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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
                                    <li><a href="{{asset('quantri/thongtinqt')}}">Thông tin cá nhân</a></li>
                                    <li class="divider"></li>                           
                                    <li><a href="{{asset('quantri/doimatkhauqt')}}">Đổi mật khẩu</a></li>                                    
                                </ul>
                            </li>
                        </ul>
                       
                        <ul class="nav navbar-nav navbar-right">
 <!--                            
                            <li> 
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-lg" style="padding: 0px 0px; margin-top: 5px; margin-right: 40px;">
                                     <img src="{{asset('public/images/search-icon(4).png')}}">
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
                                                         <img src="{{asset('public/images/Search.png')}}">
                                                     </button>                                         
                                                </form>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
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
                    @yield('content_quantri')
            </div> <!-- /container -->
            <hr>
            <footer class="footer">
                <p>&copy; Company 2015</p>
            </footer>
        </div>   
    </body>
</html>
