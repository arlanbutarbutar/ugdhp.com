<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Laporkan masalah";$_SESSION['page-to']="report-problem";
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
                                        <h2 class="h3 mb-0">Hello, <?= $_SESSION['username']?></h2>
                                        <small class="mb-0"><?= $_SESSION['page-name']?> <i class="fas fa-angle-left"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-left"></i></small>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Report Problem == -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row flex-row-reverse">
                                        <?php if($_SESSION['id-role']<=3){?>
                                            <div class="col-lg-4">
                                                <?php if($_SESSION['id-role']==3){?>
                                                <div class="card card-body shadow border-0 text-center mt-3">
                                                    <h4 class="font-weight-bold">Penting!!</h4>
                                                    <p class="small text-justify">Harap diingat dan diperhatikan bahwa laporan masalah selalu terupdate setiap hari mengenai system yang berjalan di Client Services. Untuk itu selalu pantau terus <strong>Report a Problem</strong> untuk memastikan semua tombol dan data berjalan dengan aman dan baik saat digunakan.</p>
                                                </div>
                                                <?php }?>
                                                <div class="card card-body shadow border-0 text-center mt-3">
                                                    <h4 class="font-weight-bold">Insert Problem</h4>
                                                    <p class="small">Masukan masalah yang terjadi pada system.</p>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <textarea name="problem-message" cols="30" rows="5" placeholder="Masukan masalah system" class="form-control" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="submit-report-problem" class="btn btn-dark mt-3 btn-sm">Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php }else if($_SESSION['id-role']>=4){?>
                                            <div class="col-lg-4">
                                                <div class="card card-body shadow border-0 text-center mt-3">
                                                    <h4 class="font-weight-bold">Penting!!</h4>
                                                    <p class="small text-justify">Harap diingat dan diperhatikan bahwa laporan masalah selalu terupdate setiap hari mengenai system yang berjalan di Client Services. Untuk itu selalu pantau terus <strong>Report a Problem</strong> untuk memastikan semua tombol dan data berjalan dengan aman dan baik saat digunakan.</p>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <div class="col-lg-8 mb-5">
                                            <?php if(mysqli_num_rows($report_problem)==0){?>
                                                <div class="card card-body shadow border-0 text-center mt-3">
                                                    <p>Belum ada Report a Problem</p>
                                                </div>
                                            <?php }if(mysqli_num_rows($report_problem)>0){while($row=mysqli_fetch_assoc($report_problem)){?>
                                                <div class="card card-body shadow border-0 mt-3">
                                                    <blockquote class="blockquote mb-0">
                                                        <p class="small"><?= $row['problem_message']?></p>
                                                        <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row['date']?></small></cite></footer>
                                                    </blockquote>
                                                </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Report Problem  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>