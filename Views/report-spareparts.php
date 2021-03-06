<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Laporan Spareparts";$_SESSION['page-to']="report-spareparts";
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
                                    <div class="d-sm-flex align-items-center justify-content-between flex-wrap flex-md-nowrap mb-4">
                                        <small class="mb-0 <?= $colorMode?>"><i class="fas fa-angle-right"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-right"></i> <?= $_SESSION['page-name']?></small>
                                        <div class="d-flex flex-nowrap">

                                            <!-- == Aksi Cepat == -->
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <button type="submit" name="stok-sparepart" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" title="Gunakan fitur View Stock Fast untuk melihat stok dengan cepat."><i class="fas fa-box-open text-info"></i></button>
                                                    </div>
                                                </form>
                                                <form action="" method="POST">
                                                    <div class="form-group ml-2">
                                                        <button type="submit" name="pakai-sparepart" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" title="Gunakan fitur View Used Fast untuk melihat data yang telah terpakai."><i class="fas fa-map-pin text-info"></i></button>
                                                    </div>
                                                </form>
                                            <!-- == end of Aksi Cepat == -->

                                            <!-- == Search == -->
                                                <button type="button" class="btn btn-info btn-sm shadow ml-2" data-toggle="modal" data-target="#search"><i class="fas fa-search"></i> Search</button>
                                                <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Find what you're looking for</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <select name="id-status" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                            <option>Pilih Status</option>
                                                                            <?php foreach($statusSparepart as $rowSt):?>
                                                                            <option value="<?= $rowSt['id_status']?>"><?= $rowSt['status']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-status-sparepart"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="sparepart" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Cari...">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-sparepart"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <label for="tgl-pembelian">Tanggal Pembelian</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="date" name="date" id="tgl-pembelian" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Date">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-date-sparepart"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <label for="rentang-tanggal1">Rentang Tanggal</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="row">
                                                                            <div class="col-lg-5">
                                                                                <input type="date" name="date1" id="rentang-tanggal1" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Date Start">
                                                                            </div>
                                                                            <div class="col-lg-5">
                                                                                <input type="date" name="date2" id="rentang-tanggal2" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Date End">
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <button class="btn btn-outline-info" type="submit" name="search-dateLn-sparepart"><i class="fas fa-search"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <label for="rentang-tanggal1">Teknisi & Bulan</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="row">
                                                                            <div class="col-lg-5">
                                                                                <select name="id-pegawai" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                    <option>Pilih Teknisi</option>
                                                                                    <?php foreach($selectTech as $rowTech):?>
                                                                                    <option value="<?= $rowTech['id_user']?>"><?= $rowTech['first_name']?></option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-lg-5">
                                                                                <input type="month" name="month" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Date End">
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <button class="btn btn-outline-info" type="submit" name="search-temonth-sparepart"><i class="fas fa-search"></i></button>
                                                                            </div>
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
                                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Masukan Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <p>Masukan data Spareparts.</p>
                                                                    <div class="row">
                                                                        <div class="col-lg-10">
                                                                            <div class="form-group">
                                                                                <select name="suplayer" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                    <option>Pilih Penyuplai</option>
                                                                                    <?php foreach($supplier1 as $row_sp):?>
                                                                                    <option value="<?= $row_sp['supplier']?>"><?= $row_sp['supplier']?></option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="form-group">
                                                                                <button type="button" class="btn btn-outline-<?= $btnMode?> shadow ml-n3" data-toggle="modal" data-target="#tambah-suplayer"><i class="fas fa-plus"></i></button>
                                                                                <button type="button" class="btn btn-link btn-sm ml-n1" data-toggle="tooltip" data-placement="top" title="Jika sparepart yg ingin kamu masukan tidak ada dalam daftar, kamu bisa menambahkannya! data akan masuk namun tetap akan dicek admin 2/48."><i class="fas fa-question-circle text-info"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <input type="text" name="ket" placeholder="Sparepart" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <input type="number" name="jumlah" placeholder="Jumlah barang" class="form-control bg-<?= $bgMode?> <?= $colorMode?> mt-3">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <input type="number" name="harga" placeholder="Harga (per biji)" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <textarea name="ket-plus" cols="30" rows="5" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Keterangan tambahan" style="resize: none"></textarea>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-lg-4 m-auto">
                                                                            <div class="form-group text-center">
                                                                                <label>Tgl pembelian</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-8">
                                                                            <div class="form-group">
                                                                                <input type="date" name="tgl-beli" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="submit-sparepart" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Tambah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of New == -->
                                            
                                            <!-- == New Sparepart == -->
                                                <div class="modal fade" id="tambah-suplayer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                            <div class="modal-header border-bottom-0">
                                                                <h5 class="modal-title" id="exampleModalLabel">Suplayer Baru</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <input type="text" name="suplayer" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Suplayer Baru" required>
                                                                </div>
                                                                <div class="modal-footer border-top-0 justify-content-center">
                                                                    <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="tambah-suplayer" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Tambah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of New Sparepart == -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Report Spareparts == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow border-light bg-<?= $bgMode?>" style="overflow-x: auto">
                                        <div class="card-body">
                                            <table class="table table-sm text-center <?= $colorMode?>">
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Status</th>
                                                        <th colspan="3">Aksi</th>
                                                        <th scope="col">Barcode</th>
                                                        <th scope="col">Data Nota</th>
                                                        <th scope="col">Tgl Beli/Tgl masuk</th>
                                                        <th scope="col">Teknisi</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu</th>
                                                        <?php }?>
                                                        <th scope="col">Sparepart</th>
                                                        <th scope="col">Suplayer</th>
                                                        <th scope="col">Jumlah Barang</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col">Total<button type="button" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" title="Jika total tidak sesuai artinya Sparepart sebelumnya mempunyai stok barang lebih dari 1."><i class="fas fa-info-circle text-info"></i></button></th>
                                                        <th scope="col">Ket. tambahan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $totalBiaya=0; $no=1; if(mysqli_num_rows($reportSpareparts)==0){?>
                                                    <tr>
                                                        <th colspan="<?php if($_SESSION['id-role']<=2){?>16<?php }else{?>15<?php }?>">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($reportSpareparts)>0){while($row=mysqli_fetch_assoc($reportSpareparts)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td class="small"><?= $row['status']?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_sparepart']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                            <div class="modal fade" id="ubah<?= $row['id_sparepart']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data <?= $row['ket']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                            <input type="hidden" name="tgl-cari" value="<?= $row['tgl_cari']?>">
                                                                            <div class="modal-body text-center">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="ket" value="<?= $row['ket']?>" placeholder="Sparepart" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <select name="suplayer" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                        <option>Pilih Penyuplai</option>
                                                                                        <?php foreach($supplier2 as $row_sp):?>
                                                                                        <option value="<?= $row_sp['supplier']?>"><?= $row_sp['supplier']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <input type="number" name="jumlah" value="<?= $row['jmlh_barang']?>" placeholder="Jumlah barang" class="form-control bg-<?= $bgMode?> <?= $colorMode?> mt-3">
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <input type="number" name="harga" value="<?= $row['harga']?>" placeholder="Harga (per biji)" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                                                </div>
                                                                                <div class="form-group mt-3">
                                                                                    <textarea name="ket-plus" cols="30" rows="5" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Keterangan tambahan" style="resize: none"><?= $row['ket_plus']?></textarea>
                                                                                </div>
                                                                                <div class="row mt-3">
                                                                                    <div class="col-lg-4 m-auto">
                                                                                        <div class="form-group text-center">
                                                                                            <label>Tgl pembelian</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="form-group">
                                                                                            <input type="date" name="tgl-beli" value="<?= $row['tgl_beli']?>" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                                <button type="submit" name="edit-sparepart" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus<?= $row['id_sparepart']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="hapus<?= $row['id_sparepart']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <p class="text-center">Yakin ingin menghapus data <?= $row['ket']?>?</p>
                                                                        </div>
                                                                        <div class="modal-footer border-top-0 m-auto">
                                                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                                <input type="hidden" name="qrcode" value="<?= $row['qrcode']?>">
                                                                                <button type="submit" name="delete-sparepart" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php if($row['status_sparepart']==1){?>
                                                            <a href="select-note?ids=<?= $row['id_sparepart']?>&jb=<?= $row['jmlh_barang']?>" class="btn btn-warning btn-sm shadow"><i class="fas fa-notes-medical"></i> Nota</a>
                                                            <?php }else if($row['status_sparepart']==2){?>
                                                            <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#lapor<?= $row['id_sparepart']?>"><i class="fas fa-book-medical"></i> Lapor</button>
                                                            <div class="modal fade" id="lapor<?= $row['id_sparepart']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <p class="text-center">Silakan pilih tombol dibawah ini.<br>Jika sparepart yang dipakai batal maka tekan batal <br> dan jika dipakai tekan lapor.</p>
                                                                        </div>
                                                                        <div class="modal-footer border-top-0 m-auto">
                                                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                                <input type="hidden" name="qrcode" value="<?= $row['qrcode']?>">
                                                                                <button type="submit" name="sparepartBatal" class="btn btn-danger btn-sm shadow ml-1"><i class="far fa-times-circle"></i> Batal</button>
                                                                                <button type="submit" name="sparepartDipakai" class="btn btn-success btn-sm shadow ml-2"><i class="fas fa-plus"></i> Lapor</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_sparepart']?>"><i class="fas fa-qrcode"></i></button>
                                                            <div class="modal fade" id="barcode<?= $row['id_sparepart']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Barcode <?= $row['ket']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <img src="../Assets/img/img-qrcode-spareparts/<?= $row['qrcode']?>" alt="Barcode <?= $row['ket']?>" style="width: 200px" id="print">
                                                                        </div>
                                                                        <div class="modal-footer border-top-0 m-auto">
                                                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                                <input type="hidden" name="qrcode-old" value="<?= $row['qrcode']?>">
                                                                                <button type="submit" name="remake-qrcode" class="btn btn-outline-warning btn-sm shadow"><i class="fas fa-undo"></i> re-Qrcode</button>
                                                                            </form>
                                                                            <button type="button" name="print-now" class="btn btn-success btn-sm shadow" onClick="window.print();"><i class="fas fa-print"></i> Print Now</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#dataNota<?= $row['id_sparepart']?>"><i class="fas fa-eye"></i> View</button>
                                                            <?php if(!empty($row['id_nota'])){?>
                                                            <div class="modal fade" id="dataNota<?= $row['id_sparepart']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <?php $id_userSp=$row['id_user'];
                                                                            $notes_sp=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_user='$id_userSp'");
                                                                            if(mysqli_num_rows($notes_sp)>0){$row_sp=mysqli_fetch_assoc($notes_sp);
                                                                            ?>
                                                                            <p class="font-weight-bold h4">T<?= $row_sp['id_nota_tinggal']?> | DP<?= $row_sp['id_nota_dp']?> | L<?= $row_sp['id_nota_lunas']?></p>
                                                                            <p>Biaya DP Rp. <?= number_format($row_sp['dp'])?></p>
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </td>
                                                        <td><?= $row['tgl_beli'].'/'.$row['tgl_masuk']?></td><td><?php $id_pegawai=$row['id_pegawai'];
                                                            if($id_pegawai>0){
                                                                $usersTeknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_pegawai'");
                                                                $rowTek=mysqli_fetch_assoc($usersTeknisi);
                                                                echo $rowTek['first_name'];
                                                            }else if($id_pegawai==0){
                                                                echo "Belum ada";
                                                            }
                                                        ?></td>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><?= $row['ket']?></td>
                                                        <td><?= $row['suplayer']?></td>
                                                        <td><?= $row['jmlh_barang']?></td>
                                                        <td>Rp. <?= number_format($row['harga'])?></td>
                                                        <td>Rp. <?php $total=number_format($row['jmlh_barang']*$row['harga']);echo $total;?></td>
                                                        <td><?= $row['ket_plus']?></td>
                                                    </tr>
                                                    <?php $totalBiaya += $row['jmlh_barang']*$row['harga']; $no++; }}if($_SESSION['id-role']<=2){?>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th colspan="13"></th>
                                                        <th>Rp. <?= number_format($totalBiaya)?></th>
                                                        <th></th>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                            <nav class="small mt-3" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page13)){if(isset($total_page13)){if($page13>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="report-spareparts?page=<?= $page13-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page13; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page13):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="report-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="report-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page13<$total_page13):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="report-spareparts?page=<?= $page13+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Report Spareparts  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>