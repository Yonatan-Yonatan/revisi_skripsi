<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
if($_SESSION['level'] == "kasir" || $_SESSION['level'] == "admin"){
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
        
        $id_masuk=$_GET['id_masuk'];

        
        
        $sSQL=" select * from barang_masuk m, supplier s, produk p where m.id_masuk = '$id_masuk' and m.id_produk=p.id_produk and m.id_supplier=s.id_supplier limit 1";
        $result=mysqli_query($koneksi, $sSQL);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $nama_produk = $row['nama_produk'];
                $id_produk = $row['id_produk'];
                $id_supplier = $row['id_supplier'];
                $nama_supplier = $row['nama_supplier'];
                $stok= $row['stok'];
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
                    <h1 class="mt-4" style="padding-bottom:15px";>Edit Barang Masuk</h1>
                    <form action="submit_update_restock.php" class="form" method="post"> 
                    <input id="id_masuk" class="form-control" type="hidden" name="id_masuk" value="<?php echo $id_masuk;?>" readonly/>
                    <input id="id_produk" class="form-control" type="hidden" name="id_produk" value="<?php echo $id_produk;?>" readonly/>
                    <label-form for="nama_produk">&nbsp;
                        Nama Produk
                    </label-form>
                    <input id="nama_produk" class="form-control" type="text" name="nama_produk" value="<?php echo $nama_produk;?>" readonly/>
                    <input id="id_supplier" class="form-control" type="hidden" name="id_supplier" value="<?php echo $id_supplier;?>" readonly/>
                    <label-form for="nama_supplier">&nbsp;
                        Nama Supplier
                    </label-form>
                    <input id="nama_supplier" class="form-control" type="text" name="nama_supplier" value="<?php echo $nama_supplier;?>" readonly/>
                    <input id="stoklama" class="form-control" type="hidden" name="stoklama" value="<?php echo $stok;?>" readonly required/>
                    <label-form for="stok">&nbsp;
                        Stok
                    </label-form>
                    <input id="stok" class="form-control" type="number" name="stok" value="<?php echo $stok;?>" required/>
                       
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                            <a href="restock_barang.php" class="btn btn-sm btn-danger">Batal </a>
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

        <script>
            function showPassword()
            {
                var x = document.getElementById("password");
                if (x.type === "password") 
                {
                    x.type = "text";
                } 
                else 
                {
                    x.type = "password";
                }
            }
        </script>
    </body>
</html>
