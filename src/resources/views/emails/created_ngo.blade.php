<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	Dear {{ $ngo['name'] }},<br>
	You are successfully registered with 1 INR. You can now post your projects.
	Use the following credential to login.<br>
	
	URL: oneinr.com<br>
	Email Id: {{ $ngo['email'] }}	<br>
	Password: {{ $password }}<br>	
	
	<br>
	Thank you,<br>
	1 INR

</body>
</html>