<div class="row">
    <div class="col-md-12">
        <!-- Nav tabs -->
        @if(count($data['projects']))
        <ul class="nav customtab2 nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Projects</span>
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#profile6" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                    <span   class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Transactions</span>
                </a>
            </li>
            
        </ul>
        <div class="tab-content" style="margin-top: 15px;">
            <div role="tabpanel" class="tab-pane fade active in" id="home6">
                <div class="col-md-12">
                    <table class="table table-responsive">
                        <thead>
                            <th class="text-left">Project Name</th>
                            <th class="text-center">Donated Amount</th>
                        </thead>
                        <tbody>
                            @foreach($data['projects'] as $project)
                            <tr class="text-left">
                                <td>{{ $project->project['title'] }}</td>
                                <td class="text-center">{{ $data['donations']->where('project_id', $project['project_id'])->sum('amount_donated') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile6">
                <div class="row">
                    {!! Form::open(['class'=>'form-horizontal', 'id'=>'search']) !!}
                    <input type="hidden" name="user_id" value="{{ $data['userId'] }}" id='userId'>
                    <div class="input-daterange" id="datepicker">
                        <div class="col-md-3">
                            <label class="control-label">Start Date</label>
                            <div class="input-group">
                                
                                {{-- <input type="text" class="form-control"  name="start" placeholder="DD-MM-YYYY"> --}}
                                {{ Form::text('start',null, ['class' => 'form-control','placeholder'=>'DD-MM-YYYY', 'required','id'=>'start']) }}
                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">End Date</label>
                            <div class="input-group">
                                
                                {{-- <input type="text" class="form-control" name="end" placeholder="DD-MM-YYYY"> --}}
                                {{ Form::text('end',null, ['class' => 'form-control','placeholder'=>'DD-MM-YYYY', 'required','id'=>'end']) }}
                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <label class="control-label invisible">.</label>
                        <div class="input-group">
                            <button class="btn btn-info">Search</button>
                            
                            <button id="clear" onclick='clearSearch()' type="button" class="btn btn-info m-l-15" style="display: none;">Clear</button>
                            
                        </div>
                    </div>
                    
                    {{ Form::close() }}
                </div>
                <div class="row">
                    <div class="col-md-12" id="donations">
                        <br>
                        <table class="table table-hover" id="transactions">
                            <thead>
                                <th>Project Name</th>
                                <th>NGO</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </thead>
                            <tbody>
                                @foreach($data['donations'] as $donation)
                                <tr>
                                    <td class="text-center">{{ $donation->project['title'] }}</td>
                                    <td class="text-center">{{ $donation->user['name'] }}</td>
                                    <td class="text-center">{{ $donation['created_at'] }}</td>
                                    <td class="text-center">{{ $donation['amount_donated'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @else
        <h3>No Data Found!</h3>
        @endif
    </div>
</div>

<script type="text/javascript">
    $("form").attr('autocomplete', 'off');

    @if(count($data['projects']))
    $(document).ready(function(){
        var table = $('#transactions').DataTable();
    });
    @endif
    $('.input-daterange').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
    });

    $('#search').submit(function(e){
        e.preventDefault();
        formData = $('#search').serialize();
        $.ajax({
            url:'{{ route('users.search_donation') }}',
            type:'POST',
            data:formData,
            success:function(res){
                $('#donations').html(res);
            },
            error:function(res){
                
            }
        });
    });

    function clearSearch(){
        $('#start, #end').val(null);
        $('#search').submit();
        $('#clear').hide();
    }

    $("#start, #end").keydown(function(event) {
        return false;
    });

    $("#start").change(function(event) {
        $("#end").focus();
    });

    
</script>