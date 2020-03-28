@extends('admin.admin_master')
@section('css')
<style type="text/css">
.el-element-overlay .el-card-item .el-overlay-1{
border-radius: 50%;
}
</style>
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
                {{ Form::open(['route'=>'users.update_image', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        
                        {{ Form::file('profile',['id'=>'input-file-now','class'=>'dropify','data-height'=>'100','required']) }}
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

<!-- Modal change password-->
<div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Change Password</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['id'=>'changePasswordForm','v-on:submit.prevent']) }}
                <div class="row" id="formBody">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group">
                          <label>Current Password:</label>
                          {{ Form::password('current_password',['class'=>'form-control']) }}
                          {{-- <span v-if="errors" class="text-danger">@{{ errors.current_password[0]?errors.current_password[0]:null}}</span> --}}
                        </div>

                        <div class="form-group">
                          <label>New Password:</label>
                          {{ Form::password('new_password',['class'=>'form-control']) }}
                          {{-- <span v-if="errors.new_password" class="text-danger">@{{ errors.new_password[0] }}</span> --}}
                        </div>

                        <div class="form-group">
                          <label>Confirmed Password:</label>
                          {{ Form::password('new_password_confirmation',['class'=>'form-control']) }}
                          {{-- <span v-if="errors" class="text-danger">@{{ errors.new_password_confirmation[0] }}</span> --}}

                        </div>
                        
                        <div class="alert alert-danger" v-if='errors'>
                            <ul>
                                <li v-for='error in errors'>@{{ error[0] }}</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary pull-right">Update</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            
        </div>
    </div>
</div>
{{-- // change password modal --}}
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Your Profile</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Your Profile</li>
            </ol> --}}
        </div>
    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row white-box">
        <div class="col-md-3 col-xs-12">
            <div class="white-box p-b-0">
                <div class="row el-element-overlay">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            @php
                            $image = $data['user']['profile_image'] == null?'no-image.png':$data['user']['profile_image'];
                            @endphp
                            <img src="{{ asset('uploads').'/'.$image }}"  />
                            <div class="el-overlay">
                                <ul class="el-info">
                                    {{-- <li>
                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                            href="{{ asset('uploads') }}/{{ $image->name }}">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </li> --}}
                                    <li>
                                        {{-- <form action="{{}}"> --}}
                                            <button class="btn btn-link" data-toggle="modal" data-target="#updateProfile">
                                            <a class="btn default btn-outline">
                                                <i class="icon-refresh"></i>
                                            </a>
                                            </button>
                                        </li>
                                        @if($data['user']['profile_image'] != null)
                                        <li>
                                            {{-- <form action="{{}}"> --}}
                                                {!! Form::open(['route'=>'users.destroy_image','method'=>'delete']) !!}
                                                <button class="btn btn-link">
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
                                {{-- <div class="el-card-content">
                                    <h3 class="box-title">Genelia Deshmukh</h3> <small>Managing Director</small>
                                <br/> </div> --}}
                            </div>
                            
                        </div>
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
                        {!! Form::model($data['user'],['route' => ['profile_update',$data['user']['id']], 'method'=>'put']) !!}
                        
                        
                        <div class="form-group">
                            
                            <label>Name:</label>
                            {{ Form::text('name',null, ['class' => 'form-control']) }}
                        </div>
                        @if($data['user']['role_id'] == 2)
                        <div class="form-group">
                            <label>Address:</label>
                            {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 3]) !!}
                        </div>
                        @endif
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>Mobile:</label>
                                {{ Form::text('mobile',null, ['class' => 'form-control','maxlength'=>10]) }}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>Email address:</label>
                                {{ Form::email('email',null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        
                        @if($data['user']['role_id'] == 2)
                        {{-- <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>Registration Date:</label>
                                {{ Form::text('registration_date',null, ['class' => 'form-control', 'id'=>'registration-date',
                                'autocomplete'=>'off']) }}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>Registration Number:</label>
                                
                                {{ Form::text('registration_number',null, ['class' => 'form-control']) }}
                            </div>
                        </div>  --}}
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>Landline:</label>
                                {{ Form::text('landline',null, ['class' => 'form-control','maxlength'=>11]) }}
                            </div>
                        </div>
                        @endif
                        {{-- <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>Password:</label>
                                {{ Form::text('password','', ['class' => 'form-control']) }}
                            </div>
                        </div> --}}
                        @if($data['user']['role_id'] == 2)
                        <div class="col-md-12">
                            <fieldset class="todos_labels">
                                <div class="repeatable">
                                    @foreach($data['contacts'] as $contact)
                                    
                                    <div class="field-group row">
                                        <div class="col-lg-3" style="padding-left: 1px !important;">
                                            <label for="task_{{ $loop->index }}">Name:</label>
                                            <input required type="text" class="span6 form-control" name="contacts[{{ $loop->index }}][name]"
                                            value="{{ $contact->name }}" id="task_{{ $loop->index }}">
                                        </div>
                                        <div class="col-lg-3" style="padding-left: 1px !important;">
                                            <label for="duedate_{?}">Designation:</label>
                                            <input required type="text" class="span2 form-control"
                                            name="contacts[{{ $loop->index }}][designation]" value="{{ $contact->designation }}" id="duedate_{?}">
                                        </div>
                                        <div class="col-lg-3" style="padding-left: 1px !important;">
                                            <label for="duedate_{?}">Email:</label>
                                            <input required type="text" class="span2 form-control" name="contacts[{{ $loop->index }}][email]"
                                            value="{{ $contact->email }}" id="duedate_{?}">
                                        </div>
                                        <div class="col-lg-2" style="padding-left: 1px !important;">
                                            <label for="duedate_{?}">Mobile:</label>
                                            <input required type="text" class="span2 form-control" name="contacts[{{ $loop->index }}][number]"
                                            value="{{ $contact->contact }}" id="duedate_{?}">
                                        </div>
                                        
                                        <div class="col-lg-1">
                                            <label for="">&nbsp;</label><br>
                                            <input type="button" class="btn btn-danger span-2 delete" value="X" />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <br>
                                <div class="form-group" style="text-align:center;">
                                    @php
                                    // $data['contact'] = $data['contacts'] == null? [] : $data['contact'];
                                    // $addContact = count($data['contacts']) >= 3 ? 'disabled':null;
                                    @endphp
                                    <input type="button" value="Add Contact" class="btn btn-primary add" align="center">
                                </div>
                            </fieldset>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <button type="button" class="btn btn-primary m-r-10 m-b-10" data-toggle="modal" data-target="#changePasswordModal">
                                    Change Password
                                </button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10 m-b-10">Update</button>
{{--                                <a href="{{ url()->previous() }}">--}}
                                <a href="{{ url('admin/profile')  }}">
                                    <button type="button" class="btn btn-danger waves-effect waves-light m-r-10 m-b-10">Cancel</button>
                                </a>
                                {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">Clear</button> --}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
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
    <script type="text/javascript" src="{{ asset('js/admin/jquery.repeatable.js') }}"></script>
    <script type="text/template" id="todos_labels">
    <div class="field-group row">
        <div class="col-lg-3" style="padding-left: 1px !important;">
            <label for="task_{?}">Name:</label>
            <input required type="text" class="span6 form-control" name="contacts[{?}][name]" value="{name}" id="task_{?}">
        </div>
        <div class="col-lg-3" style="padding-left: 1px !important;">
            <label for="duedate_{?}">Designation:</label>
            <input required type="text" class="span2 form-control"
            name="contacts[{?}][designation]" value="{designation}" id="duedate_{?}">
        </div>
        
        <div class="col-lg-3" style="padding-left: 1px !important;">
            <label for="duedate_{?}">Email:</label>
            <input required type="text" class="span2 form-control" name="contacts[{?}][email]" value="{email}" id="duedate_{?}">
        </div>
        <div class="col-lg-2" style="padding-left: 1px !important;">
            <label for="duedate_{?}">Mobile:</label>
            <input required type="text" maxlength="10" class="span2 form-control" name="contacts[{?}][number]" value="{number}" id="duedate_{?}">
        </div>
        <div class="col-lg-1">
            <label for="">&nbsp;</label><br>
            <input type="button" class="btn btn-danger span-2 delete" value="X" />
        </div>
    </div>
    </script>
    <script type="text/javascript">
    $(function() {
    $(".todos_labels .repeatable").repeatable({
    addTrigger: ".todos_labels .add",
    deleteTrigger: ".todos_labels .delete",
    template: "#todos_labels",
    startWith: 2,
    max: 3
    });
    });

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

    $('#changePasswordForm').submit(function(e){
        e.preventDefault();

        var formData = $('#changePasswordForm').serialize();
        $.ajax({
            url: '{{route('users.update_password')}}',
            type: 'PUT',
            data:formData,
            success: function(res){
                swal({
                    title:'Processing...',
                    
                });
                window.location.href="{{ route('profile.show') }}";
            },
            error: function(res){
                vm.errors = res.responseJSON.errors;
                // console.log(res);
            }

        });
    });

    vm = new Vue({
        el:'#formBody',
        data:{
            errors: null,
        }
    });


    </script>
    <script>document.write('<script src="http://' + (location.host || '${1:localhost}').split(':')[0] + ':${2:35729}/livereload.js?snipver=1"></' + 'script>')</script>
    @endsection