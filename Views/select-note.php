<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
if(!isset($_GET['ids']) || $_GET['ids']==""){header("Location: report-spareparts");exit;}
else if(isset($_GET['ids'])){
    $ids=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['ids']))));
    $jb=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['jb']))));}
$_SESSION['page-name']="Select Note";$_SESSION['page-to']="select-note?ids=$ids&jb=$jb";
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
                                    <div class="d-sm-flex align-items-center justify-content-between flex-wrap flex-md-nowrap mb-4">
                                        <small class="mb-0"><i class="fas fa-angle-right"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-right"></i> <?= $_SESSION['page-name']?></small>
                                        <form method="POST" class="navbar-search form-inline" id="navbar-search-main">
                                            <div class="input-group input-group-merge search-bar">
                                                <span class="input-group-text" id="topbar-addon"><span class="fas fa-search"></span></span>
                                                <input type="text" name="note" value="<?php if(isset($_POST['note'])){echo $_POST['note'];}?>" class="form-control form-control-sm" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-success border-top-left-radius-0 border-bottom-left-radius-0 btn-sm" type="submit" name="search-noteSpareparts" id="button-addon2"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>

                        <!-- == Special Alert == -->
                        <!-- == end of Special Alert == -->

                        <!-- == Select Note == -->
                            <div class="row mt-3">
                                <?php if(mysqli_num_rows($selectNoteSparepart)==0){?>
                                <?php }else if(mysqli_num_rows($selectNoteSparepart)>0){while($row=mysqli_fetch_assoc($selectNoteSparepart)){?>
                                <div class="col-lg-3">
                                    <div class="card card-body mb-3" style="width: 15.5rem;">
                                        <h5 class="card-title">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h5>
                                        <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                        <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                        <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                        <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                        <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                        <p class="card-text">Sparepart belum ada.</p>
                                        <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                        <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                        <?php }}?>
                                        <div class="col-4">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id-sparepart" value="<?= $ids?>">
                                                <input type="hidden" name="jmlh-barang" value="<?= $jb?>">
                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                <input type="hidden" name="id-pegawai" value="<?= $row['id_pegawai']?>">
                                                <button type="submit" name="sparepartTerpakai" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Pilih</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php }}?>
                            </div>
                        <!-- == end of Select Note == -->
                        
        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>