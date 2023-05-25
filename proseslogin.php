<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

$username2 = $_POST['username'];
$password1 = $_POST['password'];
$password2 = sha1($password1);

$username = mysqli_real_escape_string($koneksi, $username2);
$password = mysqli_real_escape_string($koneksi, $password2);

$q = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
$row = mysqli_fetch_array ($q);

if (mysqli_num_rows($q) > 0) {
    session_start();
    $_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $username;
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['level']    = $row['level'];
    $_SESSION['status_akun'] = $row['status_akun'];
    $_SESSION['isLoggedin']= '1';
    
    if ($_SESSION['status_akun'] == '0'){    
        if ($_SESSION['level'] == 'owner'){
            echo '
            <script>
                alert("Selamat Datang");
                window.location.href="index.php";
            </script>
            ';
        } else if ($_SESSION['level'] == 'admin'){
            echo '
            <script>
                alert("Selamat Datang");
                window.location.href="index.php";
            </script>
            ';
        } else if ($_SESSION['level'] == 'kasir'){
            echo '
            <script>
                alert("Selamat Datang");
                window.location.href="index.php";
            </script>
            ';
        }
    } else {
        echo '
        <script>
            alert("Maaf Akun Anda Sudah TIDAK AKTIF !!");
            window.location.href="logout.php";
        </script>
        ';
    }	
} else {
	header('location:login.php?error=User Name / Password Salah!!');
}
?>