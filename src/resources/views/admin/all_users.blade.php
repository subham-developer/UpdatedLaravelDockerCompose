@extends('admin.admin_master')
@section('css')
<style type="text/css">
thead th{
text-align: center;
}
</style>
@section('css')
<style type="text/css">
    
    
.table-responsive::-webkit-scrollbar {
    width: 1em;
}
 
.table-responsive::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
 
.table-responsive::-webkit-scrollbar-thumb {
  background-color: gray;
  outline: 1px solid gray;
}

input[type='search']{
    border: 1px solid #000!important;
}

</style>
@endsection
@endsection
@section('body')
<div id="app">
    <!-- user modal -->
    <div class="modal fade" id="user-details" role="dialog">
        <div class="modal-dialog modal-lg">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Donor Details</h4>
                </div>
                <div class="modal-body" style="max-height: 85vh;overflow-x: scroll;overflow-x: hidden;">
                    
                    <center><img src="{{ asset('images/admin/loader.gif') }}" id="loader"></center>
                    <div id="user"></div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
            
        </div>
    </div>
    {{-- // user modal --}}
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Donor Details</h4>
                {{-- <p class="text-muted m-b-0 font-13"> Bootstrap Elements </p> --}}
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
               <a href="{{ route('users.create') }}" class="btn btn-info pull-right m-l-20 waves-effect waves-light">Add Donor</a>
                
                {{-- <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">All Donors</li>
                </ol> --}}
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    @if(session('success'))
                    <div class = 'alert alert-success'>{{session('success')}}</div>
                    @endif
                    {{-- <h3 class="box-title m-b-0">List of all NGO</h3>
                    <p class="text-muted m-b-30 font-13"> Bootstrap Elements </p> --}}
                    @if( count($data['users']) != 0)
                    
                    <div class="table-responsive">
                        <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    {{-- <th>Email Id</th> --}}
                                    {{-- <th>Mobile</th> --}}
                                    <th>Donated</th>
                                    <th>Balance</th>
                                    <th>Projects</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if(!empty($data['users']))
                                @foreach( $data['users'] as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    {{-- <td>{{$user->email}}</td> --}}
                                    {{-- <td>{{$user->mobile}}</td> --}}
                                    <td class="text-center">{{ $user->donation->sum('amount_donated') }}</td>
                                    <td class="text-center">{{$user->balance}}</td>
                                    <td class="text-center">{{ count($user->donation->unique('project_id')) }}</td>
                                    <td align="center">
                                        
                                        <a data-id="{{ $user['id'] }}" onclick="userDetails(this)" href="#" style="display: inline;" data-toggle="modal" data-target="#user-details">
                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"
                                            style="display: inline;">
                                            <i class="ti-eye"></i>
                                            </button>
                                        </a>
                                        <a data-id="{{ $user['id'] }}" onclick="projects(this)" href="#" class="" data-toggle="modal" data-target="#user-details" style="display: inline;">
                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View">
                                            <i class="ti-book"></i>
                                            </button>
                                        </a>
                                        {{-- <a data-id="{{ $user['id'] }}" onclick="userDetails(this)" href="#" class="pull-left" data-toggle="modal" data-target="#user-details">
                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"><i class="ti-eye"></i></button>
                                        </a> --}}
                                        @can('permission','2')
                                        <a href="{{ route('users.edit',['id' => $user->id]) }}" style="display: inline;">
                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-pencil-alt"></i></button>
                                        </a>
                                        {!! Form::open(['route' => ['users.destroy',$user->id] , 'method' => 'DELETE','style'=>"display: inline;"]) !!}
                                        <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Delete" onclick="confirmation(this)"><i class="ti-trash"></i></button>
                                        {{form::close()}}
                                        @endcan
                                        
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                                
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h3 class="text-center">No Users Found!</h3>
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
    <!-- /.container-fluid -->
</div>
@endsection
@section('bottom-script')
<script>
    function userDetails(e){
        $('#modalTitle').html('Donor Details');
        $("#loader").show();
        $("#user").hide();
        var id = e.getAttribute('data-id');
        $.ajax({
            url: 'users/'+id,
            type:'GET',
            success: function(res){
                $("#loader").hide();
                $("#user").show();
                $("#user").html(res);
            }
        });
    }

    function projects(e){
        $('#modalTitle').html('Donation Details');
        $("#loader").show();
        $("#user").hide();
        var id = e.getAttribute('data-id');
        $.ajax({
            url: 'users/projects/'+id,
            type:'POST',
            success: function(res){
                $("#loader").hide();
                $("#user").show();
                $("#user").html(res);
            }
        });
    }

    

$(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [],
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
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        // action: function ( e, dt, node, config ) {
        //             //alert( 'Activated!' );
        //             this.disable(); // disable button
        //         }
    }],
    "order": []
});
/*function confirmation(){
return confirm("Are you sure, you want to delete the user?");
}*/
function confirmation(e) {
    // console.log(e.form);
    swal({
        title: "Are you sure?",
        text: "You want to delete donor!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            e.form.submit();
            // swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal.close();
            // swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
</script>
@endsection