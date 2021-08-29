<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
if($_SESSION['id-role']>=3){header("Location: ./");exit;}
$_SESSION['page-name']="Nota Tinggal";$_SESSION['page-to']="nota-tinggal";
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
                        
                        <!-- == Chart == -->
                            <div class="row">
                                <div class="col-12 col-sm-6 col-xl-8 mb-4">
                                    <h4>Hallo <?= $_SESSION['username']?></h4>
                                    <p class="text-justify">Halaman akan menampilkan data default pada bulan dan tahun saat ini. Silakan pilih bulan dan tahun pada form dibawah untuk melihat presentasinya.</p>
                                    <div class="col-6">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="bln-tahun">Pilih Bulan & Tahun</label>
                                                <input type="month" name="nt-grading" id="bln-tahun" class="form-control">
                                            </div>
                                            <div class="form-group mt-3">
                                                <button type="submit" name="search-nt-grading" class="btn btn-success btn-sm">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                    <div class="card border-light shadow-sm">
                                        <div class="card-body">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="#page-top">
                                                                    <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><i class="fas fa-chart-line fa-2x"></i></div>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0 mt-n1">
                                                                <h2 class="h5">Total Notes of the Month</h2>
                                                                <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-tools"></span></span> Nota Semua <a href="#" class="h6"><?= $countNotesT?></a></h6>
                                                                <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-primary mr-1"><span class="fas fa-recycle"></span></span> Nota Batal <a href="#" class="h6"><?= $countNotesB?></a></h6>
                                                                <small class="text-<?= $colorNotes?>"><i class="fas fa-angle-<?= $iconNotes?>"></i> <?= $totalNotesPer?>% <?= $textNotes?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if(isset($_POST['search-nt-grading'])){?>
                                                    <div class="carousel-item">
                                                        <div class="row d-block d-xl-flex align-items-center">
                                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                                <a href="#page-top">
                                                                    <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><i class="fas fa-chart-line fa-2x"></i></div>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 col-xl-7 px-xl-0 mt-n1">
                                                                <h2 class="h5">Total Notes last month</h2>
                                                                <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-tools"></span></span> Nota Semua <a href="#" class="h6"><?= $countNotesTS?></a></h6>
                                                                <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-primary mr-1"><span class="fas fa-recycle"></span></span> Nota Batal <a href="#" class="h6"><?= $countNotesBS?></a></h6>
                                                                <small class="text-<?= $colorNotesS?>"><i class="fas fa-angle-<?= $iconNotesS?>"></i> <?= $totalNotesPerS?>% <?= $textNotesS?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(isset($_POST['search-nt-grading'])){?>
                                    <div class="card border-light shadow-sm mt-3">
                                        <div class="card-body">
                                            <div class="row d-block d-xl-flex align-items-center">
                                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                    <a href="#page-top">
                                                        <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><i class="fas fa-chart-line fa-2x"></i></div>
                                                    </a>
                                                </div>
                                                <div class="col-12 col-xl-7 px-xl-0 mt-n1">
                                                    <h2 class="h5">Total Remaining Note</h2>
                                                    <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-tools"></span></span> Nota Tinggal <a href="#" class="h6"><?= $count_NTGrading?></a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-light shadow-sm mt-3">
                                        <div class="card-body">
                                            <div class="row d-block d-xl-flex align-items-center">
                                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                    <a href="#page-top">
                                                        <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><i class="fas fa-chart-line fa-2x"></i></div>
                                                    </a>
                                                </div>
                                                <div class="col-12 col-xl-7 px-xl-0 mt-n1">
                                                    <h2 class="h5">Total Notes Cancel</h2>
                                                    <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-tools"></span></span> Nota Batal <a href="#" class="h6"><?= $count_NCGrading?></a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-light shadow-sm mt-3">
                                        <div class="card-body">
                                            <div class="row d-block d-xl-flex align-items-center">
                                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                    <a href="#page-top">
                                                        <div class="icon icon-shape icon-md icon-shape-danger mr-4 round"><i class="fas fa-chart-line fa-2x"></i></div>
                                                    </a>
                                                </div>
                                                <div class="col-12 col-xl-7 px-xl-0 mt-n1">
                                                    <h2 class="h5">Total Payment Notes</h2>
                                                    <h6 class="font-weight-normal text-gray"><span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-tools"></span></span> Nota Lunas <a href="#" class="h6"><?= $count_NLGrading?></a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        <!-- == end of Chart  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>