@extends('quantri_home')

@section('content_quantri')      
       
<div class="container">
    <div class="row"> 
        <div class="col-md-12" align="center">            
                <h4 style="color: darkblue; font-weight: bold;">PHỤC HỒI CSDL</h4>
                <form action="{{action('QuantriController@PhucHoiCSDL')}}" method="post" enctype="multipart/form-data">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <label>Tên CSDL cần phục hồi: </label>
                    <input type="file" name="fTenCSDL" value="" style="width: 30%" class="form-control"/>
                    <p style='color:red;'>{{$errors->first('fTenCSDL')}}</p>                    
                <p style="color:red;"><?php echo Session::get('ThongBao'); ?></p>
                    <button type="submit" name="" class="btn btn-link" style="width: 20%; text-align: center">
                        <img src="{{asset('public/images/data-add-icon.png')}}"> <br>
                    </button>
                                     
                </form>  <br>  
                <div style="background-color: #B0E0E6;">                    
                    @if($phuchoi == 0)
<!--                    <p>{{$command}}</p>-->
                    <p>{{$kq}}</p>
                        <lable style="color: #006400; font-weight: bold;">
                            <img src="{{asset('public/images/accept-icon.png')}}"/>
                            Phục hồi CSDL thành công!
                        </lable>
<!--                        <a href="../storage/dumps/">
                            <lable style="color: #860000; font-weight: bold;">Tải về</lable>
                        </a>-->
                    @endif
                </div> <br>                              
        </div>
    </div>
</div>
    
@endsection