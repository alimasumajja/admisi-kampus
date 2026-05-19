<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Ambil data dari form
    $email      = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password   = md5($_POST['password']);

    // Cek user berdasarkan email & password
    $query = mysqli_query($koneksi, "
        SELECT * FROM users
        WHERE email = '$email'
        AND password = '$password'
    ");

    // Hitung data ditemukan
    $cek = mysqli_num_rows($query);

    if($cek > 0){

        // Ambil data user
        $data = mysqli_fetch_assoc($query);

        // Simpan session
        $_SESSION['id_user'] = $data['id'];
        $_SESSION['nama']    = $data['nama_lengkap'];
        $_SESSION['email']   = $data['email'];
        $_SESSION['role']    = $data['role'];

        // Redirect berdasarkan role
        if($data['role'] == 'admin'){

            header("Location: ../admin/dashboard.php");

        }else{

            header("Location: ../mahasiswa/dashboard.php");

        }

        exit;

    }else{

        // Login gagal
        header("Location: login.php?pesan=gagal");
        exit;

    }

}else{

    // Jika akses langsung
    header("Location: login.php");
    exit;

}
?>