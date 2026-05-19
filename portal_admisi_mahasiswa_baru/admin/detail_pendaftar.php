<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

$id = $_GET['id'];

// Ambil data pendaftar
$query = mysqli_query($koneksi,"
    SELECT pendaftaran.*, users.nama_lengkap,
    users.email,
    program_studi.nama_prodi,

    dokumen.foto,
    dokumen.ktp,
    dokumen.kk,
    dokumen.ijazah,
    dokumen.rapor

    FROM pendaftaran

    JOIN users
    ON pendaftaran.user_id = users.id

    LEFT JOIN program_studi
    ON pendaftaran.program_studi_id = program_studi.id

    LEFT JOIN dokumen
    ON pendaftaran.id = dokumen.pendaftaran_id

    WHERE pendaftaran.id='$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    header("Location: pendaftar.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Detail Pendaftar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

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

.table td{
    padding:12px;
}

.foto{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:15px;
    border:3px solid #0d6efd;
}

</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark">

<div class="container">

    <a class="navbar-brand fw-bold">
        ADMIN PMB
    </a>

    <a href="pendaftar.php"
    class="btn btn-light">

        Kembali

    </a>

</div>

</nav>

<!-- CONTENT -->
<div class="container py-5">

<div class="card shadow">

<div class="card-body p-5">

<h3 class="text-primary mb-4">
    Detail Pendaftar
</h3>

<div class="row">

<!-- FOTO -->
<div class="col-md-3 text-center mb-4">

<?php if($data['foto']) : ?>

    <img src="../uploads/dokumen/<?= $data['foto']; ?>"
    class="foto">

<?php else : ?>

    <img src="../assets/img/user.png"
    class="foto">

<?php endif; ?>

</div>

<!-- DATA -->
<div class="col-md-9">

<table class="table table-bordered">

<tr>
    <th width="35%">No Pendaftaran</th>
    <td><?= $data['no_pendaftaran']; ?></td>
</tr>

<tr>
    <th>Nama Lengkap</th>
    <td><?= $data['nama_lengkap']; ?></td>
</tr>

<tr>
    <th>Email</th>
    <td><?= $data['email']; ?></td>
</tr>

<tr>
    <th>NIK</th>
    <td><?= $data['nik']; ?></td>
</tr>

<tr>
    <th>NISN</th>
    <td><?= $data['nisn']; ?></td>
</tr>

<tr>
    <th>Tempat, Tanggal Lahir</th>
    <td>
        <?= $data['tempat_lahir']; ?>,
        <?= $data['tanggal_lahir']; ?>
    </td>
</tr>

<tr>
    <th>Jenis Kelamin</th>
    <td>

        <?php
        if($data['jenis_kelamin'] == 'L'){
            echo "Laki-laki";
        }else{
            echo "Perempuan";
        }
        ?>

    </td>
</tr>

<tr>
    <th>No HP</th>
    <td><?= $data['no_hp']; ?></td>
</tr>

<tr>
    <th>Asal Sekolah</th>
    <td><?= $data['asal_sekolah']; ?></td>
</tr>

<tr>
    <th>Program Studi</th>
    <td><?= $data['nama_prodi']; ?></td>
</tr>

<tr>
    <th>Alamat</th>
    <td><?= $data['alamat']; ?></td>
</tr>

<tr>
    <th>Status</th>
    <td>

        <?php if($data['status_pendaftaran'] == 'Lulus') : ?>

            <span class="badge bg-success">
                Lulus
            </span>

        <?php elseif($data['status_pendaftaran'] == 'Tidak Lolos') : ?>

            <span class="badge bg-danger">
                Tidak Lolos
            </span>

        <?php else : ?>

            <span class="badge bg-warning text-dark">
                Pending
            </span>

        <?php endif; ?>

    </td>
</tr>

</table>

</div>

</div>

<!-- DOKUMEN -->
<h4 class="text-primary mt-5 mb-4">
    Dokumen Pendaftar
</h4>

<div class="row">

<div class="col-md-3 mb-3">

<div class="card shadow-sm">

<div class="card-body text-center">

<h6>KTP</h6>

<?php if($data['ktp']) : ?>

<a href="../uploads/dokumen/<?= $data['ktp']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

    Lihat Dokumen

</a>

<?php else : ?>

<span class="badge bg-danger">
    Belum Upload
</span>

<?php endif; ?>

</div>
</div>
</div>

<div class="col-md-3 mb-3">

<div class="card shadow-sm">

<div class="card-body text-center">

<h6>KK</h6>

<?php if($data['kk']) : ?>

<a href="../uploads/dokumen/<?= $data['kk']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

    Lihat Dokumen

</a>

<?php else : ?>

<span class="badge bg-danger">
    Belum Upload
</span>

<?php endif; ?>

</div>
</div>
</div>

<div class="col-md-3 mb-3">

<div class="card shadow-sm">

<div class="card-body text-center">

<h6>Ijazah</h6>

<?php if($data['ijazah']) : ?>

<a href="../uploads/dokumen/<?= $data['ijazah']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

    Lihat Dokumen

</a>

<?php else : ?>

<span class="badge bg-danger">
    Belum Upload
</span>

<?php endif; ?>

</div>
</div>
</div>

<div class="col-md-3 mb-3">

<div class="card shadow-sm">

<div class="card-body text-center">

<h6>Rapor</h6>

<?php if($data['rapor']) : ?>

<a href="../uploads/dokumen/<?= $data['rapor']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

    Lihat Dokumen

</a>

<?php else : ?>

<span class="badge bg-danger">
    Belum Upload
</span>

<?php endif; ?>

</div>
</div>
</div>

</div>

</div>
</div>

</div>

</body>
</html>