<?php
session_start();

if(isset($_SESSION['role'])){

    if($_SESSION['role'] == 'admin'){
        header("Location: ../admin/dashboard.php");
    }else{
        header("Location: ../mahasiswa/dashboard.php");
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Admisi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background: linear-gradient(
                rgba(13,110,253,0.8),
                rgba(13,110,253,0.8)
            ),
            url('../assets/img/background.jpg');

            background-size: cover;
            background-position: center;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card{
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .card-body{
            padding: 40px;
        }

        .logo{
            width: 90px;
            height: 90px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;

            margin: auto;
            font-size: 40px;
        }

        .form-control{
            height: 50px;
            border-radius: 10px;
        }

        .btn-login{
            height: 50px;
            border-radius: 10px;
            font-weight: bold;
        }

        .title{
            font-weight: bold;
            color: #0d6efd;
        }

        .subtitle{
            color: gray;
            font-size: 14px;
        }

        .input-group-text{
            border-radius: 10px 0 0 10px;
        }

        .register-link{
            text-decoration: none;
            font-weight: 500;
        }

    </style>
</head>
<body>

<div class="card shadow-lg login-card">

    <div class="card-body">

        <!-- LOGO -->
        <div class="text-center mb-4">

            <div class="logo mb-3">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>

            <h3 class="title">
                Portal Admisi
            </h3>

            <p class="subtitle">
                Login Sistem Penerimaan Mahasiswa Baru
            </p>

        </div>

        <!-- ALERT -->
        <!-- ALERT -->
<?php if(isset($_GET['pesan'])) : ?>

    <?php if($_GET['pesan'] == 'gagal') : ?>

        <div class="alert alert-danger">
            Email atau password salah!
        </div>

    <?php elseif($_GET['pesan'] == 'register_berhasil') : ?>

        <div class="alert alert-success">
            Registrasi berhasil, silakan login.
        </div>

    <?php endif; ?>

<?php endif; ?>

        <!-- FORM LOGIN -->
        <form action="proses_login.php" method="POST">

            <!-- EMAIL -->
            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan email"
                        required
                    >

                </div>

            </div>

            <!-- PASSWORD -->
            <div class="mb-4">

                <label class="form-label">
                    Password
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >

                </div>

            </div>

            <!-- BUTTON -->
            <div class="d-grid">

                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login
                </button>

            </div>

        </form>

        <!-- REGISTER -->
        <div class="text-center mt-4">

            <p class="mb-0">
                Belum punya akun?

                <a href="register.php" class="register-link">
                    Daftar Sekarang
                </a>
            </p>

        </div>

        <!-- BACK -->
        <div class="text-center mt-3">

            <a href="../index.php" class="text-decoration-none">
                ← Kembali ke Beranda
            </a>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>