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
            <h4 class="page-title">Completed Projects</h4>
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
                        
                </div>
                
                @if( count($data['projects']) != 0)
                
                <div class="table-responsive">
                    <table id="projects-table" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Goal</th>
                                <th class="text-center">Funded</th>
                                <th class="text-center">Paid</th>
                                <th class="text-center">Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['projects'] as $project)

                            <tr>
                                <td>{{ $project['project']['title'] }}</td>
                                <td class="text-center">{{ $project['start_date'].' To '.$project['end_date'] }}</td>
                                <td class="text-center">{{ $project['project']['target'] }}</td>
                                <td class="text-center">{{ $project['funded'] }}</td>
                                <td class="text-center">{{ $project['payments']->sum('amount') }}</td>
                              
                                
                                {{-- <td class="text-center">{{ $project['recurring_days'] == 0? 'NA':$project['recurring_days']}}</td> --}}
                                <td class="text-center">
                                    @if($project['funded'] == 0)
                                    {{ $project['funded'] == 0 ? 'NA':null }}
                                    @else
                                    {{ $project['fund_status']==0?'Action Required':null }}
                                    {{ $project['fund_status']==1?'Refunded':null }}
                                    @endif
                                    @php
                                    $fullPaid = false;
                                    if($project['fund_status']==2){
                                        if($project['payments']->sum('amount') >= round(($project['funded']*100)/114) ){
                                            $fullPaid = true;
                                            echo 'Full Paid';
                                        }else{
                                            echo 'Half Paid';
                                        }
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @if($project['funded'] == 0)
                                    <span style="float: right;">NA</span>
                                    @else
                                    @if($project['fund_status'] == 0 || ($project['fund_status'] != 1 && !$fullPaid) )
                                    <a href="{{ route('payments.create',['id'=> $project['id'] ]) }}" style="float: right;">
                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="transfer">
                                        <i class="ti-cloud-up"></i></button></a>
                                    @endif

                                    @if($project['funded'] < $project['project']['target'] && $project['fund_status'] == 0)
                                    {!! Form::open(['route'=>'donation_refund','style'=>'float:right']) !!}
                                    {!! Form::hidden('id', $project['id'], []) !!}
                                    <button type="submit" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Refund"><i class="ti-back-right"></i></button>
                                    {!! Form::close() !!}
                                    @endif

                                    @if($fullPaid)
                                    {!! Form::open(['route'=>'generate.receipts','style'=>'float:right']) !!}
                                    {!! Form::hidden('interval_id', $project['id'], []) !!}
                                    <button type="submit" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" 
                                    title="Receipt">
                                        <i class="ti-receipt"></i>
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
                                    @endif

                                </td>
                            </tr>
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

console.log(res);
}
});
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
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
$('.js-switch').each(function() {
new Switchery($(this)[0], $(this).data());
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
var table = $('#projects-table').DataTable();

$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
    
</script>
@endsection