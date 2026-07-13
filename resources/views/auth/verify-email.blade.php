<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email Terkirim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .email-sent-box {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }

        .email-icon {
            font-size: 48px;
            color: #0d6efd;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="email-sent-box">
        <div class="email-icon">
            📧
        </div>
        <h4>Cek Email Anda</h4>
        <p>Kami telah mengirimkan link verifikasi ke alamat email Anda. Silakan periksa kotak masuk atau folder spam
            Anda.</p>
        <form action="/email/verification-notification" method="POST">
            @csrf
            <button class="btn btn-primary mt-3">Kirim Ulang Email</button>
        </form>
        <div id="resendMsg" class="text-success mt-2 d-none">Email verifikasi telah dikirim ulang!</div>
    </div>

</body>

</html>
