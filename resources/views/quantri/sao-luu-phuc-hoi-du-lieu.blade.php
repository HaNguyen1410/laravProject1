@extends('quantri_home')

@section('content_quantri')      
       
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div align="center">
                <h4 style="color: darkblue; font-weight: bold;">SAO LƯU PHỤC HỒI CSDL</h4>
                <?php
                    //ENTER THE RELEVANT INFO BELOW
                    $mysqlDatabaseName ='qlnienluan_ktpm';
                    $mysqlUserName ='root';
                    $mysqlPassword ='';
                    $mysqlHostName ='localhost';
                    $mysqlExportPath ='qlnienluan_ktpm.sql';

                    //DO NOT EDIT BELOW THIS LINE
                    //Export the database and output the status to the page
                    $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ~/' .$mysqlExportPath;
                    exec($command);
                 ?>
                <a href="">
                    <button type="button" name="" class="btn btn-link" style="width: 10%;">
                        <img src="{{asset('images/data-backup-icon.png')}}"> <br>
                        <label>Sao lưu CSDL</label>
                    </button>
                </a><br>
            </div>                      
        </div>
    </div>
</div>
    
@endsection