<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Apps Store";$_SESSION['page-to']="apps-store";
?>
<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("../Application/access/header-back.php")?></head>
    <body id="page-top">
        <?php require_once("../Application/access/topNav.php");?>
        <div class="container-fluid bg-soft">
            <div class="row">
                <div class="col-12">
                    <?php require_once("../Application/access/sideNavbar.php")?>
                    <main class="content">
                        <?php require_once("../Application/access/topNavbar.php");if($_SESSION['id-role']<=3){?>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                            <div class="btn-toolbar dropdown">
                                <button class="btn btn-primary btn-sm mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-plus mr-2"></span>New Task
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2">
                                    <?php foreach($newTask as $row):?>
                                    <a class="dropdown-item font-weight-bold text-dark" href="<?= $row['url']?>"><i class="<?= $row['icon']?> text-dark"></i></span> <?= $row['title']?></a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button type="submit" name="use-procedure" class="btn btn-sm btn-outline-primary">Usage Procedure</button>
                                <button type="submit" name="report-generate" class="btn btn-sm btn-outline-primary">Report</button>
                            </div>
                        </div>
                        <?php }?>

                        <!-- == Header == -->
                            <div class="row">
                                <div class="col-md-12 mb-n3">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <small class="mb-0"><i class="fas fa-angle-right"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-right"></i> <?= $_SESSION['page-name']?></small>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Apps Store == -->
                            <div class="row p-2 mt-n2">
                                <div class="col-md-12 bg-gradient-dark border-bottom-left-radius-0 border-bottom-right-radius-0" style="border-radius: 5px">
                                    <marquee behavior="" direction="left" class="d-flex flex-nowrap text-white font-weight-bold">
                                    <?php if(mysqli_num_rows($runTextNotes)>0){while($row=mysqli_fetch_assoc($runTextNotes)){$total=$row['biaya']-$row['dp']; echo "T".$row['id_nota_tinggal']." DP".$row['id_nota_dp']." L".$row['id_nota_lunas']." Biaya: Rp.".number_format($total)." | ";}}?>
                                    </marquee>
                                </div>
                                <div class="col-md-12 bg-gradient-dark border-top-left-radius-0 border-top-right-radius-0" style="border-radius: 5px">
                                    <marquee behavior="" direction="left" scrolldelay="200" class="d-flex flex-nowrap text-white font-weight-bold">
                                    <?php if(mysqli_num_rows($runTextSpareparts)>0){while($row=mysqli_fetch_assoc($runTextSpareparts)){$total=$row['jmlh_barang']*$row['harga']; echo $row['ket']." Suplayer ".$row['suplayer']." jumlah barang ".$row['jmlh_barang']." Harga/satuan: ".$row['harga']." Total: Rp.".number_format($total)." | ";}}?>
                                    </marquee>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card shadow mt-3" style="width: 18rem;">
                                        <img src="https://i.ibb.co/yd3kkKw/logo-ugdhp.png" class="card-img-top" alt="Logo UGD HP">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">UGD HP</h5>
                                                <a class="btn btn-link btn-sm mt-n1" data-toggle="collapse" href="#app-desUGDHP" role="button" aria-expanded="false" aria-controls="app-desUGDHP"><i class="fas fa-angle-down" style="font-size: 24px"></i></a>
                                            </div>
                                            <div class="collapse" id="app-desUGDHP">
                                                <p>Aplikasi pelayanan perbaikan handphone dan laptop dengan fitur yang mudah digunakan dan aksi cepatnya yang responsif mendukung pelayanan perbaikan anda.</p>
                                            </div>
                                            <a href="UGD HP_1_28.2.apk" download="UGD HP_1_28.2.apk" class="btn btn-success btn-sm shadow"><i class="fas fa-download"></i> Unduh</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Apps Store  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>