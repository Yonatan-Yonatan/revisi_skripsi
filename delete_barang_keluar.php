<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id_keluar = $_GET['id_keluar'];

     $select=" select * from barang_keluar where id_keluar='$id_keluar' limit 1";
        $result=mysqli_query($koneksi, $select);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $id_produk = $row['id_produk'];
                $stok = $row['jumlah_barang'];
            }
        }	 
        $getdata = mysqli_query($koneksi, "select * from produk where id_produk='$id_produk'");
        $data = mysqli_fetch_array($getdata);
        $qty = $data['qty'];

        $selisih = $qty + $stok;
        $update = mysqli_query($koneksi,"update produk set qty='$selisih' where id_produk='$id_produk'");

     $sSQL= mysqli_query($koneksi, " delete from  barang_keluar where id_keluar='$id_keluar'");
        
    
     if ($update &&  $sSQL) {
            header("location:barang_keluar.php");
            exit();
     }	
     else
           echo "Error: " . $sSQL . "<br>" . mysqli_error($conn);	  		  
    


?>
