<?php
session_start();

// Hapus semua session
session_destroy();

// Redirect ke halaman login admin
header("Location: ../auth/login.php");
exit;
?>