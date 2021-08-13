<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Activity Log";$_SESSION['page-to']="activity";
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
                        
                        <!-- == Activity Card == -->
                            <div class="row">
                                <h6>Banyaknya kesalahan: <?= $countActivity;?></h6>
                                <?php if(mysqli_num_rows($activity)==0){?>
                                <div class="col-md-12">
                                    <div class="card card-body shadow">
                                        <p class="text-center">Belum ada aktivitas kamu.</p>
                                    </div>
                                </div>    
                                <?php }else if(mysqli_num_rows($activity)>=0){while($row=mysqli_fetch_assoc($activity)){?>
                                <div class="col-md-12">
                                    <div class="card shadow mb-3">
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p class="small"><?= $row['log']?></p>
                                                <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row['date']?></small></cite></footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <?php }}?>
                            </div>
                        <!-- == end of Activity Card  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>