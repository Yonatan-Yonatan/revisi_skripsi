<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id_masuk = $_GET['id_masuk'];

     $select=" select * from barang_masuk where id_masuk='$id_masuk' limit 1";
        $result=mysqli_query($koneksi, $select);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $id_produk = $row['id_produk'];
                $stok = $row['stok'];
            }
        }	 
        $getdata = mysqli_query($koneksi, "select * from produk where id_produk='$id_produk'");
        $data = mysqli_fetch_array($getdata);
        $qty = $data['qty'];

        if ($qty >= $stok) {
        $selisih = $qty - $stok;
        $update = mysqli_query($koneksi,"update produk set qty='$selisih' where id_produk='$id_produk'");

     $sSQL= mysqli_query($koneksi, " update barang_masuk set status_bmasuk = '1' where id_masuk='$id_masuk'");
        
    
     if ($update &&  $sSQL) {
        echo '
        <script>
            alert("Data Barang Masuk BERHASIL Di Cancel");
            history.go(-1);
        </script>
        ';
        exit();
     }else{
        echo '
        <script>
            alert("Data Barang Masuk GAGAL Di Cancel");
            history.go(-1);
        </script>
        '; 
    }	
    } else {
            echo '
            <script>
                alert("Stock Saat Ini Tidak Mencukupi");
                history.go(-1);
            </script>
            ';
        }


?>
