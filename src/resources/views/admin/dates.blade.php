

@extends('admin.admin_master')

@section('css')
<style type="text/css">
    .user-bg{
        height: 250px;
    }
</style>
@endsection

@section('body')

<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Transacation Dates</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">View Dates</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="white-box">
                            <div class="row">
                                {{Form::model($data['formData'], ['url' => url()->current(), 'method'=>'get'])}}
                                <div class="col-md-6">
                                  <div class="form-group">
                                    {{Form::selectMonth('month',null,array('class' => 'form-control','aria-expanded' => 'true'))}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    {{Form::selectRange('year',null, 2018 ,null,array('class' => 'form-control','aria-expanded' => 'true', ))}}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                   <div class="row" >
                                    <button class="btn btn-block btn-info" >Search</button>
                                   </div>
                                </div> 
                                {{Form::close()}}
                                <div class="col-md-12">
                                <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Dates</th>
                                            <th>Amount</th>
                                          
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        @if(count($data['DonationDates']) != 0)
                                         @foreach($data['DonationDates'] as $date)
                                                     <tr>
                                                        <td>{{ $date['created_at'] }}</td>
                                                        <td>{{ $date['amount_donated'] }}</td>
                                                    </tr>
                                         @endforeach
                                        @else
                                        <tr>
                                            <td><strong>No Records Found</strong></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            </div>  
                        </div>   
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <h2>All Details</h2>
                                    <table class="table m-t-30 table-hover contact-list footable-loaded footable">
                                        <tbody>
                                            <tr>
                                                <td><strong>Name </strong></td>
                                                <td>{{$data['UserDetails'][0]['name']}} </td>
                                            </tr>
                                             <tr>
                                                <td><strong>Email </strong></td>
                                                <td>{{$data['UserDetails'][0]['email']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Avalable Fund </strong></td>
                                                <td>{{$data['UserDetails'][0]['fund']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Project Title </strong></td>
                                                <td>{{$data['ProjectDetails'][0]['title']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Donated To This Project </strong></td>
                                                <td>{{$data['totalAmount']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
@endsection

@section('bottom-script')
@endsection