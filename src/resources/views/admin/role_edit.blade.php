@php
// $data['role'] = json_decode(json_encode($data['role']),true);
// $data['role']['permission_id'] = explode(',', $data['role']['permission_id']);

@endphp
<div class="alert alert-danger" id="updateErrors" style="display: none;">
    <li>The name already taken.</li>
</div>
{!! Form::model($data['role'],['id'=>'updateRoleForm']) !!}
    <input type="hidden" name="id" id="roleId" value="{{ $data['role']['id'] }}">
    <div class="form-group">
        <label>Role:</label>
        {{-- <input name="name" type="text" class="form-control"> --}}
        {!! Form::text('name',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label class="col-md-4 col-xs-12">Donor:</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '1') }} Read-only</label>
        <label class="col-md-4 col-xs-6 text-normal" >{{ Form::checkbox('permission_id[]', '2') }} Read-write</label>
    </div>
    <div class="form-group">
        <label class="col-md-4 col-xs-12">NGO:</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '3') }} Read-only</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '4') }} Read-write</label>
    </div>
    <div class="form-group">
        <label class="col-md-4 col-xs-12">Project:</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '5') }} Read-only</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '6') }} Read-write</label>
    </div>
    <div class="form-group">
        <label class="col-md-4 col-xs-12">Accounts:</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '7') }} Read-only</label>
        <label class="col-md-4 col-xs-6 text-normal">{{ Form::checkbox('permission_id[]', '8') }} Read-write</label>
    </div>
    <button type="submit" class="btn btn-info">Update</button>
{!! Form::close() !!}

<script type="text/javascript">
    $('#updateRoleForm').submit(function(e){
        e.preventDefault();

        var data = $('#updateRoleForm').serialize();
        id = $('#roleId').val(); 
        $.ajax({
            url: '{{ route('roles.index') }}/'+id,
            type: 'PUT',
            data: data,
            success: function(res) {
                location.reload();
            },
            error: function(res){
                $('#updateErrors').show();
            }

        });
        
    });
</script>