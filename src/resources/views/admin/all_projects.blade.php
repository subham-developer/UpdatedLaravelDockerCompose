@extends('admin.admin_master')
@section('css')
<style type="text/css">
    #transactions td{
        padding: 2px;
    }
input[type='search']{
        border: 1px solid #000!important;
    }
</style>

@endsection
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">List of all Projects</h4>
            {{-- <p class="text-muted m-b-0 font-13"> Bootstrap Elements </p> --}}
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {{-- <a href="#" target="_blank" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add NGO</a> --}}
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Projects</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            
            <div class="white-box">
                {{-- <h3 class="box-title m-b-0">List of all NGO</h3>
                <p class="text-muted m-b-30 font-13"> Bootstrap Elements </p> --}}
                <div class="row">
                    <div class="col-xs-12">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    </div>

                    {{-- <form class="form-horizontal"> --}}
                        {!! Form::open(['route' => 'projects.index','method'=>'get', 'class'=>'form-horizontal']) !!}
                        <div class="input-daterange" id="datepicker">
                            <div class="col-md-3">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    @php
                                    $start = isset($data['start'])?$data['start']:null;
                                    @endphp
                                    {{-- <input type="text" class="form-control"  name="start" placeholder="DD-MM-YYYY"> --}}
                                    {{ Form::text('start',$start, ['id'=>'start','class' => 'form-control','placeholder'=>'DD-MM-YYYY', 'required','readonly']) }}
                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">End Date</label>
                                <div class="input-group">
                                    @php
                                    $end = isset($data['end'])?$data['end']:null;
                                    
                                    @endphp
                                    {{-- <input type="text" class="form-control" name="end" placeholder="DD-MM-YYYY"> --}}
                                    {{ Form::text('end',$end, ['id'=>'end','class' => 'form-control','placeholder'=>'DD-MM-YYYY', 'required','readonly']) }}
                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                        </div>
                                @php
                                $daysLeft = isset($data['daysLeft'])?$data['daysLeft']:null;
                                @endphp
                        {{-- <div class="col-md-2">
                            <label class="control-label">Days Left</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="days_left" placeholder="Days Left">
                                {{ Form::text('days_left',$daysLeft, ['class' => 'form-control','placeholder'=>'Days Left']) }}
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <label class="control-label invisible">.</label>
                            <div class="input-group">
                                <button class="btn btn-info">Search</button>
                                @if(isset($data['start']))
                                <a href="{{ route('projects.index') }}">
                                <button type="button" class="btn btn-info m-l-15">Clear</button>
                                </a>
                                @endif
                            </div>
                        </div>

                        
                    {{ Form::close() }}
                </div>
                <br>
                <hr>
                @if( count($data['projects']) != 0)
                
                <div class="table-responsive">
                    <table id="projects-table" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Goal</th>
                                <th class="text-center">Target</th>
                                <th class="text-center">Funded</th>
                                {{-- <th>Donators</th> --}}
                                {{-- <th>Completion(%)</th> --}}
                                <th class="text-center" id="days-left">Days Left</th>
                                <th class="text-center" id="days-left">Recurring</th>
                                {{-- <th id="days-left">Recurring Days</th> --}}
                                <th>Status</th>
                                <th>Home Project</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['projects'] as $project)
                            @if($daysLeft == null || now()->diffInDays($project['end_date']) == $daysLeft)
                            <tr>
                                <td>{{ $project['title'] }}</td>
                                <td class="text-center">{{ $project['goal'] }}</td>
                                <td class="text-center">{{ $project['target'] }}</td>
                                <td class="text-center">{{ $project['interval'][0]['funded'] ?? $project['funded'] }}</td>
                                {{-- <td></td> --}}
                                @php 
                                    $dayleftcount = '';
                                    $project_end_date = $project['interval'][0]['end_date'] ?? $project['end_date'];
                                                                    
                                    $now = date("d-m-Y");
                                 
                                    $datetime1 = date_create($now);

                                    $datetime2 = date_create($project_end_date);

                                    $interval = date_diff($datetime1, $datetime2);
                                    
                                    $signed_days = $interval->format('%R%a');

                                    $adjust_date = (int)$signed_days + 1;

                                    if($adjust_date <= 0)
                                        $dayleftcount = 'Ended';
                                    else 
                                        $dayleftcount = $adjust_date.' days';
                                @endphp
                                {{-- <td class="text-center">{{ number_format($completion, 2, '.', '') }}%</td> --}}
                                <td class="text-center">
                                {{$dayleftcount}}                                
                                 <?php
                                       
                                ?>
                            </td>
                                <td class="text-center">{{ $project['recurring_days'] == 0? 'No':'Yes'}}</td>
                                {{-- <td class="text-center">{{ $project['recurring_days'] == 0? 'NA':$project['recurring_days']}}</td> --}}
                                <td>
                                    @php $status = $project['status'] == 1?'checked':null; @endphp
                                    @if(Auth::user()->role_id != 2)
                                    @can('permission','6')

                                            @if(!empty($project['user']) )
                                            <center>
                                                <input data-size="small" type="checkbox" {{ $status }} class="js-switch" data-color="#99d683"
                                                data-id="{{ $project['id'] }}" onchange="myFunction(this)" />
                                            </center>
                                            @else
                                            NGO Deleted!
                                            @endif

                                    @endcan
                                    @else
                                    {{-- @if(Auth::user()->can('permission','5') && !Auth::user()->can('permission','6')) --}}
                                    {{ $project['status'] == 1? "Activated":"Pending" }}
                                    {{-- @endif --}}
                                    @endif

                                </td>
                                {{-- Here home project status --}}
                                <td>
                                    @php $home_status = $project['display_on_home_status'] == 1?'checked':null; @endphp
                                    @if(Auth::user()->role_id != 2)
                                    @can('permission','6')

                                            @if(!empty($project['user']) )
                                            <center>
                                                <input data-size="small" type="checkbox" {{ $home_status }} class="js-switch display_on_home_status_chk" data-color="#99d683"
                                                data-id="{{ $project['id'] }}" onchange="changeDisplayOnHomeStatus(this)" />
                                            </center>
                                            @else
                                            NGO Deleted!
                                            @endif

                                    @endcan
                                    @else
                                    {{-- @if(Auth::user()->can('permission','5') && !Auth::user()->can('permission','6')) --}}
                                    {{ $project['display_on_home_status'] == 1? "Activated":"Pending" }}
                                    {{-- @endif --}}
                                    @endif

                                </td>
                                {{-- End --}}
                                <td>
                                    
                                    <a href="{{ route('projects.show',['id'=> $project['id'] ]) }}">
                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"><i class="ti-eye"></i></button></a>
                                    
                                    @if( ($project['status'] == 0 && Auth::user()->role_id == 2) || Auth::user()->role_id == 1 ||
                                    Auth::user()->can('permission','6'))
                                    <a href="{{ route('projects.edit',['id'=> $project['id'] ]) }}">

                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-pencil-alt"></i></button></a>
                                    @endif
                                    @if( ($project['status'] == 0 && Auth::user()->role_id == 2) || Auth::user()->role_id == 1 ||
                                    Auth::user()->can('permission','6'))
                                    <a href="{{ route('projects.fund',['id'=> $project['id'] ]) }}">

                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-money"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        
                        
                    </table>
                </div>
                @else
                <h3 class="text-center">No Projects Found!</h3>
                @endif

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
@endsection
@section('bottom-script')
<script>


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

function myFunction(project){

var data = {
status: project.checked,
id: project.getAttribute("data-id")
};
$.ajax({
url: '{{ route('projects.status') }}',
type: 'POST',
data: data,
success: function(res){
},
error:function(res){

// console.log(res);
}
});
}

function changeDisplayOnHomeStatus(project){

var data = {
display_on_home_status: project.checked,
id: project.getAttribute("data-id")
};
$.ajax({
url: '{{ route('projects.home_status') }}',
type: 'POST',
data: data,
success: function(res){
    changeSwitch(".display_on_home_status_chk",false);
    changeSwitch(project,true);
},
error:function(res){

// console.log(res);
}
});
}

function changeSwitch(switch_id,active) {
    var check = $(switch_id); //document.querySelector(switch_id);
    //console.log("check",switch_id,check.checked,"to",active);
    if (active){
        var c = $(check).next('span').attr("class").replace("switchery ","");
        var l = {"switchery-large":"26px","switchery-small":"13px","switchery-default":"20px"}; 
        $(check).prop("checked",true).next('span').attr("style","box-shadow: rgb(153, 214, 131) 0px 0px 0px 16px inset; border-color: rgb(153, 214, 131); background-color: rgb(153, 214, 131); transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;").find('small').attr("style","left: "+l[c]+"; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);");
    }else if (!active){
        $(check).prop("checked",false).next('span').attr("style","box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;").find('small').attr("style","left: 0px; transition: background-color 0.4s, left 0.2s;");
    }
}

$(document).ready(function() {
// DatePicker
// jQuery('.mydatepicker, #datepicker').datepicker();
/*
================================
Active Deactive Status
================================
*/
// Range Selector
$('#datepicker').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy',
clearBtn: true
});

$('.input-group-addon').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy',
clearBtn: true
});

$('#datepicker').datepicker()
    .on('hide', function(e) {
        $('#start, #end').blur();
        // `e` here contains the extra attributes
});

var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
$('.js-switch').each(function() {
new Switchery($(this)[0], $(this).data());
});
/*$(function() {
$('#projects-table').DataTable({
processing: true,
serverSide: true,
ajax: {
url: '{{ url('admin/projects') }}',
type: 'post'
},
columns: [
{ data: 'title', name: 'Title' },
{ data: 'goal', name: 'Goal' },
{ data: 'funded', name: 'Funded' },
{ data: 'days_left', name: 'Days Left' },
{ data: 'start_date', name: 'Start Date' },
{ data: 'end_date', name: 'End Date' },
{ data: 'status', name: 'Status' },
{ data: 'action', name: 'Action' },
],
});
});*/
/*var table = $('#example').DataTable({
"columnDefs": [{
"visible": false,
"targets": 2
}],
"order": [
[2, 'asc']
],
"displayLength": 25,
"drawCallback": function(settings) {
var api = this.api();
var rows = api.rows({
page: 'current'
}).nodes();
var last = null;
api.column(2, {
page: 'current'
}).data().each(function(group, i) {
if (last !== group) {
$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
last = group;
}
});
}
});*/
// Order by the grouping
$('#example tbody').on('click', 'tr.group', function() {
var currentOrder = table.order()[0];
if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
table.order([2, 'desc']).draw();
} else {
table.order([2, 'asc']).draw();
}
});
});
// $('#projects-table thead tr').clone(true).appendTo( '#projects-table thead' );
$('#projects-table days-left tr').clone(true).appendTo('#projects-table thead');
$('#projects-table thead tr:eq(1) th').each(function(i) {
var title = $(this).text();
$(this).html('<input type="text" placeholder="Search ' + title + '" />');
$('input', this).on('keyup change', function() {
if (table.column(i).search() !== this.value) {
table
.column(i)
.search(this.value)
.draw();
}
});
});
var table = $('#projects-table').DataTable({
dom: 'Bfrtip',
buttons: [{
    extend: 'collection',
    text: 'Export',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ]
}

],
extend: 'collection',
"order":[[3,'desc']]

});


$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
</script>
@endsection