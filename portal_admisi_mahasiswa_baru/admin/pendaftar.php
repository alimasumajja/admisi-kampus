<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

// Ambil data pendaftar
$query = mysqli_query($koneksi,"
    SELECT pendaftaran.*, users.nama_lengkap,
    program_studi.nama_prodi
    FROM pendaftaran
    JOIN users ON pendaftaran.user_id = users.id
    LEFT JOIN program_studi
    ON pendaftaran.program_studi_id = program_studi.id
    ORDER BY pendaftaran.id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Pendaftar</title>

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

.table{
    vertical-align:middle;
}

</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark">

<div class="container">

    <a class="navbar-brand fw-bold" href="#">
        ADMIN PMB
    </a>

    <a href="dashboard.php" class="btn btn-light">
        Dashboard
    </a>

</div>

</nav>

<!-- CONTENT -->
<div class="container py-5">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="text-primary mb-4">
    Data Pendaftar Mahasiswa
</h3>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

    <th>No</th>
    <th>No Pendaftaran</th>
    <th>Nama</th>
    <th>Asal Sekolah</th>
    <th>Program Studi</th>
    <th>Status</th>
    <th>Aksi</th>

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
        <?= $data['no_pendaftaran']; ?>
    </td>

    <td>
        <?= $data['nama_lengkap']; ?>
    </td>

    <td>
        <?= $data['asal_sekolah']; ?>
    </td>

    <td>
        <?= $data['nama_prodi']; ?>
    </td>

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
                <?= $data['status_pendaftaran']; ?>
            </span>

        <?php endif; ?>

    </td>

    <td>

        <a href="detail_pendaftar.php?id=<?= $data['id']; ?>"
        class="btn btn-sm btn-primary">

            Detail

        </a>

        <a href="verifikasi.php?id=<?= $data['id']; ?>"
        class="btn btn-sm btn-success">

            Verifikasi

        </a>

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