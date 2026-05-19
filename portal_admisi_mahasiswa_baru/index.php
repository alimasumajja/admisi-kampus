<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Admisi Mahasiswa Baru</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body{
            background-color: #f5f7fb;
        }

        .navbar{
            background: #0d6efd;
        }

        .navbar-brand,
        .nav-link{
            color: white !important;
            font-weight: 500;
        }

        .hero{
            background: linear-gradient(rgba(13,110,253,0.8), rgba(13,110,253,0.8)),
            url('assets/img/banner.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
        }

        .hero h1{
            font-size: 52px;
            font-weight: bold;
        }

        .hero p{
            font-size: 18px;
        }

        .section-title{
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card-feature{
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card-feature:hover{
            transform: translateY(-5px);
        }

        .icon-box{
            width: 70px;
            height: 70px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            margin: auto;
        }

        .alur-box{
            text-align: center;
            padding: 20px;
        }

        .footer{
            background: #0d6efd;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            PORTAL ADMISI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Program Studi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Alur Pendaftaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Pengumuman</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="auth/login.php">Login</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-light ms-2" href="auth/register.php">
                        Daftar Sekarang
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero text-center">
    <div class="container">

        <h1>Portal Admisi Mahasiswa Baru</h1>

        <p class="mt-3">
            Sistem Penerimaan Mahasiswa Baru Berbasis Web
        </p>

        <a href="auth/register.php" class="btn btn-warning btn-lg mt-4">
            Daftar Sekarang
        </a>

    </div>
</section>

<!-- FITUR -->
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="section-title">Fitur Utama</h2>
            <p>
                Mempermudah proses penerimaan mahasiswa baru secara online
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>

                    <h5>Pendaftaran Online</h5>

                    <p>
                        Calon mahasiswa dapat melakukan pendaftaran secara online kapan saja.
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>

                    <h5>Upload Dokumen</h5>

                    <p>
                        Upload dokumen persyaratan dengan mudah dan cepat.
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>

                    <h5>Pengumuman Online</h5>

                    <p>
                        Hasil seleksi dapat dilihat langsung melalui dashboard mahasiswa.
                    </p>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ALUR -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="section-title">Alur Pendaftaran</h2>
        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="alur-box">
                    <i class="fa-solid fa-user fa-3x text-primary mb-3"></i>
                    <h5>Registrasi</h5>
                    <p>Buat akun pendaftaran</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alur-box">
                    <i class="fa-solid fa-file-lines fa-3x text-primary mb-3"></i>
                    <h5>Isi Formulir</h5>
                    <p>Lengkapi data pendaftaran</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alur-box">
                    <i class="fa-solid fa-credit-card fa-3x text-primary mb-3"></i>
                    <h5>Pembayaran</h5>
                    <p>Lakukan pembayaran administrasi</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alur-box">
                    <i class="fa-solid fa-graduation-cap fa-3x text-primary mb-3"></i>
                    <h5>Pengumuman</h5>
                    <p>Lihat hasil seleksi online</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- PROGRAM STUDI -->
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="section-title">Program Studi</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card shadow border-0 p-3 text-center">
                    <h5>Teknik Informatika</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow border-0 p-3 text-center">
                    <h5>Sistem Informasi</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow border-0 p-3 text-center">
                    <h5>Manajemen Informatika</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow border-0 p-3 text-center">
                    <h5>Desain Komunikasi Visual</h5>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center text-white" style="background:#0d6efd;">
    <div class="container">

        <h2>
            Bergabung Bersama Kampus Kami
        </h2>

        <p class="mt-3">
            Daftarkan diri Anda sekarang dan raih masa depan terbaik.
        </p>

        <a href="auth/register.php" class="btn btn-warning btn-lg mt-3">
            Mulai Pendaftaran
        </a>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer text-center">
    <div class="container">

        <p class="mb-0">
            &copy; <?php echo date('Y'); ?> Portal Admisi Mahasiswa Baru
        </p>

    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>