<!DOCTYPE html>
<html>
<head>
    <title>WineLand.com</title>
</head>
<body>
<p>Hi, you have a new message from <b>{{ $data['name'] }}</b>.</p>
<p>The message: <b><i>{{ $data['message'] }}</i></b>.</p>
<p>The user's phone number: <b>{{ $data['phone'] }}</b>.</p>
<p>The user's email address: <b>{{ $data['email'] }}</b>.</p>
<h1><i>Have a nice day!</i></h1>
</body>
</html>
