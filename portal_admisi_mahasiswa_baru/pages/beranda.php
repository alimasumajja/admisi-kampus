<?php
require_once __DIR__ . '/../config/koneksi.php';

// Ambil pengumuman
$pengumuman = mysqli_query($koneksi,"
    SELECT * FROM pengumuman
    ORDER BY id DESC
    LIMIT 3
");

// Ambil jumlah pendaftar
$total_pendaftar = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
"));

// Ambil jumlah prodi
$total_prodi = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT * FROM program_studi
"));

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Beranda PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f5f7fb;
}

/* NAVBAR */
.navbar{
    background:#0d6efd;
}

/* HERO */
.hero{
    background:linear-gradient(
        rgba(13,110,253,0.8),
        rgba(13,110,253,0.8)
    ),
    url('../assets/img/bg-campus.jpg');

    background-size:cover;
    background-position:center;

    color:white;
    padding:120px 0;
}

.hero h1{
    font-size:55px;
    font-weight:bold;
}

/* CARD */
.card{
    border:none;
    border-radius:20px;
}

.stat-card{
    color:white;
    border-radius:20px;
    padding:30px;
}

.icon{
    font-size:45px;
}

.step{
    padding:25px;
    border-radius:20px;
    background:white;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
    height:100%;
}

.footer{
    background:#0d6efd;
    color:white;
    padding:20px;
    text-align:center;
}

</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

    <a class="navbar-brand fw-bold">
        PORTAL PMB
    </a>

    <button class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarNav">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse"
    id="navbarNav">

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">
                <a class="nav-link active"
                href="#">
                    Beranda
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                href="../auth/login.php">
                    Login
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                href="../auth/register.php">
                    Register
                </a>
            </li>

        </ul>

    </div>

</div>

</nav>

<!-- HERO -->
<section class="hero">

<div class="container text-center">

    <h1>
        Portal Admisi Mahasiswa Baru
    </h1>

    <p class="lead mt-3">

        Sistem Pendaftaran Mahasiswa Baru
        Online Universitas

    </p>

    <a href="../auth/register.php"
    class="btn btn-light btn-lg mt-3">

        Daftar Sekarang

    </a>

</div>

</section>

<!-- STATISTIK -->
<div class="container py-5">

<div class="row">

<div class="col-md-6 mb-4">

    <div class="stat-card bg-primary shadow">

        <div class="d-flex justify-content-between">

            <div>

                <h5>Total Pendaftar</h5>

                <h2>
                    <?= $total_pendaftar; ?>
                </h2>

            </div>

            <div class="icon">
                <i class="bi bi-people-fill"></i>
            </div>

        </div>

    </div>

</div>

<div class="col-md-6 mb-4">

    <div class="stat-card bg-success shadow">

        <div class="d-flex justify-content-between">

            <div>

                <h5>Total Program Studi</h5>

                <h2>
                    <?= $total_prodi; ?>
                </h2>

            </div>

            <div class="icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>

        </div>

    </div>

</div>

</div>

</div>

<!-- ALUR PENDAFTARAN -->
<div class="container pb-5">

<h2 class="text-center text-primary mb-5">
    Alur Pendaftaran Mahasiswa Baru
</h2>

<div class="row g-4">

<div class="col-md-3">

    <div class="step text-center">

        <div class="icon text-primary mb-3">
            <i class="bi bi-person-plus-fill"></i>
        </div>

        <h5>Pendaftaran</h5>

        <p>
            Calon mahasiswa melakukan registrasi akun.
        </p>

    </div>

</div>

<div class="col-md-3">

    <div class="step text-center">

        <div class="icon text-success mb-3">
            <i class="bi bi-file-earmark-arrow-up-fill"></i>
        </div>

        <h5>Upload Dokumen</h5>

        <p>
            Upload berkas persyaratan pendaftaran.
        </p>

    </div>

</div>

<div class="col-md-3">

    <div class="step text-center">

        <div class="icon text-warning mb-3">
            <i class="bi bi-patch-check-fill"></i>
        </div>

        <h5>Verifikasi</h5>

        <p>
            Admin melakukan verifikasi data dan dokumen.
        </p>

    </div>

</div>

<div class="col-md-3">

    <div class="step text-center">

        <div class="icon text-danger mb-3">
            <i class="bi bi-megaphone-fill"></i>
        </div>

        <h5>Pengumuman</h5>

        <p>
            Hasil seleksi diumumkan secara online.
        </p>

    </div>

</div>

</div>

</div>

<!-- PENGUMUMAN -->
<div class="container pb-5">

<h2 class="text-center text-primary mb-5">
    Pengumuman Terbaru
</h2>

<div class="row">

<?php while($data = mysqli_fetch_assoc($pengumuman)) : ?>

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<div class="card-body">

    <h5 class="text-primary">
        <?= $data['judul']; ?>
    </h5>

    <small class="text-muted">
        <?= $data['tanggal']; ?>
    </small>

    <p class="mt-3">
        <?= $data['isi']; ?>
    </p>

</div>

</div>

</div>

<?php endwhile; ?>

</div>

</div>

<!-- FOOTER -->
<div class="footer">

<p class="mb-0">
    © 2026 Portal Admisi Mahasiswa Baru
</p>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>