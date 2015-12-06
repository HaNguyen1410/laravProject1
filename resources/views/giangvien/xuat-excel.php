<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">        
        <title></title>
        <!-- Bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{Asset('public/css/style.css')}}">
        <link rel="stylesheet" href="{{Asset('/bootstrap/css/bootstrap.min.css')}}">
        <script src="{{Asset('/bootstrap/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{Asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="panel-body">
            <form action="index.php" method="post" id="export-form">
                <input type="hidden" value='' id='hidden-type' name='ExportType'/>
            </form>

             <table id="" class="table table-striped table-bordered">
                <tr>
                    <th>STT</th>
                    <th>Mã nhóm thực hiện</th>
                    <th>Nhóm trưởng</th>
                    <th>Họ tên</th>
                    
                </tr>
                <tbody>
                  <?php foreach($data as $row):?>
                  <tr>
                  <td><?php echo $row ['Name']?></td>
                  <td><?php echo $row ['Status']?></td>
                  <td><?php echo $row ['Priority']?></td>
                  <td><?php echo $row ['Salary']?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
