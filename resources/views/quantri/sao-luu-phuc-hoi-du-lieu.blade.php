@extends('quantri_home')

@section('content_quantri')      
       
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div align="center" style="width: 50%">
                <h4 style="color: darkblue; font-weight: bold;">SAO LƯU CSDL</h4>
                <form action="{{action('QuantriController@SaoLuuCSDL')}}" method="post">
                    <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                    <a href="">
                        <button type="submit" name="" class="btn btn-link" style="width: 20%; text-align: center">
                            <img src="{{asset('images/data-backup-icon.png')}}"> <br>
                        </button>
                    </a>                  
                </form>  <br>  
                <div style="background-color: #B0E0E6;">
                    @if($giatri == 0)
                        <lable style="color: #006400; font-weight: bold;">
                            <img src="{{asset('images/accept-icon.png')}}"/>
                            Sao lưu CSDL thành công!
                        </lable>
                    @endif
                </div>
            </div>                      
        </div>
    </div>
</div>
    
@endsection