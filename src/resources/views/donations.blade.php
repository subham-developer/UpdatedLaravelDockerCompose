@extends('donoraccount_master')

@section('css')
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('wallet-body')
<div class="col-lg-9">
	
	<div class="account-content profile">
		<h3 class="account-title">Backed Campaigns</h3>
		<div class="account-main">
			<table class="table table-striped" id="donationsTable">
				<thead>
					<th>#</th>
					<th>Date</th>
					<th>Amount</th>
				</thead>
				<tbody>
					@foreach($data['donations'] as $donation)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $donation->created_at }}</td>
						<td>{{ $donation->amount_donated }}</td>
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

	$('#donationsTable').DataTable();
</script>
@endsection