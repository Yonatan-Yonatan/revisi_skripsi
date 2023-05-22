<?php
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
    else{
    }

    if($_SESSION['level'] == "admin"){
        echo '
            <script>
                alert("Maaf anda tidak memiliki akses");
                javascript:window.history.go(-1);
            </script>
        ';
    } 

if(isset($_POST['print'])){
    $dari = $_POST['dari'];
    $sampai = $_POST['sampai'];
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/styleprint.css" rel="stylesheet" />
</head>

<body>
<br><br><br>
<header>
    <div class="row">
        <div id="img" class="container-fluid col-sm-4">
            <img id="logo" src="images/logo31.png" width="160" height="160" />
        </div>
        <div class="container-fluid col-sm-8">
            <h1><strong>Laporan Transaksi Barang Keluar</strong></h1>
            <h3>Periode : <?php echo date('d F Y', strtotime($dari));?> - <?php echo date('d F Y', strtotime($sampai));?></h3>
        </div>
    </div>
</header>

<div class="container-fluid px-4">
    <br>  
    <hr class="garis1"/>
    <br>
    <div class="table-responsive">
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
                $subtotal = mysqli_query($koneksi, "select SUM(total_harga) AS subtotal, SUM(jumlah_barang) as jumlah_terjual from barang_keluar where (tanggal BETWEEN '$dari' and '$sampai');");
                $row1 = mysqli_fetch_array($subtotal);
                $jumlah_terjual=$row1['jumlah_terjual'];
                $sub_total_harga=$row1['subtotal'];
                
            ?>	                         
            <tr>   
                <td colspan="3" class="subtotal">Subtotal</td>
                <td><?php echo $jumlah_terjual;?></td>
                <td colspan="2" style="text-align:right"><?php echo FormatUang($sub_total_harga);?></td>
            
            </tr>
            <?php
                }
            
            ?>
        </tbody>
    </table>
            </div>
</div>
<br><br><br><br><br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <p>Singkawang, <?php echo date('d F Y');?></p>
        <br><br><br><br>
        <p>Wahana Service </p>
    </div>
</div>
</body>

<script>
    window.print();
</script>

</html>