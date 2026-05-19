<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

// Statistik
$total_pendaftar = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
"));

$total_lulus = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
    WHERE status_pendaftaran='Lulus'
"));

$total_tidak_lolos = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
    WHERE status_pendaftaran='Tidak Lolos'
"));

$total_pending = mysqli_num_rows(mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
    WHERE status_pendaftaran='Pending'
"));

// Data laporan
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
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Laporan PMB</title>

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

.stat-card{
    color:white;
    border-radius:20px;
    padding:25px;
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

<h2 class="text-primary mb-4">
    Laporan Pendaftaran Mahasiswa
</h2>

<!-- STATISTIK -->
<div class="row mb-4">

<div class="col-md-3 mb-3">

    <div class="stat-card bg-primary shadow">

        <h5>Total Pendaftar</h5>

        <h2>
            <?= $total_pendaftar; ?>
        </h2>

    </div>

</div>

<div class="col-md-3 mb-3">

    <div class="stat-card bg-success shadow">

        <h5>Lulus</h5>

        <h2>
            <?= $total_lulus; ?>
        </h2>

    </div>

</div>

<div class="col-md-3 mb-3">

    <div class="stat-card bg-danger shadow">

        <h5>Tidak Lolos</h5>

        <h2>
            <?= $total_tidak_lolos; ?>
        </h2>

    </div>

</div>

<div class="col-md-3 mb-3">

    <div class="stat-card bg-warning shadow">

        <h5>Pending</h5>

        <h2>
            <?= $total_pending; ?>
        </h2>

    </div>

</div>

</div>

<!-- TABEL -->
<div class="card shadow">

<div class="card-body p-4">

<div class="d-flex justify-content-between mb-4">

    <h4 class="text-primary">
        Data Pendaftar
    </h4>

    <button onclick="window.print()"
    class="btn btn-primary">

        Cetak Laporan

    </button>

</div>

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
                Pending
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