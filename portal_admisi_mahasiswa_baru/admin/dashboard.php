<?php
session_start();

if(!isset($_SESSION['role'])){

    header("Location: ../auth/login.php");
    exit;

}

if($_SESSION['role'] != 'admin'){

    header("Location: ../auth/login.php");
    exit;

}

require_once __DIR__ . '/../config/koneksi.php';

// Total Mahasiswa
$total_mahasiswa = mysqli_num_rows(mysqli_query($koneksi,
"SELECT * FROM users WHERE role='mahasiswa'"));

// Total Pendaftaran
$total_pendaftaran = mysqli_num_rows(mysqli_query($koneksi,
"SELECT * FROM pendaftaran"));

// Total Lulus
$total_lulus = mysqli_num_rows(mysqli_query($koneksi,
"SELECT * FROM pendaftaran WHERE status_pendaftaran='Lulus'"));

// Total Pending
$total_pending = mysqli_num_rows(mysqli_query($koneksi,
"SELECT * FROM pembayaran WHERE status_pembayaran='Pending'"));

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background-color: #f5f7fb;
        }

        .sidebar{
            width: 260px;
            height: 100vh;
            background: #0d6efd;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar h3{
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a{
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            transition: 0.3s;
        }

        .sidebar a:hover{
            background: rgba(255,255,255,0.2);
        }

        .content{
            margin-left: 260px;
            padding: 30px;
        }

        .topbar{
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .card-dashboard{
            border: none;
            border-radius: 20px;
            color: white;
            transition: 0.3s;
        }

        .card-dashboard:hover{
            transform: translateY(-5px);
        }

        .card-icon{
            font-size: 45px;
            opacity: 0.3;
        }

        .table-container{
            background: white;
            border-radius: 20px;
            padding: 20px;
        }

    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h3>
        PORTAL ADMISI
    </h3>

    <a href="dashboard.php">
        <i class="fa-solid fa-gauge"></i>
        Dashboard
    </a>

    <a href="pendaftar.php">
        <i class="fa-solid fa-users"></i>
        Data Pendaftar
    </a>

    <a href="verifikasi.php">
        <i class="fa-solid fa-circle-check"></i>
        Verifikasi Berkas
    </a>

    <a href="pembayaran.php">
        <i class="fa-solid fa-money-bill"></i>
        Pembayaran
    </a>

    <a href="pengumuman.php">
        <i class="fa-solid fa-bullhorn"></i>
        Pengumuman
    </a>

    <a href="laporan.php">
        <i class="fa-solid fa-file"></i>
        Laporan
    </a>

    <a href="../auth/logout.php">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

</div>

<!-- CONTENT -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <div>
            <h4 class="mb-0">
                Dashboard Admin
            </h4>

            <small>
                Selamat datang,
                <b><?php echo $_SESSION['nama']; ?></b>
            </small>
        </div>

        <div>
            <i class="fa-solid fa-user-shield fa-2x text-primary"></i>
        </div>

    </div>

    <!-- CARD -->
    <div class="row g-4 mb-4">

        <div class="col-md-3">

            <div class="card card-dashboard bg-primary shadow p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <h5>Total Mahasiswa</h5>
                        <h2><?php echo $total_mahasiswa; ?></h2>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-dashboard bg-success shadow p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <h5>Total Pendaftaran</h5>
                        <h2><?php echo $total_pendaftaran; ?></h2>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-dashboard bg-warning shadow p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <h5>Mahasiswa Lulus</h5>
                        <h2><?php echo $total_lulus; ?></h2>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-dashboard bg-danger shadow p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <h5>Pembayaran Pending</h5>
                        <h2><?php echo $total_pending; ?></h2>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-container shadow">

        <div class="d-flex justify-content-between mb-3">

            <h5>
                Data Pendaftaran Terbaru
            </h5>

            <a href="pendaftar.php" class="btn btn-primary">
                Lihat Semua
            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

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

                    $query = mysqli_query($koneksi, "
                        SELECT pendaftaran.*, users.nama_lengkap,
                        program_studi.nama_prodi
                        FROM pendaftaran
                        JOIN users
                        ON pendaftaran.user_id = users.id
                        LEFT JOIN program_studi
                        ON pendaftaran.program_studi_id = program_studi.id
                        ORDER BY pendaftaran.id DESC
                        LIMIT 5
                    ");

                    while($data = mysqli_fetch_assoc($query)) :
                    ?>

                    <tr>

                        <td><?php echo $no++; ?></td>

                        <td>
                            <?php echo $data['no_pendaftaran']; ?>
                        </td>

                        <td>
                            <?php echo $data['nama_lengkap']; ?>
                        </td>

                        <td>
                            <?php echo $data['asal_sekolah']; ?>
                        </td>

                        <td>
                            <?php echo $data['nama_prodi']; ?>
                        </td>

                        <td>

                            <?php

                            if($data['status_pendaftaran'] == 'Lulus'){

                                echo '<span class="badge bg-success">Lulus</span>';

                            }elseif($data['status_pendaftaran'] == 'Tidak Lolos'){

                                echo '<span class="badge bg-danger">Tidak Lolos</span>';

                            }else{

                                echo '<span class="badge bg-warning text-dark">
                                '.$data['status_pendaftaran'].'
                                </span>';

                            }

                            ?>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>