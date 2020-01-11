<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{ $data->username }}</h2>
<br/>
Your registered email-id is {{ $data->email }} , Please click on the below link to verify your email account
<br/>
<a href="{{ url('users/verify', $data->verifyUser->token) }}">Verify Email</a>
</body>

</html>