<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Password Reset</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <p>We have received a request from you to reset your password</p>
     <p>Click <a class="btn btn-sm btn-success" href="{{$url}}/reset-password/{{$token->token}}">here</a> to reset your password </p>
    <p>Thank you.</p>
</body>
</html>