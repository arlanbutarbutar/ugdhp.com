<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Laporan Pengeluaran";$_SESSION['page-to']="report-expense";
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
                                        <div>

                                            <!-- == Search == -->
                                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#search"><i class="fas fa-search"></i> Search</button>
                                                <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Find what you're looking for</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="expense" class="form-control" placeholder="Cari">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-expense"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="date" name="date" class="form-control" placeholder="Cari">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-date-expense"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of Search == -->
    
                                            <!-- == New == -->
                                                <button type="button" class="btn btn-success btn-sm shadow ml-2" data-toggle="modal" data-target="#new"><i class="fas fa-plus"></i> New</button>
                                                <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Masukan Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <p>Masukan data pengeluaran.</p>
                                                                    <div class='form-group'>
                                                                        <input type="text" name="jenis" placeholder="Jenis Pengeluaran" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <input type="text" name="ket" placeholder="Keterangan" class="form-control text-center">
                                                                        <small class="text-info">Jika ada!</small>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <input type="number" name="biaya" placeholder="Biaya" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="submit-expense" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Lapor</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of New == -->
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Report Expense == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow" style="overflow-x: auto">
                                        <div class="card-body">
                                            <table class="table table-sm text-center">
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Jenis Pengeluaran</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Biaya</th>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu</th>
                                                        <?php }?>
                                                        <th colspan="2">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $total_pengeluaran=0; $no=1; if(mysqli_num_rows($report_expense)==0){?>
                                                    <tr>
                                                        <th colspan="<?php if($_SESSION['id-role']<=2){?>8<?php }else{?>7<?php }?>">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($report_expense)>0){while($row=mysqli_fetch_assoc($report_expense)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td><?= $row['jenis_pengeluaran']?></td>
                                                        <td><?= $row['ket']?></td>
                                                        <td>Rp. <?= number_format($row['biaya_pengeluaran'])?></td>
                                                        <td><?= $row['tgl_pengeluaran']?></td>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_pengeluaran']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                            <div class="modal fade" id="ubah<?= $row['id_pengeluaran']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['jenis_pengeluaran']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                                                                            <input type="hidden" name="tgl-cari" value="<?= $row['tgl_cari']?>">
                                                                            <div class="modal-body">
                                                                                <div class='form-group'>
                                                                                    <input type="text" name="jenis" value="<?= $row['jenis_pengeluaran']?>" placeholder="Jenis Pengeluaran" class="form-control text-center" required>
                                                                                    <small class="text-danger">Wajib*</small>
                                                                                </div>
                                                                                <div class='form-group'>
                                                                                    <input type="text" name="ket" value="<?= $row['ket']?>" placeholder="Keterangan" class="form-control text-center">
                                                                                    <small class="text-info">Jika ada!</small>
                                                                                </div>
                                                                                <div class='form-group'>
                                                                                    <input type="number" name="biaya" value="<?= $row['biaya_pengeluaran']?>" placeholder="Biaya" class="form-control text-center" required>
                                                                                    <small class="text-danger">Wajib*</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer border-0 m-auto">
                                                                                <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                                <button type="submit" name="edit-expense" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#delete<?= $row['id_pengeluaran']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="delete<?= $row['id_pengeluaran']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Yakin ingin menghapus <?= $row['jenis_pengeluaran']?>?</p>
                                                                        </div>
                                                                        <div class="modal-footer border-0 m-auto">
                                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                                                                                <input type="hidden" name="tgl-cari" value="<?= $row['tgl_cari']?>">
                                                                                <button type="submit" name="delete-expense" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php $total_pengeluaran += $row['biaya_pengeluaran']; $no++; }}?>
                                                </tbody>
                                            </table>
                                            <nav class="small mt-3" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page12)){if(isset($total_page12)){if($page12>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="report-expense?page=<?= $page12-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page12; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page12):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="report-expense?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="report-expense?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page12<$total_page12):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="report-expense?page=<?= $page12+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Report Expense == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>