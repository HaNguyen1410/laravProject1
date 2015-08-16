<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cập nhật công việc</title>
         <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/signin.css">
        <script src="../bootstrap/js/jquery-1.11.3.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../scripts/ckeditor/ckeditor.js"></script>         
    </head>

    <style type="text/css">
            th{
                text-align: right;
                color: darkblue;
                background-color: #dff0d8;
            }
    </style>

    <?php
        include_once 'chucnang/sv_chitietphancong.php';
        include_once 'chucnang/sv_phancv.php';
        
        $manth = $_GET['id_manth'];
        $macv = $_GET['id_macv'];
//Lấy mã công việc mà công việc đang câp nhật phụ thuộc
        $ma = maCVchinh($manth, $macv); 
        if($ma == NULL){
            return;
        }     
        $macvphuthuoc = $ma['phuthuoc_cv'];
        
        if(isset($_POST['btnCapNhat'])){
            $macv = $_POST['txtMaCV'];
              $tencv = $_POST['txtTenCV'];
              $bdkh = $_POST['txtNgayBatDauKH'];
              $ktkh = $_POST['txtNgayKetThucKH'];
              $bdtt = $_POST['txtNgayBatDauThucTe'];
              $kttt =  $_POST['txtNgayKTThucTe'];
              $giaocho = $_POST['cbGiaoCho'];
              $ndcv = $_POST['txtNoiDungViec'];
              $trangthai = $_POST['cbTrangThai'];
              $tiendo = $_POST['txtTienDo'];
              $gio_thucte = $_POST['txtGioThucTe'];
              $uutien = $_POST['cbUuTien'];
              
              //($macv,$tencv,$giaocho,$bdkehoach,$ketthuctkehoach,$bdthucte,$ketthucte,$sogio_thucte,
            //$taisdcv,$uutien,$trangthai,$tiendo,$ndthuchien,$ghichu)
              cv_sua($macv,$tencv,$giaocho,$bdkh,$ktkh,$bdtt,$kttt,$gio_thucte,$macvphuthuoc,$uutien,$trangthai,$tiendo,$ndcv,'null');
              
              echo "<script>window.location.href='?cn=dschitietphancong&id_manth=$manth&id_macv=$macvphuthuoc'</script>";
        }
        
        $dscv = thongtin_cvNhom($manth, $macv); 
        if($dscv == NULL){
            return;
        }           
    ?>
    
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: darkblue; font-weight: bold;">
                        Cập nhật công việc phụ thuộc việc: <label><?php echo $ma['phuthuoc_cv']; ?></label> 
                    </h3>
                    
                    <form action="" method="post" >
                        <table class="table table-bordered" width="800px" cellpadding="15px" cellspacing="0px" id="bang1">
                            <tr>
                                <th width="10%">Mã công việc:</th>
                                <td>
                                    <input type="text" name="txtMaCV" value="<?php echo $dscv['macv'];  ?>" class="form-control" readonly=""/>
                                    <input type="hidden" name="txtMaCvChinh" value="<?php echo $ma['phuthuoc_cv'];  ?>" class="form-control"/>
                                </td>
                                <th width="10%">Tên công việc:</th>
                                <td colspan="3">
                                    <input type="text" name="txtTenCV" value="<?php echo $dscv['congviec']; ?>" class="form-control" readonly=""/>
                                </td>
                            </tr>
                            <tr>
                                <th width="10%">Ngày bắt đầu (kế hoạch):</th>
                                <td width="30%">
                                   <input type="text" id="txtNgayBatDauKH" name="txtNgayBatDauKH" value="<?php echo $dscv['ngaybatdau_kehoach']; ?>" class="form-control"/>
                                </td>
                                <th width="18%">Ngày kết thúc (kế hoạch):</th>
                                <td width="30%">
                                    <input type="text" id="txtNgayKetThucKH" name="txtNgayKetThucKH" value="<?php echo $dscv['ngayketthuc_kehoach']; ?>" class="form-control"/>
                                </td>
                            </tr>
                            <tr>
                                <th width="10%">Ngày bắt đầu (thực tế):</th>
                                <td width="30%">
                                   <input type="text" id="txtNgayBatDauThucTe" name="txtNgayBatDauThucTe" value="<?php echo $dscv['ngaybatdau_thucte']; ?>" class="form-control"/>
                                </td>
                                <th width="18%">Ngày kết thúc (thực tế):</th>
                                <td width="30%">
                                    <input type="text" id="txtNgayKTThucTe" name="txtNgayKTThucTe" value="<?php echo $dscv['ngayketthuc_thucte']; ?>" class="form-control"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Giao cho:</th>
                                <td colspan="3">
                                    <?php xem_thanhvien($manth) ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="20%">Nội dung công việc:</th>
                                <td colspan="3">
                                    <textarea name="txtNoiDungViec" rows="2" cols="2" class="ckeditor"><?php echo $dscv['noidungthuchien']; ?></textarea>
                                    <script language="javascript">
                                        CKEDITOR.replace( 'txtNoiDungViec',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [['Font'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'], 
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                            ['Style', 'FontFormat', 'FontName', 'FontSize']]
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th>Số giờ thực tế</th>
                                <td><input type="text" id="txtGioThucTe" name="txtGioThucTe" value="<?php echo $dscv['sogio_thucte']; ?>" class="form-control"/></td>
                                <th>Tiến độ (%):</th>
                                <td><input type="text" name="txtTienDo" value="<?php echo $dscv['tiendo']; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <select class="form-control" size="1" name="cbTrangThai">
                                        <option value="1">Đang làm</option>
                                        <option value="2">Sắp làm</option>
                                        <option value="3">Hoàn thành</option>
                                    </select>
                                </td>  
                                <th width="13%">Độ ưu tiên:</th>
                                <td>
                                    <select class="form-control" size="1" name="cbUuTien">
                                        <option value="Cao">Cao</option>
                                        <option value="Trung bình">Trung bình</option>
                                        <option value="Thấp">Thấp</option>
                                    </select>
                                </td>
                            </tr>                     
                            <tr>
                                <td></td>
                                <td colspan="3" align="center">
                                    <button type="submit" name="btnCapNhat" class="btn btn-primary" style="width:20%;">
                                        <img src="images/save-as-icon.png"> Cập nhật
                                    </button>&nbsp;&nbsp;
                                    <a href="?cn=dschitietphancong&id_manth=<?php echo $manth;?>&id_macv=<?php echo $macvphuthuoc;?>" class="btn btn-warning" style="width:20%;">
                                        <img src="images/delete-icon.png"> Hủy bỏ
                                    </a>                              
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div> <!-- /row -->
        </div> <!-- /container -->
        
    </body>
</html>
