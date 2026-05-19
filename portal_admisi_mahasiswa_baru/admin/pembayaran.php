<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

// Verifikasi pembayaran
if(isset($_POST['verifikasi'])){

    $id = $_POST['id'];
    $status = $_POST['status'];

    mysqli_query($koneksi,"
        UPDATE pembayaran
        SET status_pembayaran='$status'
        WHERE id='$id'
    ");

    header("Location: pembayaran.php");
}

// Ambil data pembayaran
$query = mysqli_query($koneksi,"
    SELECT pembayaran.*, users.nama_lengkap
    FROM pembayaran
    JOIN pendaftaran
    ON pembayaran.pendaftaran_id = pendaftaran.id
    JOIN users
    ON pendaftaran.user_id = users.id
    ORDER BY pembayaran.id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verifikasi Pembayaran</title>

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

</style>

</head>
<body>

<nav class="navbar navbar-dark">

<div class="container">

    <a class="navbar-brand fw-bold">
        ADMIN PMB
    </a>

    <a href="dashboard.php" class="btn btn-light">
        Dashboard
    </a>

</div>

</nav>

<div class="container py-5">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="text-primary mb-4">
    Verifikasi Pembayaran
</h3>

<div class="table-responsive">

<table class="table table-bordered">

<thead class="table-primary">

<tr>

    <th>No</th>
    <th>Nama</th>
    <th>Pengirim</th>
    <th>Tanggal</th>
    <th>Bukti</th>
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

    <td><?= $data['nama_lengkap']; ?></td>

    <td><?= $data['nama_pengirim']; ?></td>

    <td><?= $data['tanggal_transfer']; ?></td>

    <td>

        <a href="<?= __DIR__ . '/../uploads/pembayaran/' . $data['bukti_pembayaran']; ?>"
        target="_blank"
        class="btn btn-sm btn-info">

            Lihat

        </a>

    </td>

    <td>

        <?php if($data['status_pembayaran'] == 'Terverifikasi') : ?>

            <span class="badge bg-success">
                Terverifikasi
            </span>

        <?php else : ?>

            <span class="badge bg-warning text-dark">
                Pending
            </span>

        <?php endif; ?>

    </td>

    <td>

        <form method="POST" class="d-flex gap-2">

            <input type="hidden"
            name="id"
            value="<?= $data['id']; ?>">

            <select name="status"
            class="form-select form-select-sm">

                <option value="Pending">
                    Pending
                </option>

                <option value="Terverifikasi">
                    Terverifikasi
                </option>

            </select>

            <button type="submit"
            name="verifikasi"
            class="btn btn-sm btn-primary">

                Simpan

            </button>

        </form>

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