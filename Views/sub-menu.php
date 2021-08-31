<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Sub Menu";$_SESSION['page-to']="sub-menu";
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
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <small class="mb-0 <?= $colorMode?>"><i class="fas fa-angle-right"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-right"></i> <?= $_SESSION['page-name']?></small>
                                        <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#new-sub-menu"><i class="fas fa-plus"></i> New</button>
                                        <div class="modal fade" id="new-sub-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <p class="small">Tambahkan sub menu yang kamu mau sesuai kebutuhan.</p>
                                                            <div class="form-group">
                                                                <select name="id-menu" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>">
                                                                    <option>Pilih Menu</option>
                                                                    <?php if(mysqli_num_rows($menus)==0){?>
                                                                    <option>Maaf menu kosong.</option>
                                                                    <?php }else if(mysqli_num_rows($menus)>0){while($row=mysqli_fetch_assoc($menus)){?>
                                                                    <option value="<?= $row['id_menu']?>"><?= $row['menu']?></option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input type="text" name="title" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Title" required>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input type="text" name="url" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Url" required>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input type="text" name="icon" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Icon" required>
                                                                <small><a href="https://fontawesome.com/icons?d=gallery&m=free" class="text-decoration-none" target="blank">View all icon</a></small>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <select name="is-active" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                    <option>Pilih Status</option>
                                                                    <?php if(mysqli_num_rows($menu_status_insert)==0){?>
                                                                    <option>Maaf status kosong.</option>
                                                                    <?php }else if(mysqli_num_rows($menu_status_insert)>0){while($row=mysqli_fetch_assoc($menu_status_insert)){?>
                                                                    <option value="<?= $row['id_status']?>"><?= $row['status']?></option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="submit-sub-menu" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Tambah</button>
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
                        
                        <!-- == Sub Menu == -->
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-5">
                                    <div class="card card-body shadow border-light bg-<?= $bgMode?>" style="overflow-x: auto">
                                        <table class="table table-sm text-center <?= $colorMode?>">
                                            <thead>
                                                <tr style="border-top:hidden">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Menu</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Url</th>
                                                    <th scope="col">Icon</th>
                                                    <th scope="col">Active</th>
                                                    <th colspan="2">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php if(mysqli_num_rows($menu_sub)==0){?>
                                                    <tr>
                                                        <th colspan="8">Maaf data masih kosong.</th>
                                                    </tr>
                                                <?php }else if(mysqli_num_rows($menu_sub)>0){while($row=mysqli_fetch_assoc($menu_sub)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td scope="row"><?= $row['menu'];?></td>
                                                        <td scope="row"><?= $row['title'];?></td>
                                                        <td scope="row"><a href="<?= $row['url'];?>"><?= $row['url'];?></a></td>
                                                        <td scope="row"><?= $row['icon'];?></td>
                                                        <td scope="row"><?= $row['status']?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_sub_menu']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                            <div class="modal fade" id="ubah<?= $row['id_sub_menu']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Sub menu</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id-sub-menu" value="<?= $row['id_sub_menu']?>">
                                                                                <div class="form-group">
                                                                                    <select name="id-menu" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                        <option>Pilih Menu</option>
                                                                                        <?php foreach($menus_edit as $row_menu):?>
                                                                                        <option value="<?= $row_menu['id_menu']?>"><?= $row_menu['menu']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <input type="text" name="title" value="<?= $row['title']?>" placeholder="Title" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <input type="text" name="url" value="<?= $row['url']?>" placeholder="URL" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <input type="text" name="icon" value="<?= $row['icon']?>" placeholder="Icon" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                    <small><a href="https://fontawesome.com/icons?d=gallery&m=free" class="text-decoration-none" target="blank">View all icon</a></small>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <select name="is-active" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                        <option>Pilih Status</option>
                                                                                        <?php foreach($menu_status_edit as $row_status):?>
                                                                                        <option value="<?= $row_status['id_status']?>"><?= $row_status['status']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                                <button type="submit" name="edit-sub-menu" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-sub-menu" value="<?= $row['id_sub_menu'];?>">
                                                            <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus<?= $row['id_sub_menu']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="hapus<?= $row['id_sub_menu']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Yakin ingin hapus Sub Menu <?= $row['title']?>
                                                                        </div>
                                                                        <div class="modal-footer m-auto border-top-0">
                                                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" name="delete-sub-menu" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
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
                                                <?php if(isset($page2)){if(isset($total_page2)){if($page2>1):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" href="sub-menu?page=<?= $page2-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <?php endif;?>
                                                <?php for($i=1; $i<=$total_page2; $i++):?>
                                                    <?php if($i<=5):?>
                                                        <?php if($i==$page2):?>
                                                            <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="sub-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php else :?>
                                                            <li class="page-item shadow"><a class="page-link border-0" href="sub-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endfor;?>
                                                <?php if($page2<$total_page2):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" href="sub-menu?page=<?= $page2+1;?>">Next</a>
                                                </li>
                                                <?php endif;}}?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Sub Menu  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>