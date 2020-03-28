<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>Hello {{ $data['user']->name }},<p>

<p>We regret to inform you that the project was not funded completely, so we are refunding your money as the work cannot be executed. </p>

<p>Kindly donate to other <a href="{{ url('projects') }}">projects</a></p>
{{-- <p>Kindly donate to the below project : $ </p> --}}
</body>
</html>