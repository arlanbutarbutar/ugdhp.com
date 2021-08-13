<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Privacy Policy";$_SESSION['page-to']="privacy-policy";
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
                                        <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#new-privacy"><i class="fas fa-plus"></i> New</button>
                                        <div class="modal fade" id="new-privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Insert Privacy Policy</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <p class="small">Masukan kebijakan privasi untuk mengatur keapsahan pengguna sebagai pemakai layanan UGD HP.</p>
                                                            <div class="form-group">
                                                                <textarea name="privacy-policy" cols="30" rows="5" placeholder="Masukan Kebijakan" class="form-control" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="submit-privacy" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Tambah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Privacy Policy == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if(mysqli_num_rows($privacy_policy)==0){?>
                                        <div class="card card-body shadow">
                                            <table class="table table-sm text-center">
                                                <thead>
                                                    <tr style="border:hidden">
                                                        <th scope="col"><h3>Privacy Policy</h3></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="border:hidden">
                                                        <th colspan="1">Belum ada kebijakan privasi</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php }else if(mysqli_num_rows($privacy_policy)>0){while($row=mysqli_fetch_assoc($privacy_policy)){?>
                                        <div class="card card-body shadow">
                                            <table class="table table-sm text-center">
                                                <thead>
                                                    <tr style="border:hidden">
                                                        <th scope="col"><h3>Privacy Policy</h3></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="border:hidden">
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-pp" value="<?= $row['id_pp']?>">
                                                            <div class="form-group">
                                                                <textarea name="privacy-policy" cols="30" rows="10" class="form-control"><?= $row['privacy_policy']?></textarea>
                                                            </div>
                                                            <div class="row justify-content-center mt-3">
                                                                <div class="col-lg-1">
                                                                    <div class="form-group">
                                                                        <button type="submit" name="edit-privacy" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus"><i class="fas fa-trash"></i> Hapus</button>
                                                                        <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header border-bottom-0">
                                                                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Yakin ingin menghapus kebijakan privasi?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer border-top-0 m-auto">
                                                                                        <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Tidak</button>
                                                                                        <button type="submit" name="delete-privacy" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php }}?>
                                </div>
                            </div>
                        <!-- == end of Privacy Policy  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>