<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Registration OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

    <!-- Wrapper -->
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px 0;">
        <tr>
            <td align="center">

                <!-- Email Container -->
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#6c0a03; padding:20px; text-align:center;">
                            <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                Event Registration
                            </h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#333333; font-size:15px; line-height:1.6;">

                            <p style="margin-top:0;">
                                Hello <strong>{{ $name }}</strong>,
                            </p>

                            <p>
                                Your registration has been received.
                                {{-- <strong>{{ $eventId }}</strong>. --}}
                            </p>

                            <p>
                                Please use the verification code below to complete your registration:
                            </p>

                            <!-- OTP Box -->
                            <div style="margin:30px 0; text-align:center;">
                                <span style="display:inline-block; background-color:#f2f2f2; border:1px dashed #6c0a03; padding:15px 30px;
                                    font-size:28px; letter-spacing:6px; font-weight:bold; color:#6c0a03; border-radius:6px;  ">
                                    {{ $otp }}
                                </span>
                            </div>

                            <p style="text-align:center; font-size:13px; color:#666;">
                                This code will expire in <strong>10 minutes</strong>.
                            </p>

                            <p>
                                If you did not initiate this registration, you can safely ignore this email.
                            </p>

                            <p style="margin-bottom:0;">
                                Regards,<br>
                                <strong>The Events Logger Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9f9f9; padding:15px; text-align:center; font-size:12px; color:#888;">
                            <p style="margin:0;">
                                © {{ date('Y') }} Events Logger. All rights reserved.
                            </p>
                            <p style="margin:5px 0 0;">
                                This is an automated email — please do not reply.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End Container -->

            </td>
        </tr>
    </table>

</body>
</html>
