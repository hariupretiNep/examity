<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation for online examination</title>
</head>
<body>
<div>
Hi <b>{{ $student->name }}</b>,</br>
I am very pleased to announce you that, You are invited to participate on a online test. By simply clicking on below link you can accept this invitation.</br>
<a href="{{ $invitationLink }}" target="_blank">Start Test </a>
</div>
</body>
</html>