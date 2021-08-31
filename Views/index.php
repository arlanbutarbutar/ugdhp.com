<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Console";$_SESSION['page-to']="./";
?>
<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("../Application/access/header-back.php")?></head>
    <body id="page-top">
        <?php require_once("../Application/access/topNav.php");?>
        <div class="container-fluid bg-<?= $rowMode['bg']?>">
            <div class="row">
                <div class="col-12">
                    <?php require_once("../Application/access/sideNavbar.php")?>
                    <main class="content">
                        <?php require_once("../Application/access/topNavbar.php");if($_SESSION['id-role']<=3){?>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                            <div class="btn-toolbar dropdown">
                                <button class="btn btn-<?= $btnMode?> btn-sm mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-plus mr-2"></span>New Task
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2 bg-<?= $bgMode?>">
                                    <?php foreach($newTask as $row):?>
                                    <a class="dropdown-item font-weight-bold <?= $colorMode?>" href="<?= $row['url']?>"><i class="<?= $row['icon']?> <?= $colorMode?>"></i></span> <?= $row['title']?></a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <?php if($_SESSION['id-role']<=2){?>
                            <div class="btn-group">
                                <button type="submit" name="use-procedure" class="btn btn-sm btn-outline-<?= $btnMode?> <?= $colorMode?>">Usage Procedure</button>
                                <button type="submit" name="report-generate" class="btn btn-sm btn-outline-<?= $btnMode?> <?= $colorMode?>">Report</button>
                            </div>
                            <?php }?>
                        </div>
                        <?php }?>
                        <div class="row justify-content-md-center">

                            <?php if($_SESSION['id-role']<=2){?>
                            <!-- == Revenue value == -->
                                <div class="col-12 mb-4">
                                    <div class="card bg-yellow-alt shadow-sm">
                                        <div class="card-header d-flex flex-row align-items-center flex-0">
                                            <div class="d-block">
                                                <div class="h5 font-weight-normal mb-2">Revenue value</div>
                                                <h2 class="h3">Rp. <?= number_format($income)?></h2>
                                                <div class="small mt-2">
                                                    <span class="font-weight-bold mr-2">Month <?= date('M');?></span>
                                                    <span class="fas fa-angle-<?= $iconPer?> text-<?= $colorPer?>"></span>
                                                    <span class="text-<?= $colorPer?> font-weight-bold"><?= $incomePer?>% <?= $statusPer;?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            <p>Chart not yet available</p>
                                            <!-- <div class="ct-chart-income-value ct-double-octave ct-series-g"></div> -->
                                        </div>
                                    </div>
                                </div>
                            <!-- == end of Revenue value == -->

                            <?php }if($_SESSION['id-role']<=3){?>
                            <!-- == Card Info == -->
                                <!-- ++ Customers/Repair -->
                                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                    <div class="card border-light shadow-sm bg-<?= $bgMode?> <?= $colorMode?>">
                                        <div class="card-body">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="users">
                                                                    <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-user-md fa-2x"></i></div>
                                                                </a>
                                                                <div class="d-sm-none">
                                                                    <h2 class="h5">Customers</h2>
                                                                    <h5 class="mb-1"><?= $userView?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0">
                                                                <div class="d-none d-sm-block">
                                                                    <h2 class="h5">Customers</h2>
                                                                    <h5 class="mb-1"><?= $userView?></h5>
                                                                </div>
                                                                <small><?= $rowStartUsers?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> WorldWide</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="nota-tinggal">
                                                                    <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-tools fa-2x"></i></div>
                                                                </a>
                                                                <div class="d-sm-none">
                                                                    <h2 class="h5">Repair</h2>
                                                                    <h5 class="mb-1"><?= $userRepair?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0">
                                                                <div class="d-none d-sm-block">
                                                                    <h2 class="h5">Repair</h2>
                                                                    <h5 class="mb-1"><?= $userRepair?></h5>
                                                                </div>
                                                                <small><?= $rowStartUsers?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> WorldWide</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ++ Income/Expense -->
                                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                    <div class="card border-light shadow-sm bg-<?= $bgMode?> <?= $colorMode?>">
                                        <div class="card-body">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="report-day">
                                                                    <div class="icon icon-shape icon-md icon-shape-secondary mr-4 round"><i class="fas fa-money-bill-wave fa-2x"></i></div>
                                                                </a>
                                                                <div class="d-sm-none">
                                                                    <h2 class="h5">Income</h2>
                                                                    <h5 class="mb-1">Rp.<?= $valueIncomeInfo?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0">
                                                                <div class="d-none d-sm-block">
                                                                    <h2 class="h5">Income</h2>
                                                                    <h5 class="mb-1">Rp. <?= $valueIncomeInfo?></h5>
                                                                </div>
                                                                <small><?= $rowStartInEx?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> Worldwide</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="report-expense">
                                                                    <div class="icon icon-shape icon-md icon-shape-secondary mr-4 round"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                                                                </a>
                                                                <div class="d-sm-none">
                                                                    <h2 class="h5">Expense</h2>
                                                                    <h5 class="mb-1">Rp.<?= $valueExpenseInfo?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0">
                                                                <div class="d-none d-sm-block">
                                                                    <h2 class="h5">Expense</h2>
                                                                    <h5 class="mb-1">Rp. <?= $valueExpenseInfo?></h5>
                                                                </div>
                                                                <small><?= $rowStartInEx?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> Worldwide</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ++ Total Repair/Notes -->
                                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                    <div class="card border-light shadow-sm bg-<?= $bgMode?> <?= $colorMode?>">
                                        <div class="card-body">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="nota-tinggal">
                                                                    <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><span class="fas fa-chart-pie"></span></div>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0">
                                                                <h2 class="h5">Total Repair</h2>
                                                                <h6 class="font-weight-normal"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-mobile-alt"></span></span> Handphone <a href="#" class="h6"><?= $countTotalRepairHP?></a></h6>
                                                                <h6 class="font-weight-normal mb-4"><span class="icon w-20 icon-xs icon-primary mr-1"><span class="fas fa-desktop"></span></span> Laptop <a href="#" class="h6"><?= $countTotalRepairLaptop?></a></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="nt-grading">
                                                                    <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><i class="fas fa-chart-line fa-2x"></i></div>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0 mt-n1">
                                                                <h2 class="h5">Total Notes</h2>
                                                                <h6 class="font-weight-normal"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-tools"></span></span> Nota Semua <a href="#" class="h6"><?= $countNotesT?></a></h6>
                                                                <h6 class="font-weight-normal"><span class="icon w-20 icon-xs icon-primary mr-1"><span class="fas fa-recycle"></span></span> Nota Batal <a href="#" class="h6"><?= $countNotesB?></a></h6>
                                                                <small class="text-<?= $colorNotes?>"><i class="fas fa-angle-<?= $iconNotes?>"></i> <?= $totalNotesPer?>% <?= $textNotes?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- == end of Card Info == -->
                            <?php }?>

                        </div>
                        <div class="row flex-row-reverse">
                            <?php if($_SESSION['id-role']<=3){?>
                            <div class="col-12 col-xl-4">

                                <!-- == Total Spareparts == -->
                                    <div class="col-12 mb-4">
                                        <div class="card border-light shadow-sm bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="card-body border-bottom">
                                                <div class="h6 font-weight-normal mb-2">Total Spareparts</div>
                                                <div class="col-md-12 m-0 p-0 d-flex flex-row align-items-center flex-0">
                                                    <div class="d-block">
                                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">
                                                                    <h2 class="h3"><i class="fas fa-plus" style="font-size: 18px"></i> <?= $countTotalSparepartsNow?></h2>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <h2 class="h3"><?= $countTotalSpareparts?></h2>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <div class="small mt-2 d-flex flex-nowrap">
                                                            <span class="fas fa-angle-<?= $iconPerSparepart?> m-auto text-<?= $colorPerSparepart?>"></span>
                                                            <span class="ml-1 text-<?= $colorPerSparepart?> font-weight-bold d-flex flex-nowrap"><?= $sparepartsTotalPer?>% <div class="ml-2 text-<?= $statusCol_PerSparepart?>"><?= $statusPerSparepart?></div></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-block ml-auto">
                                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">
                                                                    <div class="d-flex align-items-center text-right mb-4">
                                                                        <span class="font-weight-normal small"><?= $dateSparepart?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="d-flex align-items-center text-right mb-4">
                                                                        <span class="font-weight-normal small"><?= $dateSparepartLn?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- == Total Spareparts == -->
                                
                            </div>
                            <?php }if($_SESSION['id-role']<=4){if($_SESSION['id-role']<=3){?>
                            <div class="col-12 col-xl-8 mb-4" id="repair-reviews">
                            <?php }else if($_SESSION['id-role']==4){?>
                            <div class="col-12 col-xl-12 mb-4 mt-3" id="repair-reviews">
                            <?php }?>
                                <?php if (mysqli_num_rows($news_reviews) == 0) { ?>
                                    <div class="card border-light shadow mb-3 bg-<?= $bgMode?> <?= $colorMode?>">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-start">
                                            <h6 class="m-0 font-weight-bold">Repair Data</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <p>
                                                Belum ada data yang dimasukkan.
                                            </p>
                                        </div>
                                    </div>
                                    <?php } else if (mysqli_num_rows($news_reviews) > 0) {
                                    while ($row = mysqli_fetch_assoc($news_reviews)) { ?>
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold"><?= "T" . $row['id_nota_tinggal'] . " | DP" . $row['id_nota_dp'] . " | L" . $row['id_nota_lunas'] ?></h6>
                                                <?php if($_SESSION['id-role']<=3){?>
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#starHalf<?= $row['id_data']?>"><i class="fas fa-star-half-alt text-info"></i></button>
                                                <div class="modal fade" id="starHalf<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0">
                                                                <h4 class="modal-title" id="exampleModalLabel">Quick Status <i class="fas fa-space-shuttle text-info"></i></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id-data" value="<?= $row['id_data']?>">
                                                                <div class="modal-body">
                                                                    <p>Kemudahan mengubah status perbaikan dengan cepat. Pilih status untuk perbaikan nota <?= "T" . $row['id_nota_tinggal'] . " | DP" . $row['id_nota_dp'] . " | L" . $row['id_nota_lunas'] ?><br><span class="badge bg-warning text-dark">Peringatan!!</span> Cek kembali data sebelum merubah status.</p>
                                                                    <div class="form-group">
                                                                        <select name="id-status" class="form-control">
                                                                            <option>Pilih Status</option>
                                                                            <?php if($row['id_status']==4){
                                                                                $notesStatusBost=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status=5");
                                                                            }else if($row['id_status']<=4){
                                                                                $notesStatusBost=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status<=4");
                                                                            }else if($row['id_status']==5){
                                                                                $notesStatusBost=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status=6");}
                                                                            foreach($notesStatusBost as $rowBost):?>
                                                                            <option value="<?= $rowBost['id_status']?>"><?= $rowBost['status']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer border-top-0 justify-content-center">
                                                                    <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                    <button type="submit" name="ubah-cepat-status" class="btn btn-dark btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>
                                            <div class="card-body">
                                                <p class="small">
                                                    Perbaikan <?= $row['product'] ?> dengan kerusakan <?= $row['kerusakan'] ?> dan kondisi <?= $row['kondisi'] ?>. Kelengkapan dari <?= $row['product'] ?> <?php if (empty($row['kelengkapan']) || $row['kelengkapan'] == '-') { echo 'tidak ada'; } else { echo $row['kelengkapan']; } ?>. Perbaikan dikerjakan oleh <?php $id_tek = $row['id_pegawai']; $teknisi = mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'"); $row_tek = mysqli_fetch_assoc($teknisi); echo $row_tek['first_name']; ?>
                                                </p>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-lg-4">
                                                        <div class="h6 mb-0 mr-3 font-weight-bold">Progress:
                                                            <?php $id_barang = $row['id_barang'];
                                                            if ($row['id_layanan'] == 1) {
                                                                $handphone = mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");
                                                                $row_hp = mysqli_fetch_assoc($handphone);
                                                                echo $row_hp['type'] . " (" . $row_hp['seri'] . " - " . $row_hp['imei'] . ")";
                                                            }
                                                            if ($row['id_layanan'] == 2) {
                                                                $laptop = mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");
                                                                $row_laptop = mysqli_fetch_assoc($laptop);
                                                                echo $row_laptop['merek'] . " (" . $row_laptop['seri'] . ")";
                                                            } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="progress-wrapper">
                                                            <div class="progress-info">
                                                                <div class="progress-label">
                                                                    <span class="text-info"><?= $row['status']?></span>
                                                                </div>
                                                                <div class="progress-percentage">
                                                                    <span><?= $row['progress']?>%</span>
                                                                </div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar <?php if($row['progress']<=10){echo "bg-danger";}else if($row['progress']>10 && $row['progress']<=75){echo "bg-warning";}else if($row['progress']>75){echo "bg-success";}?>" role="progressbar" style="width: <?= $row['progress'] . "%" ?>" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }} ?>
                            </div>
                            <?php }?>
                        </div>
            <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>
