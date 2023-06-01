<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    </head>

    <?php
        
        $id_produk=$_GET['id_produk'];
    
        $sSQL=" select * from produk p, supplier s where p.id_supplier = s.id_supplier and p.id_produk='$id_produk' limit 1";
        $result=mysqli_query($koneksi, $sSQL);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $id_produk = $row['id_produk'];
                $nama_produk = $row['nama_produk'];
                $jenis_produk = $row['jenis_barang'];
                $harga= $row['harga'];
                $idsupplier=$row['id_supplier'];
                $nama_supplier=$row['nama_supplier'];
            }
        }	 
    ?>  

    <body class="sb-nav-fixed">
    <?php include "head.php"; ?>
        <div id="layoutSidenav">
        <?php include "menu.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <div class="container-fluid px-4">
                    <h1 class="mt-4" style="padding-bottom:15px";>Edit Barang</h1>
                    <form action="submit_update_barang.php" class="form" method="post"> 
                    
                    <input id="id_produk" class="form-control" type="hidden" name="id_produk" value="<?php echo $id_produk;?>" readonly/>
                    <label-form for="nama_produk">&nbsp;
                        Nama Produk
                    </label-form>
                    <input id="nama_produk" class="form-control" type="text" name="nama_produk" value="<?php echo $nama_produk;?>" required/>
                    <label-form for="jenis_barang">&nbsp;
                        Jenis Barang
                    </label-form>
                    <input id="jenis_barang" class="form-control" type="text" name="jenis_barang" value="<?php echo $jenis_produk;?>" required/>
                    <label-form for="harga">&nbsp;
                        Harga
                    </label-form>
                    <input id="harga" class="form-control" type="number" min="50" name="harga" value="<?php echo $harga;?>" required/>
                    <label-form for="nama_supplier">&nbsp;
                        Supplier
                    </label-form>
                    <select id="id_supplier" name="id_supplier" class="form-control" required>
                    <option value="<?php echo $idsupplier;?>"><?php echo $nama_supplier;?></option>
                            <?php
                                $ambildata = mysqli_query($koneksi, "select * from supplier");
                                while($fetcharray = mysqli_fetch_array($ambildata)){
                                    $namasupplier = $fetcharray['nama_supplier'];
                                    $idsupplier = $fetcharray['id_supplier'];
                            ?>
                            <option value="<?=$idsupplier;?>"><?=$namasupplier;?></option>
                            <?php
                                }

                            ?>
                    </select>
                       
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                            <a href="index.php" class="btn btn-sm btn-danger">Batal </a>
                            </div>
                        </div>
                    </form>
                </div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"><sup>&copy;</sup>2023 Wahana Service. All Rights Reserved</div>
                        </div>
                    </div>
                </footer>
            </div>
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
