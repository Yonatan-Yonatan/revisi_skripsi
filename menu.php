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
<body class="sb-nav-fixed">

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion" id="sidenavAccordion" style="background: -webkit-linear-gradient(bottom,#3498db, #FFFFFF);">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Data Barang
                </a>
                <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                <a class="nav-link" href="restock_barang.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                    Barang Masuk
                </a>
                <?php } ?>
                <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "kasir"){?>
                <a class="nav-link" href="barang_keluar.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                    Barang Keluar
                </a>
                <?php } ?>
                <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                <a class="nav-link" href="retur.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-reply"></i></div>
                    Retur Barang
                </a>
                <?php } ?>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa fa-file"></i></div>
                    Laporan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                            <a class="nav-link" href="laporan_data_masuk.php">Laporan Transaksi Masuk</a>
                        <?php } ?>
                        <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "kasir"){?>
                            <a class="nav-link" href="laporan_data_keluar.php">Laporan Transaksi Keluar</a>
                        <?php } ?>
                        <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                            <a class="nav-link" href="laporan_retur.php">Laporan Retur Barang</a>
                        <?php } ?>
                    </nav>
                </div>
                <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                <a class="nav-link" href="supplier.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-flatbed"></i></div>
                    Supplier
                </a>
                <?php } ?>
                <?php if($_SESSION['level'] == "owner"){?>
                <a class="nav-link" href="user.php">
                    <div class="sb-nav-link-icon"><i class='fa-solid fa-user-large'></i></div>
                    User
                </a>
                <?php } ?>
            </div>
        </div>
    </nav>
    
</body>
</html>