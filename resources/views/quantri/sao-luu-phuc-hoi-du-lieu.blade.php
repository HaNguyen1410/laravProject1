@extends('quantri_home')

@section('content_quantri')      
       
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div align="center">
                <h4 style="color: darkblue; font-weight: bold;">SAO LƯU PHỤC HỒI CSDL</h4>
               
                <a href="saoluucsdl">
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