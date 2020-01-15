<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<p>Mr/Mrs {{ $data->username }},</p>
<h2>Welcome to the UNIVERSAL SALT IODIZATION PROGRAM</h2>
<br/>
Your registered email is <sapn style="font-weight: bold">{{ $data->email }}</sapn> , Please click on the below link to verify your email account
<br/>
<a href="{{ url('users/verify', $data->verifyUser->token) }}"> confirm verification</a>
<p>Thank you.</p>

<p>Universal Salt Iodization Program </p>
</body>

</html>