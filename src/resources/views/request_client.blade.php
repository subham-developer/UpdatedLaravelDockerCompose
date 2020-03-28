@extends('layouts/header')

<!-- style for page -->
@section('style')
<link href="{{ asset('css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.btn-sm{
		padding: .3rem !important;
	}

	.alertbuttonclass{
		margin: 10px 2px !important;
		width: 30% !important;
	}
</style>
@stop
<!-- End style for page -->

@section('content')

<style type="text/css">
    /* tr td i.fa.fa-check {
        color: green;
        font-size: 20px;
        text-align: center;
    }
    
    table tr th {
        background: #b0b0b0c4;
    } */
    
    .dropdown-toggle::after {
        content: none !important;
        border: none;
    }
    
    button#dropdownMenuButton {
        border: none;
    }
    .orange {
        color: #ef6c00;
    }

    /* .table th, .table td{
        padding: 0.50rem !important;
        text-align: center;
    }

    .table td button{
        padding: 4px;
    } */

    .show > .btn-secondary.dropdown-toggle, .btn-secondary:focus, .btn-secondary.active, .btn-secondary:active, .btn-secondary:hover {
        color: #595d6e;
        border-color: #e2e5ec;
        background-color: transparent;
    }

    /* @media only screen and (min-width: 1025px) {
        .kt-wrapper{
            padding-top: 90px !important;
        }
    } */

    .div-scroll-style {
        display: block;
        max-width: 100%;
        overflow-y: scroll;
        overflow-x: scroll;
    }

    /* .div-scroll-style thead, tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    } */

    .div-scroll-style::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .div-scroll-style::-webkit-scrollbar
    {
        width: 7px;
        height: 7px;
        background-color: #F5F5F5;
    }

    .div-scroll-style::-webkit-scrollbar-thumb
    {
        border-radius: 5px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: gray;
    }

    .dataTables_wrapper .pagination .page-item.active > .page-link {
        background: #48a7f9;
        color: #ffffff;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
                <h3 class="kt-portlet__head-title">
					Client Request
				</h3>
            </div>
			<div class="input-group" style="width: 30%;height: 0px; padding-top: 10px">
                <input class="form-control py-2 border-right-0 border searchInputBox" type="text" placeholder="search" id="example-search-input" onkeyup="searchInvoiceStatus(this)" onchange="searchInvoiceStatus(this)">
                <span class="input-group-append">
                    <button class="btn btn-outline-secondary border-left-0 border" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="kt-portlet__body">
			<table class="table table-striped- table-bordered table-hover table-checkable" id="html_table">
				<thead>
					<tr>
						<th>Company Name</th>
						<th>Finance Name</th>
						<th>Finance Email</th>
						<th>Finance Number</th>
						<th>TAN</th>
						<th>PAN</th>
						<th>GST</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($client as $value)
					<tr>
						<td>{{ $value->company_name }}</td>
						<td>{{ $value->finance_name }}</td>
						<td>{{ $value->finance_email }}</td>
						<td>{{ $value->finance_contact_number }}</td>
						<td>{{ $value->tan }}</td>
						<td>{{ $value->pan }}</td>
						<td>{{ $value->gst }}</td>
						<td>
							<button type="button" class="btn btn-success btn-sm" onclick="acceptRequest(this, '{{ $value->id }}')">Accept</button>
							<button type="button" class="btn btn-danger btn-sm" onclick="rejectRequest(this, '{{ $value->id }}')">Reject</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal fade" id="updateClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Replace/Update Client</h5>
			</div>
			<div class="modal-body">
				<div class="addNoteData">
					<form id="replaceClient">
						<input type="hidden" name='type' value="replace">
						<input type="hidden" name="id">
						<div class="kt-section__body">
							<div class="form-group row">
								<div class="col-lg-12">
									<label>Previous Employee</label>
									<input type="text" class="form-control" list="preClientList" onchange="getPrevClientId(this)">
									<input type="hidden" name='previous_employee'>
								</div>
							</div>
						</div>
						<p></p>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="addNoteData btn btn-brand btn-elevate btn-icon-sm" onclick="replaceClientData(this, 'replaceClient')">Update</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<datalist id="preClientList">
	@foreach($preClient as $value)
	<option value="{{ $value->client_name }}" data-id="{{ $value->id }}">
	@endforeach
</datalist>
@endsection

@section('scripts')
<script src="{{ asset('js/pages/custom/projects/add-project.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script>

<script type="text/javascript">
	function getPrevClientId(currentObj){
		let value = $(currentObj).val();
		let id = $("#preClientList").find('[value="'+value+'"]').attr('data-id');
		$(currentObj).next().val(id);
	}

	let datatableContain;
    $(document).ready(function() {
        datatableContain = $('.table').DataTable({
            // paging: false
            "columnDefs": [
                { "orderable": false, "targets": 7 }
            ] 
        });

        $("#html_table_filter").parent().parent().hide();
        $("#html_table_info").attr('style','margin-left: 32px;margin-bottom: 12px;')
        $("#html_table_paginate").attr('style','float: left;')
	});
	
	function searchInvoiceStatus(currentObj){
        let value = $(currentObj).val();
        // $("#html_table_filter").find('input').val(value);
        datatableContain.search(value).draw() ;
	}


	function createButton(text, id, myclass) {
        return $('<button class="swal2-input swal2-styled alertbuttonclass '+myclass+'" id="'+id+'">'+text+'</button>');
    }

    function createMessage(text) {
        return $('<div class="swal2-content" style="display: block;">'+text+'</div>');
	}
	
	function openNewmodal(id){
		$("#updateClient").modal('show');
		$("#updateClient").find('[name="id"]').val(id);
	}
	
	function acceptRequest(currentObj, id){
		var buttonsPlus = $('<div>')
                .append(createMessage('You won\'t be able to revert this!'))
                .append(createButton('Add','sw_butt1','btn btn-success'))
                .append(createButton('Replace','sw_butt2','btn btn-warning'))
                .append(createButton('Cancel','sw_butt3','btn btn-danger'));

		Swal.fire({
	        title: 'Are you sure?',
	        // text: "You won't be able to revert this!",
			type: 'warning',
			html: buttonsPlus,
			showCancelButton: false,
            showConfirmButton: false,
            animation: false,
	        // showCancelButton: true,
	        // confirmButtonColor: '#3085d6',
	        // cancelButtonColor: '#d33',
			// confirmButtonText: 'Yes, Accept it!',
			onOpen: function (dObj) {
                $('#sw_butt1').on('click',function () {
					sentRequest(currentObj, '{{ route('request-client-status') }}', { 'id' : id , 'type' : 'accept'});
                    swal.close();
                });
                $('#sw_butt2').on('click',function () {
					openNewmodal(id);
					swal.close();
                });
                $('#sw_butt3').on('click',function () {
                    swal.close();
                });
            }
		})
		// .then((result) => {
        // 	if (result.value) {
		// 		sentRequest(currentObj, '{{ route('request-client-status') }}', { 'id' : id , 'type' : 'accept'})
		// 	}
        // })
	}

	function rejectRequest(currentObj, id){
		Swal.fire({
	        title: 'Are you sure?',
	        text: "You won't be able to revert this!",
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
        	if (result.value) {
				sentRequest(currentObj, '{{ route('request-client-status') }}', { 'id' : id , 'type' : 'reject'})
			}
		})
	}

	function sentRequest(currentObj, url, dataObj){
		let buttonName = $(currentObj).text();
		let buttonClick = $(currentObj).attr('onclick');
		$(currentObj).removeAttr('onclick');
		$(currentObj).text('Loading...');

		$.ajax({
			type:"post",
			url:url,
			data:dataObj,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success:function(rec){
		    	try{
		    		let jsonData = JSON.parse(rec);
		    		if(jsonData.code == 200){
		    			$(currentObj).parent().parent().fadeOut();
		    		}
		    		else{
		    			alert(jsonData.message);
		    		}
		    		$(currentObj).attr('onclick',buttonClick);
		    		$(currentObj).text(buttonName);
		    	}
		    	catch(ex){
		    		console.log(ex);
		    		$(currentObj).attr('onclick',buttonClick);
		    		$(currentObj).text(buttonName);
		    	}
		    },
		    error:function(err){
		    	console.log(err)
		    	$(currentObj).attr('onclick',buttonClick);
		    	$(currentObj).text(buttonName);
		    }
		})
	}

	function replaceClientData(currentObj, id){
		let buttonName = $(currentObj).text();
		let buttonClick = $(currentObj).attr('onclick');
		let newClientId = $("#updateClient").find('[name="id"]').val();
		$(currentObj).removeAttr('onclick');
		$(currentObj).text('Loading...');

		let dataObj = $("#"+id).serialize();

		$.ajax({
			type:"post",
			url:'{{ route('request-client-status') }}',
			data:dataObj,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success:function(rec){
		    	try{
		    		let jsonData = JSON.parse(rec);
		    		if(jsonData.code == 200){
						// $(currentObj).parent().parent().fadeOut();
						$("#updateClient").modal('hide');
						datatableContain.row( $("#html_table").find('[onclick="acceptRequest(this, \''+newClientId+'\')"]').parent().parent() ).remove().draw();
		    		}
		    		else{
		    			alert(jsonData.message);
		    		}
		    		$(currentObj).attr('onclick',buttonClick);
		    		$(currentObj).text(buttonName);
		    	}
		    	catch(ex){
		    		console.log(ex);
		    		$(currentObj).attr('onclick',buttonClick);
		    		$(currentObj).text(buttonName);
		    	}
		    },
		    error:function(err){
		    	console.log(err)
		    	$(currentObj).attr('onclick',buttonClick);
		    	$(currentObj).text(buttonName);
		    }
		})
	}
</script>
@stop
