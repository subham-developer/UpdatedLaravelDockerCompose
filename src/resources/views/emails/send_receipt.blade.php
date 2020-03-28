<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<ul>
		@foreach($data['donations'] as $donation)
		<li>{{ $donation }}</li>
		@endforeach
	</ul>
</body>
</html>