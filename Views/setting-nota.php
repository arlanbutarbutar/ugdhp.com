<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Setting Nota";$_SESSION['page-to']="setting-nota";
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
                                        <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#new"><i class="fas fa-plus"></i> New</button>
                                        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Insert Notes Type</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <p>Masukan tipe nota jika ingin ditambahakan.</p>
                                                            <div class="form-group">
                                                                <input type="text" name="name" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Nama" required>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input type="number" name="no-nota" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Nomor nota" required>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input type="text" name="kombinasi" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Kombinasi">
                                                                <small class="text-info small <?= $colorMode?>">Memasukan karakter kombinasi hanya jika diperlukan!</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="submit-notes-type" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Buat</button>
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
                        
                        <!-- == Setting Nota == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow border-light bg-<?= $bgMode?>" style="overflow-x: auto">
                                        <div class="card-body">
                                            <table class="table table-sm text-center <?= $colorMode?>">
                                                <thead>
                                                    <tr style="border-top: hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Monor Nota</th>
                                                        <th scope="col">Kombinasi</th>
                                                        <th scope="col">Tgl Buat</th>
                                                        <?php if($_SESSION['id-access']<=2){?>
                                                        <th colspan="2">Aksi</th>
                                                        <?php }?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1; if(mysqli_num_rows($notes_type)==0){?>
                                                        <tr><td colspan="7" class="text-dark font-weight-bold">Maaf data saat ini kosong!</td></tr>
                                                    <?php }else if(mysqli_num_rows($notes_type)>0){while($row=mysqli_fetch_assoc($notes_type)){?>
                                                        <tr>
                                                            <td><?= $no?></td>
                                                            <td><?= $row['name']?></td>
                                                            <td><?= $row['no_nota']?></td>
                                                            <td><?= $row['kombinasi']?></td>
                                                            <td><?= $row['date']?></td>
                                                            <?php if($_SESSION['id-access']<=2){?>
                                                            <td scope="row">
                                                                <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_nota']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                                <div class="modal fade" id="ubah<?= $row['id_nota']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['name']?></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-nota" value="<?= $row['id_nota']?>">
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <input type="number" name="no-nota" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Nomor nota" required>
                                                                                    </div>
                                                                                    <div class="form-group mt-3">
                                                                                        <input type="text" name="kombinasi" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Kombinasi">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="edit-notes-type" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><form action="" method="POST">
                                                                <input type="hidden" name="id-nota" value="<?= $row['id_nota']?>">
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_nota']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                                <div class="modal fade" id="hapus<?= $row['id_nota']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                            <div class="modal-header border-bottom-0">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Yakin ingin menghapus <?= $row['name']?>?</p>
                                                                            </div>
                                                                            <div class="modal-footer m-auto border-top-0">
                                                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm" data-dismiss="modal">Tidak</button>
                                                                                <button type="submit" name="delete-notes-type" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                            </div>
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
                                                    <?php if(isset($page6)){if(isset($total_page6)){if($page6>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="setting-nota?page=<?= $page6-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page6; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page6):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="setting-nota?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="setting-nota?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page6<$total_page6):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="setting-nota?page=<?= $page6+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Setting Nota  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>