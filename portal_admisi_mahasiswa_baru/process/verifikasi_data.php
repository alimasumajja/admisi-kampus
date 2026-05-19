<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

// Ambil data pendaftar + dokumen
$query = mysqli_query($koneksi,"
    SELECT pendaftaran.*, users.nama_lengkap,
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

    ORDER BY pendaftaran.id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Verifikasi Data</title>

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

.table{
    vertical-align:middle;
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

    <a href="dashboard.php"
    class="btn btn-light">
        Dashboard
    </a>

</div>

</nav>

<!-- CONTENT -->
<div class="container py-5">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="text-primary mb-4">
    Verifikasi Data & Dokumen
</h3>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

    <th>No</th>
    <th>Nama</th>
    <th>Program Studi</th>
    <th>Foto</th>
    <th>KTP</th>
    <th>KK</th>
    <th>Ijazah</th>
    <th>Rapor</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($data = mysqli_fetch_assoc($query)) :
?>

<tr>

    <td><?= $no++; ?></td>

    <td>
        <?= $data['nama_lengkap']; ?>
    </td>

    <td>
        <?= $data['nama_prodi']; ?>
    </td>

    <td>

        <?php if($data['foto']) : ?>

            <a href="../uploads/dokumen/<?= $data['foto']; ?>"
            target="_blank"
            class="btn btn-sm btn-primary">

                Lihat

            </a>

        <?php else : ?>

            <span class="badge bg-danger">
                Belum Upload
            </span>

        <?php endif; ?>

    </td>

    <td>

        <?php if($data['ktp']) : ?>

            <a href="../uploads/dokumen/<?= $data['ktp']; ?>"
            target="_blank"
            class="btn btn-sm btn-primary">

                Lihat

            </a>

        <?php else : ?>

            <span class="badge bg-danger">
                Belum Upload
            </span>

        <?php endif; ?>

    </td>

    <td>

        <?php if($data['kk']) : ?>

            <a href="../uploads/dokumen/<?= $data['kk']; ?>"
            target="_blank"
            class="btn btn-sm btn-primary">

                Lihat

            </a>

        <?php else : ?>

            <span class="badge bg-danger">
                Belum Upload
            </span>

        <?php endif; ?>

    </td>

    <td>

        <?php if($data['ijazah']) : ?>

            <a href="../uploads/dokumen/<?= $data['ijazah']; ?>"
            target="_blank"
            class="btn btn-sm btn-primary">

                Lihat

            </a>

        <?php else : ?>

            <span class="badge bg-danger">
                Belum Upload
            </span>

        <?php endif; ?>

    </td>

    <td>

        <?php if($data['rapor']) : ?>

            <a href="../uploads/dokumen/<?= $data['rapor']; ?>"
            target="_blank"
            class="btn btn-sm btn-primary">

                Lihat

            </a>

        <?php else : ?>

            <span class="badge bg-danger">
                Belum Upload
            </span>

        <?php endif; ?>

    </td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
</div>

</div>

</body>
</html>