@extends('admin.admin_master')
@section('body')
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Add fund</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				
			</div>
		</div> 
		<div class="row white-box" >
			<div class="row">
				<h2>Donate fund for {{$data->title}}</h2>
			</div>

			<div>
				<form method="post" action="{{url('admin/projects/submitfund')}}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="project_id" value="{{$data->id}}">
					<div class="row">
						<div class="form-group col-sm-4 col-xs-12">
							<label>Add Fund : </label>
							<input class="form-control" name="fund_amount" type="text" value="">
						</div>
					</div>
					@if($errors->has('fund_amount'))
					<div class="form-group row">
						<div class = 'has-error alert alert-danger col-sm-4 col-xs-12'>
							{{$errors->first('fund_amount')}}
						</div>
					</div>
					@endif
					@if(Session::has('fund_limit_msg'))
					<div class="form-group row">
						<div class = 'has-error alert alert-danger col-sm-4 col-xs-12'>
							{{ Session::get('fund_limit_msg') }}
						</div>
					</div>
					@endif
					<div class="form-group row">
						<div class="offset-sm-3 col-sm-9">
							<button type="submit" class="img-btn btn btn-success waves-effect waves-light m-r-10">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		@endsection
		