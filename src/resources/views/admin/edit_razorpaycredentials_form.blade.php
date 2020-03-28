<?php
// echo "<pre>";
// print_r($all_razorpaydata);
// exit;
?>
@extends('admin.admin_master')

@section('body')

<div class="container-fluid">
  <div class="row bg-title">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <h4 class="page-title col-lg-8 col-md-8 col-sm-8 col-xs-8">
        Edit Razorpay Credentials
      </h4>

    </div>

    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            @if ($errors->any())
            <div class="alert alert-danger" style="text-transform: capitalize;">
              <ul>
                @foreach($errors->all() as $error)
                <li>
                  {{ $error }}
                </li>
                @endforeach
              </ul>
            </div>
            @endif
            {!! Form::open(['route' => ['razorpaycredentials.update', $all_razorpaydata[0]['id']], 'method' => 'PUT', 'files'=>true, 'id'=>'user-form','autocomplete'=>"off", 'role'=>'form', 'enctype'=>'multipart/form-data']) !!}
            <div class="row">
              {{-- <div class="col-md-4">
                <div style="width: 150px;">
                  {{ Form::file('profile',['id'=>'input-file-now','class'=>'dropify','data-height'=>'136']) }}
                </div>
                <br/>
                <br/>
              </div> --}}
            </div>
            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
              <div class="form-group">
                <label>
                  RAZORPAY KEY:
                </label>
                {{ Form::text('RAZORPAY_KEY',$all_razorpaydata[0]['RAZORPAY_KEY'], ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="col-sm-6 col-xs-12" style="padding-left: 1px !important;">
              <div class="form-group">
                <label>
                  RAZORPAY SECRET:
                </label>
                {{ Form::text('RAZORPAY_SECRET',$all_razorpaydata[0]['RAZORPAY_SECRET'], ['class' => 'form-control']) }}
              </div>
            </div>

            <div class="col-md-6" style="padding-left: 1px !important;">
              <div class="form-group">
                <label>
                  Status
                </label>
                <select name="status" class='form-control'>
                  <option value="1" <?php if($all_razorpaydata[0]['status']==1) echo "selected"; ?>>Enabled</option>                
                  <option value="0" <?php if($all_razorpaydata[0]['status']==0) echo "selected"; ?>>Disabled</option>                
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <button class="btn btn-success waves-effect waves-light m-r-10" type="submit">
                  Submit
                </button>
              </div>
            </div>

            {!! Form::close() !!}
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
@endsection
@section('bottom-script')
<script type="text/javascript">
  $(document).ready(function() {
    $('.dropify').dropify({
      messages: {
        default: 'Add Profile',
        replace: '',
        remove: 'X',
        error: ''
      }
    });

        // $('#user-form').parsley();
      });

  $( document ).ready(function() {
    $('input').attr('autocomplete','off');
  });
  $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
  });
</script>
@endsection