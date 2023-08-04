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
                $total_harga = $row['total_harga'];
                $no_nota = $row['no_nota'];
            }
        }	
        
        $getdata = mysqli_query($koneksi, "select * from produk where id_produk='$id_produk'");
        $data = mysqli_fetch_array($getdata);
        $qty = $data['qty'];

        $selisih = $qty + $stok;
        $update = mysqli_query($koneksi,"update produk set qty='$selisih' where id_produk='$id_produk'");

        $getsubtotal = mysqli_query($koneksi, "select * from transaksi_keluar where no_nota='$no_nota'");
        $datasubtotal = mysqli_fetch_array($getsubtotal);
        $subtotl = $datasubtotal['subtotal'];
        $selisihharga = $subtotl - $total_harga;
        $updateharga = mysqli_query($koneksi,"update transaksi_keluar set subtotal='$selisihharga' where no_nota='$no_nota'");

     $sSQL= mysqli_query($koneksi, " update barang_keluar set status_bkeluar = '1' where id_keluar='$id_keluar'");
        
    
     if ($update &&  $sSQL && $updateharga) {
        echo '
        <script>
            alert("Data Barang Keluar BERHASIL Di Cancel");
            history.go(-1);
        </script>
        ';
        exit();
     }	
     else
     echo '
     <script>
         alert("Data Barang Keluar GAGAL Di CAncel");
         history.go(-1);
     </script>
     '; 		  
    


?>
