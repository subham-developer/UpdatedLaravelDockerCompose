@extends('admin.admin_master')
@section('css')
@endsection
@section('body')
<!-- Modal update-->
<div id="updateProfile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Update Profile Image</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'ngo.update_image', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        
                        {{ Form::file('logo',['id'=>'input-file-now','class'=>'dropify','data-height'=>'100','required']) }}
                        <br>
                        <center><button class="btn btn-primary">Update</button></center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- // update modal --}}
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Your Profile</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Your Profile</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="white-box">
                @php
                $image = $data['user']['profile_image'] == null?'no-image.png':$data['user']['profile_image'];
                @endphp
                <img src="{{asset('uploads').'/'.$image}}" class="img-responsive" alt="Profile Image">
                <br>
                <center>
                <button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#updateProfile">Update</button>
                <button class="btn btn-danger btn-rounded">Remove</button>
                </center>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                Details Updated Successfully!
            </div>
            @endif
            <div class="white-box">
                {!! Form::open(['route' => ['profile_update',$data['user']['id']] , 'method' => 'PUT']) !!}
                
                <div class="form-group">
                    <label>First Name:</label>
                    {{ Form::text('first_name',$data["user"]["first_name"], ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    {{ Form::text('last_name',$data["user"]["last_name"], ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    {{ Form::text('email',$data["user"]["email"], ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Mobile:</label>
                    {{ Form::text('mobile',$data["user"]["mobile"], ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                </div>
                {{Form::close()}}
                
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('bottom-script')
<script type="text/javascript">
$(document).ready(function(){
                $('.dropify').dropify({
                messages: {
                default: 'Update logo',
                replace: '',
                remove: 'X',
                error: ''
            }
            });
        });
</script>
@endsection