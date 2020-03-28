@extends('admin.admin_master')
@section('css')
<style type="text/css">
.user-bg{
height: auto;
}
strong{
    font-weight: 400;
}
</style>
@endsection
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Project Detail</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Dashboard</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills m-b-30 ">
                            <li class="active"> <a href="#navpills-1" data-toggle="tab" aria-expanded="false">Details</a> </li>
                            <li class=""> <a href="#navpills-2" data-toggle="tab" aria-expanded="false">Contributors</a> </li>
                            
                        </ul>
                        <div class="tab-content br-n pn">
                            <div id="navpills-1" class="tab-pane active">
                                <div class="row">
                                    
                                    <div class="col-md-4 col-xs-12">
                                        <div class="white-box">
                                            <div class="user-bg">
                                                {{-- <img width="100%" alt="user" src="{{asset('images/admin/large/img1.jpg')}}"> --}}
                                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                    <!-- Indicators -->
                                                    {{-- <ol class="carousel-indicators">
                                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                                    </ol> --}}
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        @foreach($data['project']['image'] as $image)
                                                        <div class="item {{ $loop->first?'active':null}}">
                                                            <img src="{{ asset('uploads') }}/{{ $image['name'] }}" alt="Los Angeles" style="height: 150px;">
                                                        </div>
                                                        @endforeach
                                                        
                                                        
                                                        
                                                    </div>
                                                    <!-- Left and right controls -->
                                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                        <span class="fa fa-angle-left"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                        <span class="fa fa-angle-right"></span>
                                                        {{-- <span class="glyphicon glyphicon-chevron-right"></span> --}}
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                <h1 class="page-title" style="font-size: 24px;line-height: normal;text-align: center;">{{ $data['project']['title'] }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="white-box">
                                            <ul class="nav nav-tabs tabs customtab">
                                                {{-- <li class="active tab">
                                                    <a href="#ngo_details" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">NGO Details</span> </a>
                                                </li> --}}
                                                <li class="active tab">
                                                    <a href="#pro_details" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Project Details</span> </a>
                                                </li>
                                                <li class="tab">
                                                    <a href="#dates" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Dates</span> </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane" id="ngo_details">
                                                    <table class="table table-condensed">
                                                        
                                                        <tbody>
                                                            <tr>
                                                                <th>Name</th>
                                                                <td>{{ $data['project']['user']['name'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td>{{ $data['project']['user']['email'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Mobile</th>
                                                                    <td>{{ $data['project']['user']['mobile'] }}</td>
                                                                </tr><tr>
                                                                <th>Landline</th>
                                                                <td>{{ $data['project']['user']['ngo']['landline'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td>{{ $data['project']['user']['ngo']['address'] }}</td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <div class="tab-pane active" id="pro_details">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if($data['project']['video_link'] != null)
                                                    {{-- <iframe class="col-md-12 pull-right" src="{{ $data['project']['video_link'] }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> --}}

                                                    <?php
                                                                $video_link = '';
                                                                $video_code = '';
                                                                $video_link = explode('/',$data['project']['video_link']);
                                                                $video_code = end($video_link);
                                                            ?>
                                                    <iframe class="col-md-12 pull-right" src="https://www.youtube.com/embed/<?php echo $video_code; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                    
                                                    @endif        
                                                        </div>
                                                    </div>
                                                    
                                                    <p class="m-t-30">
                                                        {{ $data['project']['description'] }}
                                                    </p>
                                                    @if($data['project']['long_description'] != null)
                                                    <b>About Project<br></b>
                                                    {!! $data['project']['long_description'] !!}
                                                    @endif
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th>Recurring</th>
                                                                <td>{{ $data['project']['recurring_days'] == 0? 'No':'Yes'}}</td>
                                                            </tr>
                                                            @if($data['project']['recurring_days'] != 0)
                                                            <tr>
                                                                <th>Recurring every after</th>
                                                                
                                                                <td>{{ $data['project']['recurring_days'] }} Days</td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    <h4 class="font-bold m-t-30">Goal</h4>
                                                    <hr>
                                                    <h5>Goal <span class="pull-right">{{ $data['project']['goal'] }} INR</span></h5>
                                                    {{-- <h5>Reached<span class="pull-right">90 INR</span></h5> --}}
                                                    {{-- <div class="progress">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">90% Complete</span> </div>
                                                    </div> --}}
                                                </div>
                                                <div class="tab-pane" id="dates">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Start Date</strong>
                                                            <br>
                                                            <p class="text-muted">{{ $data['project']['start_date'] }}</p>
                                                        </div>
                                                        <div class="col-md-3 col-xs-6 b-r"> <strong>End Date</strong>
                                                            <br>
                                                            <p class="text-muted">{{ $data['project']['end_date'] }}</p>
                                                        </div>
                                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Days Left</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                {{-- {{ now()->diffInDays($data['project']['end_date']) }} --}}
                                                                <?php
                                                                    $project_end_date = $data['project']['end_date'];
                                                                    
                                                                    $now = date("d-m-Y");
                                                                 
                                                                    $datetime1 = date_create($now);

                                                                    $datetime2 = date_create($project_end_date);

                                                                    $interval = date_diff($datetime1, $datetime2);
                                                                    
                                                                    $signed_days = $interval->format('%R%a');

                                                                    $adjust_date = (int)$signed_days + 1;

                                                                    if($adjust_date <= 0)
                                                                        echo 'Ended';
                                                                    else 
                                                                        echo $adjust_date.' days';
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table id="intervals-table" class="table display nowrap" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Date</th>
                                                                            <th class="text-center">Goal</th>
                                                                            <th class="text-center">Funded</th>
                                                                            <th class="text-center">Completion</th>
                                                                        </tr>
                                                                    </thead>
                                                                    
                                                                    <tbody>
                                                                        @foreach($data['intervals'] as $interval)
                                                                        @php
                                                                            $completion = ($interval['funded'] / $data['project']['target'] )*100;
                                                                        @endphp
                                                                        <tr>

                                                                            <td>{{ date('d-M-Y',strtotime($interval['start_date'])).' To '.date('d-M-Y',strtotime($interval['end_date'])) }}</td>
                                                                            <td class="text-center">{{ $data['project']['target'] }}</td>
                                                                            <td class="text-center">{{ $interval['funded'] }}</td>
                                                                            <td class="text-center">{{  number_format($completion, 2, '.', '') }}%</td>
                                                                        </tr>
                                                                        
                                                                        
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="navpills-2" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(count($data['contributors']) != 0)
                                        <div class="table-responsive">
                                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        {{-- <th>Email</th> --}}
                                                        {{-- <th>Mobile</th> --}}
                                                        <th class="text-center">Donated</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    @foreach($data['contributors'] as $contributor)
                                                    <tr>
                                                        <td>{{ $contributor['user']['name'] }}</td>
                                                        {{-- <td>John@gmail.com</td> --}}
                                                        {{-- <td>1234567899</td> --}}
                                                        <td class="text-center">{{ $data['donations']->where('user_id', $contributor['user_id'] )->sum('amount_donated') }}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <h3 class="text-center">No Contribution yet.</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>
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
<script type="text/javascript">
$('#registration-date').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd/mm/yyyy',
clearBtn: true
});
$(document).ready(function() {
// DataTable
$('#myTable').DataTable();
// DatePicker
// DataTable buttons
$(document).ready(function() {
var table = $('#example').DataTable({
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
});
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
});
$('#example23').DataTable({
dom: 'Bfrtip',
buttons: [{
    extend: 'collection',
    text: 'Export',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ]
}
]
});

var table = $('#intervals-table').DataTable({
dom: 'Bfrtip',
buttons: [{
    extend: 'collection',
    text: 'Export',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ]
}
],
"order":[]

});
</script>
@endsection