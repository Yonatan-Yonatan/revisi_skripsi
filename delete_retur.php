<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id_retur = $_GET['id_retur'];

     $select=" select * from retur_barang where id_retur='$id_retur' limit 1";
        $result=mysqli_query($koneksi, $select);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $id_produk = $row['id_produk'];
                $stok = $row['quantity'];
                $status = $row['status'];
            }
        }
        if ($status=="Diajukan" || $status=="Diambil"){
        $getdata = mysqli_query($koneksi, "select * from produk where id_produk='$id_produk'");
        $data = mysqli_fetch_array($getdata);
        $qty = $data['qty'];

        $selisih = $qty + $stok;
        $update = mysqli_query($koneksi,"update produk set qty='$selisih' where id_produk='$id_produk'");

     $sSQL= mysqli_query($koneksi, " delete from  retur_barang where id_retur='$id_retur'");

     if ($update &&  $sSQL) {
        echo '
        <script>
            alert("Data Retur Barang BERHASIL Di Hapus");
            window.location.href="retur.php";
        </script>
        ';
        exit();
     }	
     else{
     echo '
     <script>
         alert("Data Retur Barang GAGAL Di Hapus");
         window.location.href="retur.php";
     </script>
     ';  		  
     }
    } else if ($status=="Selesai"){
     $sSQL= mysqli_query($koneksi, " delete from  retur_barang where id_retur='$id_retur'");
    
     if ($sSQL) {
        echo '
        <script>
            alert("Data Retur Barang BERHASIL Di Hapus");
            window.location.href="retur.php";
        </script>
        ';
        exit();
     }	
     else{
     echo '
     <script>
         alert("Data Retur Barang GAGAL Di Hapus");
         window.location.href="retur.php";
     </script>
     ';  		  
     }
    }

?>
