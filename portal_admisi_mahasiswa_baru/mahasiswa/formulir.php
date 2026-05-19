<?php
session_start();
if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

$prodi = mysqli_query($koneksi,"SELECT * FROM program_studi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulir Pendaftaran</title>

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

.form-control,
.form-select{
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

<!-- FORM -->
<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="text-center text-primary mb-4">
    Formulir Pendaftaran
</h3>

<form action="../process/simpan_pendaftaran.php" method="POST">

<div class="row">

    <div class="col-md-6 mb-3">
        <label>NIK</label>
        <input type="text" name="nik" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>NISN</label>
        <input type="text" name="nisn" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Jenis Kelamin</label>

        <select name="jenis_kelamin" class="form-select" required>
            <option value="">Pilih</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Asal Sekolah</label>
        <input type="text" name="asal_sekolah" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Program Studi</label>

        <select name="program_studi_id" class="form-select" required>

            <option value="">Pilih Prodi</option>

            <?php while($p = mysqli_fetch_assoc($prodi)) : ?>

            <option value="<?= $p['id']; ?>">
                <?= $p['nama_prodi']; ?>
            </option>

            <?php endwhile; ?>

        </select>
    </div>

    <div class="col-12 mb-3">
        <label>Alamat</label>

        <textarea name="alamat"
        class="form-control"
        rows="4"
        required></textarea>
    </div>

</div>

<button type="submit" class="btn btn-primary w-100">
    Simpan Pendaftaran
</button>

</form>

</div>
</div>
</div>
</div>
</div>

</body>
</html>