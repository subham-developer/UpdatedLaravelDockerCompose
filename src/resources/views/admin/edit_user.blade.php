@extends('admin.admin_master')
@section('body')
<!-- Modal -->
{{-- <div class="modal fade" id="profile" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'users.update_image', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-push-4">
                        <input type="hidden" name="user_id" value="{{ $data['user']['id'] }}">
                        <div style="width: 150px">
                            {{ Form::file('profile',['id'=>'input-file-now','class'=>'dropify','data-height'=>'136', 'required']) }}
                        </div>
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
</div> --}}
{{-- modal close --}}
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Edit Donar</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Edit User</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                {{-- <div class="row el-element-overlay m-b-40" style="width: 200px;border-radius: 50%">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1" style="border-radius: 50%">
                            @php
                            $image = $data['user']['profile_image'] == null?'no-image.png':$data['user']['profile_image'];
                            @endphp
                            <img src="{{ asset('uploads').'/'.$image }}" width="200"/>
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li>
                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                            href="{{ asset('uploads') }}/{{ $image->name }}">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{}}">
                                            <button class="btn btn-link" data-toggle="modal" data-target="#profile">
                                            <a class="btn default btn-outline">
                                                <i class="icon-refresh"></i>
                                            </a>
                                            </button>
                                        </li>
                                        @if($data['user']['profile_image'] != null)
                                        <li>
                                            <form action="{{}}">
                                                {!! Form::open(['route'=>'users.destroy_image','method'=>'delete', 'id'=>'delete-profile']) !!}
                                                <input type="hidden" name="user_id" value="{{ $data['user']['id'] }}">
                                                <button type="button" onclick="confirmation()" class="btn btn-link model_img">
                                                <a class="btn default btn-outline">
                                                    <i class="icon-trash"></i>
                                                </a>
                                                </button>
                                                {{ Form::close() }}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title">Genelia Deshmukh</h3> <small>Managing Director</small>
                                <br/> </div>
                            </div>
                            
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                
                                @if ($errors->any())
                                <div class="alert alert-danger" style="text-transform: capitalize;">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(session('success'))
                                <div class="alert alert-success">
                                    Detail Updated Successfully
                                </div>
                                @endif
                                {!! Form::model($data['user'],['route' => ['users.update',$data['user']['id']] , 'method' => 'PUT']) !!}
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        {{ Form::text('first_name',null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        {{ Form::text('last_name',null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        {{ Form::text('mobile',null, ['class' => 'form-control', 'maxlength'=>10]) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Email Id</label>
                                        {{ Form::text('email',null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label>IMEI Number</label>
                                    {{ Form::text('IMEI',null, ['class' => 'form-control', 'maxlength'=>15]) }}
                                </div> --}}
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Update</button>
                                {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">Clear</button> --}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <h2>Image</h2>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        @endsection
        @section('bottom-script')
        <script type="text/javascript">
        function confirmation() {
        swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
        }, function(isConfirm){
        if (isConfirm) {
        $("#delete-profile").submit();
        // swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
        swal.close();
        // swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
        });
        }
        $(document).ready(function() {
        $('.dropify').dropify({
        messages: {
        default: 'Update profile',
        replace: '',
        remove: 'X',
        error: ''
        }
        });
        });
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        </script>
        @endsection