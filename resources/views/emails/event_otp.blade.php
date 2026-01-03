<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Registration OTP</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>Hello {{ $name }},</h2>

    <p>
        You have successfully registered for the event
        <strong>{{ $eventId }}</strong>.
    </p>

    <p>
        Your verification code is:
    </p>

    <h1 style="letter-spacing: 5px;">
        {{ $otp }}
    </h1>

    <p>
        This code will expire in 10 minutes.
    </p>

    <p>
        If you did not initiate this registration, please ignore this email.
    </p>

    <br>
    <p>Thank you.</p>

</body>
</html>
