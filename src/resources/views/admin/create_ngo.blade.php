@extends('admin.admin_master')
@section('css')


@endsection
@section('body')
    <div class="container-fluid" id="app">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Add NGO</h4></div>
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



{{--                            @if (session('success'))--}}
{{--                                <div class="alert alert-success">--}}
{{--                                    NGO Added Successfully!--}}
{{--                                </div>--}}
{{--                            @endif--}}
                            {!! Form::open(['id' => 'ngo-form','files'=>true, 'name'=>'add-ngo','autocomplete'=>"off"]) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        {{ Form::file('logo',['id'=>'input-file-now','class'=>'dropify','data-height'=>'136']) }}
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>NGO Name:<span style="color:red;">*</span></label>
                                {{ Form::text('name','', ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                <label>Address:<span style="color:red;">*</span></label>
                                {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 3, 'required']) !!}
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Email address:<span style="color:red;">*</span></label>
                                    {{ Form::email('email','', ['class' => 'form-control', 'required', 'title'=>'john@gmail.com', 'oninvalid' => "this.setCustomValidity('Please Enter Valid Email')" , 'oninput' => "this.setCustomValidity('')"]) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Registration Date:<span style="color:red;">*</span></label>
                                    {!! Form::text('registration_date',null, ['class' => 'form-control', 'id'=>'registration-date', 'required','readonly', 'v-model'=>'date']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Registration Number:<span style="color:red;">*</span></label>

                                    {{ Form::text('registration_number','', ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Mobile:<span style="color:red;">*</span></label>
                                    {{ Form::tel('mobile',null, ['class' => 'form-control','maxlength'=>10, 'required']) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Landline:<span style="color:red;">*</span></label>
                                    {{ Form::tel('landline','', ['class' => 'form-control','maxlength'=>11,]) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Password:<span style="color:red;">*</span></label>
                                    {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <label>Pancard:<span style="color:red;">*</span></label>
                                        {{ Form::file('pancard',['id'=>'input-file-now','class'=>'dropify_pancard','data-height'=>'136']) }}
                                    </div>
                                    <br>
                                </div>


                                <div class="col-md-3">
                                    <div>
                                        <label>Certificate:<span style="color:red;">*</span></label>
                                        {{ Form::file('certificate',['id'=>'input-file-now','class'=>'dropify_certificate','data-height'=>'136']) }}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-3">
                                    <div style="position: absolute;">
                                        <label>Charity Registration Certificate:<span style="color:red;">*</span></label>
                                        {{ Form::file('charity_registration_certificate',['id'=>'input-file-now','class'=>'dropify_charity_registration_certificate','data-height'=>'136']) }}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-3">
                                    <div>
                                        <label>Dead:<span style="color:red;">*</span></label>
                                        {{ Form::file('dead',['id'=>'input-file-now','class'=>'dropify_dead','data-height'=>'136']) }}
                                    </div>
                                    <br>
                                </div>
                            </div>


                            <h4 class="form-group" style="font-weight: bold;">Dummy User Info</h4>

                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>User Name:<span style="color:red;">*</span></label>
                                    {{ Form::text('dummyname','', ['class' => 'form-control', 'required']) }}

                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Mobile:<span style="color:red;">*</span></label>
                                    {{ Form::text('dummymobile',null, ['class' => 'form-control','maxlength'=>10, 'required']) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Password:<span style="color:red;">*</span></label>
                                    {{ Form::password('dummypassword', ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Email address:<span style="color:red;">*</span></label>
                                    {{ Form::email('dummyemail','', ['class' => 'form-control', 'required', 'title'=>'john@gmail.com', 'oninvalid' => "this.setCustomValidity('Please Enter Valid Email')" , 'oninput' => "this.setCustomValidity('')"]) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
                                <div class="form-group">
                                    <label>Address:<span style="color:red;">*</span></label>
                                    {!! Form::textarea('dummyaddress',null,['class'=>'form-control', 'rows' => 2, 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                {{-- <input type="file" name="logo" id="input-file-now" class="dropify" data-height="100"/> --}}
                                <br>
                            </div>

                            <div class="col-xs-12">
                                <fieldset class="todos_labels">
                                    <div class="repeatable"></div>
                                    <br>
                                    <div class="form-group" style="text-align:center;">
                                        {{-- <input type="button" value="Add Contact" class="btn btn-primary add" align="center"> --}}
                                        <button type="button" class="btn btn-primary add">Add Contact</button>
                                        {{-- <input type="button" value="Add Contact" class="btn btn-primary add" align="center"> --}}
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-xs-12">
                                <fieldset class="bank_details_labels">
                                    <div class="repeatable"></div>
                                    <br>
                                    <div class="form-group" style="text-align:center;">
                                        {{-- <input type="button" value="Add Contact" class="btn btn-primary add" align="center"> --}}
                                        <button type="button" class="btn btn-primary add">Add Bank Details</button>
                                        {{-- <input type="button" value="Add Contact" class="btn btn-primary add" align="center"> --}}
                                    </div>
                                </fieldset>
                            </div>


                            <div class="col-xs-12">
                                <button class="btn btn-success waves-effect waves-light m-r-10" id="submit">Submit
                                </button>
                                <img src="{{ asset('images/admin/loader.gif') }}" id="loader"
                                     style="visibility: hidden;">
                                {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">Clear</button> --}}
                            </div>

                            <div class="col-xs-12">
                                <br>
                                <div class="alert alert-danger" id="errors" style="display: none;">
                                    <ul>

                                    </ul>
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

    <script type="text/javascript" src="{{ asset('js/admin/jquery.repeatable.js') }}"></script>

    <script type="text/template" id="todos_labels">
        <div class="field-group row">
            <div class="col-lg-3" style="padding-left: 1px !important;">
                <label for="task_{?}">Name:</label>
                <input required type="text" class="span6 form-control" name="contacts[{?}][name]" value="{name}"
                       id="task_{?}">
            </div>
            <div class="col-lg-3" style="padding-left: 1px !important;">
                <label for="duedate_{?}">Designation:</label>
                <input required type="text" class="span2 form-control"
                       name="contacts[{?}][designation]" value="{designation}" id="duedate_{?}">
            </div>
            <div class="col-lg-3" style="padding-left: 1px !important;">
                <label for="duedate_{?}">Email:</label>
                <input required type="text" class="span2 form-control" name="contacts[{?}][email]" value="{email}"
                       id="duedate_{?}">
            </div>
            <div class="col-lg-2" style="padding-left: 1px !important;">
                <label for="duedate_{?}">Mobile:</label>
                <input required type="tel" maxlength="10" class="span2 form-control" name="contacts[{?}][number]"
                       value="{number}" id="duedate_{?}">
            </div>
            <div class="col-lg-1">
                <label for="">&nbsp;</label><br>
                {{-- <input type="button" class="btn btn-danger span-2 delete" value="Remove" /> --}}
                <button type="button" class="btn btn-danger span-2 delete">X</button>
            </div>
        </div>
    </script>

    <script type="text/template" id="bank_details_labels">
        <div class="field-group row">
            <div class="col-lg-3" style="padding-left: 1px !important;">
                <label for="task_{?}">Bank Name:</label>
                <input required type="text" class="span6 form-control" name="bank_details[{?}][bank_name]"
                       value="{bank_name}" id="task_{?}">
            </div>
            <div class="col-lg-3" style="padding-left: 1px !important;">
                <label for="duedate_{?}">Account Number:</label>
                <input required type="text" class="span2 form-control"
                       name="bank_details[{?}][account_number]" value="{account_number}" id="duedate_{?}">
            </div>
            <div class="col-lg-3" style="padding-left: 1px !important;">
                <label for="duedate_{?}">Beneficiary Name:</label>
                <input required type="text" class="span2 form-control" name="bank_details[{?}][beneficiary_name]"
                       value="{beneficiary_name}" id="duedate_{?}">
            </div>
            <div class="col-lg-2" style="padding-left: 1px !important;">
                <label for="duedate_{?}">IFSC Code:</label>
                <input required type="tel" maxlength="10" class="span2 form-control" name="bank_details[{?}][ifsc]"
                       value="{ifsc}" id="duedate_{?}">
            </div>
            <div class="col-lg-1">
                <label for="">&nbsp;</label><br>
                {{-- <input type="button" class="btn btn-danger span-2 delete" value="Remove" /> --}}
                <button type="button" class="btn btn-danger span-2 delete">X</button>
            </div>
        </div>
    </script>

    <script>
        $(function () {
            $(".todos_labels .repeatable").repeatable({
                addTrigger: ".todos_labels .add",
                deleteTrigger: ".todos_labels .delete",
                template: "#todos_labels",
                startWith: 1,
                max: 3
            });
        });
    </script>

    <script>
        $(function () {
            $(".bank_details_labels .repeatable").repeatable({
                addTrigger: ".bank_details_labels .add",
                deleteTrigger: ".bank_details_labels .delete",
                template: "#bank_details_labels",
                startWith: 1,
                max: 3
            });
        });
    </script>

    {{-- <script type="text/javascript">

    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script> --}}

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#registration-date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            orientation: "top auto",
        }).on('hide', function (e) {
            $('input').blur();
            // `e` here contains the extra attributes
        });

        /*$( "#registration-date" ).datepicker({
              changeMonth: true,
              changeYear: true,
              dateFormat: "dd-mm-yy",
              minDate: "+1"
        });*/

        $("#registration-date").keydown(function (event) {
            return false;
        });

        $("#registration-date").click(function (event) {
            window.scrollTo({
                top: 50,
                behavior: "smooth"
            });
        });


        $(document).ready(function () {

            $('.dropify').dropify({
                messages: {
                    default: 'Add logo',
                    replace: '',
                    remove: 'X',
                    error: ''
                }
            });

            $('.dropify_pancard').dropify({
                messages: {
                    default: 'Add Pancard',
                    replace: '',
                    remove: 'X',
                    error: ''
                }
            });

            $('.dropify_certificate').dropify({
                messages: {
                    default: 'Add Certificate',
                    replace: '',
                    remove: 'X',
                    error: ''
                }
            });

            $('.dropify_charity_registration_certificate').dropify({
                messages: {
                    default: 'Add Charity Registration Certificate',
                    replace: '',
                    remove: 'X',
                    error: ''
                }
            });

            $('.dropify_dead').dropify({
                messages: {
                    default: 'Add Dead',
                    replace: '',
                    remove: 'X',
                    error: ''
                }
            });

            $("#ngo-form").submit(function (e) {
                e.preventDefault();
                $("#loader").css('visibility', 'visible');
                var data = $('#ngo-form').serialize();
                var formData = new FormData(this);
                $.ajax({
                    'type': 'POST',
                    'url': "{{route('ngo.store')}}",
                    'data': formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $("#errors").css('display', 'none');
                        $("#ngoForm").find("input, textarea").val(null);
                        $("#loader").css('visibility', 'hidden');
                        {{ session()->reflash() }}
                            window.location.href = '{{ route('ngo.index') }}';
                    },
                    error: function (response) {
                        console.log(response);
                        var errors = response.responseJSON.errors;
                        $("#errors ul li").remove();
                        $("#errors").css('display', 'block');
                        $("#loader").css('visibility', 'hidden');
                        for (var error in errors) {
                            $("#errors ul").append("<li>" + errors[error][0] + "</li>");
                            // console.log(errors[error][0]);
                        }
                    }
                })

            })
        });

        // $("#ngo-form").parsley();

        $( document ).ready(function() {
            $('input').attr('autocomplete','off');
        });
    </script>
@endsection