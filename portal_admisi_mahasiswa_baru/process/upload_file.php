<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$pendaftaran_id = $_POST['pendaftaran_id'];

// Folder upload
$folder = "../uploads/dokumen/";

// Buat folder jika belum ada
if(!is_dir($folder)){
    mkdir($folder, 0777, true);
}

// Ambil file
$foto   = $_FILES['foto']['name'];
$ktp    = $_FILES['ktp']['name'];
$kk     = $_FILES['kk']['name'];
$ijazah = $_FILES['ijazah']['name'];
$rapor  = $_FILES['rapor']['name'];

// Rename file
$foto_baru   = time() . "_foto_" . $foto;
$ktp_baru    = time() . "_ktp_" . $ktp;
$kk_baru     = time() . "_kk_" . $kk;
$ijazah_baru = time() . "_ijazah_" . $ijazah;
$rapor_baru  = time() . "_rapor_" . $rapor;

// Upload file
move_uploaded_file(
    $_FILES['foto']['tmp_name'],
    $folder . $foto_baru
);

move_uploaded_file(
    $_FILES['ktp']['tmp_name'],
    $folder . $ktp_baru
);

move_uploaded_file(
    $_FILES['kk']['tmp_name'],
    $folder . $kk_baru
);

move_uploaded_file(
    $_FILES['ijazah']['tmp_name'],
    $folder . $ijazah_baru
);

move_uploaded_file(
    $_FILES['rapor']['tmp_name'],
    $folder . $rapor_baru
);

// Simpan ke database
$query = mysqli_query($koneksi,"
    INSERT INTO dokumen(

        pendaftaran_id,
        foto,
        ktp,
        kk,
        ijazah,
        rapor

    ) VALUES(

        '$pendaftaran_id',
        '$foto_baru',
        '$ktp_baru',
        '$kk_baru',
        '$ijazah_baru',
        '$rapor_baru'

    )
");

// Redirect
if($query){

    header("Location: ../mahasiswa/upload_dokumen.php?pesan=sukses");

}else{

    header("Location: ../mahasiswa/upload_dokumen.php?pesan=gagal");

}
?>