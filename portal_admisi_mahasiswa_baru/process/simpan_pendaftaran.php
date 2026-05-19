<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$nik              = $_POST['nik'];
$nisn             = $_POST['nisn'];
$tempat_lahir     = $_POST['tempat_lahir'];
$tanggal_lahir    = $_POST['tanggal_lahir'];
$jenis_kelamin    = $_POST['jenis_kelamin'];
$no_hp            = $_POST['no_hp'];
$asal_sekolah     = $_POST['asal_sekolah'];
$program_studi_id = $_POST['program_studi_id'];
$alamat           = $_POST['alamat'];

// Generate nomor pendaftaran
$no_pendaftaran = "PMB" . date('YmdHis');

// Cek apakah sudah pernah daftar
$cek = mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
    WHERE user_id='$id_user'
");

if(mysqli_num_rows($cek) > 0){

    // Update data
    $update = mysqli_query($koneksi,"
        UPDATE pendaftaran SET

        nik='$nik',
        nisn='$nisn',
        tempat_lahir='$tempat_lahir',
        tanggal_lahir='$tanggal_lahir',
        jenis_kelamin='$jenis_kelamin',
        no_hp='$no_hp',
        asal_sekolah='$asal_sekolah',
        program_studi_id='$program_studi_id',
        alamat='$alamat'

        WHERE user_id='$id_user'
    ");

    if($update){

        header("Location: ../mahasiswa/formulir.php?pesan=sukses");

    }else{

        header("Location: ../mahasiswa/formulir.php?pesan=gagal");

    }

}else{

    // Simpan data baru
    $insert = mysqli_query($koneksi,"
        INSERT INTO pendaftaran(

            user_id,
            no_pendaftaran,
            nik,
            nisn,
            tempat_lahir,
            tanggal_lahir,
            jenis_kelamin,
            no_hp,
            asal_sekolah,
            program_studi_id,
            alamat,
            status_pendaftaran

        ) VALUES(

            '$id_user',
            '$no_pendaftaran',
            '$nik',
            '$nisn',
            '$tempat_lahir',
            '$tanggal_lahir',
            '$jenis_kelamin',
            '$no_hp',
            '$asal_sekolah',
            '$program_studi_id',
            '$alamat',
            'Pending'

        )
    ");

    if($insert){

        header("Location: ../mahasiswa/formulir.php?pesan=sukses");

    }else{

        header("Location: ../mahasiswa/formulir.php?pesan=gagal");

    }

}
?>