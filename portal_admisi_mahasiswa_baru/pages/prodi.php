<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

// Ambil data prodi
$query = mysqli_query($koneksi,"
    SELECT * FROM program_studi
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Data Program Studi</title>

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

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="text-primary">
        Data Program Studi
    </h3>

    <a href="tambah_prodi.php"
    class="btn btn-primary">

        Tambah Prodi

    </a>

</div>

<!-- TABEL -->
<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

    <th width="5%">No</th>
    <th>Kode Prodi</th>
    <th>Nama Prodi</th>
    <th>Jenjang</th>
    <th>Dibuat</th>
    <th width="18%">Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($data = mysqli_fetch_assoc($query)) :
?>

<tr>

    <td>
        <?= $no++; ?>
    </td>

    <td>
        <?= $data['kode_prodi']; ?>
    </td>

    <td>
        <?= $data['nama_prodi']; ?>
    </td>

    <td>
        <?= $data['jenjang']; ?>
    </td>

    <td>
        <?= $data['created_at']; ?>
    </td>

    <td>

        <a href="edit_prodi.php?id=<?= $data['id']; ?>"
        class="btn btn-sm btn-warning">

            Edit

        </a>

        <a href="hapus_prodi.php?id=<?= $data['id']; ?>"
        class="btn btn-sm btn-danger"
        onclick="return confirm('Yakin ingin menghapus data?')">

            Hapus

        </a>

    </td>

</tr>

<?php endwhile; ?>

<?php if(mysqli_num_rows($query) == 0) : ?>

<tr>

    <td colspan="6" class="text-center">

        Data program studi belum tersedia

    </td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>
</div>

</div>

</body>
</html>