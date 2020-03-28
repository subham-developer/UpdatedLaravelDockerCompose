@extends('donoraccount_master')
@section('css')
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('wallet-body')
<div class="col-lg-9">
	
	<div class="account-content profile">
		<h3 class="account-title">Backed Campaigns</h3>
		<div class="account-main">
			@if(session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
			@endif
			<table class="table table-striped" id="projectsTable">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Total</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($data['projects'] as $project)
					@php
					// $projectId = Hashids::encode($project->project_id);
					$projectId = $project->project_id;
					@endphp
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $project->project['title']}} </td>
						<td>{{ $data['totalDonated'][$loop->index] }}</td>
						<td>
							<a href="{{ url('backed-campaigns').'/'.$projectId }}" class="btn btn-link" style="display: inline;" title="Details">
								<i class="fa fa-money" aria-hidden="true"></i>
							</a>
							{!! Form::open(['url'=>'invoice/'.$projectId, 'style'=>'display:inline']) !!}
							<button class="btn btn-link" title="Receipt"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
							{!! Form::close() !!}
						</td>
					</tr>
					
					
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
</div>
@endsection
@section('bottom-script')
<script src="{{ asset('js/admin/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
	$('#campaigns').addClass('active');
	$('#projectsTable').DataTable();
</script>
@endsection