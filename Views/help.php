<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Bantuan";$_SESSION['page-to']="help";
?>
<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("../Application/access/header-back.php")?></head>
    <body id="page-top">
        <?php require_once("../Application/access/topNav.php");?>
        <div class="container-fluid bg-<?= $bgMode?>">
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

                        <!-- == Header == -->
                            <div class="row">
                                <div class="col-md-12 mb-n3">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4 <?= $colorMode?>">
                                        <h2 class="h3 mb-0">Hello, <?= $_SESSION['username']?></h2>
                                        <small class="mb-0"><?= $_SESSION['page-name']?> <i class="fas fa-angle-left"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-left"></i></small>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Help == -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row flex-row-reverse">
                                        <?php if($_SESSION['id-role']>=3){?>
                                        <div class="col-lg-4">
                                            <div class="card card-body shadow mt-3 text-center border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                                <h4>Apa Yang Dapat Dibantu?</h4>
                                                <p>Masukan masalah dibawah ini dan akan kami jawab.</p>
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <textarea name="help-message" cols="30" rows="5" placeholder="Masukan yang ingin dibantu" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit-help" class="btn btn-<?= $btnMode?> mt-3 btn-sm">Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                        <?php }if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){?>
                                            <div class="col-lg-12">
                                        <?php }?>
                                            <?php if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){
                                                if(mysqli_num_rows($help_message_admin)==0){?>
                                                    <div class="card card-body shadow mt-3 border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                                        <p class="text-center">Belum ada pesan bantuan yang masuk.</p>
                                                    </div>
                                                <?php }else if(mysqli_num_rows($help_message_admin)>0){while($row_admin=mysqli_fetch_assoc($help_message_admin)){?>
                                                    <div class="card card-body shadow mt-3 border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                                        <blockquote class="blockquote mb-0">
                                                            <p class="small"><?= $row_admin['help_message']?></p>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id-help" value="<?= $row_admin['id_help']?>">
                                                                <div class="form-group">
                                                                    <textarea name="answer" cols="30" rows="5" placeholder="Answer Help" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" required><?= $row_admin['answer']?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" name="help-admin" class="btn btn-<?= $btnMode?> mt-3 btn-sm">Apply</button>
                                                                </div>
                                                            </form>
                                                            <footer class="blockquote-footer mt-3"><cite title="Source Title"><small><?= $row_admin['date']?></small></cite></footer>
                                                        </blockquote>
                                                    </div>
                                                <?php }}?>
                                            <?php }if($_SESSION['id-role']>=3){
                                                if(mysqli_num_rows($help_message)==0){?>
                                                    <div class="card card-body shadow mt-3 border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                                        <p class="text-center">Belum ada pesan bantuan yang kamu masukan.</p>
                                                    </div>
                                                <?php }else if(mysqli_num_rows($help_message)>0){while($row_user=mysqli_fetch_assoc($help_message)){?>
                                                    <div class="card card-body shadow mt-3 border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                                        <blockquote class="blockquote mb-0">
                                                            <p class="small"><strong>Pesan kamu</strong> <?= $row_user['help_message']?></p>
                                                            <p class="small mt-n3"><strong>Jawabannya</strong> <?= $row_user['answer']?></p>
                                                            <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row_user['date']?></small></cite></footer>
                                                        </blockquote>
                                                    </div>
                                                <?php }}?>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Help  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>