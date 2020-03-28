		@extends('layouts.header')

		<!-- style for page -->
		@section('style')
		<link href="{{ asset('css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />
		@stop
		<!-- End style for page -->

		@section('content')
		<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__head kt-portlet__head--lg">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Clients
						</h3>
					</div>
					
					<div class="kt-portlet__head-toolbar" style="float: right;">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">

								&nbsp;
								<a href="{{ url('client') }}" class="btn btn-brand btn-elevate btn-icon-sm">
									<i class="la la-plus"></i>
									Add Client
								</a>
									&nbsp;
								<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-brand btn-elevate btn-icon-sm">
									<i class="la la-download"></i>
									Export & Send
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="kt-portlet__body">

					<!--begin: Datatable -->
					<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
						<thead>
							<tr>
								<th>Client</th>
								<th>Reporting Manager Name</th>
								<th>Reporting Manager Phone</th>
								<th>Reporting Manager Email</th>
								<th>Accountant Name</th>
								<th>Accounting Email</th>
								<th>Map Link</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($clients as $key => $data)

							<tr>
								<td>{{$data['client_name']}}</td>
								<td>{{$data['reporting_name']}}</td>
								<td>{{$data['reporting_contact']}}</td>
								<td>{{$data['reporting_email']}}</td>
								<td>{{$data['account_name']}}</td>
								<td>{{$data['account_email']}}</td>
								<td><a href="{{$data['address_map_link']}}"  target="_blank">Address</a></td>
								<td data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell">
									<span style="overflow: visible; position: relative; width: 133px;">		<div class="dropdown">
										<a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
											<i class="flaticon-more-1"></i>								
										</a>
										<div class="dropdown-menu dropdown-menu-right">					<ul class="kt-nav">
																	<!-- <li class="kt-nav__item">									<a class="kt-nav__link" href="#">							<i class="kt-nav__link-icon flaticon2-expand"></i>		   <span class="kt-nav__link-text">View</span>			</a>										
																	</li>		 -->								
																	<li class="kt-nav__item">									<a class="kt-nav__link" href="{{ url('clientedit/' . $data->id) }}">							<i class="kt-nav__link-icon flaticon2-contract"></i>	<span class="kt-nav__link-text">Edit</span>				</a>
																	</li>										
																	<li class="kt-nav__item">									<a class="kt-nav__link" href="#" onclick="deleteClient(<?php echo $data->id; ?>)">						<i class="kt-nav__link-icon flaticon2-trash"></i>		<span class="kt-nav__link-text">Delete</span>			</a>										
																	</li>										
																	<!-- <li class="kt-nav__item">									<a class="kt-nav__link" href="#">							<i class="kt-nav__link-icon flaticon2-mail-1"></i>			<span class="kt-nav__link-text">Export</span>		</a>										
																	</li>		 -->							
																</ul>								
															</div>							
														</div>						
													php											</span>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>

									<!--end: Datatable -->
								</div>
							</div>
						</div>


						<!-- Button trigger modal -->

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form method="POST" action="{{route('export')}}">
										@csrf
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-mail"></i> Download And Send </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
`
											<!-- Default unchecked -->
											<div class="row col-md-12" >

												<div class="custom-control custom-radio	col-md-6">
													<input type="radio" class="custom-control-input action" id="defaultUnchecked" value="download" name="action" checked>
													<label class="custom-control-label" for="defaultUnchecked">Download Excel</label>
												</div>

												<!-- Default checked -->
												<div class="custom-control custom-radio col-md-6">
													<input type="radio" class="custom-control-input action" id="defaultChecked" value="send" name="action">
													<label class="custom-control-label" for="defaultChecked">Send To Email</label>
												</div>
											</div>
											<!-- Material input -->
											<div class="custom-control custom-radio p-3 col-md-12" id="input-email">	
												<input placeholder="Enter Email Address" type="email" name="email" id="email_input" class="form-control">

											</div>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary" id="btnname">Download</button>
										</div>
									</form>
								</div>
							</div>
						</div>


						@endsection

						<!-- sript for page -->
						@section('scripts')
						<script src="{{ asset('js/pages/crud/datatables/basic/scrollable.js') }}" type="text/javascript"></script>
						<script src="{{ asset('js/pages/custom/projects/add-project.js') }}" type="text/javascript"></script>
						<!-- <script src="{{ asset('js/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script> -->
						<script>
							var msg = '{{Session::get('alert')}}';
							var exist = '{{Session::has('alert')}}';
							var msg1 = '{{Session::get('exits')}}';
							var exist1 = '{{Session::has('exits')}}';

							if(exist){
								Swal.fire({
									position: 'center',
									type: 'success',
									title: msg,
									showConfirmButton: false,
									timer: 2500
								})
							}

							if(exist1){
								Swal.fire(msg1);
							}


							function deleteClient(id){

								Swal.fire({
									title: 'Are you sure?',
									text: "You won't be able to revert this!",
									type: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									confirmButtonText: 'Yes, delete it!'
								}).then((result) => {
									if (result.value) {
										$.ajax({
											url: "{{ url('clientdelete/') }}/"+id, 
											type: "GET",
											success: function(res){
												if(res == 200)
												{
													Swal.fire(
														'Deleted!',
														'Client Deleted Successfully.',
														'success'
														)
													location.reload();
												}
												else
												{
													Swal.fire(
														'warning!',
														'Something Went Wrong.',
														'fail'
														)
												}


											}});

									}
								})
							}
							$('#input-email').hide();
							$('.action').click(function(){
								if(this.value == 'download'){
									$('#input-email').hide();
									$('#btnname').html('Download');
                                   
                                    $('#email_input').prop('required',false);
								}else{
									$('#input-email').show();
									$('#btnname').html('Send');
                                    $('#email_input').prop('required',true);
								}
							});

							

						</script>
						@stop	
		<!-- End sript for page -->