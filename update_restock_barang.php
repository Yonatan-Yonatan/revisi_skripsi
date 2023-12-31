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
    </head>

    <?php
        
        $id_tr_masuk=$_GET['id_tr_masuk'];

        
        
        $sSQL=" select * from transaksi_masuk tm, supplier s where s.id_supplier = tm.id_supplier and tm.id_tr_masuk = '$id_tr_masuk' limit 1";
        $result=mysqli_query($koneksi, $sSQL);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $no_faktur = $row['no_faktur'];
                $tanggal = $row['tanggal'];
                $id_supplier = $row['id_supplier'];
                $nama_supplier = $row['nama_supplier'];
                
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
                    <input id="id_tr_masuk" class="form-control" type="hidden" name="id_tr_masuk" value="<?php echo $id_tr_masuk;?>" readonly/>
                    <label-form for="nama_produk">&nbsp;
                        No. Faktur
                    </label-form>
                    <input id="no_faktur" class="form-control" type="text" name="no_faktur" value="<?php echo $no_faktur;?>"/>
                    <label-form for="nama_supplier">&nbsp;
                        Supplier
                    </label-form>
                    <select id="supplier" name="supplier" class="form-control" required>
                        <option value="<?=$id_supplier?>"><?=$nama_supplier?></option>
                            <?php
                                $ambildata = mysqli_query($koneksi, "select * from supplier");
                                while($fetcharray = mysqli_fetch_array($ambildata)){
                                    $idsupplier = $fetcharray['id_supplier'];
                                    $supplier=$fetcharray['nama_supplier'];
                            ?>
                                <?php foreach($ambildata as $isi) : ?>
					            <option value="<?= $isi ["id_supplier"]?>"><?=$isi ["nama_supplier"]?></option>
				                <?php endforeach?>
                            <?php
                                }
                            ?>
                    </select>
                    
                    <label-form for="stok">&nbsp;
                        Tanggal
                    </label-form>
                    <input id="tanggal" class="form-control" type="date"  name="tanggal" value="<?php echo $tanggal;?>" required/>
                       
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
