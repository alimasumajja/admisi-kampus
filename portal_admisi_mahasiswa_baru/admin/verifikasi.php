<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
}

require_once __DIR__ . '/../config/koneksi.php';

// Update status
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $status = $_POST['status'];

    mysqli_query($koneksi,"
        UPDATE pendaftaran
        SET status_pendaftaran='$status'
        WHERE id='$id'
    ");

    header("Location: verifikasi.php");
}

// Ambil data
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

<title>Verifikasi Pendaftaran</title>

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
    Verifikasi Pendaftaran
</h3>

<div class="table-responsive">

<table class="table table-bordered">

<thead class="table-primary">

<tr>

    <th>No</th>
    <th>Nama</th>
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

    <td><?= $data['nama_lengkap']; ?></td>

    <td><?= $data['nama_prodi']; ?></td>

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

                <option value="Lulus">
                    Lulus
                </option>

                <option value="Tidak Lolos">
                    Tidak Lolos
                </option>

            </select>

            <button type="submit"
            name="update"
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