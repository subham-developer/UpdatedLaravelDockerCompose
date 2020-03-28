@extends('admin.admin_master')

@section('body')
<div class="container-fluid">


    <div class="row bg-title">

       @php
           if(Auth::user()->role_id == 2){
           if($ngoDetails->is_kyc == 0){  @endphp
           <p class="alert {{ Session::get('alert-class', 'alert-info') }}">KYC Pending</p>
        @php   }
           }
       @endphp


        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Create Project</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Create Project</li>
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
                            {{ session('success') }}
                        </div>
                        @endif
                        
                        {!! Form::model($data['formData'],['route' => 'projects.store','files' => true,'id'=>'projectForm']) !!}
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Title:</label>
                                {{ Form::text('title','', ['class' => 'form-control', 'required','id'=>'title']) }}
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Description: (Max 144 char)</label>
                                {{ Form::textarea('description','', ['class' => 'form-control', 'rows'=>2, 'required','maxlength'=>144]) }}
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-md-3 p-l-0">
                                    <b style="float: left;">Is this project recurring?</b>
                                </label>
                                <div class="col-xs-12 col-md-9">
                                    <div class="radio-list">
                                        {{-- <input type="radio" name="is_recurring" id="yes" value="yes"> --}}
                                        {{ Form::radio('is_recurring','yes',false,['id'=>'yes','v-model'=>'isRecurring']) }}
                                        <label for="yes">Yes </label>
                                        {{-- <input type="radio" name="is_recurring" id="no" value="no" checked> --}}
                                        {{ Form::radio('is_recurring','no',true,['id'=>'no', 'v-model'=>'isRecurring','class'=>'m-l-10']) }}
                                        <label for="no">No </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="recurring-days">
                                    <div class="col-xs-12 col-md-3 p-l-0">
                                        {{ Form::select('recurring_in', ['1' => 'Day', '7' => 'Week', '30' => 'Month'], null, ['placeholder'=>'Select...','id'=>'recurring-in','class'=>'form-control']) }}
                                    </div>
                                    <div class="col-xs-12 col-md-9 p-l-0">
                                        
                                        {{ Form::text('recurring_days',null, ['id'=>'days','class' => 'form-control col-md-8','placeholder'=>'Enter number of recurring days']) }}
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <br>
                                <label>Goal:</label>
                                {{ Form::number('goal','', ['class' => 'form-control', 'required', 'id'=>'goal']) }}
                            </div>
                        </div>
                        <div class="input-daterange" id="datepicker">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <br>
                                    <label>Start Date:</label>
                                    {{ Form::text('start_date','', ['id'=>'start','class' => 'form-control', 'required', 'readonly']) }}
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <br>
                                    <label>End Date:</label>
                                    {{ Form::text('end_date','', ['id'=>'end','class' => 'form-control', 'required','readonly']) }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Video Embed Link:</label>
                                {{-- <select class="form-control select2"> --}}
                                    {{ Form::text('video_link',null, ['class' => 'form-control','placeholder'=>'https://www.youtube.com/embed/HSlijLLka5o']) }}
                                {{-- </select> --}}
                            </div>
                        </div>
                        <div class="col-xs-12">
                            
                            <div class="form-group">
                                <label>Long Description:</label>
                                {{-- <select class="form-control select2"> --}}
                                    {{-- <textarea id="mymce" name="area"></textarea> --}}
                                    {{ Form::textarea('long_description',null,['id'=>'mymce']) }}
                                {{-- </select> --}}
                            </div>
                        </div>
                        @can('admin')
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Select NGO:</label>
                                {{-- <select class="form-control select2"> --}}
                                    {{ Form::select('user_id',$data['ngo'], null, ['class'=>'form-control select2','readonly']) }}
                                {{-- </select> --}}
                            </div>
                        </div>
                        @endcan
                        {{-- <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Images:</label>
                                {{-- <select class="form-control select2">
                                    {{-- <div id="uploads"></div>
                                    {{-- {{ Form::file('images[]',['multiple', 'required']) }}
                                {{-- </select>
                            </div>
                        </div> --}}
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Feature Image:</label>
                                <br>
                                <label>Note:</label> Image dimensions must be 1024(i.e. width) * 768(i.e. height)
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="feature_image[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Cover Image:</label>
                                <br>
                                <label>Note:</label> Image dimensions must be 1024(i.e. width) * 768(i.e. height)
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="cover_image[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Images:</label><br>
                                <label>Note:</label> Image dimensions must be 1024(i.e. width) * 768(i.e. height)
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>
                            
                            <div class="col-md-4">
                                <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>

                            <div class="col-md-4">
                                <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>

                            <div class="col-md-4">
                                <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>

                            <div class="col-md-4">
                                <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                <br>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <br>
                                    <label>Commision:</label>
                                    {{ Form::number('commission','10', ['class' => 'form-control', 'required', 'id'=>'goal']) }}
                                </div>
                            </div>
                            
                        </div>

                        
                        
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="submitBtn">Submit</button>
                        <img src="{{ asset('images/admin/loader.gif') }}" id="loader" style="visibility: hidden;">

                        <div class="col-xs-12">
                                <br>
                                <div class="alert alert-danger" id="errors" style="display: none;">
                                    <ul>
                                        
                                    </ul>
                                </div>
                        </div>
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
@endsection
@section('bottom-script')
<script type="text/javascript">

    $('#projectForm').submit(function(e){
        e.preventDefault();
        $('#submitBtn').attr('disabled',true);
        $( "#loader" ).css('visibility', 'visible');

        var formData = new FormData(this);

        $.ajax({
            'type'  : 'POST',
            'url'   : "{{route('projects.store')}}",
            'data'  : formData,
            contentType : false,
            processData: false,
            success : function(response){
                console.log('Error: '+response)
                $( "#errors" ).css('display', 'none');
                $("#ngoForm").find("input, textarea").val(null);
                $( "#loader" ).css('visibility', 'hidden');
                {{ session()->reflash() }}
                window.location.href='{{ route('projects.index') }}';
            },
            error : function(response){
                $('#submitBtn').attr('disabled',false);
                var errors = response.responseJSON.errors;
                // console.log(response.responseJSON);
                $( "#errors ul li" ).remove();
                $( "#errors" ).css('display', 'block');
                $( "#loader" ).css('visibility', 'hidden');
                $("#errors ul").append("<li>"+response.responseJSON.message+"</li>");
                console.log(response.responseJSON);    
                for (var error in errors) {
                    $("#errors ul").append("<li>"+errors[error][0]+"</li>");
                    console.log(errors[error][0]);
                }
            }
        })
    });
$("#recurring-in").change(function() {
    var days = $("#recurring-in").val();
    $("#days").val(days);
});
$(document).ready(function() {
    tinymce.init({
        selector: "textarea#mymce",
        theme: "modern",
        height: 200,
        menubar: false,
        plugins: "preview code table lists textcolor",
        toolbar: 'preview | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | subscript superscript | table | bullist numlist | forecolor backcolor | code'
    });
    $('#recurring-days').css('visibility', 'hidden');
    @if(isset($errors->recurring_days))
    $('#recurring-days').css('visibility', 'visible');
    @endif
    $('.dropify').dropify({
        messages: {
            default: 'Add Image',
            replace: '',
            remove: 'X',
            error: ''
        }
    });
});
$(".select2").select2();
// Range Selector
$('#datepicker').datepicker({
    autoclose: true,
    todayHighlight: false,
    toggleActive: true,
    format: 'dd-mm-yyyy',
    startDate: "0d",
    orientation: "top auto",
});

$('#datepicker').datepicker()
    .on('hide', function(e) {
        $('#start, #end').blur();
        // `e` here contains the extra attributes
});

$("#start, #end").keydown(function(event) {
    return false;
});
$("#start, #end").click(function(event) {
    window.scrollTo({
        top: 50,
        behavior: "smooth"
    });
});
$("#start").change(function(event) {
    $("#end").focus();
});
/*$(document).ready(function () {
uploadHBR.init({
"target": "#uploads",
"textNew": "ADD",
"mimes": ["image/jpeg", "image/png", "image/jpg"],
"max": 5
});
});*/
$("input[name=is_recurring]").change(function() {
    var isRecurring = $("input[name=is_recurring]:checked").val();
    $('#days').val(null);
    $('#recurring-in').val(null);
    if (isRecurring == 'yes') {
        $("#recurring-days").css('visibility', 'visible');
    } else {
        $("#recurring-days").css('visibility', 'hidden');
    }
});

</script>
@endsection