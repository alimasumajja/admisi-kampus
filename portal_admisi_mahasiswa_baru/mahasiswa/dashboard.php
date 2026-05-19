<?php
session_start();

if(!isset($_SESSION['role'])){

    header("Location: ../auth/login.php");
    exit;

}

if($_SESSION['role'] != 'mahasiswa'){

    header("Location: ../auth/login.php");
    exit;

}

require_once __DIR__ . '/../config/koneksi.php';

$id_user = $_SESSION['id_user'];

$queryUser = mysqli_query($koneksi, "
    SELECT * FROM users
    WHERE id = '$id_user'
");

$user = mysqli_fetch_assoc($queryUser);

$queryPendaftaran = mysqli_query($koneksi, "
    SELECT pendaftaran.*, program_studi.nama_prodi
    FROM pendaftaran
    LEFT JOIN program_studi
    ON pendaftaran.program_studi_id = program_studi.id
    WHERE user_id = '$id_user'
");

$pendaftaran = mysqli_fetch_assoc($queryPendaftaran);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
            background: linear-gradient(
                rgba(13,110,253,0.8),
                rgba(13,110,253,0.8)
            ),
            url('../assets/img/banner.jpg');

            background-size: cover;
            background-position: center;

            color: white;
            padding: 100px 0;
        }

        .hero h1{
            font-size: 50px;
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
            border-radius: 20px;
            transition: 0.3s;
        }

        .card-feature:hover{
            transform: translateY(-5px);
        }

        .icon-box{
            width: 80px;
            height: 80px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;

            margin: auto;
            font-size: 30px;
        }

        .status-box{
            border-radius: 20px;
            padding: 20px;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .info-card{
            border: none;
            border-radius: 20px;
        }

        .footer{
            background: #0d6efd;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
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

        <button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="formulir.php">
                        Formulir
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="upload_dokumen.php">
                        Upload Dokumen
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="pembayaran.php">
                        Pembayaran
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="hasil_seleksi.php">
                        Hasil Seleksi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-light ms-2"
                    href="../auth/logout.php">
                        Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="hero text-center">

    <div class="container">

        <h1>
            Selamat Datang,
            <?php echo $user['nama_lengkap']; ?>
        </h1>

        <p class="mt-3">
            Dashboard Portal Admisi Mahasiswa Baru
        </p>

    </div>

</section>

<!-- STATUS -->
<section class="py-5">

    <div class="container">

        <?php

        if($pendaftaran){

            $status = $pendaftaran['status_pendaftaran'];

            if($status == 'Lulus'){

                $bg = 'bg-success';

            }elseif($status == 'Tidak Lolos'){

                $bg = 'bg-danger';

            }else{

                $bg = 'bg-warning text-dark';

            }

        ?>

        <div class="status-box <?php echo $bg; ?> shadow">

            Status Pendaftaran:
            <?php echo $status; ?>

        </div>

        <?php }else{ ?>

        <div class="status-box bg-secondary shadow">

            Anda belum mengisi formulir pendaftaran.

        </div>

        <?php } ?>

    </div>

</section>

<!-- MENU -->
<section class="pb-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">
                Menu Mahasiswa
            </h2>

            <p>
                Kelola proses admisi mahasiswa melalui dashboard
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-3">

                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>

                    <h5>
                        Formulir
                    </h5>

                    <p>
                        Lengkapi formulir pendaftaran mahasiswa baru.
                    </p>

                    <a href="formulir.php"
                    class="btn btn-primary">
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>

                    <h5>
                        Upload Dokumen
                    </h5>

                    <p>
                        Upload dokumen persyaratan pendaftaran.
                    </p>

                    <a href="upload_dokumen.php"
                    class="btn btn-primary">
                        Upload
                    </a>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>

                    <h5>
                        Pembayaran
                    </h5>

                    <p>
                        Lakukan pembayaran biaya administrasi.
                    </p>

                    <a href="pembayaran.php"
                    class="btn btn-primary">
                        Bayar
                    </a>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-feature shadow p-4 text-center">

                    <div class="icon-box mb-3">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>

                    <h5>
                        Hasil Seleksi
                    </h5>

                    <p>
                        Lihat hasil seleksi penerimaan mahasiswa.
                    </p>

                    <a href="hasil_seleksi.php"
                    class="btn btn-primary">
                        Lihat
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- INFORMASI -->
<section class="pb-5">

    <div class="container">

        <div class="row g-4">

            <div class="col-md-6">

                <div class="card info-card shadow">

                    <div class="card-body p-4">

                        <h4 class="mb-4">
                            Biodata Mahasiswa
                        </h4>

                        <table class="table">

                            <tr>
                                <th>Nama</th>
                                <td>
                                    <?php echo $user['nama_lengkap']; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>
                                    <?php echo $user['email']; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Program Studi</th>
                                <td>
                                    <?php
                                    echo $pendaftaran['nama_prodi']
                                    ?? '-';
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th>No Pendaftaran</th>
                                <td>
                                    <?php
                                    echo $pendaftaran['no_pendaftaran']
                                    ?? '-';
                                    ?>
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card info-card shadow">

                    <div class="card-body p-4">

                        <h4 class="mb-4">
                            Informasi PMB
                        </h4>

                        <ul class="list-group">

                            <li class="list-group-item">
                                Jadwal Seleksi:
                                20 Juni 2026
                            </li>

                            <li class="list-group-item">
                                Pengumuman:
                                30 Juni 2026
                            </li>

                            <li class="list-group-item">
                                Daftar Ulang:
                                1 - 10 Juli 2026
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="footer text-center">

    <div class="container">

        <p class="mb-0">
            &copy; <?php echo date('Y'); ?>
            Portal Admisi Mahasiswa Baru
        </p>

    </div>

</footer>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>