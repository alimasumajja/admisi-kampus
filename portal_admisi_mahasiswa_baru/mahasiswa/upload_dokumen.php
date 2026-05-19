<?php
session_start();

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

$id_user = $_SESSION['id_user'];

// Ambil data pendaftaran
$query = mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
    WHERE user_id='$id_user'
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

<title>Upload Dokumen</title>

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

.form-control{
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

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="text-center text-primary mb-4">
    Upload Dokumen
</h3>

<?php if(isset($_GET['pesan'])) : ?>

    <?php if($_GET['pesan'] == 'sukses') : ?>

        <div class="alert alert-success">
            Dokumen berhasil diupload.
        </div>

    <?php endif; ?>

<?php endif; ?>

<form action="../process/upload_file.php"
method="POST"
enctype="multipart/form-data">

<input type="hidden"
name="pendaftaran_id"
value="<?= $data['id']; ?>">

<div class="mb-3">

    <label class="form-label">
        Upload Foto
    </label>

    <input type="file"
    name="foto"
    class="form-control"
    required>

</div>

<div class="mb-3">

    <label class="form-label">
        Upload KTP
    </label>

    <input type="file"
    name="ktp"
    class="form-control"
    required>

</div>

<div class="mb-3">

    <label class="form-label">
        Upload KK
    </label>

    <input type="file"
    name="kk"
    class="form-control"
    required>

</div>

<div class="mb-3">

    <label class="form-label">
        Upload Ijazah
    </label>

    <input type="file"
    name="ijazah"
    class="form-control"
    required>

</div>

<div class="mb-4">

    <label class="form-label">
        Upload Rapor
    </label>

    <input type="file"
    name="rapor"
    class="form-control"
    required>

</div>

<button type="submit"
class="btn btn-primary w-100">

    Upload Dokumen

</button>

</form>

</div>
</div>
</div>
</div>
</div>

</body>
</html>