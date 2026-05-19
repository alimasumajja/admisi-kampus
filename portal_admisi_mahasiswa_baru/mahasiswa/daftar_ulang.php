<?php
session_start();

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

$id_user = $_SESSION['id_user'];

// Ambil data mahasiswa
$query = mysqli_query($koneksi,"
    SELECT pendaftaran.*, users.nama_lengkap,
    program_studi.nama_prodi
    FROM pendaftaran
    JOIN users ON pendaftaran.user_id = users.id
    LEFT JOIN program_studi
    ON pendaftaran.program_studi_id = program_studi.id
    WHERE pendaftaran.user_id='$id_user'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    header("Location: formulir.php");
    exit;
}

// Hanya mahasiswa lulus yang bisa daftar ulang
if($data['status_pendaftaran'] != 'Lulus'){
    header("Location: hasil_seleksi.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Daftar Ulang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
}

.navbar{
    background:#0d6efd;
}

.card{
    border:none;
    border-radius:20px;
}

.step{
    padding:15px;
    border-radius:15px;
    background:#f8f9fa;
    margin-bottom:15px;
}

</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark">

<div class="container">

    <a class="navbar-brand fw-bold" href="#">
        PORTAL ADMISI
    </a>

    <a href="dashboard.php" class="btn btn-light">
        Dashboard
    </a>

</div>

</nav>

<!-- CONTENT -->
<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-body p-5">

<h2 class="text-center text-primary mb-4">
    Daftar Ulang Mahasiswa
</h2>

<div class="alert alert-success">

    Selamat <b><?= $data['nama_lengkap']; ?></b>,
    Anda dinyatakan <b>LULUS</b> seleksi PMB.

</div>

<table class="table table-bordered mb-4">

<tr>
    <th width="35%">No Pendaftaran</th>
    <td><?= $data['no_pendaftaran']; ?></td>
</tr>

<tr>
    <th>Nama Lengkap</th>
    <td><?= $data['nama_lengkap']; ?></td>
</tr>

<tr>
    <th>Program Studi</th>
    <td><?= $data['nama_prodi']; ?></td>
</tr>

<tr>
    <th>Status</th>
    <td>
        <span class="badge bg-success">
            <?= $data['status_pendaftaran']; ?>
        </span>
    </td>
</tr>

</table>

<h5 class="mb-3">
    Tahapan Daftar Ulang
</h5>

<div class="step">
    1. Cetak kartu peserta PMB.
</div>

<div class="step">
    2. Melakukan pembayaran daftar ulang.
</div>

<div class="step">
    3. Upload bukti pembayaran.
</div>

<div class="step">
    4. Menunggu verifikasi admin.
</div>

<div class="step">
    5. Mendapatkan NIM mahasiswa.
</div>

<div class="alert alert-warning mt-4">

    Jadwal daftar ulang:
    <b>1 Juli 2026 - 10 Juli 2026</b>

</div>

<div class="d-grid gap-2 mt-4">

    <a href="kartu_peserta.php"
    class="btn btn-primary">

        Cetak Kartu Peserta

    </a>

    <a href="pembayaran.php"
    class="btn btn-success">

        Pembayaran Daftar Ulang

    </a>

</div>

</div>
</div>
</div>
</div>
</div>

</body>
</html>