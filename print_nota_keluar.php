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
    $nota = $_POST['no_nota'];
    $status_print = $_POST['status_print'];

    $query = mysqli_query($koneksi, "update transaksi_keluar set status_print='$status_print' where no_nota ='$nota'");
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

<?php
$sSQL=" select * from transaksi_keluar where no_nota = '$nota'";
$result=mysqli_query($koneksi, $sSQL);
if (mysqli_num_rows($result) > 0) 
{
    while ($row=mysqli_fetch_assoc($result))
    {
        $status_print = $row['status_print'];
        $ket = $row['ket'];
        $tanggal = $row['tanggal'];
        $no_nota = $row['no_nota'];
    }
}	  

?>
<br><br><br>
<header>
    <div class="row">
        <div id="img" class="container-fluid col-sm-4">
            <img id="logo" src="images/logo31.png" width="160" height="160" />
        </div>
        <div class="container-fluid col-sm-8">
            <h1><strong>Wahana Service </strong></h1>
            <h3>Jalan GM Situt No. 43, Singkawang Barat, Kota Singkawang, KalBar</h3>
        </div>
    </div>
</header>

<div class="container-fluid px-4">
    <br>  
    <hr class="garis1"/>
    <br>
    <div class="container-fluid col-lg-12">
            <h2 style="text-align:center"><strong>NOTA PENJUALAN </strong></h2>
    </div>
    <div class="container-fluid row-lg-6">
            <h5 style="text-align:left">No. Nota : <?=$no_nota;?></h5>
            <h5 style="text-align:left">Tanggal : <?=$tanggal;?></h5>
            <h5 style="text-align:left">Yth. : <?=$ket;?></h5>
    </div>
    <br>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>   
                <th>Quantity</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>   
                <th>Total Harga</th>              
            </tr>
        </thead>
        <tbody>
            <?php
                $data = mysqli_query($koneksi, "select * from barang_keluar k, produk p where k.id_produk = p.id_produk and k.no_nota = '$no_nota' and status_bkeluar = '0'");
                while($row = mysqli_fetch_array($data)){
                    $nama_produk = $row['nama_produk'];
                    $harga = $row['harga'];
                    $jumlah= $row['jumlah_barang'];
                    $totalharga = $row['total_harga'];
            ?>	                         
            <tr>   
                <td><?php echo $jumlah;?></td>
                <td><?php echo $nama_produk;?></td>
                <td><?php echo FormatUang($harga);?></td>
                <td><?php echo FormatUang($totalharga);?></td>
            </tr>
            <?php	   
                }
                $subtotal = mysqli_query($koneksi, "select SUM(total_harga) AS subtotal from barang_keluar where no_nota = '$no_nota' and status_bkeluar = '0';");
                $row1 = mysqli_fetch_array($subtotal);
                $sub_total_harga=$row1['subtotal'];
                
            ?>	                         
            <tr>   
                <td colspan="3" class="subtotal">Subtotal</td>
                <td colspan="2" style="text-align:left"><?php echo FormatUang($sub_total_harga);?></td>
            
            </tr>
            <?php
                }
            
            ?>
        </tbody>
    </table>
            </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <p>Terima Kasih</p>
        <br><br><br><br>
        <p>Wahana Service </p>
    </div>
</div>
</body>

<script>
    window.print();
</script>

</html>