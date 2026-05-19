<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Ambil data dari form
    $nama_lengkap       = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email              = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password           = $_POST['password'];
    $konfirmasiPassword = $_POST['konfirmasi_password'];

    // Validasi konfirmasi password
    if($password != $konfirmasiPassword){

        header("Location: register.php?pesan=password");
        exit;

    }

    // Cek email sudah digunakan atau belum
    $cekEmail = mysqli_query($koneksi, "
        SELECT * FROM users
        WHERE email = '$email'
    ");

    if(mysqli_num_rows($cekEmail) > 0){

        header("Location: register.php?pesan=email");
        exit;

    }

    // Enkripsi password
    $passwordHash = md5($password);

    // Simpan data user
    $query = mysqli_query($koneksi, "
        INSERT INTO users (
            nama_lengkap,
            email,
            password,
            role
        ) VALUES (
            '$nama_lengkap',
            '$email',
            '$passwordHash',
            'mahasiswa'
        )
    ");

    // Cek berhasil atau gagal
    if($query){

        header("Location: login.php?pesan=register_berhasil");
        exit;

    }else{

        header("Location: register.php?pesan=gagal");
        exit;

    }

}else{

    header("Location: register.php");
    exit;

}
?>