@extends('admin.admin_master')
@section('css')
@endsection
@section('body')
<style type="text/css">
    .el-element-overlay .el-card-item .el-overlay-1 img{
        height: 200px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="profile" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'ngo.update_image', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-push-4">
                        <input type="hidden" name="user_id" value="{{ $data['ngo']['id'] }}">
                        {{ Form::file('logo',['id'=>'input-file-now','class'=>'dropify','data-height'=>'100','required']) }}
                        <br>
                        <center><button class="btn btn-primary">Update</button></center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>

    </div>
</div>
{{-- modal close --}}

<!-- Modal -->
<div class="modal fade" id="pancard" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'ngo.update_pancard', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-push-4">
                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                        {{ Form::file('pancard',['id'=>'input-file-now','class'=>'dropify_pancard','data-height'=>'100','required']) }}
                        <br>
                        <center><button class="btn btn-primary">Update</button></center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>

    </div>
</div>
<div class="modal fade" id="certificate" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'ngo.update_certificate', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-push-4">
                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                        {{ Form::file('certificate',['id'=>'input-file-now','class'=>'dropify_certificate','data-height'=>'100','required']) }}
                        <br>
                        <center><button class="btn btn-primary">Update</button></center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>

    </div>
</div>
{{-- modal close --}}
<div class="modal fade" id="crcertificate" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'ngo.update_crcertificate', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-push-4">
                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                        {{ Form::file('charity_registration_certificate',['id'=>'input-file-now','class'=>'dropify_crcertificate','data-height'=>'100','required']) }}
                        <br>
                        <center><button class="btn btn-primary">Update</button></center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>

    </div>
</div>
{{-- modal close --}}
<div class="modal fade" id="dead" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route'=>'ngo.update_dead', 'method'=>'put', 'files'=>true]) }}
                <div class="row">
                    <div class="col-md-4 col-md-push-4">
                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                        {{ Form::file('dead',['id'=>'input-file-now','class'=>'dropify_dead','data-height'=>'100','required']) }}
                        <br>
                        <center><button class="btn btn-primary">Update</button></center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>

    </div>
</div>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Edit NGO</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Add NGO</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
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
                            NGO Updated Successfully!
                        </div>
                        @endif
                        <div class="row el-element-overlay m-b-40" style="width: 200px;">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1">
                                    @php
                                        $image = $data['ngo']['profile_image'] == null?'no-image.png':$data['ngo']['profile_image'];
                                    @endphp
                                    <img src="{{ asset('uploads').'/'.$image }}" width="200" />
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
                                                    <button class="btn btn-link" data-toggle="modal" data-target="#profile">
                                                    <a class="btn default btn-outline">
                                                        <i class="icon-refresh"></i>
                                                    </a>
                                                    </button>
                                                </li>
                                                @if($data['ngo']['profile_image'] != null)
                                                <li>
                                                    {{-- <form action="{{}}"> --}}
                                                        {!! Form::open(['route'=>'ngo.delete_image','method'=>'delete','id'=>'deleteImg']) !!}
                                                        <input type="hidden" name="user_id" value="{{ $data['ngo']['id'] }}">
                                                        <button type="button" class="btn btn-link" onclick="confirmation()">
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
                         <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="el-element-overlay">
                                <div class="el-card-item"> <label>Pancard</label>
                                    <div class="el-card-avatar el-overlay-1">

                                        @php
                                            $image = $data['ngo']['ngo']['pancard'] == null?'no-image.png':$data['ngo']['ngo']['pancard'];
                                        @endphp
{{--                                        <img src="{{ asset('uploads').'/'.$image }}" width="200" />--}}
                                        <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive" width="200" >

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
                                                    <button class="btn btn-link" data-toggle="modal" data-target="#pancard">
                                                        <a class="btn default btn-outline">
                                                            <i class="icon-refresh"></i>
                                                        </a>
                                                    </button>
                                                </li>
                                                @if($data['ngo']['ngo']['pancard'] != null)
                                                    <li>
                                                        {{-- <form action="{{}}"> --}}
                                                        {!! Form::open(['route'=>'ngo.delete_pan','method'=>'delete','id'=>'deletePan']) !!}
                                                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                                                        <button type="button" class="btn btn-link" onclick="panconfirmation()">
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
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="el-element-overlay">
                                <div class="el-card-item"> <label>Certificate</label>
                                    <div class="el-card-avatar el-overlay-1">

                                        @php
                                            $image = $data['ngo']['ngo']['certificate'] == null?'no-image.png':$data['ngo']['ngo']['certificate'];
                                        @endphp
{{--                                        <img src="{{ asset('uploads').'/'.$image }}" width="200" />--}}
                                        <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive" width="200" >

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
                                                    <button class="btn btn-link" data-toggle="modal" data-target="#certificate">
                                                        <a class="btn default btn-outline">
                                                            <i class="icon-refresh"></i>
                                                        </a>
                                                    </button>
                                                </li>
                                                @if($data['ngo']['ngo']['certificate'] != null)
                                                    <li>
                                                        {{-- <form action="{{}}"> --}}
                                                        {!! Form::open(['route'=>'ngo.delete_certificate','method'=>'delete','id'=>'deletecertificate']) !!}
                                                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                                                        <button type="button" class="btn btn-link" onclick="cerconfirmation()">
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
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <div class="el-element-overlay">
                                <div class="el-card-item"> <label>Charity Registration Certificate</label>
                                    <div class="el-card-avatar el-overlay-1">

                                        @php
                                            $image = $data['ngo']['ngo']['charity_registration_certificate'] == null?'no-image.png':$data['ngo']['ngo']['charity_registration_certificate'];
                                        @endphp
{{--                                        <img src="{{ asset('uploads').'/'.$image }}" width="200" />--}}
                                        <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive" width="200" >

                                        <div class="el-overlay">
                                            <ul class="el-info">

                                                <li>
                                                    <button class="btn btn-link" data-toggle="modal" data-target="#crcertificate">
                                                        <a class="btn default btn-outline">
                                                            <i class="icon-refresh"></i>
                                                        </a>
                                                    </button>
                                                </li>
                                                @if($data['ngo']['ngo']['charity_registration_certificate'] != null)
                                                    <li>
                                                        {{-- <form action="{{}}"> --}}
                                                        {!! Form::open(['route'=>'ngo.delete_crcertificate','method'=>'delete','id'=>'deletecrcertificate']) !!}
                                                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                                                        <button type="button" class="btn btn-link" onclick="crcerconfirmation()">
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

                                </div>

                            </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <div class="el-element-overlay">
                                <div class="el-card-item"> <label>Dead</label>
                                    <div class="el-card-avatar el-overlay-1">

                                        @php
                                            $image = $data['ngo']['ngo']['dead'] == null?'no-image.png':$data['ngo']['ngo']['dead'];
                                        @endphp
{{--                                        <img src="{{ asset('uploads').'/'.$image }}" width="200" />--}}
                                        <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive" width="200" >

                                        <div class="el-overlay">
                                            <ul class="el-info">

                                                <li>
                                                    <button class="btn btn-link" data-toggle="modal" data-target="#dead">
                                                        <a class="btn default btn-outline">
                                                            <i class="icon-refresh"></i>
                                                        </a>
                                                    </button>
                                                </li>
                                                @if($data['ngo']['ngo']['dead'] != null)
                                                    <li>
                                                        {{-- <form action="{{}}"> --}}
                                                        {!! Form::open(['route'=>'ngo.delete_dead','method'=>'delete','id'=>'deletedead']) !!}
                                                        <input type="hidden" name="ngo_id" value="{{ $data['ngo']['ngo']['id'] }}">
                                                        <button type="button" class="btn btn-link" onclick="deadconfirmation()">
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

                                </div>

                            </div>
                    </div>
                </div>

                                {!! Form::model($data['ngo'],['route' => ['ngo.update',$data['ngo']['id']], 
                                'method'=>'put', 'id'=>'editNgoForm']) !!}
                                
                                <div class="form-group">
                                    
                                    <label>NGO Name:</label>
                                    {{ Form::text('name',null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 3]) !!}
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Email address:</label>
                                        {{ Form::email('email',null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Registration Date:</label>
                                        {{ Form::text('registration_date',null, ['class' => 'form-control', 'id'=>'registration-date',
                                        'autocomplete'=>'off','readonly']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Registration Number:</label>
                                        
                                        {{ Form::text('registration_number',null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Mobile:</label>
                                        {{ Form::tel('mobile',null, ['class' => 'form-control','maxlength'=>10]) }}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Landline:</label>
                                        {{ Form::tel('landline',null, ['class' => 'form-control','maxlength'=>11]) }}
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <fieldset class="todos_labels">
                                        <div class="repeatable">
                                            
                                            @foreach($data['contacts'] as $contact)
                                            <div class="field-group row">
                                                <div class="col-lg-3 col-xs-12" style="padding-left: 1px !important;">
                                                    <label>Name:</label>
                                                    <input required type="text" class="span6 form-control" name="contacts[{{ ($loop->count+1) - $loop->iteration }}][name]"
                                                    value="{{ $contact->name }}" id="task_{{ ($loop->count+1) - $loop->iteration }}">
                                                </div>
                                                <div class="col-lg-3 col-xs-12" style="padding-left: 1px !important;">
                                                    <label for="duedate_{?}">Designation:</label>
                                                    <input required type="text" class="span2 form-control"
                                                    name="contacts[{{ ($loop->count+1) - $loop->iteration }}][designation]" value="{{ $contact->designation }}" id="duedate_{?}">
                                                </div>
                                                <div class="col-lg-3 col-xs-12" style="padding-left: 1px !important;">
                                                    <label for="duedate_{?}">Email:</label>
                                                    <input required type="text" class="span2 form-control" name="contacts[{{ ($loop->count+1) - $loop->iteration }}][email]"
                                                    value="{{ $contact->email }}" id="duedate_{?}">
                                                </div>
                                                <div class="col-lg-2 col-xs-12" style="padding-left: 1px !important;">
                                                    <label for="duedate_{?}">Mobile:</label>
                                                    <input required type="text" class="span2 form-control" name="contacts[{{ ($loop->count+1) - $loop->iteration }}][number]"
                                                    value="{{ $contact->contact }}" id="duedate_{?}">
                                                </div>
                                                
                                                
                                                <div class="col-lg-1 col-xs-12">
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
                                            $addContact = count($data['contacts']) >= 3 ? 'disabled':null;
                                            @endphp
                                            <input type="button" value="Add Contact" class="btn btn-primary add" align="center">
                                        </div>
                                    </fieldset>
                                </div>

                            <div class="col-xs-12">
                                <fieldset class="bank_details_labels">
                                    <div class="repeatable">

                                        @foreach($data['bank_details'] as $bank_details)

                                            <div class="field-group row">
                                                <div class="col-lg-3 col-xs-12" style="padding-left: 1px !important;">
                                                    <label>Bank Name::</label>
                                                    <input required type="text" class="span6 form-control" name="bank_details[{{ ($loop->count+1) - $loop->iteration }}][bank_name]"
                                                           value="{{ $bank_details->bank_name }}" id="task_{{ ($loop->count+1) - $loop->iteration }}">
                                                </div>
                                                <div class="col-lg-3 col-xs-12" style="padding-left: 1px !important;">
                                                    <label for="duedate_{?}">Account Number::</label>
                                                    <input required type="text" class="span2 form-control"
                                                           name="bank_details[{{ ($loop->count+1) - $loop->iteration }}][account_number]" value="{{ $bank_details->account_number }}" id="duedate_{?}">
                                                </div>
                                                <div class="col-lg-3 col-xs-12" style="padding-left: 1px !important;">
                                                    <label for="duedate_{?}">Beneficiary Name:</label>
                                                    <input required type="text" class="span2 form-control" name="bank_details[{{ ($loop->count+1) - $loop->iteration }}][beneficiary_name]"
                                                           value="{{ $bank_details->beneficiary_name }}" id="duedate_{?}">
                                                </div>
                                                <div class="col-lg-2 col-xs-12" style="padding-left: 1px !important;">
                                                    <label for="duedate_{?}">IFSC Code:</label>
                                                    <input required type="text" class="span2 form-control" name="bank_details[{{ ($loop->count+1) - $loop->iteration }}][ifsc]"
                                                           value="{{ $bank_details->ifsc }}" id="duedate_{?}">
                                                </div>


                                                <div class="col-lg-1 col-xs-12">
                                                    <label for="">&nbsp;</label><br>
                                                    <input type="button" class="btn btn-danger span-2 delete" value="X" />
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <br>
                                    <div class="form-group" style="text-align:center;">
                                        <input type="button" value="Add Bank Details" class="btn btn-primary add" align="center">
                                    </div>
                                </fieldset>
                            </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-danger" id="errors" style="display: none;">
                                            <ul>
                                                
                                            </ul>
                                        </div>
                                        <br>
                                        <button id="submit" type="submit" class="btn btn-success waves-effect waves-light m-r-10">Update </button>
                                        <img src="{{ asset('images/admin/loader.gif') }}" id="loader" style="visibility: hidden;">
                                        <a href="{{route('ngo.index') }}">
                                        <button type="button" class="btn btn-danger waves-effect waves-light m-r-10">Cancel</button>
                                        </a>
                                        {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">Clear</button> --}}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <img src="{{ asset('images/admin/ngo.jpg') }}" class="img-responsive">
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
        <!-- /.container-fluid -->
        @endsection
        @section('bottom-script')

        <script type="text/javascript">
            $("#editNgoForm").submit(function(e){
                e.preventDefault();
                $('#submit').attr('disabled',true);
                $( "#loader" ).css('visibility', 'visible');
                var data = $('#editNgoForm').serialize();
                var formData = new FormData(this);
                $.ajax({
                    'type'  : 'POST',
                    'url'   : "{{route('ngo.update',['id'=>$data['ngo']['id']])}}",
                    'data'  : formData,
                    contentType: false,
                    processData: false,
                    success : function(response){
                        $( "#errors" ).css('display', 'none');
                        // $("#ngoForm").find("input, textarea").val(null);
                        $( "#loader" ).css('visibility', 'hidden');
                        {{ session()->reflash() }}
                        {{--// {{ Request::session()->flash('success','kasjdfk') }}--}}
                        {{--{{ Request::session()->flash('success') }}--}}
                        window.location.href='{{ route('ngo.index') }}';
                    },
                    error : function(response){
                        $('#submit').attr('disabled',false);
                        var errors = response.responseJSON.errors;
                        $( "#errors ul li" ).remove();
                        $( "#errors" ).css('display', 'block');
                        $( "#loader" ).css('visibility', 'hidden');
                        for (var error in errors) {
                            $("#errors ul").append("<li>"+errors[error][0]+"</li>");
                            // console.log(errors[error][0]);
                        }
                    }
                })

            })
        </script>
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

        <script type="text/template" id="bank_details_labels">
            <div class="field-group row">
                <div class="col-lg-3" style="padding-left: 1px !important;">
                    <label for="task_{?}">Bank Name:</label>
                    <input required type="text" class="span6 form-control" name="bank_details[{?}][bank_name]" value="{bank_name}" id="task_{?}">
                </div>
                <div class="col-lg-3" style="padding-left: 1px !important;">
                    <label for="duedate_{?}">Account Number:</label>
                    <input required type="text" class="span2 form-control"
                           name="bank_details[{?}][account_number]" value="{account_number}" id="duedate_{?}">
                </div>
                <div class="col-lg-3" style="padding-left: 1px !important;">
                    <label for="duedate_{?}">Beneficiary Name:</label>
                    <input required type="text" class="span2 form-control" name="bank_details[{?}][beneficiary_name]" value="{beneficiary_name}" id="duedate_{?}">
                </div>
                <div class="col-lg-2" style="padding-left: 1px !important;">
                    <label for="duedate_{?}">IFSC Code:</label>
                    <input required type="tel" maxlength="10" class="span2 form-control" name="bank_details[{?}][ifsc]" value="{ifsc}" id="duedate_{?}">
                </div>
                <div class="col-lg-1">
                    <label for="">&nbsp;</label><br>
                    {{-- <input type="button" class="btn btn-danger span-2 delete" value="Remove" /> --}}
                    <button type="button" class="btn btn-danger span-2 delete">X</button>
                </div>
            </div>
        </script>
        <script>
        $("#registration-date").click(function(event) {
        window.scrollTo({
        top: 50,
        behavior: "smooth"
        });
        });
        $(function() {
        $(".todos_labels .repeatable").repeatable({
        addTrigger: ".todos_labels .add",
        deleteTrigger: ".todos_labels .delete",
        template: "#todos_labels",
        startWith: 1,
        max: 3
        });
        });
        </script>
        {{-- <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
        </script> --}}
        <script type="text/javascript">
        $('#registration-date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        clearBtn: false,
        orientation: "top auto",
        });
        $("#registration-date").keydown(function(event) {
        return false;
        });
        $("#start, #end").click(function(event) {
        window.scrollTo({
        top: 50,
        behavior: "smooth"
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
        $(document).ready(function(){
                $('.dropify_pancard').dropify({
                messages: {
                default: 'Update pancard',
                replace: '',
                remove: 'X',
                error: ''
            }
            });
        });

        $(document).ready(function(){
                $('.dropify_certificate').dropify({
                messages: {
                default: 'Update Certificate',
                replace: '',
                remove: 'X',
                error: ''
            }
            });
        });

        $(document).ready(function(){
                $('.dropify_crcertificate').dropify({
                messages: {
                default: 'Update Charity Registration Certificate',
                replace: '',
                remove: 'X',
                error: ''
            }
            });
        });

        $(document).ready(function(){
                $('.dropify_dead').dropify({
                messages: {
                default: 'Update Dead',
                replace: '',
                remove: 'X',
                error: ''
            }
            });
        });

        function confirmation() {
        // console.log(e.form);

        
        swal({   
            title: "Are you sure?",   
            text: "You want to delete image!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes!",   
            cancelButtonText: "No!",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){   
            if (isConfirm) {     
                // e.form.submit();
                $('#deleteImg').submit();
                // $('#deletecertificate').submit();
                // $('#deletecrcertificate').submit();
                // $('#deletedead').submit();
                $('#delete').submit();
                swal({
                    title: "Deleted",
                    text: "Logo Deleted Successfully!",
                    timer: 2000,
                    showConfirmButton: false
                });
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {   
                
                swal.close();
                
                // swal("Cancelled", "Your imaginary file is safe :)", "error");   
            } 
        });

        // return ans;
    }

    //--Pancard image deletion
        function panconfirmation() {
            // console.log(e.form);


            swal({
                title: "Are you sure?",
                text: "You want to delete image!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    $('#deletePan').submit();
                    $('#delete').submit();
                    swal({
                        title: "Deleted",
                        text: "Pancard Deleted Successfully!",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {

                    swal.close();

                    // swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });

            // return ans;
        }

        function cerconfirmation() {
            // console.log(e.form);


            swal({
                title: "Are you sure?",
                text: "You want to delete image!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    // e.form.submit();
                    // $('#deleteImg').submit();
                    $('#deletecertificate').submit();
                    // $('#deletecrcertificate').submit();
                    // $('#deletedead').submit();
                    $('#delete').submit();
                    swal({
                        title: "Deleted",
                        text: "Certificate Deleted Successfully!",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {

                    swal.close();

                    // swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });

            // return ans;
        }

        function crcerconfirmation() {
            // console.log(e.form);


            swal({
                title: "Are you sure?",
                text: "You want to delete image!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    // e.form.submit();
                    // $('#deleteImg').submit();
                    // $('#deletecertificate').submit();
                    $('#deletecrcertificate').submit();
                    // $('#deletedead').submit();
                    $('#delete').submit();
                    swal({
                        title: "Deleted",
                        text: "Charity Registration Certificate Deleted Successfully!",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {

                    swal.close();

                    // swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });

            // return ans;
        }

        function deadconfirmation() {
            // console.log(e.form);


            swal({
                title: "Are you sure?",
                text: "You want to delete image!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    // e.form.submit();
                    // $('#deleteImg').submit();
                    // $('#deletecertificate').submit();
                    // $('#deletecrcertificate').submit();
                    $('#deletedead').submit();
                    $('#delete').submit();
                    swal({
                        title: "Deleted",
                        text: "Dead Deleted Successfully!",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {

                    swal.close();

                    // swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });

            // return ans;
        }

</script>

        <script>
            $(function() {
                $(".bank_details_labels .repeatable").repeatable({
                    addTrigger: ".bank_details_labels .add",
                    deleteTrigger: ".bank_details_labels .delete",
                    template: "#bank_details_labels",
                    startWith: 1,
                    max: 10
                });
            });
        </script>

        @endsection