<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$_SESSION['isLoggedin']= '1';
$username2 = $_POST['username'];
$password1 = $_POST['password'];
$password2 = sha1($password1);

$username = mysqli_real_escape_string($koneksi, $username2);
$password = mysqli_real_escape_string($koneksi, $password2);

if (empty($username) && empty($password)) {
	header('location:index.php?error=Username dan Password Kosong!');
} else if (empty($username)) {
	header('location:index.php?error=Username Kosong!');
} else if (empty($password)) {
	header('location:index.php?error=Password Kosong!');
}

$q = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
$row = mysqli_fetch_array ($q);

if (mysqli_num_rows($q) == 1) {
    $_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $username;
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['level']    = $row['level'];
    
    if ($_SESSION['level'] == 'owner'){
        header('location:index.php');
    } else if ($_SESSION['level'] == 'admin'){
        header('location:index.php');
    } else if ($_SESSION['level'] == 'kasir'){
        header('location:index.php');
    }

	
} else {
	header('location:login.php?error=Anda Belum Terdaftar!');
}
?>