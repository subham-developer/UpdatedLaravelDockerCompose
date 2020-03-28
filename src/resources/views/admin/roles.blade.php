@extends('admin.admin_master')
@section('css')
<style type="text/css">
    .text-normal{
        font-weight: normal;
    }
    input[type='search']{
        border: 1px solid #000!important;
    }
</style>
@endsection
@section('body')
<!-- Modal -->
<div id="app">
<div id="updateRoleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Role</h4>
      </div>
      <div class="modal-body">
        <div id="roleUpdate">
            
        </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Update</button>
      </div> --}}
    </div>

  </div>
</div>
{{-- // Modal --}}
<!-- Modal -->
<div id="createRoleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Role</h4>
      </div>
      <div class="modal-body">
        <div id="errors">
            
        <div class="alert alert-danger" v-if='errors'>
            <ul>
                <li v-for='error in errors'>
                    @{{ error[0] }}
                </li>
            </ul>
        </div>
        </div>
        <form id="roleForm">
                    <div class="form-group">
                        <label>Role:</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-md-4">Donor:</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="1"> Read-only</label>
                        <label class="col-md-4 col-xs-6" ><input type="checkbox" name="permission_id[]" value="2"> Read-write</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-12">NGO:</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="3"> Read-only</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="4"> Read-write</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-12">Project:</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="5"> Read-only</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="6"> Read-write</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-12">Accounts:</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="7"> Read-only</label>
                        <label class="col-md-4 col-xs-6"><input type="checkbox" name="permission_id[]" value="8"> Read-write</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Update</button>
      </div> --}}
    </div>

  </div>
</div>
{{-- // Modal --}}

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Starter Page</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            <a href="" class="btn btn-info pull-right m-l-20 waves-effect waves-light" data-toggle="modal" data-target="#createRoleModal">Add Role</a>
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Dashboard</li>
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
    </div>
    <div class="row">
        {{-- <div class="col-md-6">
            <div class="white-box">
                <h3>Add Role</h3>
                <form id="roleForm">
                    <div class="form-group">
                        <label>Role:</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Donor:</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="1"> Read-only</label>
                        <label class="col-md-4" ><input type="checkbox" name="permission_id[]" value="2"> Read-write</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">NGO:</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="3"> Read-only</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="4"> Read-write</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Project:</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="5"> Read-only</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="6"> Read-write</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Accounts:</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="7"> Read-only</label>
                        <label class="col-md-4"><input type="checkbox" name="permission_id[]" value="8"> Read-write</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div> --}}
        
        <div class="col-md-12">
            <div class="white-box">
                    
                <div class="table-responsive">
                    <table class="block nowrap" id="roleTable">
                        <thead>
                            <th>Role</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody>
                            @foreach($data['roles'] as $role)
                            <tr>
                                <td>{{ $role['name'] }}</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit" data-toggle="modal" data-target="#updateRoleModal" data-id="{{ $role['id'] }}" onclick="updateRoleModal(this)">
                                        <i class="ti-pencil-alt"></i>
                                    </button>
                                    <button  type="button" data-id="{{$role['id']}}" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Delete" onclick="deleteRole(this)"><i class="ti-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
</div>
@endsection
@section('bottom-script')
<script type="text/javascript">

vm = new Vue({
    el: '#app',
    data:{
        errors: null,
        
    }
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#roleTable').DataTable({
    order:[]
});

$("#roleForm").submit(function(e) {
    e.preventDefault();
    swal({
                title: 'Processing...',
                text: 'Please wait!',
                showConfirmButton: false 
            });
    var data = $('#roleForm').serialize();
    $.ajax({
        url: '{{ route('roles.store') }}',
        type: 'POST',
        data: data,
        success: function(res) {
            location.reload();
        },
        error: function(res){
            vm.errors = res.responseJSON.errors;
            swal.close();
        }

    });
});

function updateRoleModal(e) {
    var id = e.getAttribute('data-id');

    $.ajax({
        url: 'roles/'+id+'/edit',
        type: 'GET',
        success: function(res){
            $('#roleUpdate').html(res);
        }
    });
}

function deleteRole(e) {
    var id = e.getAttribute('data-id');

    swal({
        title: "Are you sure?",
        text: "You want to delete role!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Processing...',
                text: 'Please wait!',
                showConfirmButton: false 
            });
            $.ajax({
                url: '{{ route('roles.index') }}/' + id,
                type: 'DELETE',
                success: function(res) {
                    location.reload();
                }
            });
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