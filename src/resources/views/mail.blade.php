<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div>Dear {!! $name !!}, </div>

	<img src="{{ asset('uploads').'/'.$imageName }}" alt="">
	
	{!! $emailbody !!}

</body>
</html>
