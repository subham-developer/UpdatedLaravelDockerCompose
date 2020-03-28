@extends('web_master')
@section('body')
<h3 class="text-center" style="margin-top: 100px;">Payment Status: {{ $data['status'] }}</h3>
<p class="text-center">Txn Id: {{ $data['txnid'] }}</p>
<center>
<a href="{{ url('/') }}" class="btn btn-success">Ok</a>
<a href="{{ url('wallet')}}" class="btn btn-warning">Back</a>
</center>
@php
	session()->forget('transaction');
@endphp
@endsection