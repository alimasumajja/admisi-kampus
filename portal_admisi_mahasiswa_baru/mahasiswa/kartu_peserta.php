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

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kartu Peserta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
}

.navbar{
    background:#0d6efd;
}

.kartu{
    max-width:800px;
    margin:auto;
    border:none;
    border-radius:20px;
    overflow:hidden;
}

.header{
    background:#0d6efd;
    color:white;
    padding:25px;
    text-align:center;
}

.table td{
    padding:12px;
}

.btn-print{
    border-radius:10px;
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

<div class="card shadow kartu">

    <!-- HEADER -->
    <div class="header">

        <h3>
            KARTU PESERTA PMB
        </h3>

        <p class="mb-0">
            Portal Admisi Mahasiswa Baru
        </p>

    </div>

    <!-- BODY -->
    <div class="card-body p-4">

        <div class="row">

            <!-- FOTO -->
            <div class="col-md-3 text-center mb-4">

                <img src="<?= __DIR__; ?>/../assets/img/user.png"
                width="150"
                class="img-thumbnail">

            </div>

            <!-- DATA -->
            <div class="col-md-9">

                <table class="table table-bordered">

                    <tr>
                        <th width="35%">No Pendaftaran</th>
                        <td>
                            <?= $data['no_pendaftaran']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Nama Lengkap</th>
                        <td>
                            <?= $data['nama_lengkap']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>NIK</th>
                        <td>
                            <?= $data['nik']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Asal Sekolah</th>
                        <td>
                            <?= $data['asal_sekolah']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td>
                            <?= $data['nama_prodi']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Tanggal Ujian</th>
                        <td>
                            20 Juni 2026
                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <!-- KETERANGAN -->
        <div class="alert alert-info mt-4">

            <b>Catatan:</b>

            Harap membawa kartu peserta ini saat mengikuti
            ujian seleksi mahasiswa baru.

        </div>

        <!-- BUTTON -->
        <div class="text-center mt-4">

            <button onclick="window.print()"
            class="btn btn-primary btn-print">

                Cetak Kartu Peserta

            </button>

        </div>

    </div>

</div>

</div>

</body>
</html>