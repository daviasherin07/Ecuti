<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','1');

if(session_status()===PHP_SESSION_NONE){
    session_start();
}

require "function/koneksi.php";

$pesan="";

if(isset($_POST['login'])){

    $nip = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $q = mysqli_query($conn,"
SELECT *
FROM userlogin
WHERE
nip='$nip'
AND password='$password'
");

    if(mysqli_num_rows($q)>0){

        $data = mysqli_fetch_assoc($q);
      
        // LOGIN ADMIN
        if($data['nip']=="admin"){

            $_SESSION['username']="admin";
            $_SESSION['nama']="HR Administrator";
            $_SESSION['divisi']="Human Resources";
            $_SESSION['level']="Administrator";

            header("Location:dashboard/");
            exit;
        }
        }

        // LOGIN KARYAWAN
$nipLogin = $data['nip'];

$qKar = mysqli_query($conn,"
SELECT *
FROM karyawan
WHERE nip='$nipLogin'
");

if(mysqli_num_rows($qKar)>0){

    $kar = mysqli_fetch_assoc($qKar);

    $_SESSION['nip']    = $kar['nip'];
    $_SESSION['nama']   = $kar['nama'];
    $_SESSION['divisi'] = $kar['divisi'];
    $_SESSION['level']  = $kar['level'];

    header("Location:dashboard/");
    exit;

}else{

    $pesan = "Data karyawan tidak ditemukan.";

}

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Sistem Cuti Online</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            box-sizing: border-box;
            font-family: 'Poppins', Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,.9), transparent 28%),
                radial-gradient(circle at bottom right, rgba(210,180,140,.35), transparent 34%),
                linear-gradient(135deg, #f7efe5, #ead8c0, #d8b894);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #3b271c;
        }

        .login-wrapper {
            width: 1120px;
            min-height: 610px;
            background: #fffaf3;
            border-radius: 30px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1.08fr;
            box-shadow: 0 30px 80px rgba(80,48,28,.22);
            border: 1px solid rgba(139,94,60,.12);
        }

        .login-left {
            position: relative;
            padding: 72px 66px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,.5), transparent 36%),
                radial-gradient(circle at bottom left, rgba(183,122,69,.12), transparent 34%),
                linear-gradient(135deg, #fff3e4, #f2d9bd);
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(255,255,255,.34);
            top: -180px;
            right: -170px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background:
                radial-gradient(circle, rgba(255,255,255,.55) 2px, transparent 3px);
            background-size: 18px 18px;
            opacity: .38;
            bottom: -110px;
            left: -90px;
        }

        .brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 100px;
        }

        .brand-icon {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: linear-gradient(135deg, #a66a42, #6d3f25);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fffaf3;
            box-shadow: 0 16px 30px rgba(109,63,37,.28);
        }

        .brand-icon svg {
            width: 38px;
            height: 38px;
            stroke: currentColor;
            stroke-width: 2.2;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-title {
            font-size: 21px;
            font-weight: 900;
            color: #3b271c;
            text-transform: uppercase;
            letter-spacing: .2px;
        }

        .brand-subtitle {
            margin-top: 4px;
            font-size: 14px;
            font-weight: 800;
            color: #80614d;
        }

        .hero-title {
            position: relative;
            z-index: 2;
            font-size: 56px;
            line-height: 1.12;
            margin: 0;
            font-weight: 900;
            letter-spacing: -1.4px;
            color: #3b271c;
        }

        .line {
            position: relative;
            z-index: 2;
            width: 76px;
            height: 6px;
            background: #b77a45;
            border-radius: 30px;
            margin: 30px 0 34px;
        }

        .hero-desc {
            position: relative;
            z-index: 2;
            font-size: 18px;
            line-height: 1.8;
            color: #5d4738;
            max-width: 430px;
            margin: 0;
            font-weight: 400;
            letter-spacing: .1px;
        }

        .login-right {
            background: rgba(255,255,255,.86);
            padding: 72px 78px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .login-right h2 {
            margin: 0 0 12px;
            text-align: center;
            font-size: 42px;
            font-weight: 900;
            color: #3b271c;
            letter-spacing: -1px;
        }

        .desc {
            text-align: center;
            color: #8a7668;
            font-size: 17px;
            margin-bottom: 42px;
            font-weight: 500;
        }

        .alert {
            background: #fff0ee;
            color: #b42318;
            border: 1px solid #ffc9c2;
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 20px;
            font-weight: 800;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #3b271c;
            font-size: 15px;
            font-weight: 900;
        }

        .input-wrap {
            height: 58px;
            display: flex;
            border: 1px solid #d8c7b8;
            border-radius: 16px;
            background: #fffdf9;
            overflow: hidden;
            transition: .2s;
        }

        .input-wrap:focus-within {
            border-color: #a66a42;
            box-shadow: 0 0 0 4px rgba(166,106,66,.13);
        }

        .input-icon {
            width: 64px;
            background: #f3e8dc;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #8a5737;
            border-right: 1px solid #e5d6c9;
        }

        .input-icon svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            stroke-width: 2.4;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .input-wrap input {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            padding: 0 16px;
            color: #3b271c;
            font-size: 16px;
            font-weight: 500;
        }

        .input-wrap input::placeholder {
            color: #9a8a7f;
        }

        .btn-login {
            width: 100%;
            height: 62px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #a66a42, #6d3f25);
            color: #fffaf3;
            font-size: 18px;
            font-weight: 900;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 14px 28px rgba(109,63,37,.24);
            transition: .2s;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            filter: brightness(.96);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #b7a797;
            margin: 30px 0 24px;
            font-weight: 800;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #eadfd4;
        }

        .forgot-area {
            text-align: center;
        }

        .forgot-link {
            display: inline-block;
            color: #8a5737;
            font-weight: 900;
            font-size: 15px;
            text-decoration: none;
            padding-bottom: 4px;
            border-bottom: 2px solid transparent;
            transition: .2s;
        }

        .forgot-link:hover {
            color: #5d331d;
            border-bottom-color: #8a5737;
        }

        @media(max-width: 950px) {
            body {
                padding: 20px;
            }

            .login-wrapper {
                width: 100%;
                grid-template-columns: 1fr;
            }

            .login-left {
                display: none;
            }

            .login-right {
                padding: 46px 30px;
            }

            .login-right h2 {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-left">
            <div class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="17" rx="3"></rect>
                        <path d="M8 2v4"></path>
                        <path d="M16 2v4"></path>
                        <path d="M3 9h18"></path>
                        <circle cx="16.5" cy="16.5" r="3"></circle>
                        <path d="M16.5 15v1.8l1.2.8"></path>
                    </svg>
                </div>

                <div>
                    <div class="brand-title">Sistem Cuti Online</div>
                    <div class="brand-subtitle">Dashera Cuti Digital</div>
                </div>
            </div>

            <h1 class="hero-title">Form Cuti<br>Kantor</h1>
            <div class="line"></div>

            <p class="hero-desc">
                Aplikasi pengajuan cuti karyawan yang mudah, cepat,
                dan terintegrasi untuk mendukung manajemen data kepegawaian.
            </p>
        </div>

        <div class="login-right">
            <h2>Selamat Datang</h2>
            <div class="desc">Silakan masuk untuk melanjutkan</div>

            <?php if ($pesan != '') { ?>
                <div class="alert">⚠ <?php echo $pesan; ?></div>
            <?php } ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>NIP</label>
                    <div class="input-wrap">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 21a8 8 0 0 0-16 0"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <input
type="text"
name="username"
placeholder="Masukkan NIP"
required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="5" y="10" width="14" height="11" rx="2"></rect>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            </svg>
                        </div>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" name="login" class="btn-login">Masuk</button>
            </form>

            <div class="divider">atau</div>

            <div class="forgot-area">
                <a href="lupapassword.php" class="forgot-link">Lupa password?</a>
            </div>
        </div>
    </div>
</body>
</html>