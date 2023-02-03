<?php
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
    else{
    }

if(isset($_POST['print'])){
    $dari = $_POST['dari'];
    $sampai = $_POST['sampai'];
?>


<!DOCTYPE html>
<head>
<style>
    h1 {
        font-family: Times New Roman;
        font-size: 48px;
        text-align: center;
        text-decoration: bold;
        padding-bottom: 0;
    }
    h3 {
        font-family: Times New Roman;
        font-size: 24px;
        text-align: center;
        text-decoration: bold;
        padding-bottom: 0;
    }
    p {
        font-family: Times New Roman;
        font-size: 18px;
        text-align: right;
        text-decoration: none;
        padding-top: 0;
    }
    
    f {
        font-family: Times New Roman;
        font-size: 18px;
        text-align: right;
        text-decoration: none;
        padding-top: 0;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    .right { text-align: right;}
</style>
</head>

<body>
<br><br><br>
<h1>Laporan Transaksi Barang Keluar</h1>
<h3>Periode : <?php echo date('d F Y', strtotime($dari));?> - <?php echo date('d F Y', strtotime($sampai));?></h3>
<br><br><br>
<table class="table">
    <thead>
        <tr>   
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>   
            <th>Quantity</th>
            <th>Total Harga</th>   
            <th>Keterangan</th>             
        </tr>
    </thead>
    <tbody>
        <?php
            $data = mysqli_query($koneksi, "select * from barang_keluar k, produk p where (tanggal BETWEEN '$dari' and '$sampai') and k.id_produk = p.id_produk");
            while($row = mysqli_fetch_array($data)){
                $tanggal = $row['tanggal'];
                 $nama_produk = $row['nama_produk'];
                $harga = $row['harga'];
                $jumlah= $row['jumlah_barang'];
                $totalharga = $row['total_harga'];
                $deskripsi = $row['deskripsi'];
         ?>	                         
        <tr>   
            <td><?php echo date('d M Y', strtotime($tanggal));?></td>
            <td><?php echo $nama_produk;?></td>
            <td><?php echo FormatUang($harga);?></td>
            <td><?php echo $jumlah;?></td>
            <td><?php echo FormatUang($totalharga);?></td>
            <td><?php echo $deskripsi;?></td>
        </tr>
        <?php	   
            }  
        }
        ?>
    </tbody>
</table>

<br><br><br><br><br>
<p>Singkawang, <?php echo date('d F Y');?></p>
<br><br><br><br>
<p>Wahana Service </p>
</body>

<script>
    window.print();
</script>

</html>