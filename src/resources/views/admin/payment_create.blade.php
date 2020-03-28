@extends('admin.admin_master')
@section('css')
@endsection
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Starter Page</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Dashboard</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row" id="app">
        <div class="col-md-6">
            <div class="white-box">
                <table width="100%">
                    @php
                    $commission = DB::table('configs')->where('name','commission')->first()->value;
                    $goal = ($data['interval']['funded'] *100) /114; 
                    $x = $goal * (0.10/100*100) ; // Our Commission
                    $y = $x * (18/100); // GST on commission
                    $z = ($goal + $x + $y) * 2/100; // 2% PG charges
                    $charges = $x + $y + $z;
                    @endphp
                    <tr>
                        <th>Title</th>
                        <td>{{ $data['project']['title'] }}</td>
                    </tr>
                    <tr>
                        <th>Target:</th>
                        <td>{{ $data['project']['target'] }}</td>
                    </tr>
                    <tr>
                        <th>Funded:</th>
                        <td>{{ $data['interval']['funded'] }}</td>
                    </tr>
                    <tr>
                        <th>{{$commission}}% Commsion:</th>
                        <td>{{ round($x) }}</td>
                    </tr>
                    <tr>
                        <th>18% GST:</th>
                        <td>{{ round($y) }}</td>
                    </tr>
                    <tr>
                        <th>2% PG Charges:</th>
                        <td>{{ round($z) }}</td>
                    </tr>
                    <tr>
                        <th>Total amt to pay:</th>
                        {{-- <td>{{ round(($data['interval']['funded'] - $charges)) }}</td> --}}
                        <td>{{ round(($data['interval']['funded']*100)/114) }}</td>
                        
                    </tr>
                    <tr>
                        <th>Amt Paid:</th>
                        <td>{{ $data['paid'] }}</td>
                    </tr>
                    <tr>
                        <th>Amt to Pay:</th>
                        <td>{{ round(($data['interval']['funded']*100)/114) - $data['paid'] }}</td>
                    </tr>
                </table>
                <hr>
                {{-- <b>Project:</b> {{ $data['project']['title'] }}<br>
                <b>Target:</b> {{ $data['project']['target'] }}<br>
                <b>Funded:</b> {{ $data['interval']['funded'] }}<br>
                <b>Amount to pay:</b> {{ round(($data['interval']['funded']*100)/114) }}<br>
                <b>Amount paid:</b> {{ round(($data['interval']['funded']*100)/114) }}<br> --}}
                <br>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['route'=>'payments.store']) !!}
                {!! Form::hidden('id', $data['interval']['id'], []) !!}
                <div class="form-group">
                    <label>Amount To Pay:</label>
                {!! Form::number('amount', null, ['class'=>'form-control','v-model="pay"','required']) !!}
                <span class="text-danger" v-if="totalPay > funded"><b>You are exceeding the amount</b></span>
                </div>
                <div class="form-group">
                    <label>Payment Description:</label>
                    {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>5,'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
                {{-- @{{ totalPay }} --}}
            </div>
        </div>

        <div class="col-md-6">
            <div class="white-box">
                <h3>Payment History</h3>
                <table class="table table-responsive">
                    <tr>
                        <th>Amount Paid</th>
                        <th>Description</th>
                        <th class="text-center">Date</th>
                    </tr>
                    @foreach($data['payments'] as $payment)
                    <tr>
                        <th>{{ $payment['amount'] }}</th>
                        <th>{{ $payment['description'] }}</th>
                        <th class="text-center">{{ $payment['created_at'] }}</th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('bottom-script')
<script type="text/javascript">
    vm = new Vue({
        el:'#app',
        data:{
            paid: {{ $data['paid'] }},
            pay: null,
            funded: {{ $data['pay'] }}
        },
        computed:{
            totalPay: function(){
                return Number(this.paid) + Number(this.pay);
            }
        }


    });

    
</script>
@endsection