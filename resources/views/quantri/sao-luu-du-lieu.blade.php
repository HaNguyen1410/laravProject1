@extends('quantri_home')

@section('content_quantri')      
       
<div class="container">
    <div class="row">        
        <div class="col-md-12" align="center">            
                <h4 style="color: darkblue; font-weight: bold;">SAO LƯU CSDL</h4>
                <form action="{{action('QuantriController@SaoLuuCSDL')}}" method="post">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <label>Lưu với tên: </label>
                    <input type="text" name="txtTenCSDL" value="" placeholder="Có thể đặt tên (Nếu cần)" style="width: 30%" class="form-control"/>
                    <button type="submit" name="" class="btn btn-link" style="width: 20%; text-align: center">
                        <img src="{{asset('public/images/data-backup-icon.png')}}"> <br>
                    </button>
                                      
                </form>  <br>     
                 
                <div style="background-color: #B0E0E6;">   
                    @if($saoluu == 0)  
                        <lable style="color: #006400; font-weight: bold;">
                            <img src="{{asset('public/images/accept-icon.png')}}"/>
                            Sao lưu CSDL thành công!
                        </lable>
                        <a href="../storage/dumps/{{$tenfile}}">
                            <lable style="color: #860000; font-weight: bold;">Tải về</lable>
                        </a>
                    @endif
                </div>                                 
        </div>
    </div>
</div>
    
@endsection