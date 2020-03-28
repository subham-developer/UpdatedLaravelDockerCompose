<?php

?>
@extends('admin.admin_master')

@section('body')

<div class="container-fluid">
    <div class="row bg-title">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h4 class="page-title col-lg-8 col-md-8 col-sm-8 col-xs-8">
                Add Donor
            </h4>

            {{-- <input type="file" value="CSV Upload" class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> --}}

            {{-- <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile04">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
            </div> --}}

        </div>

        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {{-- <ol class="breadcrumb">
                <li>
                    <a href="#">
                        Dashboard
                    </a>
                </li>
                <li class="active">
                    Add Donor
                </li>
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
                        <div class="alert alert-danger" style="text-transform: capitalize;">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                Donor Added Successfully
                            </div>
                        @endif


                        {!! Form::open(['route' => 'users.store' , 'method' => 'POST', 'files'=>true, 'id'=>'user-form','autocomplete'=>"off", 'role'=>'form', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <div style="width: 150px;">
                                {{ Form::file('profile',['id'=>'input-file-now','class'=>'dropify','data-height'=>'136']) }}
                                </div>
                                <br/>
                                <br/>
                            </div> --}}
                        </div>
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    First Name:
                                </label>
                                {{ Form::text('first_name','', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    Last Name:
                                </label>
                                {{ Form::text('last_name','', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    Mobile Number
                                </label>
                                {{ Form::tel('mobile',null, ['class' => 'form-control','maxlength'=>10,
                                'data-parsley-type'=>"number",
                                'data-parsley-length'=>"[10,10]",
                                'data-parsley-length-message'=>"The value must be 10 digit."]) }}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    Email Id
                                </label>
                                {{ Form::text('email',null, ['class' => 'form-control','data-parsley-type'=>'email']) }}
                            </div>
                        </div>

                        {{--
                        <div class="col-md-6" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    IMEI Number
                                </label>
                                {{ Form::text('IMEI','', ['class' => 'form-control', 'required', 'maxlength'=>15]) }}
                            </div>
                        </div>
                        --}}
                        {{--
                        <div class="col-md-6" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    Role
                                </label>
                                {{ Form::select('role_id', ['3' => 'user'], null, ['class'=>'form-control']) }}
                            </div>
                        </div>
                        --}}
                        <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    Password
                                </label>
                                {{ Form::password('password', ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12" style="padding-left: 1px !important;">
                            <div class="form-group">
                                <label>
                                    Or You Can Upload CSV Only
                                </label>
                                {{ Form::file('donor_csv_upload',null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12" style="padding-left: 1px !important; text-decoration: underline;">
                            <a href="{{ url('admin/users/download/donor_sample.csv') }}">Download and check format of sample CSV</a>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Note: Before uploading CSV, make sure that each and every row in CSV must be unique.</label>
                                <br>
                                <button class="btn btn-success waves-effect waves-light m-r-10" type="submit">
                                Submit
                                </button>
                            </div>
                        </div>
                        {{--
                        <button class="btn btn-inverse waves-effect waves-light" type="reset">
                        Clear
                        </button>
                        --}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        {{--
        <div class="col-md-4">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <h2>
                        Image
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        --}}
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
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Add Profile',
                replace: '',
                remove: 'X',
                error: ''
            }
        });

        // $('#user-form').parsley();
    });

    $( document ).ready(function() {
        $('input').attr('autocomplete','off');
    });
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
</script>
@endsection