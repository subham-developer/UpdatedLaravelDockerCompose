<div class="row">
    <div class="col-sm-2 col-xs-2">
       {{--  <div class="form-group">
            @php
            $image = $data['user']['profile_image'] == null?'no-image.png':$data['user']['profile_image'];
            @endphp
            <center>
            <img src="{{asset('uploads').'/'.$image }}" alt="user" class="img-responsive img-circle" style="width: 70%">
            </center>
        </div> --}}
    </div>
    <div class="col-sm-8 col-xs-12">
        <div class="form-group">
            <table class="table table-condensed">
                
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{$data['user']['name']}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><a href="mailto:{{$data['user']['email']}}">{{$data['user']['email']}}</a></td>
                    </tr>
                    {{-- <tr>
                        <th>Mobile OS</th>
                        <td>Android</td>
                    </tr> --}}
                    {{-- <tr>
                        <th>IMEI</th>
                        <td>{{$data['user']['IMEI']}}</td>
                    </tr> --}}
                    <tr>
                        <th>Mobile</th>
                        <td>{{$data['user']['mobile']}}</td>
                    </tr>
                    
                    <tr>
                        <th>Total Amount Donated</th>
                        <td>{{$data['amountDonated']}}</td>
                    </tr>
                    <tr>
                        <th>Balance</th>
                        <td>{{$data['user']['balance']}}</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>