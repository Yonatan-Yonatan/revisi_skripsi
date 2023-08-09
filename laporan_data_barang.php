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
                        <h1 class="mt-4" style="padding-bottom:30px";>Laporan Stok Barang</h1>
                        <form method="get" style="padding-bottom :50px;">
                            <div class="row">
                                <div class="col-sm-8">    
                                    <label style="padding-bottom :5px;">Filter : </label><br>
                                    <select id="filter" name="filter" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="semua">Semua Barang</option>
                                        <option value="habis">Habis</option>
                                        <option value="hampirhabis">Hampir Habis</option>
                                    </select>
                                </div>
                                <div class="col-sm-4" style="padding-top :30px;"> 
                                    <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                        
                        <div class="card mb-4">
                            <div class="card-body">
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
                                                $data="";
                                                $filter = isset($_GET['filter']);
                                                if(isset($_GET['filter']) && !empty($_GET['filter'])){
                                                    $filter = $_GET['filter'];
                                                    if ($filter == "semua"){ 
                                                        // tampilkan data yang sesuai dengan filter yang dipilih 
                                                        $data = mysqli_query($koneksi, "select * from produk p");
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
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <form method="POST" action="print_laporan_stok.php" target="_BLANK">
                                                <div class="col-sm-4" style="padding-bottom:15px">
                                                    <input type="hidden" name="filter" class="filter-form-control" value="<?php echo $_GET['filter'];?>">
                                                </div>
                                                <input type="submit" name="print" value="print" class="btn btn-sm btn-primary" />&nbsp
                                            </form>
                                        </tfoot>
                                            <?php   
                                                    } else if ($filter == "habis"){ 
                                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data		
                                                    $data = mysqli_query($koneksi, "select * from produk p where qty = 0");
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
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <form method="POST" action="print_laporan_stok.php" target="_BLANK">
                                                <div class="col-sm-4" style="padding-bottom:15px">
                                                    <input type="hidden" name="filter" class="filter-form-control" value="<?php echo $_GET['filter'];?>">
                                                </div>
                                                <input type="submit" name="print" value="print" class="btn btn-sm btn-primary" />&nbsp
                                            </form>
                                        </tfoot>
                                        <?php
                                                } else if ($filter == "hampirhabis"){ 
                                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data		
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
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <form method="POST" action="print_laporan_stok.php" target="_BLANK">
                                                <div class="col-sm-4" style="padding-bottom:15px">
                                                    <input type="hidden" name="filter" class="filter-form-control" value="<?php echo $_GET['filter'];?>">
                                                </div>
                                                <input type="submit" name="print" value="print" class="btn btn-sm btn-primary" />&nbsp
                                            </form>
                                        </tfoot>
                                        <?php
                                                } 
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
