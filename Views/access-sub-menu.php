<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Access Sub Menu";$_SESSION['page-to']="access-sub-menu";
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
                                        <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#new-access-sub-menu"><i class="fas fa-plus"></i> New</button>
                                        <div class="modal fade" id="new-access-sub-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Access Sub Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <p class="small">Berikan hak akses sub menu kepada user selain role users.</p>
                                                            <div class="form-group">
                                                                <select name="id-role" class="form-control text-center" required>
                                                                    <option>Pilih role users</option>
                                                                    <?php foreach($users_roles as $row_role):?>
                                                                    <option value="<?= $row_role['id_role']?>"><?= $row_role['role']?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <select name="id-sub-menu" class="form-control text-center" required>
                                                                    <option>Pilih sub menu</option>
                                                                    <?php foreach($menu_sub_select as $row_menu):?>
                                                                    <option value="<?= $row_menu['id_sub_menu']?>"><?= $row_menu['title']?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="submit-access-sub-menu" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Tambah</button>
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
                        
                        <!-- == Access Sub Menu == -->
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-5">
                                    <div class="card card-body shadow" style="overflow-x: auto">
                                        <table class="table table-sm text-center">
                                            <thead>
                                                <tr style="border-top:hidden">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Role Users</th>
                                                    <th scope="col">Sub Menu</th>
                                                    <th colspan="1">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; if(mysqli_num_rows($menu_sub_access)==0){?>
                                                    <tr>
                                                        <th colspan="4">Maaf data masih kosong.</th>
                                                    </tr>
                                                <?php }else if(mysqli_num_rows($menu_sub_access)>0){while($row=mysqli_fetch_assoc($menu_sub_access)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no?></th>
                                                        <td><?= $row['role']?></td>
                                                        <td><?= $row['title']?></td>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-access-sub-menu" value="<?= $row['id_access_sub_menu']?>">
                                                            <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus<?= $row['id_access_sub_menu']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="hapus<?= $row['id_access_sub_menu']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Yakin ingin hapus akses sub menu <?= $row['title']?>?</p>
                                                                        </div>
                                                                        <div class="modal-footer m-auto border-top-0">
                                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" name="hapus-access-sub-menu" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form></td>
                                                    </tr>
                                                <?php $no++; }}?>
                                            </tbody>
                                        </table>
                                        <nav class="small mt-3" aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if(isset($page4)){if(isset($total_page4)){if($page4>1):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" href="access-sub-menu?page=<?= $page4-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <?php endif;?>
                                                <?php for($i=1; $i<=$total_page4; $i++):?>
                                                    <?php if($i<=5):?>
                                                        <?php if($i==$page4):?>
                                                            <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="access-sub-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php else :?>
                                                            <li class="page-item shadow"><a class="page-link border-0" href="access-sub-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endfor;?>
                                                <?php if($page4<$total_page4):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" href="access-sub-menu?page=<?= $page4+1;?>">Next</a>
                                                </li>
                                                <?php endif;}}?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Access Sub Menu  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>