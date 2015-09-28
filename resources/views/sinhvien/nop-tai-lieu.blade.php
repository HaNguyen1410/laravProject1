@extends('sinhvien_home')

@section('content_sv')

    <style type="text/css">
        th{
            text-align: center;
            color: darkblue;
            background-color: #dff0d8;
        }
    </style>

<div class="container">  
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: darkblue; font-weight: bold; margin-left: 20px;">
               Nộp tài liệu
            </h3>
            <form action="{{action('QltailieuController@LuuNopTaiLieu')}}" method="post" enctype="multipart/form-data">
                 <input type='hidden' name='_token' value='<?= csrf_token();?>'/>
                 <table class="table table-bordered" id="bang1">
                    <tr>
                        <th width='20%'>Mã tài liệu:</th>
                        <td width='15%'>
                            <input type="text" name="txtMaTL" value="{{$matl}}" style="text-align: center;" class="form-control" readonly=""/>
                        </td>
                        <th width='15%'>Tên công việc:</th>
                        <td>
                             <select class="form-control" name="cbGiaiDoan">
                                    <option value="">-- Chọn tên công việc --</option>  
                                @foreach($dscvchinh as $cv)
                                    <option value="{{$cv->macv}}">{{$cv->congviec}}</option>  
                                @endforeach
                            </select>
                            <p style='color:red;'>{{$errors->first('cbGiaiDoan')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Tài liệu:</th>
                        <td colspan="4">
                             <input type="file" id="fTaiLieu" name="fTaiLieu" style="width:60%;"/> 
                             <p style='color:red;'>{{$errors->first('fTaiLieu')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Mô tả tài liệu:</th>
                        <td colspan="4">
                            <textarea name="txtMoTa" class="form-control" rows="3"></textarea><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='5' align='center'>
                             <button type="submit" class="btn btn-warning">
                                    <img src="{{asset('public/images/save-upload-icon.png')}}"/>
                                    Gửi tập tin
                             </button>
                        </td>
                    </tr>
                </table>
            </form>          
        </div>
    </div> <!-- /row -->        
</div> <!-- /container -->   
@endsection