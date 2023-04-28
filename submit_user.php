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
        echo '
            <script>
                alert("Data User BERHASIL Dimasukkan");
                window.location.href="user.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Data User GAGAL Dimasukkan");
                window.location.href="user.php";
            </script>
            ';
        }      
}

?>
