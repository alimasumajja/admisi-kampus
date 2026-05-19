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

<title>Pembayaran PMB</title>

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

.info-bank{
    background:#f8f9fa;
    border-radius:15px;
    padding:20px;
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

<div class="card-body p-5">

<h2 class="text-center text-primary mb-4">
    Pembayaran PMB
</h2>

<!-- INFO -->
<div class="info-bank mb-4">

    <h5 class="mb-3">
        Informasi Pembayaran
    </h5>

    <table class="table">

        <tr>
            <th width="35%">Bank</th>
            <td>Bank BRI</td>
        </tr>

        <tr>
            <th>No Rekening</th>
            <td>1234567890</td>
        </tr>

        <tr>
            <th>Atas Nama</th>
            <td>Universitas PMB</td>
        </tr>

        <tr>
            <th>Total Pembayaran</th>
            <td>
                <b>Rp 350.000</b>
            </td>
        </tr>

    </table>

</div>

<!-- ALERT -->
<?php if(isset($_GET['pesan'])) : ?>

    <?php if($_GET['pesan'] == 'sukses') : ?>

        <div class="alert alert-success">
            Bukti pembayaran berhasil diupload.
        </div>

    <?php elseif($_GET['pesan'] == 'gagal') : ?>

        <div class="alert alert-danger">
            Upload pembayaran gagal.
        </div>

    <?php endif; ?>

<?php endif; ?>

<!-- FORM -->
<form action="<?= __DIR__ . '/../process/proses_pembayaran.php'; ?>"
method="POST"
enctype="multipart/form-data">

<input type="hidden"
name="pendaftaran_id"
value="<?= $data['id']; ?>">

<div class="mb-3">

    <label class="form-label">
        Nama Pengirim
    </label>

    <input type="text"
    name="nama_pengirim"
    class="form-control"
    required>

</div>

<div class="mb-3">

    <label class="form-label">
        Tanggal Transfer
    </label>

    <input type="date"
    name="tanggal_transfer"
    class="form-control"
    required>

</div>

<div class="mb-3">

    <label class="form-label">
        Upload Bukti Pembayaran
    </label>

    <input type="file"
    name="bukti_pembayaran"
    class="form-control"
    required>

</div>

<button type="submit"
class="btn btn-primary w-100">

    Kirim Pembayaran

</button>

</form>

</div>
</div>
</div>
</div>
</div>

</body>
</html>