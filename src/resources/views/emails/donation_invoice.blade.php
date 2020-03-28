<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>Dear {{ $data['user']->name }}</p>
<br>

Thank you for your support for "{{ $data['project_name'] }}" in One INR. Please find the receipt on this 
<strong><a href="{{ url('invoice').'/'.$data['key']}}">link</a></strong> for your reference. 
{{-- Invoice</a> --}}
</body>
</html>