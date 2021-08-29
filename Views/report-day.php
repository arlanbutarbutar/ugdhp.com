<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Laporan Harian";$_SESSION['page-to']="report-day";
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
                                                                <p class="text-center">Silakan masukan kata yang ingin dicari di salah satu form pencarian</p>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" name="note" class="form-control" placeholder="Cari Nota">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-nota-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <?php if($_SESSION['id-role']==3){if($_SESSION['id-category']==1){?>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="hp" class="form-control" placeholder="Cari handphone">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-hp-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <?php }if($_SESSION['id-category']==2){?>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="laptop" class="form-control" placeholder="Cari laptop">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-laptop-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <?php }}else if($_SESSION['id-role']!=3){?>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="hp" class="form-control" placeholder="Cari handphone">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-hp-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="laptop" class="form-control" placeholder="Cari laptop">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-laptop-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <?php }?>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="date" name="tgl" class="form-control" placeholder="Tanggal">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-date-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="month" name="bulan" class="form-control" placeholder="Bulan">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-month-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <select name="id-teknisi" class="form-control">
                                                                            <option>Pilih Teknisi</option>
                                                                            <?php foreach($selectTech as $rowTech):?>
                                                                            <option value="<?= $rowTech['id_user']?>"><?= $rowTech['first_name']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-tech-report"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of Search == -->
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Report Days == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow" style="overflow-x: auto">
                                        <div class="card-body">
                                            <table class="table table-sm text-center">
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">#Nota Tinggal</th>
                                                        <th scope="col">#Nota DP</th>
                                                        <th scope="col">#Nota Lunas</th>
                                                        <th scope="col">QR/Barcode</th>
                                                        <th scope="col">Client</th>
                                                        <th scope="col">Layanan</th>
                                                        <th scope="col">Teknisi</th>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu Masuk</th>
                                                        <?php }?>
                                                        <th scope="col">Tgl Lunas</th>
                                                        <th scope="col">Tgl Ambil</th>
                                                        <th scope="col">Tgl Laporan</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Kelengkapan</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">Biaya</th>
                                                        <th scope="col">Bukti tanpa nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($report_days)==0){?>
                                                    <tr>
                                                        <th colspan="<?php if($_SESSION['id-role']<=2){?>18<?php }else{?>16<?php }?>">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($report_days)>0){while($row=mysqli_fetch_assoc($report_days)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td>T<?= $row['id_nota_tinggal']?></td>
                                                        <td>DP<?= $row['id_nota_dp']?></td>
                                                        <td>L<?= $row['id_nota_lunas']?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                                            <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body" id="print">
                                                                            <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                                            <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                                <input type="hidden" name="barcode-old" value="<?= $row['barcode']?>">
                                                                                <button type="submit" name="remake-barcode" class="btn btn-outline-warning btn-sm shadow"><i class="fas fa-undo"></i> re-Barcode</button>
                                                                            </form>
                                                                            <button type="button" name="print-now" class="btn btn-success btn-sm shadow" onClick="window.print();"><i class="fas fa-print"></i> Print Now</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#users<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['first_name']?></button>
                                                            <div class="modal fade" id="users<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Users T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Nama Depan: <?= $row['first_name']?></p>
                                                                            <p>Nama Belakang: <?= $row['last_name']?></p>
                                                                            <p>No. Tlpn: <?= $row['phone']?></p>
                                                                            <p>Email: <?= $row['email']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php $id_barang=$row['id_barang']; if($row['id_layanan']==1){
                                                            $handphone=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($handphone as $row_hp):?>
                                                            <td>
                                                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#handphone<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['product']?></button>
                                                                <div class="modal fade" id="handphone<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Handphone T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Type: <?= $row_hp['type']?></p>
                                                                                <p>Seri: <?= $row_hp['seri']?></p>
                                                                                <p>Imei: <?= $row_hp['imei']?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php endforeach;}if($row['id_layanan']==2){
                                                            $laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $row_laptop):?>
                                                            <td>
                                                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#laptop<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['product']?></button>
                                                                <div class="modal fade" id="laptop<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Laptop T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Type: <?= $row_laptop['merek']?></p>
                                                                                <p>Seri: <?= $row_laptop['seri']?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php endforeach;}?>
                                                        <td><?php $id_tek=$row['id_pegawai'];
                                                            $teknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><?= $row['tgl_lunas']?></td>
                                                        <td><?= $row['tgl_ambil']?></td>
                                                        <td><?= $row['tgl_laporan']?></td>
                                                        <td><?= $row['kerusakan']?></td>
                                                        <td><?= $row['kondisi']?></td>
                                                        <td><?= $row['kelengkapan']?></td>
                                                        <td>Rp. <?= number_format($row['dp'])?></td>
                                                        <td>Rp. <?= number_format($row['biaya'])?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#bukti<?= $row['id_data']?>"><i class="fas fa-eye"></i> Lihat</button>
                                                            <div class="modal fade" id="bukti<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Bukti tanpa nota T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img src="../Assets/img/img-notes/<?= $row['ket_img']?>" alt="Bukti Lunas" class="img-fluid">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}?>
                                                </tbody>
                                            </table>
                                            <nav class="small mt-3" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page11)){if(isset($total_page11)){if($page11>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="report-day?page=<?= $page11-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page11; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page11):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="report-day?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="report-day?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page11<$total_page11):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="report-day?page=<?= $page11+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Report Days  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>