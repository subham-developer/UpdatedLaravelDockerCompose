@extends('admin.admin_master')
@section('css')
<style type="text/css">
input[type='search']{
        border: 1px solid #000!important;
    }
</style>
@endsection
@section('body')
<div id="createRoleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="clearForm()">&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
                {!! Form::open(['id'=>'createEditorForm']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">name:</label>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">Role:</label>
                        {{ Form::select('role_id', $data['roles'], null, ['placeholder' => 'Select Role...','class'=>'form-control']) }}
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">Email address:</label>
                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Mobile:</label>
                        {!! Form::text('mobile',null, ['class'=>'form-control','maxlength'=>10]) !!}
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Password:</label>
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
                {!! Form::close() !!}
                <br>
            <div id="errors" v-if="errors">
                <div class="alert alert-danger">
                    <ul>
                        <li v-for="error in errors">
                            @{{ error[0] }}
                        </li>
                    </ul>
                </div>
            </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> --}}
    </div>

  </div>
</div>

<div id="editUserModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
                {!! Form::open(['id'=>'updateEditorForm','v-on:submit.prevent="updateUser"']) !!}
                <input type="hidden" name="id" v-model="user.id">
                <div class="row">
                    {{-- @{{ user }} --}}
                    <div class="col-md-6">
                        <div class="form-group">

                        <label for="email">name:</label>
                        {!! Form::text('name', null, ['class'=>'form-control','v-model="user.name"']) !!}
                        
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">Role:</label>
                        {{ Form::select('role_id', $data['roles'], null, ['v-model="user.role"','placeholder' => 'Select Role...','class'=>'form-control']) }}
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">Email address:</label>
                        {!! Form::email('email', null, ['v-model="user.email"','class'=>'form-control']) !!}
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Mobile:</label>
                        {!! Form::text('mobile',null, ['v-model="user.mobile"','class'=>'form-control','maxlength'=>10]) !!}
                    </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-info">Submit</button>
                {!! Form::close() !!}
                <br>
            <div v-if="updateErrors">
                <div class="alert alert-danger">
                    <ul>
                        <li v-for="error in updateErrors">
                            @{{ error[0] }}
                        </li>
                    </ul>
                </div>
            </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> --}}
    </div>

  </div>
</div>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Starter Page</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" data-toggle='modal' data-target="#createRoleModal" onclick="clearForm()">Add User</a>
            
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                <table id="editors" class="display nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['users'] as $user)
                        <tr>
                            <td>{{ $user['name'] }}</td>
                            <td class="text-center">{{ $user->role['name'] }}</td>
                            <td class="text-center">{{ $user['email'] }}</td>
                            <td class="text-center">{{ $user['mobile'] }}</td>
                            <td class="text-right">
                                {{-- <a href="{{ route('editors.edit',$user['id']) }}"> --}}
                                @php
                                    $userDetails['id'] = $user['id']; 
                                    $userDetails['name'] = $user['name']; 
                                    $userDetails['email'] =  $user['email'];
                                    $userDetails['mobile'] =  $user['mobile'];
                                    $userDetails['role'] =  $user['role']['id'];
                                @endphp
                                <button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Edit" data-toggle="modal" 
                                data-target="#editUserModal" data-user="{{ json_encode($userDetails,JSON_FORCE_OBJECT) }}" 
                                onclick='user.user = {{ json_encode($userDetails,JSON_FORCE_OBJECT) }};'>

                                <i class="ti-pencil-alt"></i>
                                </button>
                                {{-- </a> --}}
                                <button  type="button" data-id="{{$user['id']}}" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" title="Delete" onclick="deleteUser(this)"><i class="ti-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


@endsection
@section('bottom-script')
<script type="text/javascript">

 $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$('#editors').DataTable({
    order:[]
});

function clearForm(){
    $('#createEditorForm input, #createEditorForm select').val(null);
     vm.errors = '';
}
$('#createEditorForm').submit(function(e){
    e.preventDefault();
    var data = $('#createEditorForm').serialize();

    $.ajax({
        url: '{{ route('editors.store') }}',
        type: 'POST',
        data: data,
        success: function(res) {
            // console.log(res);
            window.location.href = '{{route('editors.index')}}';
            // location.reload()
        },
        error: function(res){
            vm.errors = res.responseJSON.errors;
            // console.log(res);
        }
    });
});

vm = new Vue({
    el: '#errors',
    data:{
        errors:null,
    }
});

user = new Vue({
    el: '#editUserModal',
    data:{
        updateErrors:null,
        user:{
            id:null,
            name:null,
            email:null,
            mobile:null,
            role:null,
        }
    },
    methods:{
        updateUser: function(e){
            data = $('#updateEditorForm').serialize();
            id = this.user.id;
            $.ajax({
                url: '{{ route('editors.index') }}/'+id,
                type: 'PUT',
                data: data,
                success: function(res){
                    console.log(res);
                    window.location.href="{{ route('editors.index') }}";
                },
                error: function(res){
                    // this.updateErrors = res.responseJSON.errors;
                    user.updateErrors = res.responseJSON.errors;
                    // console.log(this.updateErrors);
                }
            });       
        }
    }

});


function editUser(e){
    var data = e.getAttribute('data-user');
    alert();
}


function deleteUser(e) {
    var id = e.getAttribute('data-id');

    swal({
        title: "Are you sure?",
        text: "You want to delete user!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: '{{route('editors.index') }}/'+id,
                type: 'DELETE',
                success: function(res) {
                    swal.close();
                    
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