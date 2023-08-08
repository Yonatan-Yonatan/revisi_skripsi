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
    $filter = $_POST['filter'];
}
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
            <h1><strong>Laporan Stok Barang</strong></h1>
            <h3>Periode : <?php echo date('d F Y H:i:s');?></h3>
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
                <th>Nama Produk</th>
                <th>Jenis Produk</th>   
                <th>Stok</th>  
                <th>Harga</th>                         
            </tr>
        </thead>
        <tbody>
            <?php
             if ($filter == "semua"){ 
                $data = mysqli_query($koneksi, "select * from produk");
                while($row = mysqli_fetch_array($data)){
                    $id_produk = $row['id_produk'];
                    $nama_produk = $row['nama_produk'];
                    $jenis_produk = $row['jenis_barang'];
                    $qty= $row['qty'];
                    $harga= $row['harga'];
            ?>		                                                
            <tr>
                <td><?php echo $nama_produk;?></td>
                <td><?php echo $jenis_produk;?></td>
                <td><?php echo $qty;?></td>
                <td><?php echo FormatUang($harga);?></td>
        </tr>
            <?php
                }
             } else if ($filter == "habis"){ 
                $data = mysqli_query($koneksi, "select * from produk where qty = 0");
                while($row = mysqli_fetch_array($data)){
                    $id_produk = $row['id_produk'];
                    $nama_produk = $row['nama_produk'];
                    $jenis_produk = $row['jenis_barang'];
                    $qty= $row['qty'];
                    $harga= $row['harga'];
            ?>		                                                
            <tr>
                <td><?php echo $nama_produk;?></td>
                <td><?php echo $jenis_produk;?></td>
                <td><?php echo $qty;?></td>
                <td><?php echo FormatUang($harga);?></td>
        </tr>
            <?php
                } 
            } else if ($filter == "hampirhabis"){ 
                    $data = mysqli_query($koneksi, "select * from produk p where (qty < min_qty and qty > 0)");
                    while($row = mysqli_fetch_array($data)){
                        $id_produk = $row['id_produk'];
                        $nama_produk = $row['nama_produk'];
                        $jenis_produk = $row['jenis_barang'];
                        $qty= $row['qty'];
                        $harga= $row['harga'];
                ?>		                                                
                <tr>
                    <td><?php echo $nama_produk;?></td>
                    <td><?php echo $jenis_produk;?></td>
                    <td><?php echo $qty;?></td>
                    <td><?php echo FormatUang($harga);?></td>
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