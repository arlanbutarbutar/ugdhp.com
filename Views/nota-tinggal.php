<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="Nota Tinggal";$_SESSION['page-to']="nota-tinggal";
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
                                                                        <input type="number" name="note" class="form-control" placeholder="Cari Nota Tinggal">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-nota-tinggal"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="hp" class="form-control" placeholder="Cari handphone">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-hp-tinggal"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="laptop" class="form-control" placeholder="Cari laptop">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-laptop-tinggal"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <form action="" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <input type="date" name="tgl" class="form-control" placeholder="Tanggal">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-info border-top-left-radius-0 border-bottom-left-radius-0" type="submit" name="search-date-tinggal"><i class="fas fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of Search == -->
    
                                            <?php if($_SESSION['id-role']<=3){?>
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
                                                                    <p>Masukan data untuk nota tinggal ataupun nota dp disini.</p>
                                                                    <div class='form-group'>
                                                                        <input type="number" name="nota-tinggal" placeholder="Nomor nota tinggal" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="number" name="nota-dp" placeholder="Nomor nota dp" class="form-control text-center">
                                                                        <small class="text-info">Jika ada isikan!</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="text" name="username" placeholder="Nama pengguna" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="email" name="email" placeholder="Alamat email" class="form-control text-center">
                                                                        <small class="text-info">Jika diinginkan!</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="number" name="tlpn" placeholder="Nomor hp/tlpn" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="text" name="alamat" placeholder="Alamat" class="form-control text-center">
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <select name="id-layanan" class="form-control" required>
                                                                            <option>Pilih layanan</option>
                                                                            <?php foreach($category_services as $row_layanan):?>
                                                                                <option value="<?= $row_layanan['id_category']?>"><?= $row_layanan['product']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class="row mt-3 text-center">
                                                                        <h6 class="font-weight-bold"><span class="badge bg-warning">Perhatian!</span> Mengisi sesui dengan layanan yang dipilih!</h6>
                                                                        <div class="col-lg-6">
                                                                            <button class="btn btn-link btn-sm font-weight-bold" type="button" data-toggle="collapse" data-target="#handphone" aria-expanded="false" aria-controls="handphone">Handphone</button>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <button class="btn btn-link btn-sm font-weight-bold" type="button" data-toggle="collapse" data-target="#laptop" aria-expanded="false" aria-controls="laptop">Laptop</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="collapse" id="handphone">
                                                                        <div class="form-group mt-3">
                                                                            <input type="text" name="type" placeholder="Type" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <input type="text" name="seri-hp" placeholder="Seri" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <input type="text" name="imei" placeholder="Imei" class="form-control text-center">
                                                                        </div>
                                                                    </div>
                                                                    <div class="collapse" id="laptop">
                                                                        <div class="form-group mt-3">
                                                                            <input type="text" name="merek" placeholder="Merek" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <input type="text" name="seri-laptop" placeholder="Seri" class="form-control text-center">
                                                                        </div>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="text" name="kerusakan" placeholder="Kerusakan" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="text" name="kondisi" placeholder="Kondisi" class="form-control text-center">
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="text" name="kelengkapan" placeholder="Kelengkapan" class="form-control text-center">
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <select name="id-teknisi" class="form-control" required>
                                                                            <option>Pilih teknisi</option>
                                                                            <?php foreach($users_teknisi as $row_teknisi):?>
                                                                                <option value="<?= $row_teknisi['id_user']?>"><?= $row_teknisi['first_name']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>   
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <label for="tgl-ambil">Tgl Ambil</label>
                                                                        <input type="date" name="tgl-ambil" id="tgl-ambil" class="form-control text-center">
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="number" name="dp" placeholder="DP" class="form-control text-center">
                                                                        <small class="text-info">Jika ada nota dp!</small>
                                                                    </div>
                                                                    <div class='form-group mt-3'>
                                                                        <input type="number" name="biaya" placeholder="Biaya" class="form-control text-center" required>
                                                                        <small class="text-danger">Wajib*</small>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="submit-notes" class="btn btn-success btn-sm shadow"><i class="fas fa-plus"></i> Repair</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- == end of New == -->
                                            <?php }?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->

                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <!-- == Nota Tinggal == -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow" style="overflow-x: auto">
                                        <div class="card-body">
                                            <table class="table table-sm text-center">
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">#</th>
                                                        <?php if($_SESSION['id-role']<=3 && $_SESSION['id-access']<=2){?>
                                                        <th colspan="2">Aksi</th>
                                                        <?php }?>
                                                        <th scope="col">#Nota Tinggal</th>
                                                        <th scope="col">#Nota DP</th>
                                                        <th scope="col">QR/Barcode</th>
                                                        <th scope="col">Client</th>
                                                        <th scope="col">Layanan</th>
                                                        <th scope="col">Teknisi</th>
                                                        <?php if($_SESSION['id-role']<=3){?>
                                                        <th scope="col">Status</th>
                                                        <?php }if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Tgl Status</th>
                                                        <?php }?>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu Masuk</th>
                                                        <?php }?>
                                                        <th scope="col">Tgl Ambil</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Kelengkapan</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">Biaya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($notes_views_all)==0){?>
                                                    <tr>
                                                        <th colspan="<?php if($_SESSION['id-role']<=2){?>18<?php }else{?>16<?php }?>">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($notes_views_all)>0){while($row=mysqli_fetch_assoc($notes_views_all)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <?php if($_SESSION['id-role']<=3 && $_SESSION['id-access']<=2){?>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah<?= $row['id_data']?>"><i class="fas fa-pen"></i> Ubah</button>
                                                            <div class="modal fade" id="ubah<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah data T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <input type="hidden" name="id-data" value="<?= $row['id_data']?>">
                                                                            <input type="hidden" name="id-barang" value="<?= $row['id_barang']?>">
                                                                            <input type="hidden" name="id-nota-tinggal-old" value="<?= $row['id_nota_tinggal']?>">
                                                                            <input type="hidden" name="id-nota-dp-old" value="<?= $row['id_nota_dp']?>">
                                                                            <div class="modal-body">
                                                                                <div class='form-group'>
                                                                                    <input type="number" name="nota-tinggal" value="<?= $row['id_nota_tinggal']?>" placeholder="Nomor nota tinggal" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <input type="number" name="nota-dp" value="<?= $row['id_nota_dp']?>" placeholder="Nomor nota dp" class="form-control text-center">
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <select name="id-layanan" class="form-control" required>
                                                                                        <option>Pilih layanan</option>
                                                                                        <?php foreach($category_services as $row_layanan):?>
                                                                                            <option value="<?= $row_layanan['id_category']?>"><?= $row_layanan['product']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="row mt-3 text-center">
                                                                                    <h6 class="font-weight-bold"><span class="badge bg-warning">Perhatian!</span> Mengisi sesui dengan layanan yang dipilih!</h6>
                                                                                    <div class="col-lg-6">
                                                                                        <button class="btn btn-link btn-sm font-weight-bold" type="button" data-toggle="collapse" data-target="#handphone" aria-expanded="false" aria-controls="handphone">Handphone</button>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <button class="btn btn-link btn-sm font-weight-bold" type="button" data-toggle="collapse" data-target="#laptop" aria-expanded="false" aria-controls="laptop">Laptop</button>
                                                                                    </div>
                                                                                </div>
                                                                                <?php $id_barang=$row['id_barang']; if($row['id_layanan']==1){
                                                                                $handphone=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                                <div class="collapse" id="handphone">
                                                                                    <div class="form-group mt-3">
                                                                                        <input type="text" name="type" value="<?= $row_hp['type']?>" placeholder="Type" class="form-control text-center">
                                                                                    </div>
                                                                                    <div class="form-group mt-3">
                                                                                        <input type="text" name="seri-hp" value="<?= $row_hp['seri']?>" placeholder="Seri" class="form-control text-center">
                                                                                    </div>
                                                                                    <div class="form-group mt-3">
                                                                                        <input type="text" name="imei" value="<?= $row_hp['imei']?>" placeholder="Imei" class="form-control text-center">
                                                                                    </div>
                                                                                </div>
                                                                                <?php }else if($row['id_layanan']==2){
                                                                                $laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
                                                                                <div class="collapse" id="laptop">
                                                                                    <div class="form-group mt-3">
                                                                                        <input type="text" name="merek" value="<?= $row_laptop['merek']?>" placeholder="Merek" class="form-control text-center">
                                                                                    </div>
                                                                                    <div class="form-group mt-3">
                                                                                        <input type="text" name="seri-laptop" value="<?= $row_laptop['seri']?>" placeholder="Seri" class="form-control text-center">
                                                                                    </div>
                                                                                </div>
                                                                                <?php }?>
                                                                                <div class='form-group mt-3'>
                                                                                    <input type="text" name="kerusakan" value="<?= $row['kerusakan']?>" placeholder="Kerusakan" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <input type="text" name="kondisi" value="<?= $row['kondisi']?>" placeholder="Kondisi" class="form-control text-center">
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <input type="text" name="kelengkapan" value="<?= $row['kelengkapan']?>" placeholder="Kelengkapan" class="form-control text-center">
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <select name="id-teknisi" class="form-control" required>
                                                                                        <option>Pilih teknisi</option>
                                                                                        <?php foreach($users_teknisi as $row_teknisi):?>
                                                                                            <option value="<?= $row_teknisi['id_user']?>"><?= $row_teknisi['first_name']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <label for="tgl-ambil">Tgl Ambil</label>
                                                                                    <input type="date" name="tgl-ambil" value="<?= $row['tgl_ambil']?>" id="tgl-ambil" class="form-control text-center">
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <input type="number" name="dp" value="<?= $row['dp']?>" placeholder="DP" class="form-control text-center">
                                                                                </div>
                                                                                <div class='form-group mt-3'>
                                                                                    <input type="number" name="biaya" value="<?= $row['biaya']?>" placeholder="Biaya" class="form-control text-center" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Batal</button>
                                                                                <button type="submit" name="edit-notes" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#delete<?= $row['id_data']?>"><i class="fas fa-trash"></i> Hapus</button>
                                                            <div class="modal fade" id="delete<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Yakin ingin menghapus nota dengan nomor T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?>?</p>
                                                                        </div>
                                                                        <div class="modal-footer border-0 m-auto">
                                                                            <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-data" value="<?= $row['id_data']?>">
                                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                                <input type="hidden" name="id-barang" value="<?= $row['id_barang']?>">
                                                                                <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                                                                <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                                                                                <button type="submit" name="delete-notes" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php }?>
                                                        <td>T<?= $row['id_nota_tinggal']?></td>
                                                        <td>DP<?= $row['id_nota_dp']?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                                            <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" id="print" style="width: 40%">
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
                                                        <?php if($_SESSION['id-role']<=3){?>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#status<?= $row['id_data']?>" style="width: 100px"><i class="fas fa-star-half"></i> <marquee behavior="" width="60" direction="left" scrolldelay="300" class="m-auto"><?= $row['status']?></marquee></button>
                                                            <div class="modal fade" id="status<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Status T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="" method="POST">
                                                                            <input type="hidden" name="id-data" value="<?= $row['id_data']?>">
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <select name="id-status" class="form-control">
                                                                                        <option>Pilih Status</option>
                                                                                        <?php foreach($notesStatus as $row_status):?>
                                                                                        <option value="<?= $row_status['id_status']?>"><?= $row_status['status']?></option>
                                                                                        <?php endforeach;?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Keluar</button>
                                                                                <button type="submit" name="ubah-status-NT" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php }if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row['tgl_status']?></td>
                                                        <?php }?>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><?= $row['tgl_ambil']?></td>
                                                        <td><?= $row['kerusakan']?></td>
                                                        <td><?= $row['kondisi']?></td>
                                                        <td><?= $row['kelengkapan']?></td>
                                                        <td>Rp. <?= number_format($row['dp'])?></td>
                                                        <td>Rp. <?= number_format($row['biaya'])?></td>
                                                    <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}?>
                                                </tbody>
                                            </table>
                                            <nav class="small mt-3" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page7)){if(isset($total_page7)){if($page7>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="nota-tinggal?page=<?= $page7-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page7; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page7):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" href="nota-tinggal?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="nota-tinggal?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page7<$total_page7):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" href="nota-tinggal?page=<?= $page7+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Nota Tinggal  == -->

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>