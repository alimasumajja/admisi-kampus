<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

// Ambil data pendaftar
$query = mysqli_query($koneksi,"
    SELECT pendaftaran.*, users.nama_lengkap,
    program_studi.nama_prodi

    FROM pendaftaran

    JOIN users
    ON pendaftaran.user_id = users.id

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

<title>Cetak PDF</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    font-size:14px;
}

.judul{
    text-align:center;
    margin-bottom:30px;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th,
.table td{
    border:1px solid #000;
    padding:8px;
}

@media print{

    .btn-print{
        display:none;
    }

}

</style>

</head>
<body>

<div class="container mt-4">

<!-- JUDUL -->
<div class="judul">

    <h2>
        LAPORAN DATA PENDAFTAR PMB
    </h2>

    <p>
        Portal Admisi Mahasiswa Baru
    </p>

</div>

<!-- BUTTON -->
<div class="mb-3">

    <button onclick="window.print()"
    class="btn btn-primary btn-print">

        Cetak PDF

    </button>

</div>

<!-- TABEL -->
<table class="table">

<thead>

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
        <?= $data['status_pendaftaran']; ?>
    </td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

<script>

window.onload = function(){

    window.print();

}

</script>

</body>
</html>