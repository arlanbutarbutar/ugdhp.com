<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Users Management";$_SESSION['page-to']="users";
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
                                        <form method="POST" class="navbar-search form-inline" id="navbar-search-main">
                                            <div class="input-group input-group-merge search-bar">
                                                <span class="input-group-text" id="topbar-addon"><span class="fas fa-search"></span></span>
                                                <input type="text" name="keyword-users" class="form-control form-control-sm" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-success border-top-left-radius-0 border-bottom-left-radius-0 btn-sm" type="submit" name="search-users" id="button-addon2"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Users == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-body shadow border-light bg-<?= $bgMode?>" style="overflow-x: auto">
                                        <table class="table table-sm text-center <?= $colorMode?>">
                                            <thead>
                                                <tr style="border-top:hidden">
                                                    <th scope="col">No</th>
                                                    <?php if($_SESSION['id-role']<=2){?>
                                                    <th scope="col">Data encrypt</th>
                                                    <?php }?>
                                                    <th scope="col">Icon</th>
                                                    <th scope="col">Nama depan</th>
                                                    <th scope="col">Nama belakang</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Kategori Layanan</th>
                                                    <th scope="col">No. hp/tlp</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">Kode pos</th>
                                                    <th scope="col">Kebijakan</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Akses</th>
                                                    <th scope="col">Tools</th>
                                                    <th scope="col">Tgl Buat</th>
                                                    <?php if($_SESSION['id-access']==1){?>
                                                    <th colspan="2">Aksi</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php if(mysqli_num_rows($users_data)==0){?>
                                                    <tr>
                                                        <th colspan="16">Maaf data users masih kosong.</th>
                                                    </tr>
                                                <?php }else if(mysqli_num_rows($users_data)>0){while($row=mysqli_fetch_assoc($users_data)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td scope="row"><?= $row['data_encrypt'];?></td>
                                                        <?php }?>
                                                        <td scope="row"><img src="../Assets/img/img-users/<?= $row['img']?>" alt="icon profile" class="rounded-circle" style="width: 40px"></td>
                                                        <td scope="row"><?= $row['first_name']?></td>
                                                        <td scope="row"><?= $row['last_name']?></td>
                                                        <td scope="row"><?= $row['email']?></td>
                                                        <td scope="row"><?= $row['product']?></td>
                                                        <td scope="row"><?= $row['phone']?></td>
                                                        <td scope="row"><?= $row['address']?></td>
                                                        <td scope="row"><?= $row['postal']?></td>
                                                        <td scope="row"><?= $row['kebijakan']?></td>
                                                        <td scope="row"><?= $row['role']?></td>
                                                        <td scope="row"><?= $row['status']?></td>
                                                        <td scope="row"><?= $row['access']?></td>
                                                        <td scope="row"><?= $row['tools']?></td>
                                                        <td scope="row"><?= $row['date_created']?></td>
                                                        <?php if($_SESSION['id-access']==1){?>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_user']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                            <div class="modal fade" id="ubah<?= $row['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data <?= $row['first_name']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                                <div class="form-group">
                                                                                    <select name="id-role" class="form-control bg-<?= $bgMode?> <?= $colorMode?> border-light">
                                                                                        <option>Pilih Role</option>
                                                                                        <?php foreach($users_data_role as $row1):?>
                                                                                        <option value="<?= $row1['id_role']?>"><?= $row1['role']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <select name="is-active" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                        <option>Pilih Status</option>
                                                                                        <?php foreach($users_data_status as $row2):?>
                                                                                        <option value="<?= $row2['is_active']?>"><?= $row2['status']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <select name="id-access" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                        <option>Pilih Access</option>
                                                                                        <?php foreach($users_data_access as $row2):?>
                                                                                        <option value="<?= $row2['id_access']?>"><?= $row2['access']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <select name="id-tools" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                        <option>Pilih Tools</option>
                                                                                        <?php foreach($users_tools as $row3):?>
                                                                                        <option value="<?= $row3['id_tools']?>"><?= $row3['tools']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <select name="id-category" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                        <option>Pilih Kategori Service</option>
                                                                                        <?php foreach($category_service as $row4):?>
                                                                                        <option value="<?= $row4['id_category']?>"><?= $row4['product']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <label for="id-console">Console Access</label>
                                                                                    <input type="number" name="id-keyConsole" id="id-console" value="<?= $row['data_encrypt']?>" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                    <small class="text-danger">*Masukan Data Encrypting</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                                <button type="submit" name="edit-users" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-user" value="<?= $row['id_user'];?>">
                                                            <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus<?= $row['id_user']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="hapus<?= $row['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <div class="modal-body">
                                                                                <p>Yakin ingin menghapus users dengan nama <?= $row['first_name']?>?</p>
                                                                            </div>
                                                                            <div class="modal-footer m-auto border-top-0">
                                                                                <button type="button" class="btn btn-outline-<? $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                                <button type="submit" name="delete-users" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form></td>
                                                        <?php }?>
                                                    </tr>
                                                <?php $no++; }}?>
                                            </tbody>
                                        </table>
                                        <nav class="small mt-3" aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if(isset($page5)){if(isset($total_page5)){if($page5>1):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" href="users?page=<?= $page5-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <?php endif;?>
                                                <?php for($i=1; $i<=$total_page5; $i++):?>
                                                    <?php if($i<=5):?>
                                                        <?php if($i==$page5):?>
                                                            <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="users?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php else :?>
                                                            <li class="page-item shadow"><a class="page-link border-0" href="users?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endfor;?>
                                                <?php if($page5<$total_page5):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" href="users?page=<?= $page5+1;?>">Next</a>
                                                </li>
                                                <?php endif;}}?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Users  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>