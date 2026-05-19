<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

// Tambah pengumuman
if(isset($_POST['simpan'])){

    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];
    $tanggal = date('Y-m-d');

    mysqli_query($koneksi,"
        INSERT INTO pengumuman(
            judul,
            isi,
            tanggal
        ) VALUES(
            '$judul',
            '$isi',
            '$tanggal'
        )
    ");

    header("Location: pengumuman.php");
}

// Hapus pengumuman
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($koneksi,"
        DELETE FROM pengumuman
        WHERE id='$id'
    ");

    header("Location: pengumuman.php");
}

// Ambil data pengumuman
$query = mysqli_query($koneksi,"
    SELECT * FROM pengumuman
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Pengumuman PMB</title>

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

.form-control,
textarea{
    border-radius:10px;
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

<div class="row">

<!-- FORM -->
<div class="col-lg-4 mb-4">

<div class="card shadow">

<div class="card-body p-4">

<h4 class="text-primary mb-4">
    Tambah Pengumuman
</h4>

<form method="POST">

<div class="mb-3">

    <label class="form-label">
        Judul
    </label>

    <input type="text"
    name="judul"
    class="form-control"
    required>

</div>

<div class="mb-3">

    <label class="form-label">
        Isi Pengumuman
    </label>

    <textarea
    name="isi"
    class="form-control"
    rows="5"
    required></textarea>

</div>

<button type="submit"
name="simpan"
class="btn btn-primary w-100">

    Simpan Pengumuman

</button>

</form>

</div>
</div>
</div>

<!-- DATA -->
<div class="col-lg-8">

<div class="card shadow">

<div class="card-body p-4">

<h4 class="text-primary mb-4">
    Data Pengumuman
</h4>

<table class="table table-bordered">

<thead class="table-primary">

<tr>

    <th>No</th>
    <th>Judul</th>
    <th>Tanggal</th>
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
        <b><?= $data['judul']; ?></b>
        <br>
        <small><?= $data['isi']; ?></small>
    </td>

    <td>
        <?= $data['tanggal']; ?>
    </td>

    <td>

        <a href="?hapus=<?= $data['id']; ?>"
        class="btn btn-sm btn-danger"
        onclick="return confirm('Hapus pengumuman?')">

            Hapus

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
</div>

</body>
</html>