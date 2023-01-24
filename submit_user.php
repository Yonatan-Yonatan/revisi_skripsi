<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $username   = $_POST['username'];
    $password   = sha1($_POST['password']);
    $fullname   = $_POST['fullname'];
    $level      = $_POST['level'];

    $query = mysqli_query($koneksi, "INSERT INTO user (username, password, fullname, level) VALUES ('$username', '$password', '$fullname', '$level')");
    if ($query){
        header("location:user.php");
        exit();
    }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}

?>
