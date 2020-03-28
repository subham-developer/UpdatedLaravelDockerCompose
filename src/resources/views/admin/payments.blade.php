@extends('admin.admin_master')
@section('css')
<style type="text/css">
    @media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}

input[type='search']{
        border: 1px solid #000!important;
    }
</style>
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
        <div class="col-md-12">
            <div class="white-box">
            <div style="overflow-x: scroll;width: 100%">
            <table class="table table-responsive" id="paymentsTable">
                <thead>
                    {{-- <th>#</th> --}}
                    <th>Date</th>
                    <th>NGO</th>
                    <th>Project</th>
                    <th>Project Date</th>
                    <th>Amount</th>
                    <th>Description</th>
                    
                </thead>
                <tbody>
                    @foreach($data['payments'] as $payment)
                    <tr>
                        {{-- <td>{{ $loop->index }}</td> --}}
                        <td data-label="Date">{{ $payment['created_at'] }}</td>
                        <td data-label="NGO">{{ $payment->projectInterval->project->user->name }}</td>
                        <td data-label="Project">{{ $payment->projectInterval->project->title }}</td>
                        <td data-label="Project Date">{{ $payment->projectInterval->start_date.' To '.$payment->projectInterval->end_date }}</td>
                        <td data-label="Amount">{{ $payment->amount }}</td>
                        <td data-label="Description">{{ $payment->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('bottom-script')
    <script type="text/javascript">
        $(document).ready(function() {
    var groupColumn = 3;
    var table = $('#paymentsTable').DataTable();
 
    
} );
    </script>
@endsection