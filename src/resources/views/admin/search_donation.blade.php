@if(count($data['donations']))
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
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#transactions').DataTable({
            "order":[[3,'desc']]
        });

    });
</script>
@else
<hr>
<h3 class="text-center">No donation found!</h3>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        @if(isset($data['search']))
        $('#clear').show();
        @endif
    });
</script>