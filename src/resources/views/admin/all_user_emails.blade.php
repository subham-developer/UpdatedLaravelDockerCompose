<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
?>
@extends('admin.admin_master')
@section('css')
<style type="text/css">
  thead th{
    text-align: center;
  }

  img.img-responsive.img-circle {
    height: 100px;
    width: 100px;
    margin: 0 auto;
  }

  div#character_count {
    float: right;
    font-size: 14px;
    font-weight: 500;
  }

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

  #frm-example1{
    position: relative;
  }

  .email_body {
    margin-top: 30%;
  }

  form.donor_email_image_form {
    position: absolute;
    width: 100%;
    bottom: 37%;
    left: 5%;
  }

  .email_seperater {
    margin-top: 10px;
    margin-bottom: 10px;
  }

</style>
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
       <!-- <a href="{{ route('users.create') }}" class="btn btn-info pull-right m-l-20 waves-effect waves-light">Add Donor</a> -->

       {{-- <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="active">All Donors</li>
      </ol> --}}
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="{{route('admin.sendDonorEmails') }}" id="frm-example1" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @method('POST')
        @csrf
        <div class="white-box">
          @if(session('success'))
          <div class = 'alert alert-success'>{{session('success')}}</div>
          @endif

          @if( count($data['users']) != 0)

          <div class="table-responsive">
            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th style="background : none!important;">
                    <input type="checkbox" name='showhide' onchange="checkAll(this)">
                  </th>
                  <th class="text-left">Name</th>
                  <th>Email Id</th>
                  <th>Projects</th>
                  {{-- <th>Mobile</th> --}}
                  <th>Donated</th>
                </tr>
              </thead>

              <tbody>
                @if(!empty($data['users']))
                <?php $i=1; ?>
                @foreach($data['users'] as $user)
                <tr>
                  <td><input type="checkbox" onchange="addUser('check_{{$i}}');" name='check[]' id='check_{{$i}}' value="{{$user->email}} | {{$user->name}}"></td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  {{-- <td>{{$user->mobile}}</td> --}}
                  <td class="text-center">{{ $user->donation->sum('amount_donated') }}</td>
                  <td class="text-center">{{$user->balance}}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif
              </tbody>
            </table>
            <input type="text" id="hdn_val" name="all_user_emails">

            <div class="col-sm-12 col-xs-12">
              <div class="form-group">

                <label>Subject : </label>
                <?php 
                if (isset($data['donoremail'][0]['subject'])) { ?>
                  <input class="form-control" id="email_subject" name="email_subject" type="text" value="{{$data['donoremail'][0]['subject']}}">
                <?php }else{ ?>
                  {{ Form::text('email_subject','', ['class' => 'form-control','id'=>'email_subject']) }}
                <?php } ?>
              </div>
            </div>

            <div class="col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Dear : </label>
                {{ Form::text('title','First Name', ['class' => 'form-control', 'disabled','id'=>'title']) }}
              </div>
            </div>

            <div class="col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Broadcast email body : (Max 1000 char)</label>

                <!-- {{ Form::textarea('description','', ['class' => 'form-control', 'rows'=>10,'maxlength'=>1000, 'id'=>'mymce1']) }} -->
                <?php 
                if (isset($data['donoremail'][0]['email_body'])) { ?>
                  <textarea class="form-control" rows="10" maxlength="10" value="{{$data['donoremail'][0]['email_body']}}" id="mymce" name="description" cols="50">{{$data['donoremail'][0]['email_body']}}</textarea>
                <?php }else{ ?>
                  <textarea class="form-control" rows="10" maxlength="10" value="" id="mymce" name="description" cols="50"></textarea>                  
                <?php } ?>
                <div id="character_count"></div>


               <!--  <textarea class="textarea form-control" id="mymce1" rows="10" maxlength="1000" name="description">
                  <?php //if(isset($_POST['description'])) { 
                   //echo htmlentities ($_POST['description']); }?>
                 </textarea> -->

               </div>
             </div>


             <div class="col-sm-4 col-xs-4">    
              <div class="form-group">
                <label>Image : </label>
                <?php 
                if (isset($data['donoremail'][0]['image_name'])) { ?>
                  <img src="{{ asset('uploads').'/'.$data['donoremail'][0]['image_name'] }}" class="img-responsive img-circle" />
                  <input type="hidden" value="{{$data['donoremail'][0]['image_name']}}" name="hidden_email_image">
                  <div class="email_seperater">Or replace existing image by uploading new image</div>
                <?php }else{ ?>
                  {{ Form::file('email_image',['id'=>'input-file-now','class'=>'dropify','data-height'=>'100']) }}
                <?php } ?>

                {{ Form::file('email_image',['id'=>'input-file-now','class'=>'dropify','data-height'=>'100']) }}
                <br>
              </div>
            </div> 

            <div class="col-sm-12 col-xs-12">
              <div class="form-group">
               <button class="btn btn-success waves-effect waves-light" id="submitBtn" onclick="return ValidateCharacterLength();" >Send Emails</button>
             </div>
           </div> 


         </div>
         @else
         <h3 class="text-center">No Users Found!</h3>
         @endif
       </div>
       <!-- {{ Form::close() }} -->
     </form>

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
  $('#example23').DataTable({

    "lengthMenu": [[10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"]],

    'columnDefs': [{
      "targets": [0,1,2,3],
      "orderable": false
    }],

  });

  $("#submitBtn").on('click', function(){
    var numberOfChecked = $('input:checkbox:checked').length;
    if (numberOfChecked == 0) {
      alert("Please check atleast one donor");
      // alert($('#mymce1').val().trim().length);
      return false;
    }
    // else if( $('#mymce').val().trim().length == 0){
    //   alert("Please type something into email body");
    //   return false;
    // }
    if (confirm("You really want to send email?") == true) {
      return true;
    } else {
      return false;
    }
  });

  $("#example23_paginate").on('click', function(){
    // alert('click'); 
    var favorite = [];
    // $('input[name="check[]"]').each(function() {
      $.each($("input[name='check[]']:checked"), function(){
        favorite.push($(this).val());
      });
    // });
    console.log(favorite);

    // $('input[name="showhide"]').each(function() {
    //   this.checked = false;
    // });
    // alert('click'); 

    // var chkd = $('input:checkbox:checked');
    // if( chkd.length == 2 ) {
    //   var vals = chkd.map(function() {
    //     return this.value;
    //   }).get().join(', ');
    //   alert( vals );
    // }

  });


  tinymce.init({
    selector: "textarea#mymce",
    theme: "modern",
    max_chars: 10,
    height: 200,
    menubar: false,
    plugins: "preview code table lists textcolor",
    toolbar: 'preview | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | subscript superscript | table | bullist numlist | forecolor backcolor | code',
    setup: function (ed) {
      ed.on('keydown', function (e) { 
       var count = CountCharacters();
       document.getElementById("character_count").innerHTML = "Characters: " + (count+1);
     });
    }
  });

  function CountCharacters() {
    var body = tinymce.get("mymce").getBody();
    var content = tinymce.trim(body.innerText || body.textContent);
    return content.length;
  };
  
  function ValidateCharacterLength() {
    var max = 20;
    var count = CountCharacters();
    if (count > max) {
      alert("Maximum " + max + " characters allowed.")
      return false;
    }
    return;
  }


  var tmp = [];
  function addUser(id){
    var checked = $('#'+id).val();
    if ($('#'+id).is(':checked')) {
      tmp.push(checked);
    } else {
      tmp.splice($.inArray(checked, tmp),1);
    }
    $('#hdn_val').val(tmp)
    // console.log(tmp);
  }

  $(document).ready(function() {

    $('#recurring-days').css('visibility', 'hidden');
    @if(isset($errors->recurring_days))
    $('#recurring-days').css('visibility', 'visible');
    @endif
    $('.dropify').dropify({
      messages: {
        default: 'Add Image',
        replace: '',
        remove: 'X',
        error: ''
      }
    });

  });
</script>

<script type='text/javascript'>


 // Set check or unchecked all checkboxes
 function checkAll(e) {
   var checkboxes = document.getElementsByName('check[]');

   if (e.checked) {
     for (var i = 0; i < checkboxes.length; i++) { 
       checkboxes[i].checked = true;
     }
   } else {
     for (var i = 0; i < checkboxes.length; i++) {
       checkboxes[i].checked = false;
     }
   }
 }
 
 // Hide Checked rows
 function hideChecked(){
   var checkboxes = document.getElementsByName('check[]');

   for (var i = 0; i < checkboxes.length; i++) {
     var checkid = checkboxes[i].id;
     var split_id = checkid.split("_");
     var rowno = split_id[1];
     if(checkboxes[i].checked){
       document.getElementById("tr_"+rowno).style.display="none";
     } 
   }
 }
 
 // Reset layout
//  function reset(){
//   var checkboxes = document.getElementsByName('check[]');
//   document.getElementsByName("showhide")[0].checked=false;

//   for (var i = 0; i < checkboxes.length; i++) {
//     var checkid = checkboxes[i].id;
//     var split_id = checkid.split("_");
//     var rowno = split_id[1];
//     document.getElementById("tr_"+rowno).style.display="table-row";
//     checkboxes[i].checked = false;
//   }
// }

</script>
@endsection