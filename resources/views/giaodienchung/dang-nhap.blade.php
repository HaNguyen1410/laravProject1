
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="{{asset('../bootstrap/css/bootstrap.min.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('css/login-bootstrap.css')}}">
        <script src="{{asset('js/login-bootstrap.js')}}"></script>
        <script src="{{asset('../bootstrap/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{asset('../bootstrap/js/bootstrap.min.js')}}"></script> 
</head>

<body>
	<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->        
        <div class="container">
            <div class="page-header">
                <h2 style="color: darkblue;">HỆ THỐNG QUẢN LÝ NHÓM LÀM NIÊN LUẬN</h2>
            </div> 
            <div class="card card-container"> 
                <img id="profile-img" class="profile-img-card" src="{{asset('images/User-image.png')}}" />
<!--                <p id="profile-name" class="profile-name-card"></p>-->
                <form class="form-signin" action="{{action('DangNhap\DangnhapController@GoiDangNhap')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <span id="reauth-username" class="reauth-username"></span>
                    <label for="inputUsername" >Tên đăng nhập:</label>
                    <input type="text" id="txtTenDangNhap" name="txtTenDangNhap" value="" class="form-control" placeholder="Tài khoản đăng nhập" required autofocus>
                    <p style='color:red;'>{{$errors->first('txtTenDangNhap')}}</p>
                    <label for="inputPassword" >Mật khẩu:</label>
                    <input type="password" id="txtMatKhau" name="txtMatKhau" value="" class="form-control" placeholder="Mật khẩu" required>
                    <p style='color:red;'>{{$errors->first('txtMatKhau')}}</p>
                    <div id="remember" class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Nhớ mật khẩu
                        </label>
                    </div>
                    <button type="submit" name="btnDangNhap" class="btn btn-lg btn-primary btn-block btn-signin">Đăng nhập</button>
                </form><!-- /form -->
<!--                <a href="#" class="forgot-password">
                    Quên mật khẩu?
                </a>-->
            </div><!-- /card-container -->
        </div><!-- /container -->   
</body>
</html>
