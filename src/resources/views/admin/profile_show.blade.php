@extends('admin.admin_master')
@section('css')
@endsection
@section('body')
<!-- Modal update-->
<div id="updateProfile" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Update Profile Image</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['route'=>'users.update_image', 'method'=>'put', 'files'=>true]) }}
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            
            {{ Form::file('profile',['id'=>'input-file-now','class'=>'dropify','data-height'=>'100','required']) }}
            <br>
            <center><button class="btn btn-primary">Update</button></center>
          </div>
        </div>
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- // update modal --}}
<div class="container-fluid">
  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">My Profile</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        {{-- <ol class="breadcrumb">
          <li><a href="#">Dashboard</a></li>
          <li class="active">Your Profile</li>
        </ol> --}}
      </div>
    </div>
    <!-- /.row -->
    <!-- .row -->
    
    <div class="row white-box">
      <div class="col-md-3 col-xs-12">
        <div class="white-box p-b-0">
          @php
          $image = $data['user']['profile_image'] == null?'no-image.png':$data['user']['profile_image'];
          @endphp
          <img src="{{ asset('uploads').'/'.$image }}" class="img-responsive img-circle" />
          
        </div>
      </div>
      <div class="col-md-9 col-xs-12">
        
        
        <div class="white-box">
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          <table class="table table-responsive">
            <tr>
              <th>Name</th>
              <td>{{ $data['user']['name'] }}</td>
            </tr>
            <tr>
              <th>Mobile</th>
              <td>{{ $data['user']['mobile'] }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $data['user']['email'] }}</td>
            </tr>
            @if($data['user']['role_id'] != 2)
            <tr>
              <td></td>
              <td></td>
            </tr>
            @endif
            @if($data['user']['role_id'] == 2)
            <tr>
              <th>Landline</th>
              <td>{{ $data['user']['ngo']['landline'] }}</td>
            </tr>
            <tr>
              <th>Address</th>
              <td>{{ $data['user']['ngo']['address'] }}</td>
            </tr>
            <tr>
              <th>Registration Date</th>
              <td>{{ $data['user']['ngo']['registration_date'] }}</td>
            </tr>
            <tr>
              <th>Registration Number</th>
              <td>{{ $data['user']['ngo']['registration_number'] }}</td>
            </tr>
            @endif
          </table>
          @if($data['user']['role_id'] == 2)
          @if(count($data['contacts']))
          <h3>Contact Details:</h3>
          <table class="table table-hover">
            <thead>
              <th>Name</th>
              <th>Designation</th>
              <th>Email</th>
              <th>Number</th>
            </thead>
            <tbody>
              @foreach($data['contacts'] as $contact)
              <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->designation }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->contact }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
          @endif
          <a href="{{route('profile.edit')}}">
            <button class="btn btn-primary">Edit</button>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->
  @endsection
  @section('bottom-script')
  @endsection