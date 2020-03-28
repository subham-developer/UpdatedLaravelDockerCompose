@extends('admin.admin_master')

@section('css')
@endsection

@section('body')

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Add Donation</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add Donation</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-8">
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
                                        Donation Added Successfully!
                                    </div>
                                @endif

                                {!! Form::open(['route' => 'ngo.store', 'method'=>'post']) !!}
                                <div class="form-group">
                                    <label>Select NGO:</label>
                                    {{ Form::text('name','', ['class' => 'form-control']) }}
                                </div>
                                {{-- <div class="form-group">
                                    <label>Address:</label>
                                    {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 1, 'cols' => 5]) !!}
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Email address:</label>
                                        {{ Form::email('email','', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Registration Date:</label>
                                        {{ Form::text('registration_date','', ['class' => 'form-control', 'id'=>'registration-date']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Registration Number:</label>
                                        
                                        {{ Form::text('registration_number','', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                    <div class="form-group">
                                        <label>Mobile:</label>
                                        {{ Form::text('mobile','', ['class' => 'form-control']) }}
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        <button type="reset" class="btn btn-inverse waves-effect waves-light">Clear</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <img src="{{ asset('images/admin/ngo.jpg') }}" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
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
@endsection