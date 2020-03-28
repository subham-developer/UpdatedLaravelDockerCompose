@extends('admin.admin_master')

@section('css')
@endsection
<style>
    /*a.dt-button{*/
    /*    background: #41b3f9 !important;*/
    /*    color: #fff !important;*/
    /*    border: #41b3f9 !important;*/
    /*}*/
</style>

<style type="text/css">
      input[type='search']{
        border: 1px solid #000!important;
    }
</style>

@section('body')
                <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">List of all NGO</h4>
                            {{-- <p class="text-muted m-b-0 font-13"> Bootstrap Elements </p> --}}
                         </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">


                         <a href="{{ route('ngo.create') }}" class="btn btn-info pull-right m-l-20 waves-effect waves-light">Add NGO</a>
                        
                        {{-- <ol class="breadcrumb"> 
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">View NGO's</li>
                        </ol> --}}


                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">

                    <div class="col-md-12">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    </div>
                    
                    <div class="col-md-12">
                        

                        <div class="white-box">
                            {{-- <h3 class="box-title m-b-0">List of all NGO</h3>
                            <p class="text-muted m-b-30 font-13"> Bootstrap Elements </p> --}}
                            @if(count($data['ngo']) != 0)
                            <div class="table-responsive">
                                <table id="ngo-table" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Pending</th>
                                            <th class="text-center">Active</th>
                                            {{-- <th>Fullfilled</th> --}}
                                            {{-- <th>P Fullfilled</th> --}}
                                            {{-- <th>Unfullfilled</th> --}}
                                            <th class="text-center">Action Required</th>
{{--                                            <th class="text-center">Is KYC</th>--}}
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($data['ngo'] as $ngo)
{{--                                            <pre> {{ (int)$ngo['is_kyc'] }}--}}
                                        <tr>
                                            <td>{{ $ngo['name'] }}</td>
                                            <td class="text-center">{{ $data['projectCounts'][$loop->index]['pending']}}</td>
                                            {{-- <td class="text-center">{{ $ngo['ngo']['registration_date'] }}</td> --}}
                                            <td class="text-center">{{ $data['projectCounts'][$loop->index]['active']}}</td>
                                            {{-- <td class="text-center">{{ $data['projectCounts'][$loop->index]['fullfilled']}}</td> --}}
                                            {{-- <td class="text-center">{{ $data['projectCounts'][$loop->index]['partialFullfilled']}}</td> --}}
                                            {{-- <td></td> --}}
                                            <td class="text-center">{{ $data['projectCounts'][$loop->index]['actionRequired']}}</td>
                                            <td class="text-center">


                                                <a href="{{route('ngo.show',['id'=>$ngo['id']])}}" style="display: inline;"><button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="View"><i class="ti-eye"></i></button></a>
                                                @can('permission','4')

                                                <a href="{{route('ngo.edit',['id'=>$ngo['id']])}}" style="display: inline;">
                                                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit"><i class="ti-pencil-alt"></i></button></a>

                                                <a href="{{route('projects.create',['id'=>$ngo['id']])}}" style="display: inline;">
                                                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Add Project"><i class="ti-plus"></i></button></a>
                                                
                                                {{ Form::open(['route'=>['ngo.destroy',$ngo['id']],'method'=>'delete', 'id'=>'destroy-ngo','onsubmit'=>'return destroyNgo()', 'style'=>"display: inline;"]) }}

                                                    <button  type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Delete" onclick="confirmation(this)"><i class="ti-trash"></i></button>

                                                {{ Form::close() }}
                                                @endcan

                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h3 class="text-center">No NGO Found!</h3>
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
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
        
@endsection

@section('bottom-script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        // $('#myTable').DataTable();
        $(document).ready(function() {

        /*$(function() {
            $('#ngo-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ url('admin/ngo') }}',
                    type: 'post'
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'registration_date', name: 'Registration Date' },
                    { data: 'registration_number', name: 'Registration Number' },
                    { data: 'email', name: 'Email Id' },
                    { data: 'mobile', name: 'Mobile' },
                    { data: 'action', name: 'Action' },
                ]
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
            /*$('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });*/
        });
    });
    $('#ngo-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print' ],
                className: 'btn btn-info'
            }
        ],
        "order":[]
    });


    function destroyNgo(){
        return confirm("Are you sure you want delete!");
    }

    function confirmation(e) {
        // console.log(e.form);
        swal({   
            title: "Are you sure?",   
            text: "You want to delete NGO!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes!",   
            cancelButtonText: "No!",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){   
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