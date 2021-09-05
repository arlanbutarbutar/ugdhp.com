<?php $us=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['us']))));
    $us_long=strlen($us);
    if($us_long<40){
        $searchUS=mysqli_query($conn_back, "SELECT * FROM users JOIN category_services ON users.id_category=category_services.id_category JOIN users_role ON users.id_role=users_role.id_role JOIN users_status ON users.is_active=users_status.is_active JOIN users_access ON users.id_access=users_access.id_access JOIN users_tools ON users.id_tools=users_tools.id_tools WHERE users.first_name LIKE '%$us%' OR users.last_name LIKE '%$us%' OR users.email LIKE '%$us%' ORDER BY users.id_user DESC");
        if(mysqli_num_rows($searchUS)>0){?>
    <div class="row justify-content-between flex-row-reverse">
        <div class="col-md-12 mb-n3">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="<?= $colorMode?>">Data Users</h4>
                    <p class="<?= $colorMode?>">Pencarian <strong><?= $us?></strong> ditemukan!</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mt-3">
            <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                <div class="card-body">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <a href="users">
                                            <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-user-md fa-2x"></i></div>
                                        </a>
                                        <div class="d-sm-none">
                                            <h2 class="h5">Customers</h2>
                                            <h5 class="mb-1"><?= $userView?></h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h5">Customers</h2>
                                            <h5 class="mb-1"><?= $userView?></h5>
                                        </div>
                                        <small><?= $rowStartUsers?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> WorldWide</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-8 mt-3">
            <div class="card card-body border-light shadow h-100 bg-<?= $bgMode?>" style="overflow: auto">
                <table class="table table-sm <?= $colorMode?>">
                    <thead>
                        <tr style="border-top: hidden">
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Service</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Postal</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tools</th>
                            <th scope="col">Access</th>
                            <th scope="col">Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; while($rowUS=mysqli_fetch_assoc($searchUS)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td><?= $rowUS['first_name']?></td>
                            <td><?= $rowUS['last_name']?></td>
                            <td><?= $rowUS['email']?></td>
                            <td><?= $rowUS['product']?></td>
                            <td><?= $rowUS['phone']?></td>
                            <td><?= $rowUS['address']?></td>
                            <td><?= $rowUS['postal']?></td>
                            <td><?= $rowUS['role']?></td>
                            <td><?= $rowUS['status']?></td>
                            <td><?= $rowUS['tools']?></td>
                            <td><?= $rowUS['access']?></td>
                            <td><?= $rowUS['date_created']?></td>
                        </tr>
                        <?php $no++;}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><hr>
<?php }}?>
<?php $tc=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['tc']))));
    $tc_long=strlen($tc);
    if($tc_long<40){
        $searchTC=mysqli_query($conn_back, "SELECT * FROM users JOIN category_services ON users.id_category=category_services.id_category JOIN users_role ON users.id_role=users_role.id_role JOIN users_status ON users.is_active=users_status.is_active JOIN users_access ON users.id_access=users_access.id_access JOIN users_tools ON users.id_tools=users_tools.id_tools WHERE users.id_user='$tc'");
        if(mysqli_num_rows($searchTC)>0){while($rowTC=mysqli_fetch_assoc($searchTC)){
            $notesTC=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_pegawai='$tc'");
            $countRepairTC=mysqli_num_rows($notesTC);
            $notesStartTC=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_pegawai='$tc' ORDER BY id_data ASC LIMIT 1");
            $row_notesStartTC=mysqli_fetch_assoc($notesStartTC);
            $sparepartsTC=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_pegawai='$tc'");
            $countSparepartsTC=mysqli_num_rows($sparepartsTC);
            $sparepartsStartTC=mysqli_query($conn_back, "SELECT * FROM  laporan_spareparts WHERE id_pegawai='$tc' ORDER BY id_sparepart ASC LIMIT 1");
            $row_sparepartsStartTC=mysqli_fetch_assoc($sparepartsStartTC);
            $notes_searchTC=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_pegawai='$tc' ORDER BY notes.id_data DESC");
            $spareparts_searchTC=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.id_pegawai='$tc' ORDER BY laporan_spareparts.id_sparepart DESC");?>
    <div class="row justify-content-between flex-row-reverse mt-3">
        <div class="col-md-12 mb-n3">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="<?= $colorMode?>">Data Teknisi</h4>
                    <p class="<?= $colorMode?>">Pencarian <strong><?= $rowTC['first_name']?></strong> ditemukan!</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mt-3">
            <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                <div class="card-body">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <form action="" method="POST">
                                            <button type="submit" name="search-repair" class="btn btn-link">
                                                <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-tools fa-2x"></i></div>
                                            </button>
                                        </form>
                                        <div class="d-sm-none">
                                            <h2 class="h5">Repair</h2>
                                            <h5 class="mb-1"><?= $countRepairTC?></h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h5">Repair</h2>
                                            <h5 class="mb-1"><?= $countRepairTC?></h5>
                                        </div>
                                        <small><?= $row_notesStartTC['tgl_masuk']?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> WorldWide</small>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <form action="" method="POST">
                                            <button type="submit" name="search-spareparts" class="btn btn-link">
                                                <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-toolbox fa-2x"></i></div>
                                            </button>
                                        </form>
                                        <div class="d-sm-none">
                                            <h2 class="h5">Spareparts</h2>
                                            <h5 class="mb-1"><?= $countSparepartsTC?></h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h5">Spareparts</h2>
                                            <h5 class="mb-1"><?= $countSparepartsTC?></h5>
                                        </div>
                                        <small><?= $row_sparepartsStartTC['tgl_masuk']?> - Now,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> WorldWide</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-8 mt-3">
            <div class="card card-body shadow border-light bg-<?= $bgMode?>">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="../Assets/img/img-users/<?= $rowTC['img']?>" class="rounded-circle" style="width: 150px" alt="Profile <?= $rowTC['first_name']?>">
                    </div>
                    <div class="col-lg-8">
                        <h5><?= $rowTC['first_name']?> <?= $rowTC['last_name']?></h5>
                        <p class="mt-3">Email: <?= $rowTC['email']?></p>
                        <p class="mt-n3">Service: <?= $rowTC['product']?></p>
                        <p class="mt-n3">Phone: <?= $rowTC['phone']?></p>
                        <p class="mt-n3">Address: <?= $rowTC['address']?></p>
                        <p class="mt-n3">Postal: <?= $rowTC['postal']?></p>
                        <p class="mt-n3">Role: <?= $rowTC['role']?></p>
                        <p class="mt-n3">Status: <?= $rowTC['status']?></p>
                        <p class="mt-n3">Tools: <?= $rowTC['tools']?></p>
                        <p class="mt-n3">Access: <?= $rowTC['access']?></p>
                        <p class="mt-n3">Date Created: <?= $rowTC['date_created']?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($_POST['search-repair'])){?>
        <div class="col-md-12 mt-3">
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto; height: 100vh">
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Lunas</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
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
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($notes_searchTC)>0){while($row=mysqli_fetch_assoc($notes_searchTC)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td><?= $row['name']?></td>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>L<?= $row['id_nota_lunas']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['time']?></td>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="17"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php }if(isset($_POST['search-spareparts'])){?>
        <div class="col-md-12 mt-3">
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto; height: 100vh">
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Data Nota</th>
                            <th scope="col">Tgl Beli/Tgl masuk</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Sparepart</th>
                            <th scope="col">Suplayer</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total<button type="button" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" title="Jika total tidak sesuai artinya Sparepart sebelumnya mempunyai stok barang lebih dari 1."><i class="fas fa-info-circle text-info"></i></button></th>
                            <th scope="col">Ket. tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalBiaya=0; $no=1; if(mysqli_num_rows($spareparts_searchTC)>0){while($row=mysqli_fetch_assoc($spareparts_searchTC)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td class="small"><?= $row['status']?></td>
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
                            <td><?= $row['time']?></td>
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
                            <th colspan="10"></th>
                            <th>Rp. <?= number_format($totalBiaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php }?>
    </div><hr>
<?php }}}?>
<?php $nt=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['nt']))));
    $nt_long=strlen($nt);
    if($nt_long<40){
        $searchNT=mysqli_query($conn_back, "SELECT * FROM notes 
            JOIN notes_type ON notes.id_nota=notes_type.id_nota
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_nota_tinggal LIKE '%$nt%' OR notes.id_nota_dp LIKE '%$nt%' OR notes.id_nota_lunas LIKE '%$nt%' ORDER BY notes.id_data DESC");?>
    <div class="row justify-content-between flex-row-reverse mt-3">
        <div class="col-md-12 mb-n3">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="<?= $colorMode?>">Data Nota</h4>
                    <p class="<?= $colorMode?>">Pencarian nota <strong><?= $nt?></strong> ditemukan!</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-12 mt-3">
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if(mysqli_num_rows($searchNT)>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Lunas</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
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
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($searchNT)>0){while($row=mysqli_fetch_assoc($searchNT)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td><?= $row['name']?></td>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>L<?= $row['id_nota_lunas']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['time']?></td>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="17"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><hr>
<?php }?>
<?php $sp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['sp']))));
    $sp_long=strlen($sp);
    if($sp_long<40){
        if(!isset($_POST['searchSP-viewPart']) || !isset($_POST['searchSP-viewAll'])){
            $searchSP=mysqli_query($conn_back, "SELECT * FROM  laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.ket LIKE '%$sp%' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT 50");
        }if(isset($_POST['searchSP-viewPart'])){
            $searchSP=mysqli_query($conn_back, "SELECT * FROM  laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.ket LIKE '%$sp%' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT 50");
        }if(isset($_POST['searchSP-viewAll'])){
            $searchSP=mysqli_query($conn_back, "SELECT * FROM  laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.ket LIKE '%$sp%' ORDER BY laporan_spareparts.id_sparepart DESC");}?>
    <div class="row justify-content-between flex-row-reverse mt-3">
        <div class="col-md-12 mb-n3">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="<?= $colorMode?>">Data Sparepart</h4>
                    <p class="<?= $colorMode?>">Pencarian <strong><?= $sp?></strong> ditemukan!</p>
                </div>
                <div class="col-lg-6">
                    <form action="" method="POST" class="d-flex justify-content-end text-right">
                        <button type="submit" name="searchSP-viewPart" class="btn btn-link border-0"><i class="fas fa-align-center <?= $colorMode?>"></i></button>
                        <button type="submit" name="searchSP-viewAll" class="btn btn-link border-0"><i class="fas fa-align-justify <?= $colorMode?>"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-12 mt-3">
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto; height: 100vh">
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Data Nota</th>
                            <th scope="col">Tgl Beli/Tgl masuk</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Sparepart</th>
                            <th scope="col">Suplayer</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total<button type="button" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" title="Jika total tidak sesuai artinya Sparepart sebelumnya mempunyai stok barang lebih dari 1."><i class="fas fa-info-circle text-info"></i></button></th>
                            <th scope="col">Ket. tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalBiaya=0; $no=1; if(mysqli_num_rows($searchSP)>0){while($row=mysqli_fetch_assoc($searchSP)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td class="small"><?= $row['status']?></td>
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
                            <td><?= $row['time']?></td>
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
                            <th colspan="10"></th>
                            <th>Rp. <?= number_format($totalBiaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><hr>
<?php }?>
<?php $tl=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['tl']))));
    $tl_long=strlen($tl);
    if($tl_long<40){
        $notes_tinggalTL=mysqli_query($conn_back, "SELECT * FROM notes WHERE tgl_cari='$tl' AND id_nota='1' OR id_nota='2'");
        $countNotes_tinggalTL=mysqli_num_rows($notes_tinggalTL);
        $notes_lunasTL=mysqli_query($conn_back, "SELECT * FROM notes WHERE tgl_cari='$tl' AND id_nota='3'");
        $countNotes_lunasTL=mysqli_num_rows($notes_lunasTL);
        $notes_batalTL=mysqli_query($conn_back, "SELECT * FROM notes WHERE tgl_cari='$tl' AND id_nota='4'");
        $countNotes_batalTL=mysqli_num_rows($notes_batalTL);
        $report_dpTL=mysqli_query($conn_back, "SELECT * FROM notes WHERE tgl_cari='$tl' AND dp>0");
        $countReport_dpTL=mysqli_num_rows($report_dpTL);
        $report_daysTL=mysqli_query($conn_back, "SELECT * FROM notes WHERE tgl_cari='$tl' AND id_nota='5' OR id_nota='6'");
        $countReport_daysTL=mysqli_num_rows($report_daysTL);
        $report_sparepartTL=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE tgl_cari='$tl'");
        $countReport_sparepartTL=mysqli_num_rows($report_sparepartTL);?>
    <div class="row mt-3">
        <div class="col-md-12 mb-n3">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="<?= $colorMode?>">Data Tanggal</h4>
                    <p class="<?= $colorMode?>">Pencarian tgl <strong><?= $tl?></strong> ditemukan!</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <!-- == Nota Tinggal/DP & Laporan DP == -->
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-tinggalTL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-notes-medical fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Nota Tinggal/DP</h2>
                                                    <h5 class="mb-1"><?= $countNotes_tinggalTL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Nota Tinggal/DP</h2>
                                                    <h5 class="mb-1"><?= $countNotes_tinggalTL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-dpTL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Laporan DP</h2>
                                                    <h5 class="mb-1"><?= $countReport_dpTL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Laporan DP</h2>
                                                    <h5 class="mb-1"><?= $countReport_dpTL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- == Nota Lunas & Laporan Harian == -->
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-lunasTL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-receipt fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Nota Lunas</h2>
                                                    <h5 class="mb-1"><?= $countNotes_lunasTL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Nota Lunas</h2>
                                                    <h5 class="mb-1"><?= $countNotes_lunasTL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-daysTL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-calendar-day fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Laporan Harian</h2>
                                                    <h5 class="mb-1"><?= $countReport_daysTL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Laporan Harian</h2>
                                                    <h5 class="mb-1"><?= $countReport_daysTL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- == Nota Batal & Laporan Sparepart == -->
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-batalTL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-file-excel fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Nota Batal</h2>
                                                    <h5 class="mb-1"><?= $countNotes_batalTL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Nota Batal</h2>
                                                    <h5 class="mb-1"><?= $countNotes_batalTL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-sparepartTL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-clipboard-list fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Laporan Sparepart</h2>
                                                    <h5 class="mb-1"><?= $countReport_sparepartTL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Laporan Sparepart</h2>
                                                    <h5 class="mb-1"><?= $countReport_sparepartTL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-12 mt-3">
            <?php if(isset($_POST['search-tinggalTL'])){
                $search_tinggalTL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE notes.tgl_cari='$tl' AND notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_tinggalTL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countNotes_tinggalTL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Status</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_tinggalTL)>0){while($row=mysqli_fetch_assoc($search_tinggalTL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['tgl_status']?></td>
                            <td><?= $row['tgl_masuk']?></td>
                            <td><?= $row['time']?></td>
                            <td><?= $row['tgl_ambil']?></td>
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="14"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-lunasTL'])){
                $search_lunasTL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE notes.tgl_cari='$tl' AND notes.id_nota='3' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_lunasTL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countNotes_lunasTL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Status</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_lunasTL)>0){while($row=mysqli_fetch_assoc($search_lunasTL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?php $id_tek=$row['id_pegawai']; $teknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                            <td><?= $row['tgl_status']?></td>
                            <td><?= $row['tgl_masuk']?></td>
                            <td><?= $row['time']?></td>
                            <td><?= $row['tgl_ambil']?></td>
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="14"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-batalTL'])){
                $search_batalTL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE notes.tgl_cari='$tl' AND notes.id_nota='4' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_batalTL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countNotes_batalTL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Status</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_batalTL)>0){while($row=mysqli_fetch_assoc($search_batalTL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?php $id_tek=$row['id_pegawai']; $teknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                            <td><?= $row['tgl_status']?></td>
                            <td><?= $row['tgl_masuk']?></td>
                            <td><?= $row['time']?></td>
                            <td><?= $row['tgl_ambil']?></td>
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="14"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-dpTL'])){
                $search_dpTL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE notes.tgl_cari='$tl' AND notes.dp>0 ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_dpTL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countReport_dpTL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Lunas</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Lunas</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                            <th scope="col">Bukti tanpa nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_dpTL)>0){while($row=mysqli_fetch_assoc($search_dpTL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>L<?= $row['id_nota_lunas']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#bukti<?= $row['id_data']?>"><i class="fas fa-eye"></i> Lihat</button>
                                <div class="modal fade" id="bukti<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="15"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-daysTL'])){
                $search_daysTL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE notes.tgl_cari='$tl' AND notes.id_nota='5' OR notes.id_nota='6' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_daysTL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countReport_daysTL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Lunas</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
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
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_daysTL)>0){while($row=mysqli_fetch_assoc($search_daysTL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>L<?= $row['id_nota_lunas']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['time']?></td>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="16"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-sparepartTL'])){
                $search_sparepartTL=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.tgl_cari='$tl' ORDER BY laporan_spareparts.id_sparepart DESC");
                if(mysqli_num_rows($search_sparepartTL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countReport_sparepartTL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Data Nota</th>
                            <th scope="col">Tgl Beli/Tgl masuk</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Sparepart</th>
                            <th scope="col">Suplayer</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total<button type="button" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" title="Jika total tidak sesuai artinya Sparepart sebelumnya mempunyai stok barang lebih dari 1."><i class="fas fa-info-circle text-info"></i></button></th>
                            <th scope="col">Ket. tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalBiaya=0; $no=1; if(mysqli_num_rows($search_sparepartTL)>0){while($row=mysqli_fetch_assoc($search_sparepartTL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td class="small"><?= $row['status']?></td>
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
                            <td><?= $row['time']?></td>
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
                            <th colspan="10"></th>
                            <th>Rp. <?= number_format($totalBiaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}?>
        </div>
    </div>
<?php }?>
<?php $bl=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['bl']))));
    $bl_long=strlen($bl);
    if($bl_long<40){
        $notes_tinggalBL=mysqli_query($conn_back, "SELECT * FROM notes WHERE date_format(tgl_cari, '%Y-%m')='$bl' AND id_nota='1' OR id_nota='2'");
        $countNotes_tinggalBL=mysqli_num_rows($notes_tinggalBL);
        $notes_lunasBL=mysqli_query($conn_back, "SELECT * FROM notes WHERE date_format(tgl_cari, '%Y-%m')='$bl' AND id_nota='3'");
        $countNotes_lunasBL=mysqli_num_rows($notes_lunasBL);
        $notes_batalBL=mysqli_query($conn_back, "SELECT * FROM notes WHERE date_format(tgl_cari, '%Y-%m')='$bl' AND id_nota='4'");
        $countNotes_batalBL=mysqli_num_rows($notes_batalBL);
        $report_dpBL=mysqli_query($conn_back, "SELECT * FROM notes WHERE date_format(tgl_cari, '%Y-%m')='$bl' AND dp>0");
        $countReport_dpBL=mysqli_num_rows($report_dpBL);
        $report_daysBL=mysqli_query($conn_back, "SELECT * FROM notes WHERE date_format(tgl_cari, '%Y-%m')='$bl' AND id_nota='5' OR id_nota='6'");
        $countReport_daysBL=mysqli_num_rows($report_daysBL);
        $report_sparepartBL=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE date_format(tgl_cari, '%Y-%m')='$bl'");
        $countReport_sparepartBL=mysqli_num_rows($report_sparepartBL);?>
    <div class="row mt-3">
        <div class="col-md-12 mb-n3">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="<?= $colorMode?>">Data Bulan</h4>
                    <p class="<?= $colorMode?>">Pencarian bln <strong><?= $bl?></strong> ditemukan!</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <!-- == Nota Tinggal/DP & Laporan DP == -->
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-tinggalBL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-notes-medical fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Nota Tinggal/DP</h2>
                                                    <h5 class="mb-1"><?= $countNotes_tinggalBL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Nota Tinggal/DP</h2>
                                                    <h5 class="mb-1"><?= $countNotes_tinggalBL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-dpBL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Laporan DP</h2>
                                                    <h5 class="mb-1"><?= $countReport_dpBL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Laporan DP</h2>
                                                    <h5 class="mb-1"><?= $countReport_dpBL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- == Nota Lunas & Laporan Harian == -->
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-lunasBL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-receipt fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Nota Lunas</h2>
                                                    <h5 class="mb-1"><?= $countNotes_lunasBL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Nota Lunas</h2>
                                                    <h5 class="mb-1"><?= $countNotes_lunasBL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-daysBL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-calendar-day fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Laporan Harian</h2>
                                                    <h5 class="mb-1"><?= $countReport_daysBL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Laporan Harian</h2>
                                                    <h5 class="mb-1"><?= $countReport_daysBL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- == Nota Batal & Laporan Sparepart == -->
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card border-light shadow bg-<?= $bgMode?> <?= $colorMode?>">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-batalBL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-file-excel fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Nota Batal</h2>
                                                    <h5 class="mb-1"><?= $countNotes_batalBL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Nota Batal</h2>
                                                    <h5 class="mb-1"><?= $countNotes_batalBL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <form action="" method="POST">
                                                    <button type="submit" name="search-sparepartBL" class="btn btn-link">
                                                        <div class="icon icon-shape icon-md icon-shape-blue mr-4 mr-sm-0 round"><i class="fas fa-clipboard-list fa-2x"></i></div>
                                                    </button>
                                                </form>
                                                <div class="d-sm-none">
                                                    <h2 class="h5">Laporan Sparepart</h2>
                                                    <h5 class="mb-1"><?= $countReport_sparepartBL?></h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h5">Laporan Sparepart</h2>
                                                    <h5 class="mb-1"><?= $countReport_sparepartBL?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-12 mt-3">
            <?php if(isset($_POST['search-tinggalBL'])){
                $search_tinggalBL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE date_format(notes.tgl_cari, '%Y-%m')='$bl' AND notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_tinggalBL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countNotes_tinggalBL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Status</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_tinggalBL)>0){while($row=mysqli_fetch_assoc($search_tinggalBL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-tible" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['tgl_status']?></td>
                            <td><?= $row['tgl_masuk']?></td>
                            <td><?= $row['time']?></td>
                            <td><?= $row['tgl_ambil']?></td>
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="14"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-lunasBL'])){
                $search_lunasBL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE date_format(notes.tgl_cari, '%Y-%m')='$bl' AND notes.id_nota='3' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_lunasBL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countNotes_lunasBL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Status</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_lunasBL)>0){while($row=mysqli_fetch_assoc($search_lunasBL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?php $id_tek=$row['id_pegawai']; $teknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                            <td><?= $row['tgl_status']?></td>
                            <td><?= $row['tgl_masuk']?></td>
                            <td><?= $row['time']?></td>
                            <td><?= $row['tgl_ambil']?></td>
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="14"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-batalBL'])){
                $search_batalBL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE date_format(notes.tgl_cari, '%Y-%m')='$bl' AND notes.id_nota='4' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_batalBL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countNotes_batalBL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Status</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_batalBL)>0){while($row=mysqli_fetch_assoc($search_batalBL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?php $id_tek=$row['id_pegawai']; $teknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                            <td><?= $row['tgl_status']?></td>
                            <td><?= $row['tgl_masuk']?></td>
                            <td><?= $row['time']?></td>
                            <td><?= $row['tgl_ambil']?></td>
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="14"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-dpBL'])){
                $search_dpBL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE date_format(notes.tgl_cari, '%Y-%m')='$bl' AND notes.dp>0 ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_dpBL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countReport_dpBL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Lunas</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Tgl Lunas</th>
                            <th scope="col">Tgl Ambil</th>
                            <th scope="col">Kerusakan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Kelengkapan</th>
                            <th scope="col">DP</th>
                            <th scope="col">Biaya</th>
                            <th scope="col">Bukti tanpa nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_dpBL)>0){while($row=mysqli_fetch_assoc($search_dpBL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>L<?= $row['id_nota_lunas']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['kerusakan']?></td>
                            <td><?= $row['kondisi']?></td>
                            <td><?= $row['kelengkapan']?></td>
                            <td>Rp. <?= number_format($row['dp'])?></td>
                            <td>Rp. <?= number_format($row['biaya'])?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#bukti<?= $row['id_data']?>"><i class="fas fa-eye"></i> Lihat</button>
                                <div class="modal fade" id="bukti<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="15"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-daysBL'])){
                $search_daysBL=mysqli_query($conn_back, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user JOIN category_services ON notes.id_layanan=category_services.id_category JOIN notes_status ON notes.id_status=notes_status.id_status WHERE date_format(notes.tgl_cari, '%Y-%m')='$bl' AND notes.id_nota='5' OR notes.id_nota='6' ORDER BY notes.id_data DESC");
                if(mysqli_num_rows($search_daysBL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countReport_daysBL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">#Nota Tinggal</th>
                            <th scope="col">#Nota DP</th>
                            <th scope="col">#Nota Lunas</th>
                            <th scope="col">#Nota Garansi</th>
                            <th scope="col">QR/Barcode</th>
                            <th scope="col">Client</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Waktu Masuk</th>
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
                        <?php $total_dp=0; $total_biaya=0; $no=1; if(mysqli_num_rows($search_daysBL)>0){while($row=mysqli_fetch_assoc($search_daysBL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td>T<?= $row['id_nota_tinggal']?></td>
                            <td>DP<?= $row['id_nota_dp']?></td>
                            <td>L<?= $row['id_nota_lunas']?></td>
                            <td>
                                <?php if(!empty($row['nota_garansi'])){?>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#data-garansi<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['nota_garansi']?></button>
                                <div class="modal fade" id="data-garansi<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Garansi Nota <?= $row['nota_garansi']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $nota_garansi=preg_replace("/[^0-9]/","",$row['nota_garansi']);$dataGaransi=mysqli_query($conn_back, "SELECT * FROM notes JOIN category_services ON notes.id_layanan=category_services.id_category WHERE id_nota_tinggal='$nota_garansi' OR id_nota_dp='$nota_garansi' OR id_nota_lunas='$nota_garansi'");$rowG=mysqli_fetch_assoc($dataGaransi);?>
                                                <h6 class="card-title">Nota <?= "T".$rowG['id_nota_tinggal']."|DP".$rowG['id_nota_dp']."|L".$rowG['id_nota_lunas']?></h6>
                                                <?php $id_barang=$rowG['id_barang'];if($rowG['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($rowG['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $rowG['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$rowG['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                                <i class="fas fa-angle-double-down fa-2x"></i>
                                                <h6 class="card-title mt-3">Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h6>
                                                <?php $id_barang=$row['id_barang'];if($row['id_layanan']==1){$hp=mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($hp as $rowHP):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowHP['type']." (".$rowHP['seri']."|".$rowHP['imei'].")"?></p>
                                                <?php endforeach;}else if($row['id_layanan']==2){$laptop=mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $rowLaptop):?>
                                                <p class="card-text"><?= $row['product']." - ".$rowLaptop['merek']." (".$rowLaptop['seri'].")"?></p>
                                                <?php endforeach;} $id_userSP=$row['id_user']; $spare=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userSP'"); if(mysqli_num_rows($spare)==0){?>
                                                <p class="card-text">Sparepart belum ada.</p>
                                                <?php }else if(mysqli_num_rows($spare)>0){while($rowSP=mysqli_fetch_assoc($spare)){?>
                                                <p class="card-text">Sparepart: <?= $rowSP['ket']." (".$rowSP['suplayer'].")"?></p>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_data']?>"><i class="fas fa-qrcode"></i></button>
                                <div class="modal fade" id="barcode<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Barcode T<?= $row['id_nota_tinggal']?> | DP<?= $row['id_nota_dp']?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body" id="print">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                                <img src="../Assets/img/img-qrcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 40%">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                                            <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                            <td><?= $row['time']?></td>
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
                                        <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
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
                        </tr>
                        <?php $total_dp += $row['dp']; $total_biaya += $row['biaya']; $no++; }}if($_SESSION['id-role']<=2){?>
                        <tr>
                            <th>Total</th>
                            <th colspan="16"></th>
                            <th>Rp. <?= number_format($total_dp)?></th>
                            <th>Rp. <?= number_format($total_biaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}if(isset($_POST['search-sparepartBL'])){
                $search_sparepartBL=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE date_format(laporan_spareparts.tgl_cari, '%Y-%m')='$bl' ORDER BY laporan_spareparts.id_sparepart DESC");
                if(mysqli_num_rows($search_sparepartBL)>0){?>
            <div class="card card-body border-light shadow bg-<?= $bgMode?>" style="overflow-x: auto;" <?php if($countReport_sparepartBL>10){?>style="height: 100vh"<?php }?>>
                <table class="table table-sm text-center <?= $colorMode?>">
                    <thead>
                        <tr style="border-top:hidden">
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Data Nota</th>
                            <th scope="col">Tgl Beli/Tgl masuk</th>
                            <th scope="col">Teknisi</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Sparepart</th>
                            <th scope="col">Suplayer</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total<button type="button" class="btn btn-link btn-sm shadow" data-toggle="tooltip" data-placement="top" tible="Jika total tidak sesuai artinya Sparepart sebelumnya mempunyai stok barang lebih dari 1."><i class="fas fa-info-circle text-info"></i></button></th>
                            <th scope="col">Ket. tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalBiaya=0; $no=1; if(mysqli_num_rows($search_sparepartBL)>0){while($row=mysqli_fetch_assoc($search_sparepartBL)){?>
                        <tr>
                            <th scope="row"><?= $no;?></th>
                            <td class="small"><?= $row['status']?></td>
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
                            <td><?= $row['time']?></td>
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
                            <th colspan="10"></th>
                            <th>Rp. <?= number_format($totalBiaya)?></th>
                            <th></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <?php }}?>
        </div>
    </div>
<?php }?>