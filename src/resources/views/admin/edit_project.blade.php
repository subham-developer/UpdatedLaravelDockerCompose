@extends('admin.admin_master')
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Edit Project</h4> </div>
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
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Details</span></a></li>
                    <li role="presentation" class=""><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Images</span></a></li>
                    
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="home1">
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
                                
                                @php
                                    $disabled = $data['project']['status'] == 1 ?'disabled' : null;
                                    $readOnly = $data['project']['status'] == 1 ?'readonly' : null;
                                @endphp

                                @if($data['project']['status'] != 1)
                                {!! Form::model($data['project'],['route' => ['projects.update', $data['project']->id ], 'method'=>'PUT' ]) !!}
                                @else
                                {!! Form::model($data['project'],['route' => ['projects.end_date', $data['project']->id ], 'method'=>'PUT' ]) !!}
                                @endif
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Title:</label>
                                        {{ Form::text('title',null, ['class' => 'form-control',$readOnly]) }}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Description:</label>
                                        {{ Form::textarea('description',null, ['class' => 'form-control', 'rows'=>3,$readOnly,'maxlength'=>144]) }}
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Goal:</label>
                                        {{ Form::number('goal',null, ['class' => 'form-control',$readOnly]) }}
                                    </div>
                                </div>
                                <div class="input-daterange" id="datepicker">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label>Start Date:</label>
                                            {{ Form::text('start_date',null, ['id'=>'start','class' => 'form-control',$disabled,'readonly']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label>End Date:</label>
                                            {{ Form::text('end_date',null, ['id'=>'end','class' => 'form-control','readonly']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 p-l-0">
                                            <b style="float: left;">Is this project recurring?</b>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="radio-list">
                                                {{-- <input type="radio" name="is_recurring" id="yes" value="yes"> --}}
                                                {{ Form::radio('is_recurring','yes',false,['id'=>'yes',$readOnly]) }}
                                                <label for="yes">Yes </label>
                                                {{-- <input type="radio" name="is_recurring" id="no" value="no" checked> --}}
                                                {{ Form::radio('is_recurring','no',true,['id'=>'no','class'=>'m-l-10',$readOnly]) }}
                                                <label for="no">No </label>
                                            </div>
                                        </div>
                                        <div id="recurring-days">
                                            <div class="col-xs-12 col-md-3 p-l-0">
                                                {{ Form::select('recurring_in', [''=>'Select...','1' => 'Day', '7' => 'Week', '30' => 'Month'], null, ['class'=>'form-control','id'=>'recurringIn',$disabled]) }}
                                            </div>
                                            <div class="col-xs-12 col-md-9 p-l-0">
                                                
                                                {{ Form::text('recurring_days',null, ['class' => 'form-control col-md-8','placeholder'=>'Recurring period','id'=>'days',$readOnly]) }}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <br>
                                    <div class="form-group">
                                        <label>Video Embed Link:</label>
                                        {{-- <select class="form-control select2"> --}}
                                            {{ Form::text('video_link',null, ['class' => 'form-control','placeholder'=>'https://www.youtube.com/embed/HSlijLLka5o',$readOnly]) }}
                                        {{-- </select> --}}
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    
                                    <div class="form-group">
                                        <label>Long Description:</label>
                                        {{-- <select class="form-control select2"> --}}
                                            {{-- <textarea id="mymce" name="area"></textarea> --}}
                                            {{ Form::textarea('long_description',null,['id'=>'mymce',$disabled]) }}
                                        {{-- </select> --}}
                                    </div>
                                </div>
                                @can('admin')
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select NGO:</label>
                                        {{-- <select class="form-control select2"> --}}
                                            {{ Form::select('user_id',$data['ngo'], null, ['class'=>'form-control select2',$disabled]) }}
                                            
                                        {{-- </select> --}}
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Commision (%):</label>
                                        {{-- <select class="form-control select2"> --}}
                                            {!! Form::number('commission', null, ['class'=>'form-control',
                                                'placeholder'=>'Eg. 10'
                                                ]) !!}
                                            
                                        {{-- </select> --}}
                                    </div>
                                </div>
                                @endcan
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Update</button>
                                {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">Clear</button> --}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    {{-- ==============================
                    Image Tab
                    ================================== --}}
                    <div role="tabpanel" class="tab-pane fade" id="profile1">
                        <div class="row el-element-overlay m-b-40">
                            

                            <?php
                                                
                                            ?>
                            <!-- /.usercard -->
                            @foreach($data['project']['image'] as $image)

                            

                            @if(isset($image['cover']))

                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    cover
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img src="{{ asset('uploads') }}/{{ $image['name'] }}" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li>
                                                            @if(count($data['project']['image']) > 1)
                                                            {!! Form::open(['route' => ['projects.destroy_image',$image->id], 'method'=>'delete']) !!}
                                                            <input type="hidden" name="project_id" value="{{ $data['project']['id'] }} ">
                                                            <button class="btn btn-link">
                                                            <a class="btn default btn-outline">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                            </button>
                                                            {{ Form::close() }}
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @elseif(isset($image['feature']))

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                feature
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img src="{{ asset('uploads') }}/{{ $image['name'] }}" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li>
                                                            @if(count($data['project']['image']) > 1)
                                                            {!! Form::open(['route' => ['projects.destroy_image',$image->id], 'method'=>'delete']) !!}
                                                            <input type="hidden" name="project_id" value="{{ $data['project']['id'] }} ">
                                                            <button class="btn btn-link">
                                                            <a class="btn default btn-outline">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                            </button>
                                                            {{ Form::close() }}
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <b> {{ $image['image_type'] }} </b>
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img src="{{ asset('uploads') }}/{{ $image['name'] }}" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li>
                                                            @if(count($data['project']['image']) > 1)
                                                            {!! Form::open(['route' => ['projects.destroy_image',$image->id], 'method'=>'delete']) !!}
                                                            <input type="hidden" name="project_id" value="{{ $data['project']['id'] }} ">
                                                            <button class="btn btn-link">
                                                            <a class="btn default btn-outline">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                            </button>
                                                            {{ Form::close() }}
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @endforeach


                                @if(count($data['project']['image']) != 8)
                                <div class="row">
                                    {!! Form::open(['route'=>'projects.update_image','files'=>true]) !!}
                                    {!! Form::hidden('id', $data['project']->id, []) !!}
                                    <div class="col-sm-12">

                                        @if(count($data['project']['image']) < 8)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif

                                        @if(count($data['project']['image']) < 7)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif

                                        @if(count($data['project']['image']) < 6)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif
                                        
                                        @if(count($data['project']['image']) < 5)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif
                                        
                                        @if(count($data['project']['image']) < 4)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif
                                        
                                        @if(count($data['project']['image']) < 3)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif
                                        @if(count($data['project']['image']) < 2)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif
                                        @if(count($data['project']['image']) < 1)
                                        <div class="col-md-4">
                                            <input type="file" name="images[]" id="input-file-now" class="dropify" data-height="100"/>
                                            <br>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary">Upload</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                @endif
                            </div>
                            
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

        $('#datepicker').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy',
clearBtn: false
});

    var is_recurring = {{ $data['project']['recurring_days'] == null ? 0 : 1}} ;
    $(document).ready(function(){

        tinymce.init({
        selector: "textarea#mymce",
        theme: "modern",
        height: 200,
        menubar:false,

    });

    if(is_recurring){
    $("#yes").attr('checked',true);
    $("#recurring-days").css('visibility','visible');
    }else{
    $("#recurring-days").val(null);
    $("#recurring-days").css('visibility','hidden');
    }
    if($("#is-recurring").attr('checked') == 'checked'){
    $("#recurring-days").css('visibility','visible');
    
    }
    
    });
    $('.dropify').dropify({
    messages: {
    default: 'Add Image',
    replace: '',
    remove: 'X',
    error: ''
    }
    });
    $(".select2").select2();
    // Range Selector
    $('#datepicker').datepicker({
    autoclose: true,
    todayHighlight: false,
    format: 'dd-mm-yyyy',
    startDate: "0d",
    orientation: "top left",
    }).on('hide', function(e) {
        $('#start, #end').blur();
        // `e` here contains the extra attributes
    });
    $('#datepicker').datepicker()
    
    $("#start, #end").keydown(function(event) {
    return false;
    });
    $("#start").change(function(event) {
    $("#end").focus();
    });
    $("input[name=is_recurring]").change(function(){
    $("#recurring-days").val(null);
    var isRecurring = $("input[name=is_recurring]:checked").val();
    if(isRecurring == 'yes'){
    $("#recurring-days").css('visibility','visible');
    }
    else{
    $("#recurring-days").css('visibility','hidden');
    $("#recurring-days").val(null);
    }
    });
    
    $("#recurringIn").change(function() {
        var days = $("#recurringIn").val();
        $("#days").val(days);
    });
    /*$(document).ready(function () {
    uploadHBR.init({
    "target": "#uploads",
    "textNew": "ADD",
    "mimes": ["image/jpeg", "image/png", "image/jpg"],
    "max": {{ 5 - count($data['project']['image']) }}
    });
    });*/
    
    /*$(function() {
    $(".todos_labels .repeatable").repeatable({
    addTrigger: ".todos_labels .add",
    deleteTrigger: ".todos_labels .delete",
    template: "#todos_labels",
    startWith: 1,
    max: 3
    });
    });*/
    </script>
    <script type="text/template" id="todos_labels">
    <div class="box-drag column" draggable="true"><input type="hidden" name="images[]" id="base64_{?}" data-id="{?}"><div class="form-group"><div class="col-md-12 no-padding uploadArea" data-index="0"><span class="new" id="new_{?}" title="Clique ou arraste aqui uma foto" data-index="{?}">
    <input type="file" class="fileHidden hidden" multiple="" accept="image/jpeg,image/png,image/jpg" id="hidden_{?}" data-index="{?}"><i class="fa fa-camera"></i><p>ADD</p></span><span class="image-preview hidden" id="prev_{?}"><div class="remove" title="Clique aqui para remover a foto" data-index="0"><i class="fa fa-times"></i></div><img class="img-responsive" src=""></span></div></div></div>
    </script>
    @endsection