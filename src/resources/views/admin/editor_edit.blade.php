@extends('admin.admin_master')
@section('css')
@endsection
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Add User</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            <ol class="breadcrumb">
                <!-- <li><a href="#">Dashboard</a></li> -->
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="white-box">
                {!! Form::model($data['user'],['id'=>'editorUpdate']) !!}
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
                    <div class="col-md-12">
                    <div class="form-group">
                        <label>Password:</label>
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">Update</button>
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
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#editorUpdate').submit(function(e){
        e.preventDefault();
        var data = $('#editorUpdate').serialize();
        $.ajax({
            url: '{{ route('editors.update',['id'=>$data['user']]) }}',
            type: 'PUT',
            data: data,
            success: function(res) {
                // console.log(res);
                window.location.href = '{{route('editors.index')}}';
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
</script>
@endsection