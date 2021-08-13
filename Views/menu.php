<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Menu";$_SESSION['page-to']="menu";
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
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-menu"><i class="fas fa-plus"></i> New</button>
                                        <div class="modal fade" id="new-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Insert Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <p class="small">Tambahkan menu yang kamu mau sesuai kebutuhan.</p>
                                                            <div class="form-group">
                                                                <input type="text" name="menu" placeholder="Nama Menu" class="form-control text-center" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="submit-menu" class="btn btn-sm btn-success shadow"><i class="fas fa-plus"></i> Tambah</button>
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
                        
                        <!-- == Menu == -->
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <div class="card card-body shadow border-0" style="overflow-x: auto">
                                        <table class="table table-sm text-center">
                                            <thead>
                                                <tr style="border-top:hidden">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Menu</th>
                                                    <th colspan="2">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; if(mysqli_num_rows($menus)==0){?>
                                                    <tr>
                                                        <th colspan="4">Belum ada menu</th>
                                                    </tr>
                                                <?php }else if(mysqli_num_rows($menus)>0){while($row=mysqli_fetch_assoc($menus)){$_SESSION['id-menu']=$row['id_menu'];$menu_old=$row['menu'];?>
                                                    <tr>
                                                        <th scope="row"><?= $no?></th>
                                                        <td><?= $row['menu']?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_menu']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                            <div class="modal fade" id="ubah<?= $row['id_menu']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Menu</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id-menu" value="<?= $row['id_menu']?>">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="menu" value="<?= $row['menu']?>" placeholder="Ubah nama menu" class="form-control text-center" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
                                                                                <button type="submit" name="ubah-menu" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-menu" value="<?= $row['id_menu']?>">
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_menu']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="hapus<?= $row['id_menu']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Yakin ingin menghapus menu <?= $row['menu']?>?</p>
                                                                        </div>
                                                                        <div class="modal-footer m-auto border-top-0">
                                                                            <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" name="hapus-menu" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form></td>
                                                    </tr>
                                                <?php $no++;}}?>
                                            </tbody>
                                        </table>
                                        <nav class="small mt-3" aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if(isset($page1)){if(isset($total_page1)){if($page1>1):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link" href="menu?page=<?= $page1-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <?php endif;?>
                                                <?php for($i=1; $i<=$total_page1; $i++):?>
                                                    <?php if($i<=5):?>
                                                        <?php if($i==$page1):?>
                                                            <li class="page-item shadow"><a class="page-link font-weight-bold" href="menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php else :?>
                                                            <li class="page-item shadow"><a class="page-link" href="menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endfor;?>
                                                <?php if($page1<$total_page1):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link" href="menu?page=<?= $page1+1;?>">Next</a>
                                                </li>
                                                <?php endif;}}?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Menu  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>