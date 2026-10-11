<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #f7efe5, #ead8c0, #d8b894);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4e342e;
        }

        .card {
            width: 430px;
            background: #fffaf3;
            padding: 38px;
            border-radius: 26px;
            box-shadow: 0 24px 60px rgba(80, 48, 28, .22);
            text-align: center;
            border: 1px solid rgba(139, 94, 60, .14);
        }

        .icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 20px;
            border-radius: 22px;
            background: linear-gradient(135deg, #9a633f, #6d3f25);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }

        h2 {
            margin: 0 0 12px;
            font-size: 28px;
        }

        p {
            color: #6b5647;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 14px;
            background: #8a5737;
            color: white;
            text-decoration: none;
            font-weight: 900;
        }

        .btn:hover {
            background: #5d331d;
        }

        .back {
            display: block;
            margin-top: 18px;
            color: #8a5737;
            font-weight: 800;
            text-decoration: none;
        }
    </style>

<link href="css/theme-cream.css?v=20260626" rel="stylesheet" type="text/css">
</head>
<body>

<div class="card">
    <div class="icon">🔑</div>
    <h2>Lupa Password?</h2>
    <p>
        Untuk reset password, silakan hubungi Admin/HRD.
        Admin akan membantu membuatkan atau mengganti password akun kamu.
    </p>

    <a href="mailto:admin@kantor.com?subject=Permintaan Reset Password Sistem Cuti" class="btn">
        Hubungi Admin
    </a>

    <a href="index.php" class="back">
        ← Kembali ke Login
    </a>
</div>

</body>
</html>