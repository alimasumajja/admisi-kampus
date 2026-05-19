<?php
session_start();

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

$id_user = $_SESSION['id_user'];

// Ambil data hasil seleksi
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

// Status
$status = $data['status_pendaftaran'];

if($status == 'Lulus'){

    $bg = 'success';
    $icon = '🎉';

}elseif($status == 'Tidak Lolos'){

    $bg = 'danger';
    $icon = '❌';

}else{

    $bg = 'warning';
    $icon = '⏳';

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hasil Seleksi</title>

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

.status-icon{
    font-size:70px;
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

<div class="card-body text-center p-5">

    <div class="status-icon mb-3">
        <?= $icon; ?>
    </div>

    <h2 class="text-<?= $bg; ?> mb-4">

        <?php

        if($status == 'Lulus'){

            echo "SELAMAT ANDA LULUS";

        }elseif($status == 'Tidak Lolos'){

            echo "ANDA TIDAK LOLOS";

        }else{

            echo "HASIL BELUM TERSEDIA";

        }

        ?>

    </h2>

    <table class="table table-bordered text-start">

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
            <th>Status Seleksi</th>
            <td>
                <span class="badge bg-<?= $bg; ?>">
                    <?= $status; ?>
                </span>
            </td>
        </tr>

    </table>

    <?php if($status == 'Lulus') : ?>

    <div class="alert alert-success mt-4">

        Silakan melakukan daftar ulang sesuai jadwal
        yang telah ditentukan.

    </div>

    <?php elseif($status == 'Tidak Lolos') : ?>

    <div class="alert alert-danger mt-4">

        Tetap semangat dan terus mencoba kesempatan lainnya.

    </div>

    <?php else : ?>

    <div class="alert alert-warning mt-4">

        Hasil seleksi masih dalam proses verifikasi admin.

    </div>

    <?php endif; ?>

    <div class="mt-4">

        <a href="dashboard.php"
        class="btn btn-primary">

            Kembali ke Dashboard

        </a>

        <?php if($status == 'Lulus') : ?>

        <a href="kartu_peserta.php"
        class="btn btn-success">

            Cetak Kartu Peserta

        </a>

        <?php endif; ?>

    </div>

</div>
</div>
</div>
</div>
</div>

</body>
</html>