<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
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

    <body class="sb-nav-fixed">
    <?php include "head.php"; ?>
        <div id="layoutSidenav">
        <?php include "menu.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <div class="container-fluid px-4">
                    <h1 class="mt-4" style="padding-bottom:15px";>Input Data Barang Masuk</h1>
                    <form action="submit_barang_keluar.php" class="form" name="form1" method="post"> 
                    <label-form for="nama_produk">&nbsp;
                        Nama Produk
                    </label-form>
                    <select onChange="Harga()" id="id_produk" name="id_produk" class="form-control" onsubmit="cek()" required>
                        <option value="">-- Pilih --</option>
                            <?php
                                $ambildata = mysqli_query($koneksi, "select * from produk");
                                while($fetcharray = mysqli_fetch_array($ambildata)){
                                    $namaproduk = $fetcharray['nama_produk'];
                                    $idproduk = $fetcharray['id_produk'];
                                    $harga = $fetcharray['harga'];
                            ?>
                                <?php foreach($ambildata as $isi) : ?>
					            <option value="<?= $isi ["id_produk"].':'.$isi["harga"]?>"><?=$isi["nama_produk"];?></option>
				                <?php endforeach?>
                            <?php
                                }
                            ?>
                    </select>
                    <label-form for="harga">&nbsp;
                        Harga
                    </label-form>
                    <input id="harga_barang" class="form-control" type="text" name="harga_barang" readonly/>
                    <label-form for="jumlah_barang">&nbsp;
                        Quantity
                    </label-form>
                    <input onChange="Total_Harga()" id="jumlah_barang" class="form-control" type="number" name="jumlah_barang" autocomplete="on" required/>
                    <label-form for="total_harga">&nbsp;
                        Total Harga
                    </label-form>
                    
                    <input id="total_harga" class="form-control" type="text" name="total_harga" readonly/>
                    <label-form for="deskripsi">&nbsp;
                        Ket:
                    </label-form>
                    <input id="deskripsi" class="form-control" type="text" name="deskripsi" autocomplete="on" required/>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                                <a href="barang_keluar.php" class="btn btn-sm btn-danger">Batal </a>
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
    
        <script type="text/javascript">
            $(document).ready(function() {
                $('#id_produk').select2();
                $('#id_supplier').select2();
            });

            function Harga(){
                var harga1 = document.getElementById('id_produk');
                var harga2 = harga1.options[harga1.selectedIndex].value;
                const arrx = harga2.split(":");
                document.getElementById('harga_barang').value=arrx[1];
            }

            function Total_Harga(){
                var stok = document.getElementById("jumlah_barang");
                var hargabarang = document.getElementById("harga_barang");
                var hargatotal = document.getElementById("total_harga");
                const hitungtotalharga = parseInt(stok.value) * parseInt(hargabarang.value);
                hargatotal.value=""+hitungtotalharga;
            }

            function check(){
                var varjs = document.getElementById("total_harga");
                document.form1.total_harga.value = varjs;
            }

        </script>
    
    </body>
</html>
