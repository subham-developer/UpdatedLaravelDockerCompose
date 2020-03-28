@extends('admin.admin_master')
@section('css')
@endsection
@section('body')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">App Config</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            
            {{-- <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Dashboard</li>
            </ol> --}}
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Commission
                        </div>
                        <div class="panel-body">
                            @if($errors->has('commission'))
                            <div class="alert alert-danger">
                                {{ $errors->first('commission') }}
                            </div>
                            @endif
                            {!! Form::open(['route'=>'update.commission', 'method'=>'put']) !!}
                            {!! Form::number('commission', $data['commission']['value'], ['class'=>'form-control']) !!}
                            <br>
                            <button class="btn btn-primary pull-right">Update</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Banner Project
                        </div>
                        <div class="panel-body">
                            @if($errors->has('project1'))
                            <div class="alert alert-danger">
                                {{ $errors->first('project1') }}
                            </div>
                            @endif
                            <form action="{{ route('update.project1') }}" method="post">
                                @csrf
                                @method('PUT')
                                <select name="project1" class="form-control select2" id="project1">
                                    <option value="">Select Project ...</option>
                                    @foreach($data['ngos'] as $ngo)
                                    <optgroup label="{{ $ngo->user->name }}">
                                        @php
                                        $projects = $data['projects']->where('user_id',$ngo->user_id);
                                        @endphp
                                        @foreach($projects as $project)
                                        @php
                                        $selected1 = $project->id == $data['project_1']->value ? 'selected':null;
                                        @endphp
                                        <option value="{{ $project['id'] }}" {{ $selected1}}>{{ $project['title'] }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                    
                                </select>
                                <br><br>
                                <button class="btn btn-primary pull-right">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Love Project
                        </div>
                        <div class="panel-body">
                            @if($errors->has('project2'))
                            <div class="alert alert-danger">
                                {{ $errors->first('project2') }}
                            </div>
                            @endif
                            <form action="{{ route('update.project2') }}" method="post">
                                @csrf
                                @method('PUT')
                                <select name="project2" class="form-control select2" id="project2">
                                    <option value="">Select Project ...</option>
                                    @foreach($data['ngos'] as $ngo)
                                    <optgroup label="{{ $ngo->user->name }}">
                                        @php
                                        $projects = $data['projects']->where('user_id',$ngo->user_id);
                                        @endphp
                                        @foreach($projects as $project)
                                        @php
                                        $selected2 = $project->id == $data['project_2']->value ? 'selected':null;
                                        @endphp
                                        <option value="{{ $project['id'] }}" {{$selected2}}>{{ $project['title'] }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                    
                                </select>
                                <br><br>
                                <button class="btn btn-primary pull-right">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('bottom-script')
<script type="text/javascript">
$(".select2").select2();
$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
</script>
@endsection