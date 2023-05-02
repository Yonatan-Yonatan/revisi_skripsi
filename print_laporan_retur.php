<?php
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
    else{
    }

if($_SESSION['level'] == "kasir"){
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
            <h1 style="margin-left:10%"><strong>Laporan Retur Barang</strong></h1>
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
                <th>Supplier</th>   
                <th>Quantity</th>  
                <th>Keterangan</th>        
                <th>Status</th>             
            </tr>
        </thead>
        <tbody>
            <?php
                $data = mysqli_query($koneksi, "select * from retur_barang r, produk p, supplier s where (tanggal BETWEEN '$dari' and '$sampai') and r.id_produk = p.id_produk and r.id_supplier = s.id_supplier");
                while($row = mysqli_fetch_array($data)){
                    $tanggal = $row['tanggal'];
                    $nama_produk = $row['nama_produk'];
                    $nama_supplier = $row['nama_supplier'];
                    $quantity = $row['quantity'];
                    $deskripsi = $row['deskripsi'];
                    $status = $row['status'];
            ?>	                         
          <tr>   
                    <td><?php echo date('d M Y', strtotime($tanggal));?></td>
                    <td><?php echo $nama_produk;?></td>
                    <td><?php echo $nama_supplier;?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo $deskripsi;?></td>
                    <td><?php echo $status;?></td>
        </tr>
            <?php
                }
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