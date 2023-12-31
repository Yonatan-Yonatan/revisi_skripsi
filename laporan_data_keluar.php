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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inventory Wahana Service</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <?php
    function FormatUang($harga){
        $hasil = "Rp " . number_format($harga,2,',','.');
        return $hasil;
    }
    ?>
    <body class="sb-nav-fixed">
    <?php include "head.php"; ?>
        <div id="layoutSidenav">
        <?php include "menu.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style="padding-bottom:30px";>Laporan Transaksi Barang Keluar</h1>
                        <form method="get" style="padding-bottom :50px;">
                            <div class="row">
                                <div class="col-sm-4">    
                                    <label style="padding-bottom :5px;">Dari : </label><br>
                                    <input type="date" name="dari" class="filter-form-control">
                                </div>
                                <div class="col-sm-4">                             
                                    <label style="padding-bottom :5px;">Sampai : </label><br>
                                    <input type="date" name="sampai" class="filter-form-control">
                                </div>
                                <div class="col-sm-4" style="padding-top :30px;"> 
                                    <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>   
                                                <th>Tanggal</th>
                                                <th>No. Nota</th>
                                                <th>Pelanggan</th>
                                                <th>Nama Produk</th>
                                                <th>Harga Produk</th>   
                                                <th>Quantity</th>    
                                                <th>Total Harga</th>    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $data="";
                                                
                                                if(isset($_GET['dari']) && isset($_GET['sampai'])){
                                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                                    $data = mysqli_query($koneksi, "select * from barang_keluar k, produk p, transaksi_keluar tk where (tanggal BETWEEN '".$_GET['dari']."' and '".$_GET['sampai']."') and k.id_produk = p.id_produk and k.no_nota = tk.no_nota and k.status_bkeluar = '0'");
                                                    while($row = mysqli_fetch_array($data)){
                                                        $tanggal = $row['tanggal'];
                                                        $id_produk = $row['id_produk'];
                                                        $nama_produk = $row['nama_produk'];
                                                        $harga = $row['harga'];
                                                        $jumlah= $row['jumlah_barang'];
                                                        $totalharga = $row['total_harga'];
                                                        $deskripsi = $row['ket'];
                                                        $no_nota = $row['no_nota'];
                                            ?>	
                                                                            
                                                <tr>   
                                                    <td><?php echo date('d M Y', strtotime($tanggal));?></td>
                                                    <td><?php echo $no_nota;?></td>
                                                    <td><?php echo $deskripsi;?></td>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo FormatUang($harga);?></td>
                                                    <td><?php echo $jumlah;?></td>
                                                    <td><?php echo FormatUang($totalharga);?></td>
                                                </tr>
                                            <?php	   
                                                    }     
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <form method="POST" action="print_laporan_keluar.php" target="_BLANK">
                                                <div class="col-sm-4" style="padding-bottom:15px">
                                                    <input type="hidden" name="dari" class="filter-form-control" value="<?php echo $_GET['dari'];?>">
                                                    <input type="hidden" name="sampai" class="filter-form-control" value="<?php echo $_GET['sampai'];?>">
                                                </div>
                                                <input type="submit" name="print" value="print" class="btn btn-sm btn-primary" />&nbsp
                                            </form>
                                        </tfoot>
                                            <?php   
                                                }else{
                                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data		
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>       
                                
                    
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                           <div class="text-muted"><sup>&copy;</sup>2023 Wahana Service. All Rights Reserved</div>
                        </div>
                    </div>
                </footer>
            </div>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    
    
    
    </body>
</html>
