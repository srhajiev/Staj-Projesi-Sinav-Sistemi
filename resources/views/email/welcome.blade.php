<html>
	<head>
		<title>Hoş Geldiniz</title>
	</head>
	<body>
		{{ $user['email'] }}
		<br>
		<p>Kayıt Olduğunuz Eposta : {{ $user['email'] }}</p>
		<p>{{ config('app.name') }}</p>
	</body>
</html>