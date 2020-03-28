@extends('admin.admin_master')
@section('css')
<style type="text/css">
hr {
border: 0;
clear:both;
display:block;
width: 96%;
background-color:#000000;
height: 1px;
}

#NGOdetails td,#NGOdetails th{
    text-align: left;
}
th, td{
    text-align: center;
}

</style>
@endsection
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">{{ $data['ngo']['name'] }}</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">NGO Detail</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
{{--                            @if (session('success'))--}}
{{--                                <div class="alert alert-success">--}}
{{--                                    {{ session('success') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>

                        <ul class="nav nav-pills m-b-30 ">
                            <li class="active"> <a href="#navpills-1" data-toggle="tab" aria-expanded="false">Details</a> </li>
                            <li class=""> <a href="#navpills-2" data-toggle="tab" aria-expanded="false">Projects</a> </li>
                            
                        </ul>
                        <div class="tab-content br-n pn">
                            <div id="navpills-1" class="tab-pane active">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                        <label>Logo</label>
                                        <div class="form-group">
                                            @php
                                                $image = $data['ngo']['profile_image'] == null?'NGO.jpg':$data['ngo']['profile_image'];
                                               //print_r($image); exit;
                                            @endphp
                                            <img src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                        <label> Pan Card</label>
                                        <div class="form-group">
                                            @php
                                                $image = $data['ngo']['ngo']['pancard'] == null?'no-image.png':$data['ngo']['ngo']['pancard'];
                                            @endphp
{{--                                            <img src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">--}}
                                            <a style="display: inline-block" href="{{asset('uploads').'/'.$image}}" target="_blank" class="img-responsive" title="Sample title">
                                          <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-12">
                                        <label>Charity Registration Certificate</label>
                                        <div class="form-group">
                                            @php
                                                $image = $data['ngo']['ngo']['charity_registration_certificate'] == null?'no-image.png':$data['ngo']['ngo']['charity_registration_certificate'];
                                            @endphp
{{--                                            <img src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">--}}
                                            <a href="{{asset('uploads').'/'.$image}}" target="_blank" class="img-responsive" title="Sample title">
                                                <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-12">
                                        <label>Dead</label>
                                        <div class="form-group">
                                            @php
                                                $image = $data['ngo']['ngo']['dead'] == null?'no-image.png':$data['ngo']['ngo']['dead'];
                                            @endphp
{{--                                            <img src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">--}}
                                            <a href="{{asset('uploads').'/'.$image}}" target="_blank" class="img-responsive" title="Sample title">
                                                <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">
                                            </a>

                                        </div>
                                    </div>

                                    <div class="col-sm-3 col-xs-12">

                                        <label>Certificate</label>
                                        <div class="form-group">
                                            @php
                                                $image = $data['ngo']['ngo']['certificate'] == null?'no-image.png':$data['ngo']['ngo']['certificate'];
                                            @endphp
{{--                      <img src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">--}}
                        <a href="{{asset('uploads').'/'.$image}}" target="_blank" class="img-responsive" title="Sample title">
                            <embed style="pointer-events: none" src="{{asset('uploads').'/'.$image}}" alt="user" class="img-responsive">
                        </a>

                                        </div>
                                    </div>

                                    <div class="col-sm-8 col-xs-12">
                                            <table class="table table-condensed" id="NGOdetails">
                                                
                                                <tbody>
                                                    <tr>
                                                        <th>NGO Name</th>
                                                        <td>{{ $data['ngo']['name'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>{{ $data['ngo']['ngo']['address'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>{{$data['ngo']['email'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mobile</th>
                                                        <td>{{$data['ngo']['mobile'] }}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>Landline</th>
                                                        <td>{{ $data['ngo']['ngo']['landline'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Registration Date</th>
                                                        <td>{{ $data['ngo']['ngo']['registration_date'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Registration Number</th>
                                                        <td>{{ $data['ngo']['ngo']['registration_number'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    
                                                    
                                                    
                                                    
                                                </tbody>
                                            </table>

                                            @if(count($data['ngo']['ngo']['contacts']) != 0)
                                            <h4>Contacts:</h4>
                                            <div style="overflow-x: scroll;">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['ngo']['ngo']['contacts'] as $contact)

                                                    <tr>
                                                        <td>{{ $contact->name }}</td>
                                                        <td>{{ $contact->designation }}</td>
                                                        <td>{{ $contact->email }}</td>
                                                        <td>{{ $contact->contact }}</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            </div>
                                            @endif


                                            @if(count($data['ngo']['ngo']['bank_details']) != 0)
                                            <h4>Bank Details:</h4>
                                            <div style="overflow-x: scroll;">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Account</th>
                                                    <th>Beneficiary Name</th>
                                                    <th>IFSC</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['ngo']['ngo']['bank_details'] as $bank_details)

                                                    <tr>
                                                        <td>{{ $bank_details->bank_name }}</td>
                                                        <td>{{ $bank_details->account_number }}</td>
                                                        <td>{{ $bank_details->beneficiary_name }}</td>
                                                        <td>{{ $bank_details->ifsc }}</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            </div>
                                            @endif
                                            <br>

                                    <!-- Form Start Here-->
                                        {!! Form::open(['id' => 'kyc-update-form','files'=>true, 'name'=>'add-kyc']) !!}
                                        <div class="row">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="col-md-6">
                                                <div style="width: 150px;">
                                                    <label>Is KYC</label>
                                                    @php
                                                        $kyc = $data['ngo']['ngo']['is_kyc'];
                                                       // print_r($kyc);
                                                    @endphp

                                                    {{ Form::checkbox('is_kyc',1, $kyc, array('id'=>'asap')) }}
                                                    {{ Form::hidden('id', $data['ngo']['ngo']['id'], array('id' => 'invisible_id')) }}


                                                </div>
                                                <br>
                                                <div class="alert alert-danger" id="errors" style="display: none;">
                                                    <ul>

                                                    </ul>
                                                </div>
                                            </div>
                                            <button class="btn btn-success waves-effect waves-light m-r-10" id="submit">Submit</button>
                                            <img src="{{ asset('images/admin/loader.gif') }}" id="loader" style="visibility: hidden;">

                                        </div>
                                    {!! Form::close() !!}
                                    <!-- Form End Here-->
                                    </div>
                                </div>
                            </div>


                            <div id="navpills-2" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12">

                                        @if(count($data['projects']) != 0)
                                        <div style="overflow-x: scroll;">
                                        <table class="table table-responsive">
                                            <thead>
                                                <th>Pending</th>
                                                <th>Active</th>
                                                <th>Fullfilled</th>
                                                <th>Partial Fullfilled</th>
                                                <th>Unfullfilled</th>
                                                <th>Action Require</th>
                                            </thead>
                                            <tbody>
                                                <td>{{ $data['projectCounts']['pending'] }}</td>
                                                <td>{{ $data['projectCounts']['active'] }}</td>
                                                <td>{{ $data['projectCounts']['fullfilled'] }}</td>
                                                <td>{{ $data['projectCounts']['partialFullfilled'] }}</td>
                                                <td></td>
                                                <td>{{ $data['projectCounts']['actionRequired'] }}</td>
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="projects-table" class="display nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Goal</th>
                                                        <th>Funded</th>
                                                        <th id="days-left">Days Left</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['projects'] as $project)
                                                    <tr>
                                                        <td>{{ $project['title'] }}</td>
                                                        <td class="text-center">{{ $project['goal'] }}</td>
                                                        <td class="text-center">{{ $project['funded'] }}</td>
                                                        <td class="text-center">
                                                           {{--  {{ now()->diffInDays($project['end_date']) }} --}}

                                                            <?php
                                                                    $project_end_date = $project['end_date'];
                                                                    
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

                                                        </td>
                                                        <td class="text-center">{{ date_format(date_create($project->start_date),'d-m-Y') }}</td>
                                                        <td class="text-center">{{ date_format(date_create($project->end_date),'d-m-Y') }}</td>
                                                        <td>
                                                            @php $status = $project['status'] == 1?'checked':null; @endphp
                                                            
                                                            @if(Auth::user()->can('permission','6'))
                                                            <input data-size="small" type="checkbox" {{ $status }} class="js-switch" data-color="#99d683" data-id="{{ $project['id'] }}" onchange="myFunction(this)" />
                                                            @else
                                                            {{ $project['status'] == 1? 'Approved':'Pending' }}
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ route('projects.show',['id'=> $project['id'] ]) }}">
                                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"><i class="ti-eye"></i></button></a>
                                                            <a href="{{ route('projects.edit',['id'=> $project['id'] ]) }}">
                                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-pencil-alt"></i></button></a>
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
 {{--
 ===================================
 Modal
 ===================================
 --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel">Poject Title | <small>View All Dates</small></h4> </div>
            <div class="modal-body">
                <div class="col-md-4">
                    <select aria-expanded="true" data-toggle="dropdown">
                        <option Value="">Select Month To View</option>
                        <option Value="">January</option>
                        <option Value="">February</option>
                        <option Value="">March</option>
                        <option Value="">April</option>
                        <option Value="">May</option>
                        <option Value="">June</option>
                        <option Value="">July</option>
                        <option Value="">August</option>
                        <option Value="">Septempber</option>
                        <option Value="">October</option>
                        <option Value="">November</option>
                        <option Value="">December</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <button class="btn btn-info">Search</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Dates</th>
                                
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>0000000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            {{-- </div> --}}
        </div>
        <hr>
        <div class="modal-footer" style="border-top:none;">
            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.container-fluid -->
@endsection
@section('bottom-script')
<script type="text/javascript">

    function myFunction(project) {
    var data = {
        status: project.checked,
        id: project.getAttribute("data-id")
    };
    $.ajax({
        url: '{{ route('projects.status') }}',
        type: 'POST',
        data: data,
        success: function(res) {
            console.log(res);
        },
        error: function(res) {
            console.log(res);
        }
    });
}

$(document).ready(function() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });


    // DataTable buttons
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

    $("#kyc-update-form").submit(function(e){
        e.preventDefault();
        $( "#loader" ).css('visibility', 'visible');
        var data = $('#kyc-update-form').serialize();
        var formData = new FormData(this);
        $.ajax({
            'type'  : 'POST',
            'url'   : "{{route('ngo.kyc_update')}}",
            'data'  : formData,
            contentType: false,
            processData: false,
            success : function(response){
                // alert('1');
                $( "#errors" ).css('display', 'none');
                {{--$("#ngoForm").find("input, textarea").val(null);--}}
                $( "#loader" ).css('visibility', 'hidden');

                swal({
                    title: "",
                    text: "KYC Updated Successfully!",
                    timer: 2000,
                    showConfirmButton: false
                });

{{--            {{ Request::session()->flash('success','KYC Updated Successfully!') }}--}}
{{--                    window.location.href='{{ route('ngo.index') }}';--}}
            },
            error : function(response){
                // alert('Error');
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
});
$('#projects-table').DataTable({
    dom: 'Bfrtip',
    buttons: [{
        extend: 'collection',
        text: 'Export',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    }]
});</script>



@endsection