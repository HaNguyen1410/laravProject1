<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Đổi mật khẩu sinh viên</title>
        <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/signin.css">
        <script type="text/javascript" src="../scripts/ckeditor/ckeditor.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>
        
        <script type="text/javascript">
            function ktMatKhau(){
                if(document.getElementById("txtMatKhauMoi1").value !== document.getElementById("txtMatKhauMoi2").value)
                {
                    alert("Mật khẩu không giống nhau!");
                    return false;
                }
                else return true;
            }
        </script>
        
    </head>
    
    <style type="text/css">
        th{
            text-align: right;
            color: darkblue;
            font-weight: bold;
        }
    </style>

<?php
    include_once 'chucnang/sv_thongtin.php';
    //$masv = '1111317';
    $masv = $svUSER['mssv'];
    $sv = sv_xem($masv);
    if($sv == null){
        return;
    }
    $mkcu = $sv['matkhau'];
    
    if(isset($_POST['btnCapNhat'])){
        $masv = $_POST['txtMaSV'];
        $ten = $_POST['txtTen'];
        $email = $_POST['txtEmail'];        
        $matkhauMoi = isset($_POST['txtMatKhauMoi1']) ? $_POST['txtMatKhauMoi1'] : $mkcu ;        
        $filename = $sv['hinhdaidien'];
        $tachten = lay_ten($ten);
        
        global  $thumucHinhDaiDien;
            if(!file_exists($thumucHinhDaiDien))
                mkdir($thumucHinhDaiDien);
            
            if($_FILES['fHinh']['type'] == "image/jpg" || $_FILES['fHinh']['type'] == "image/jpeg" || $_FILES['fHinh']['type'] == "image/png")
            {
                if($_FILES['fHinh']['size'] <= 1024*1024){
                    $FileUpload = $_FILES['fHinh']['name'];
                    $pathinfo = pathinfo($FileUpload);
                    $extention = $pathinfo['extension'];
                    //Xử lý tên tập tin đổi thành mã số giảng viên 
                    //str_replace('tim tu', 'thay the bang', 'chuoi thay the')
                    $filename = $tachten . str_replace("/", "", str_replace(" ", "", $masv)) . "." . $extention ;
                   
                    //chép hình lên server
                    $copy = copy($_FILES['fHinh']['tmp_name'], $thumucHinhDaiDien.'/'. $filename);
                }
                else
                {
                    echo "<script>alert('Anh qua lon (nho hon 1 MB)');</script>";
                }                  
            }  
        sv_doimatkhau($masv, $filename, $matkhauMoi);

        echo "<script>window.location.href='?cn=ttsv'</script>";
    }
?>  
    
    <body>
        <div class="container">
            <div class="row">
                <form action="" enctype="multipart/form-data" method="post" class="form-horizontal">
                    <div class="col-md-4">  <!-- Upload hình đại diện -->                      
                        <div align="center">
                            <br><br><br/>
                             <?php
                                 if($sv['hinhdaidien'] != ""){
                                     echo "<img width='200px' src='hinhdaidien/".$sv['hinhdaidien']."'>";
                                 }
                                 else{
                                    echo "<img src='images/User-image.png'>";                                    
                                 }
                            ?>
                        </div><br>
                        <div align="center"><input type="file" name="fHinh" id="fHinh" /></div>
                    </div>
                    <div class="col-md-8">
                        <h3 style="color: darkblue; font-weight: bold; margin-left: 50px;">ĐỔI MẬT KHẨU</h3>
                        <table class="table table-bordered" cellpadding="0px" cellspacing="0px" align="center" style="width:800px;">
                            <tr>
                                <th width="20%">MSSV:</th>
                                <td width="50%">
                                    <input type="text" name="txtMaSV" value="<?php echo $sv['mssv']; ?>" class="form-control" readonly="" /> 
                                </td>
                            </tr>
                            <tr>
                                <th>Họ và tên:</th>
                                <td>
                                    <input type="text" name="txtTen" value="<?php echo $sv['hoten']; ?>" class="form-control" readonly="" /> 
                                </td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    <input type="text" name="txtEmail" value="<?php echo $sv['email']; ?>" class="form-control" readonly="" /> 
                                </td>
                            </tr>
                            <tr></tr>   
                            <tr>
                                <th>Mật khẩu hiện tại:</th>
                                <td>
                                    <input type="password" name="txtMatKhauCu" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <th>Mật khẩu mới:</th>
                                <td>
                                    <input type="text" id="txtMatKhauMoi1" name="txtMatKhauMoi1" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <th>Nhập lại mật khẩu mới:</th>
                                <td>
                                    <input type="text" id="txtMatKhauMoi2" name="txtMatKhauMoi2" value="" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <button onclick="return ktMatKhau();" type="submit" name="btnCapNhat" class="btn btn-primary" style="width: 20%;">
                                        <img src="images/save-as-icon.png"> Cập Nhật
                                    </button>
                                    <a href="?cn=ttsv" class="btn btn-warning" style="width:20%;">
                                        <img src="images/delete-icon.png"> Hủy bỏ
                                    </a>                                    
                                </td>
                            </tr>
                        </table>                    
                    </div>
               </form>
            </div><!-- /row -->
            
        </div> <!-- /container -->
            
    </body>
</html>
